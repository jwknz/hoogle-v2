<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;
use WPDeveloper\BetterDocs\Traits\CategoryBox as CategoryBoxTraits;

class CategoryBox extends Block {
    use CategoryBoxTraits;

    protected $editor_styles = [
        'betterdocs-fontawesome',
        'betterdocs-blocks-editor',
        'betterdocs-blocks-category-box'
    ];

    protected $frontend_styles = [
        'betterdocs-fontawesome',
        'betterdocs-blocks-category-box',
        'betterdocs-docs'
    ];

    /**
     * unique name of block
     * @return string
     */
    public function get_name() {
        return 'categorybox';
    }

    public function get_default_attributes() {
        return [
            'blockId'             => '',
            'categories'          => [],
            'selectKB'            => '',
            'includeCategories'   => '',
            'excludeCategories'   => '',
            'boxPerPage'          => 9,
            'orderBy'             => 'name',
            'order'               => 'asc',
            'layout'              => 'default',
            'showIcon'            => true,
            'showTitle'           => true,
            'titleTag'            => 'h2',
            'showCount'           => true,
            'prefix'              => '',
            'suffix'              => __( 'Docs', 'betterdocs' ),
            'suffixSingular'      => __( 'Doc', 'betterdocs' ),
            'colRange'            => 3,
            'TABcolRange'         => 2,
            'MOBcolRange'         => 1,
            'layout4Col'          => 4,
            'showLastUpdatedTime' => true
        ];
    }

    public function view_params() {
        $attributes = &$this->attributes;

        $terms_object = [
            'taxonomy'   => 'doc_category',
            'order'      => $attributes['order'],
            'orderby'    => $attributes['orderBy'],
            'number'     => isset( $attributes['boxPerPage'] ) ? $attributes['boxPerPage'] : 5,
            'hide_empty' => true
        ];

        if ( 'doc_category_order' === $attributes['orderBy'] ) {
            $terms_object['meta_key'] = 'doc_category_order';
            $terms_object['orderby']  = 'meta_value_num';
        }

        $includes = $this->string_to_array( $attributes['includeCategories'] );
        $excludes = $this->string_to_array( $attributes['excludeCategories'] );
        $styles   = '';

        if ( ! empty( $includes ) ) {
            $terms_object['include'] = array_diff( $includes, (array) $excludes );
        }

        if ( ! empty( $excludes ) ) {
            $terms_object['exclude'] = $excludes;
        }

        $_wrapper_classes = [
            'betterdocs-category-box-wrapper',
            'betterdocs-blocks-grid',
            'betterdocs-box-' . $attributes['layout']
        ];

        $_inner_wrapper_classes = [
            'betterdocs-category-box-inner-wrapper',
            'layout-flex',
            $attributes['layout'] === 'default' ? 'layout-1' : $attributes['layout'],
            "betterdocs-column-" . $attributes['colRange'],
            "betterdocs-column-tablet-" . $attributes['TABcolRange'],
            "betterdocs-column-mobile-" . $attributes['MOBcolRange']
        ];

        if ( $attributes['layout'] == 'layout-4' ) {
            $_inner_wrapper_classes = [
                'betterdocs-category-box-inner-wrapper',
                'layout-4',
                'docs-col-4',
                'single-kb',
                'betterdocs-categories-folder',
                'layout-4',
                'single-kb'
            ];
            $column     = is_tax( 'doc_category' ) ? 3 : $attributes['layout4Col'];
            $term_count = $this->get_terms_count_conditionally( $terms_object );
            $reminder   = $term_count % $column;
            $styles .= "--column: $column;";
            $styles .= "--count: $term_count;";
            $styles .= "--reminder: $reminder;";
        }

        $wrapper_attr = [
            'class' => $_wrapper_classes
        ];

        $inner_wrapper_attr = [
            'class'               => $_inner_wrapper_classes,
            'style'               => $styles,
            'data-column_desktop' => $attributes['colRange'],
            'data-column_tab'     => $attributes['TABcolRange'],
            'data-column_mobile'  => $attributes['MOBcolRange']
        ];

        $default_multiple_kb = betterdocs()->settings->get( 'multiple_kb' );
        $kb_slug             = ! empty( $attributes['selectKB'] ) && isset( $attributes['selectKB'] ) ? json_decode( $attributes['selectKB'] )->value : '';

        if ( is_tax( 'knowledge_base' ) && $default_multiple_kb == 1 ) {
            $object                     = get_queried_object();
            $terms_object['meta_query'] = [
                'relation' => 'OR',
                [
                    'key'     => 'doc_category_knowledge_base',
                    'value'   => $object->slug,
                    'compare' => 'LIKE'
                ]
            ];
        }

        if ( ! empty( $kb_slug ) ) {
            $terms_object['meta_query'] = [
                'relation' => 'OR',
                [
                    'key'     => 'doc_category_knowledge_base',
                    'value'   => $kb_slug,
                    'compare' => 'LIKE'
                ]
            ];
        }

        $_params = [
            'wrapper_attr'            => $wrapper_attr,
            'inner_wrapper_attr'      => $inner_wrapper_attr,
            'terms_query_args'        => betterdocs()->query->terms_query( $terms_object ),
            'widget_type'             => 'category-box',
            'multiple_knowledge_base' => $default_multiple_kb,
            'nested_subcategory'      => false,
            'show_header'             => true,
            'show_description'        => false
        ];

        if ( $attributes['layout'] === 'layout-2' ) {
            $_params['count_prefix']          = '';
            $_params['count_suffix']          = '';
            $_params['count_suffix_singular'] = '';
        }

        if ( $attributes['layout'] == 'layout-4' ) {
            $column                   = is_tax( 'doc_category' ) ? 3 : $attributes['layout4Col'];
            $term_count               = $this->get_terms_count_conditionally( $terms_object );
            $reminder                 = $term_count % $column;
            $_params['show_icon']     = $this->attributes['showIcon'];
            $_params['show_count']    = $this->attributes['showCount'];
            $_params['total_terms']   = $term_count;
            $_params['reminder']      = $reminder;
            $_params['category_icon'] = 'folder';
            $_params['last_update']   = $this->attributes['showLastUpdatedTime'];
            $_params['taxonomy']      = 'doc_category';
            $_params['column']        = $column;
            unset( $_params['inner_wrapper_attr']['data-column_desktop'] ); //not needed for layout 4
            unset( $_params['inner_wrapper_attr']['data-column_tab'] ); // not needed for layout 4
            unset( $_params['inner_wrapper_attr']['data-column_mobile'] ); // not needed for layout 4
        }

        return $_params;
    }

