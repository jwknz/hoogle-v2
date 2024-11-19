<?php
namespace WPDeveloper\BetterDocs\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

#[\AllowDynamicProperties]
class CSVExporter {
    private static $default_args = [
		'content'    => 'docs',
		'author'     => false,
		'category'   => false,
		'start_date' => false,
		'end_date'   => false,
		'status'     => false,
		'offset'     => 0,
		'limit'      => -1,
		'meta_query' => [], // If specified `meta_key` then will include all post(s) that have this meta_key.
		'query_args' => []
	];

	/**
	 * @var array
	 */
	private $args;

	/**
	 * @var wpdb
	 */
	private $wpdb;

    public function __construct( array $args = [] ) {
		global $wpdb;

		$this->args = wp_parse_args( $args, self::$default_args );

		$this->wpdb = $wpdb;
	}

    public function combine_csv_data($csv_data_array) {
        // Combine headers
        $headers_combined = $csv_data_array[0][0];

        foreach ($csv_data_array as $csv_data) {
            $headers_combined = array_merge($headers_combined, array_slice($csv_data[0], 1));
        }

        $csv_data_combined = [$headers_combined];

        // Combine data
        for ($i = 1; $i < count($csv_data_array[0]); $i++) {
            $combined_row = [];
            foreach ($csv_data_array as $csv_data) {
                $combined_row = array_merge($combined_row, array_fill(0, count($csv_data_combined[0]) - count($combined_row)), [$csv_data[$i][0]], array_slice($csv_data[$i], 1));
            }
            $csv_data_combined[] = $combined_row;
        }

        return $csv_data_combined;
    }


    public function run(): array {
        $allowed_post_types = ['docs', 'betterdocs_faq'];

        if ($this->args['content'] === 'glossaries') {
            return $this->handle_glossaries_export();
        }

        if (!in_array($this->args['content'], $allowed_post_types)) {
            return [];
        }

        $where = $this->wpdb->prepare(
            "{$this->wpdb->posts}.post_type = %s",
            $this->args['content']
        );

        if ($this->args['status']) {
            $where .= $this->wpdb->prepare(
                " AND {$this->wpdb->posts}.post_status = %s",
                $this->args['status']
            );
        } else {
            $where .= " AND {$this->wpdb->posts}.post_status != 'auto-draft'";
        }

        if (!empty($this->args['post__in'])) {
            $post_in = $this->args['post__in'];
            $ids_placeholder = implode(', ', array_fill(0, count($post_in), '%d'));
            $where .= $this->wpdb->prepare(
                " AND {$this->wpdb->posts}.ID IN ($ids_placeholder)",
                $post_in
            );
        }

        $join = '';

        if (isset($this->args['category_terms'])) {
            $join = "INNER JOIN {$this->wpdb->term_relationships} ON ({$this->wpdb->posts}.ID = {$this->wpdb->term_relationships}.object_id)";
            $tax_terms = [];

            // Handle doc categories
            foreach ($this->args['category_terms'] as $term_slug) {
                $term = get_term_by('slug', $term_slug, 'doc_category');
                if ($term) {
                    $tax_terms[] = $term->term_taxonomy_id;
                }
            }

            if (!empty($tax_terms)) {
                $tax_placeholder = implode(', ', array_fill(0, count($tax_terms), '%d'));
                $where .= $this->wpdb->prepare(
                    " AND {$this->wpdb->term_relationships}.term_taxonomy_id IN ($tax_placeholder)",
                    $tax_terms
                );
            }
        } elseif (isset($this->args['kb_terms'])) {
            $join = "INNER JOIN {$this->wpdb->term_relationships} ON ({$this->wpdb->posts}.ID = {$this->wpdb->term_relationships}.object_id)";
            foreach ($this->args['kb_terms'] as $term_slug) {
                $term = get_term_by('slug', $term_slug, 'knowledge_base');
                if ($term) {
                    $where .= $this->wpdb->prepare(
                        " AND {$this->wpdb->term_relationships}.term_taxonomy_id = %d",
                        $term->term_taxonomy_id
                    );
                }
            }
        }

        if ($this->args['author']) {
            $where .= $this->wpdb->prepare(
                " AND {$this->wpdb->posts}.post_author = %d",
                $this->args['author']
            );
        }

        if ($this->args['start_date']) {
            $where .= $this->wpdb->prepare(
                " AND {$this->wpdb->posts}.post_date >= %s",
                gmdate('Y-m-d', strtotime($this->args['start_date']))
            );
        }

        if ($this->args['end_date']) {
            $where .= $this->wpdb->prepare(
                " AND {$this->wpdb->posts}.post_date < %s",
                gmdate('Y-m-d', strtotime('+1 month', strtotime($this->args['end_date'])))
            );
        }

        if (!empty($this->args['meta_query'])) {
            $meta_query = new \WP_Meta_Query($this->args['meta_query']);
            $query_clauses = $meta_query->get_sql('post', $this->wpdb->posts, 'ID');

            $join .= ' ' . $query_clauses['join'];
            $where .= ' ' . $query_clauses['where'];
        }

        // Get post IDs
        $post_ids = $this->wpdb->get_col("SELECT ID FROM {$this->wpdb->posts} $join WHERE $where");

        // Add FAQ post IDs if include_faq is true
        if (!empty($this->args['include_faq'])) {
            $faq_ids = get_posts([
                'post_type'      => 'betterdocs_faq',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'post_status'    => 'publish'
            ]);
            $post_ids = array_merge($post_ids, $faq_ids);
        }

        if (empty($post_ids)) {
            return [
                'success' => false,
                'message' => 'No posts found matching the criteria.'
            ];
        }

        // Get posts data
        $posts = array_map('get_post', $post_ids);

        // Prepare CSV data
        $csv_data_terms = $this->get_terms_csv_data($post_ids);
        $csv_data_author = $this->authors_list($post_ids);
        $csv_data_posts = $this->get_posts_csv_data($posts);

        // Combine headers
        $headers_combined = array_merge(
            $csv_data_posts[0],
            array_slice($csv_data_author[0], 1),
            array_slice($csv_data_terms[0], 1)
        );

        // Initialize the combined array with headers
        $csv_data_combined = [$headers_combined];

        // Combine posts data
        for ($i = 1; $i < count($csv_data_posts); $i++) {
            $combined_row = array_merge(
                $csv_data_posts[$i],
                array_fill(0, count($headers_combined) - count($csv_data_posts[$i]), '')
            );
            $csv_data_combined[] = $combined_row;
        }

        // Combine author data
        $author_start_index = count($csv_data_posts[0]);
        for ($i = 1; $i < count($csv_data_author); $i++) {
            $combined_row = array_merge(
                [$csv_data_author[$i][0]],
                array_fill(1, $author_start_index - 1, ''),
                array_slice($csv_data_author[$i], 1)
            );
            $csv_data_combined[] = $combined_row;
        }

        // Combine terms data
        $terms_start_index = $author_start_index + count($csv_data_author[0]) - 1;
        for ($i = 1; $i < count($csv_data_terms); $i++) {
            $combined_row = array_merge(
                [$csv_data_terms[$i][0]],
                array_fill(1, $terms_start_index - 1, ''),
                array_slice($csv_data_terms[$i], 1)
            );
            $csv_data_combined[] = $combined_row;
        }

        $filename = 'betterdocs.' . date('Y-m-d') . '.csv';
        $csv_content = $this->generate_csv($csv_data_combined);

        return [
            'success' => true,
            'data' => [
                'filename' => $filename,
                'filetype' => 'text/csv',
                'download' => $csv_content,
            ]
        ];
    }

