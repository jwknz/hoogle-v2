<?php

namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Blocks;

use WPDeveloper\BetterDocs\Editors\BlockEditor\Block;

class Sidebar extends Block {

    public $view_wrapper = 'betterdocs-toc-block';

    protected $editor_styles = [
        'betterdocs-sidebar',
        'betterdocs-search-modal',
        'betterdocs-extend-search-modal'
    ];

    protected $frontend_styles = [
        'betterdocs-sidebar',
        'betterdocs-fontawesome'
    ];

    protected $frontend_scripts = [
        'betterdocs',
        'betterdocs-category-grid',
        'betterdocs-search-modal'
    ];

    public function get_name() {
        return 'sidebar';
    }

    public function register_scripts() {
        if ( function_exists( 'betterdocs_pro' ) ) { // get the sidebar modal on gutenberg edit mode
            betterdocs_pro()->assets->enqueue( 'betterdocs-extend-search-modal', 'public/js/extend-search-modal.js', [] );
        }
        $this->assets_manager->enqueue(
            'betterdocs-search-modal', 'shortcodes/js/search-modal.js', ['jquery']
        );
    }

    public function get_default_attributes() {
        return [
            'blockId'                       => '',
            'sidebar_layout'                => 'layout-1',
            'selectKB'                      => '',
            'includeCategories'             => '',
            'excludeCategories'             => '',
            'terms_per_page'                => -1,
            'terms_order'                   => 'asc',
            'terms_orderby'                 => 'doc_category_order',
            'docs_per_page'                 => -1,
            'docs_orderby'                  => 'title',
            'docs_order'                    => 'asc',
            'enableNestedSubcategory'       => false,
            'docs_per_subcategory'          => 10,
            'titleTag'                      => 'h1',
            'show_count'                    => false,
            'enableStickyTOC'               => false,
            'listIcon'                      => '',
            'listIconImageUrl'              => '',
            'initialDocsQueryNumber'        => 5,
            'initialFAQQueryNumber'         => 5,
            'searchModalQueryTermIds'       => '', //for search modal
            'searchModalQueryDocIds'        => '', //for search modal
            'searchModalQueriesFaqGroupIds' => ''
        ];
    }

    public function render( $attributes, $content ) {
        $layout        = isset( $this->attributes['sidebar_layout'] ) ? $this->attributes['sidebar_layout'] : 'layout-1';
        $layout        = str_replace( 'layout-', '', $layout );
        $layout_mapper = [
            1 => 1,
            2 => 4,
            3 => 5,
            4 => 2,
            5 => 3,
            6 => 6,
            7 => 7
        ];
        $sidebar_layout = isset( $layout_mapper[$layout] ) ? $layout_mapper[$layout] : 1;

        if ( ! betterdocs()->is_pro_active() ) {
            $sidebar_layout = 1;
        }

        add_filter( 'betterdocs_base_terms_args', [$this, 'filter_base_args'], 10, 1 );
        $this->views( 'templates/sidebars/sidebar-' . $sidebar_layout );
        if ( $this->attributes['enableStickyTOC'] && $sidebar_layout == 1 ) {
            $this->views( 'widgets/sticky-toc-block' );
        }
        remove_filter( 'betterdocs_base_terms_args', [$this, 'filter_base_args'], 10 );
    }

    public function filter_base_args( $term_args ) {
        if ( $term_args['orderby'] == 'doc_category_order' ) {
            $term_args['meta_key'] = 'doc_category_order';
            $term_args['orderby']  = 'meta_value_num';
        }
        return $term_args;
    }

    public function view_params() {
        $settings = &$this->attributes;

        $default_multiple_kb = betterdocs()->settings->get( 'multiple_kb' );
        $kb_slug             = ! empty( $settings['selectKB'] ) && isset( $settings['selectKB'] ) ? json_decode( $settings['selectKB'] )->value : '';
        $layout_seven_params = [];

        if ( $settings['sidebar_layout'] == 'layout-1' || $settings['sidebar_layout'] == 'layout-6' || $settings['sidebar_layout'] == 'layout-7' ) {
            $settings['show_count'] = true;
        }

        $default_view_params = [
            'shortcode_attr' => [
                'terms_order'              => $settings['terms_order'],
                'terms_orderby'            => $settings['terms_orderby'] == 'doc_category_order' ? 'betterdocs_order' : $settings['terms_orderby'],
                'terms_include'            => array_diff( $this->string_to_array( $settings['includeCategories'] ), $this->string_to_array( $settings['excludeCategories'] ) ),
                'terms_exclude'            => isset( $settings['excludeCategories'] ) ? $this->string_to_array( $settings['excludeCategories'] ) : '',
                'nested_subcategory'       => $settings['enableNestedSubcategory'],
                'multiple_knowledge_base'  => $default_multiple_kb,
                'kb_slug'                  => $kb_slug,
                'sidebar_list'             => true,
                'list_icon_url'            => '',
                'list_icon_name'           => $settings['sidebar_layout'] == 'layout-4' ? '' : ( ! empty( $this->attributes['listIconImageUrl'] ) ? $this->attributes['listIconImageUrl'] : ( ! empty( $this->attributes['listIcon'] ) ? $this->attributes['listIcon'] : ( ! empty( betterdocs()->settings->get( 'docs_list_icon' ) ) ? betterdocs()->settings->get( 'docs_list_icon' )['url'] : 'list' ) ) ),
                'layout_type'              => 'block',
                'disable_customizer_style' => true,
                'posts_per_page'           => -1,
                'title_tag'                => $settings['titleTag'],
                'show_count'               => $settings['show_count']
            ]
        ];

        if ( $settings['sidebar_layout'] == 'layout-7' ) {
            $default_view_params['number_of_docs'] = $settings['initialDocsQueryNumber'];
            $default_view_params['number_of_faqs'] = $settings['initialFAQQueryNumber'];
            $default_view_params['faq_term_ids']   = $settings['searchModalQueriesFaqGroupIds'];
            $default_view_params['doc_ids']        = $settings['searchModalQueryDocIds'];
            $default_view_params['doc_term_ids']   = $settings['searchModalQueryTermIds'];
        }

        return $default_view_params;
    }
}