    public function render( $attributes, $content ) {
        $_eligible = ( $attributes['layout'] == 'layout-2' || $attributes['layout'] == 'layout-3' || $attributes['layout'] == 'layout-4' );

        if ( $attributes['layout'] == 'layout-4' ) {
            add_filter( 'betterdocs_layout_filename', [$this, 'change_to_layout_four'], 15, 3 );
        }

        if( $attributes['layout'] == 'layout-4' && is_tax('doc_category') ) {
            add_filter('betterdocs_base_terms_args', [$this, 'render_child_terms'], 10, 1);
            add_filter('betterdocs_terms_query_args', [$this, 'modify_terms_params'], 10, 2);
        }

        $this->add_filter( $_eligible );
        $this->views( 'layouts/base' );
        $this->remove_filter( $_eligible );
    }

    public function change_to_layout_four() {
        return 'layout-4';
    }

    /**
     * Modify Terms Params Based On Doc Category Page
     *
     * @param array $_query_args
     * @param array $_origin_args
     * @return bool|array
     */
    public function modify_terms_params($_query_args, $_origin_args) {
        $current_category_id = get_queried_object() != null ? get_queried_object()->term_id : '';
        $count               = count( betterdocs()->query->get_all_child_term_ids( 'doc_category', $current_category_id ) );
        if( $count == 0 ) {
            return false;
        }
        return $_query_args;
    }

    /**
     * Render The Current Block Child Terms On Doc Category Page
     *
     * @param array $args
     * @return array
     */
    public function render_child_terms($args) {
        $current_category_id = get_queried_object() != null ? get_queried_object()->term_id : '';
        $_nested_categories  = betterdocs()->query->get_child_term_ids_by_parent_id( 'doc_category', $current_category_id );
        if( ! empty( $_nested_categories ) ) {
            $args['include'] = $_nested_categories;
        }
        return $args;
    }

    /**
     * Get the term count based on doc_category page or other page
     *
     * @param array $term_params
     *
     * @return int
     */
    public function get_terms_count_conditionally( $term_params ) {
        $count = 0;

        if ( is_tax( 'doc_category' ) ) {
            $current_category_id = get_queried_object() != null ? get_queried_object()->term_id : '';
            $count               = count( betterdocs()->query->get_all_child_term_ids( 'doc_category', $current_category_id ) );
        } else {
            $count = count( get_terms( $term_params ) );
        }

        return $count;
    }
}