    /**
     * Retrieve terms associated with the specified object IDs and sort them based on term meta.
     *
     * @param array $post_ids An array of object IDs.
     * @return array An array of WP_Term objects sorted based on term meta.
     */
	private function get_terms( array $post_ids, $include_faq = false ) {
        $post_types = [
            'docs'
        ];

        if( $include_faq ) {
            array_push($post_types, 'betterdocs_faq');
        }

        // Get the object taxonomies
        $taxonomies = get_object_taxonomies( $post_types );

        // Get the object terms with parent terms coming before their child terms
        $terms = wp_get_object_terms( $post_ids, $taxonomies);

        usort( $terms, array( $this, 'compare_terms_by_meta' ) );

		return $terms;
	}

    /**
     * Compare terms based on their associated term meta values.
     *
     * @param WP_Term $a The first term object.
     * @param WP_Term $b The second term object.
     * @return int Returns a negative value if $a is less than $b,
     *             a positive value if $a is greater than $b, or 0 if they are equal.
     *             Additionally, prioritize sorting terms by taxonomy order,
     *             with 'doc_category' terms appearing before other taxonomy terms.
     */
    public function compare_terms_by_meta($a, $b) {
        // Define the order of taxonomies
        $taxonomy_order = array(
            'doc_category' => 0,
            'knowledge_base' => 1,
            'doc_tag' => 2,
        );

        // Get the taxonomy order for terms $a and $b
        $order_a = isset($taxonomy_order[$a->taxonomy]) ? $taxonomy_order[$a->taxonomy] : PHP_INT_MAX;
        $order_b = isset($taxonomy_order[$b->taxonomy]) ? $taxonomy_order[$b->taxonomy] : PHP_INT_MAX;

        // If the taxonomies have different order, sort by order
        if ($order_a !== $order_b) {
            return $order_a - $order_b;
        }

        // If the taxonomies have the same order, sort by meta value
        $taxonomy_order_meta = array(
            'doc_category' => 'doc_category_order',
            'knowledge_base' => 'kb_order'
        );

        if (isset($taxonomy_order_meta[$a->taxonomy]) && isset($taxonomy_order_meta[$b->taxonomy])) {
            $meta_a = intval(get_term_meta($a->term_id, $taxonomy_order_meta[$a->taxonomy], true));
            $meta_b = intval(get_term_meta($b->term_id, $taxonomy_order_meta[$b->taxonomy], true));

            return $meta_a - $meta_b;
        }

        return 0; // Default to no sorting if meta keys are not defined
    }

    /**
     * Sorting function for sorting term data.
     *
     * @param array $a The first array to compare.
     * @param array $b The second array to compare.
     *
     * @return int Returns an integer less than, equal to, or greater than zero if the first array is considered
     *             to be respectively less than, equal to, or greater than the second.
     */
    public function sort_terms($a, $b) {
        // Compare parent values
        $parentComparison = strcmp($a[7], $b[7]);

        // If parent values are equal, compare Term ID values
        return ($parentComparison === 0) ? strcmp($a[2], $b[2]) : $parentComparison;
    }

    private function get_terms_csv_data( $post_ids ) {
        $csv_data_terms = [];

        // Add CSV headers for terms
        $csv_data_terms[] = [
            'Type',
            'Taxonomy',
            'Term ID',
            'Term name',
            'Term slug',
            'Term group',
            'Term description',
            'Term parent',
            'Assigned Docs',
            'Assigned KBs',
            'Doc Category order',
            'KB order', // Add additional term meta headers here
        ];

        if( $this->args['content'] == 'glossaries' ) {
            $terms = get_terms([
                'taxonomy'   => 'glossaries',
                'hide_empty' => false,
            ]);
        } else{
            $terms = $this->get_terms( $post_ids, $this->args['include_faq'] );
        }
        foreach ( $terms as $term ) {
            $term_meta = '';

            // Add term meta based on taxonomy
            switch ($term->taxonomy) {
                case 'doc_category':
                    $doc_category_knowledge_base = maybe_unserialize(get_term_meta($term->term_id, 'doc_category_knowledge_base', true));
                    if (is_array($doc_category_knowledge_base) && $doc_category_knowledge_base !== false) {
                        $doc_category_knowledge_base = implode(', ', array_filter($doc_category_knowledge_base));
                    } else {
                        $doc_category_knowledge_base = '';
                    }

                    $term_meta = [
                        '_docs_order' => get_term_meta($term->term_id, '_docs_order', true),
                        'doc_category_knowledge_base' => $doc_category_knowledge_base,
                        'doc_category_order' => get_term_meta($term->term_id, 'doc_category_order', true),
                    ];
                    break;

                case 'knowledge_base':
                    $term_meta = [
                        'kb_order' => get_term_meta($term->term_id, 'kb_order', true),
                    ];
                    break;
            }

            $parent = $term->parent ? get_term_by('id', $term->parent, $term->taxonomy) : '';
            // Add CSV row for term
            $csv_data_terms[] = [
                'Term',
                $term->taxonomy,
                $term->term_id,
                $term->name,
                $term->slug,
                $term->term_group,
                $term->description,
                $parent ? $parent->slug : '',
                isset($term_meta['_docs_order']) ? $term_meta['_docs_order'] : '',
                isset($term_meta['doc_category_knowledge_base']) ? $term_meta['doc_category_knowledge_base'] : '',
                isset($term_meta['doc_category_order']) ? $term_meta['doc_category_order'] : '',
                isset($term_meta['kb_order']) ? $term_meta['kb_order'] : '',
            ];
        }

        return $csv_data_terms;
    }

    private function handle_glossaries_export(): array {
        if ( isset( $this->args['glossary_terms'] ) && ( count( $this->args['glossary_terms'] ) > 0 ) ) {
            $glossary_term_ids = [];
            foreach( $this->args['glossary_terms'] as $glossary_slug ) {
                $term_object = get_term_by('slug', $glossary_slug , 'glossaries');
                if( isset( $term_object->term_id ) && ! empty( $term_object->term_id ) ){
                    array_push($glossary_term_ids, $term_object->term_id);
                }
            }
        } else {
            $glossary_term_ids = $this->wpdb->get_col( "SELECT term_id from {$this->wpdb->term_taxonomy} where taxonomy='{$this->args['content']}';" );
        }

        $filename = 'betterdocs.' . date('Y-m-d') . '.csv';
        $csv_data_combined = $this->get_glossaries_csv_data($glossary_term_ids);
        $csv_content = $this->generate_csv($csv_data_combined);

        return [
            'success' => true,
            'data' => [
                'filename' => $filename,
                'filetype' => 'text/csv',
                'download' => $csv_content,
            ],
        ];
    }

    private function get_glossaries_csv_data( $post_ids ) {
        $csv_data_terms = [];

        // Add CSV headers for terms
        $csv_data_terms[] = [
            'Taxonomy',
            'Term ID',
            'Term name',
            'Term slug',
            'Term group',
            'Term description'
        ];

        if( $this->args['content'] == 'glossaries' ) {
            $terms = get_terms([
                'taxonomy'   => 'glossaries',
                'hide_empty' => false,
            ]);
        } else{
            $terms = $this->get_terms( $post_ids, $this->args['include_faq'] );
        }
        foreach ( $terms as $term ) {
            // Add CSV row for term
            $csv_data_terms[] = [
                $term->taxonomy,
                $term->term_id,
                $term->name,
                $term->slug,
                $term->term_group,
                $term->description
            ];
        }

        return $csv_data_terms;
    }

    /**
	 * Return list of authors with posts.
	 *
	 * @param int[] $post_ids Optional. Array of post IDs to filter the query by.
	 *
	 * @return string
	 */
	private function authors_list( $post_ids ) {
		$authors = [];

        // Add CSV headers for terms
        $authors[] = [
            'Type',
            'Author id',
            'Author login',
            'Author email',
            'Author display name',
            'Author first name',
            'Author last name'
        ];

		if ( ! empty( $post_ids ) ) {
			$post_ids = array_map( 'absint', $post_ids );
			$and      = 'AND ID IN ( ' . implode( ', ', $post_ids ) . ')';
		} else {
			$and = '';
		}
        $authors_data = [];
		$results = $this->wpdb->get_results( "SELECT DISTINCT post_author FROM {$this->wpdb->posts} WHERE post_status != 'auto-draft' $and" );// phpcs:ignore
		foreach ( (array) $results as $r ) {
			$authors_data[] = get_userdata( $r->post_author );
		}

		$authors_data = array_filter( $authors_data );

		foreach ( $authors_data as $author ) {
            $authors[] = [
                'Author',
                $author->ID,
                $author->user_login,
                $author->user_email,
                $author->display_name,
                $author->first_name,
                $author->last_name
            ];
		}

		return $authors;
	}

    private function get_posts_csv_data($posts) {
        $csv_data_posts = [];

        // Add CSV headers for posts
        $csv_data_posts[] = [
            'Type',
            'Docs ID',
            'Docs author',
            'Docs date',
            'Docs date gmt',
            'Docs title',
            'Docs content',
            'Docs excerpt',
            'Docs status',
            'Docs password',
            'Docs slug',
            'Docs modified date',
            'Docs modified date gmt',
            'Docs parent',
            'Docs menu order',
            'Docs mime type',
            'Comment count',
            'Doc Categories',
            'Doc Tags',
            'Knowledge Bases',
            'Docs attachement url',
            'Docs attachement ID'
        ];

        foreach ($posts as $post) {
            $attachment_id = get_post_thumbnail_id($post->ID);
            $attachment_url = get_the_post_thumbnail_url($post->ID);
            // Add CSV row for post
            $csv_data_posts[] = [
                $post->post_type == 'betterdocs_faq' ? 'FAQ' : 'Docs',
                $post->ID,
                $post->post_author,
                $post->post_date,
                $post->post_date_gmt,
                $post->post_title,
                $post->post_content,
                $post->post_excerpt,
                $post->post_status,
                $post->post_password,
                $post->post_name,
                $post->post_modified,
                $post->post_modified_gmt,
                $post->post_parent,
                $post->menu_order,
                $post->post_mime_type,
                $post->comment_count,
                $this->get_term_ids( $post->ID, 'doc_category' ),
                $this->get_term_ids( $post->ID, 'doc_tag' ),
                $this->get_term_ids( $post->ID, 'knowledge_base' ),
                $attachment_url ? $attachment_url : '',
                $attachment_id ? $attachment_id : ''
            ];

        }

        return $csv_data_posts;
    }

    public function get_term_ids($post_id, $taxonomy) {
        $terms = get_the_terms($post_id, $taxonomy);

        if ($terms && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            return implode(', ', $term_ids);
        }

        return '';
    }

    private function generate_csv(array $data): string {
        ob_start();

        $output = fopen('php://output', 'w');

        // Add CSV rows
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);

        return ob_get_clean();
    }
}
