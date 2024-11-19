<?php
namespace WPDeveloper\BetterDocs\Editors\BlockEditor\Patterns;


class CategoryArchive extends BasePattern {

    public function register() {
        register_block_pattern(
            'betterdocs/doc-category-sleek-layout',
            array(
                'title'         => __( 'Category Archive Sleek Layout', 'betterdocs' ),
                'description'   => _x( 'Doc Category Archive Layout', 'Block pattern description', 'betterdocs' ),
                'content'       => '<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"50px"}}},"backgroundColor":"base-2","layout":{"type":"default"}} -->
                    <div class="wp-block-group has-base-2-background-color has-background" style="padding-bottom:50px"><!-- wp:group {"layout":{"backgroundColor":"#f2f4f7","inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                    <div class="wp-block-group"><!-- wp:columns {"align":"wide"} -->
                    <div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
                    <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:betterdocs/sidebar {"blockId":"betterdocs-sidebar-ge3iyo6","blockMeta":{"desktop":".betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content.betterdocs-category-sidebar{  background-color: #fff;   }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar{ width:100%; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-folder-icon{ width:16px; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header{  background-color: rgba(255, 255, 255, 0);   }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-title{ color: #3f5876; font-size: 16px;  }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header{  background-color: #5a94ff1a;   }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header{ border-color:#528fff }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{  font-size: 12px; color: #344054; }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{  background-color: #528ffe;   }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{  background-color: #591fff;   }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6 .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{  background-color: #fff;   }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{  background-color: #F2F4F7;   }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{ color: #fff; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6 .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{ color: #2b11e5; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{ color: #fefeff; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li a{  font-size: 14px; color: #667085; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li a:hover{ color: #667085; }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li img{ fill: #566e8b; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a{ color: #344054; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a:hover, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a:hover { color: #344054; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a,.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a{  font-size: 16px;  }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li a{  font-size: 14px; color: #667085; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li a:hover { color: 667085; }.betterdocs-sidebar-ge3iyo6.sticky-toc-block-wrapper .sticky-toc-container, .betterdocs-sidebar-ge3iyo6 .sticky-toc-container{ z-index: 320; }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-popup .betterdocs-searchform .betterdocs-searchform-input-wrap svg{ height:28px;width:28px; }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-popup .betterdocs-searchform .betterdocs-searchform-input-wrap .betterdocs-search-command{ color: #98A2B3; }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-popup .betterdocs-searchform{  background-color: #F9FAFB;   }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header svg g path{ color: rgb(152, 162, 179); }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header{  background-color: #F9FAFB;   }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header .betterdocs-searchform-input-wrap .betterdocs-search-field{  font-size: 16px; color: #200505; }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header .betterdocs-searchform-input-wrap .betterdocs-search-field::placeholder{ color: #475479; }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header .betterdocs-select-option-wrapper .betterdocs-form-select{ color: rgb(128, 128, 128); font-size: 16px;  }.betterdocs-sidebar-ge3iyo6  .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-info-tab .betterdocs-tab-items span{  font-size: 14px;  }.betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-info-tab .betterdocs-tab-items span svg{ height:20px; }betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-items-wrapper .betterdocs-search-item-content .betterdocs-search-item-list .content-main h4{  font-size: 16px; color: #1D2939; }betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-items-wrapper .betterdocs-search-item-content .betterdocs-search-item-list .content-sub svg{ height:20px; }betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-items-wrapper .betterdocs-search-item-content .betterdocs-search-item-list .content-sub h5{  font-size: 14px; color: #475467; }","tab":"","mobile":"","desktopHover":".betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-category-header:hover{  border-style: undefined;  }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-body:hover{  border-style: undefined;  }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li a:hover:hover{ color: #667085; }.betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-4 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-2 .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list li img, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li svg, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li i, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-body .betterdocs-articles-list li img:hover{ fill: #566e8b; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a:hover, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-title a:hover :hover{ color: #344054; }.betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-body .betterdocs-articles-list .betterdocs-nested-category-wrapper .betterdocs-nested-category-list li a:hover :hover{ color: 667085; }","tabHover":"","mobileHover":"","extraStyles":" .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content.betterdocs-category-sidebar{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header{ transition:background 0.5s, background 0.5s,  border 0.5s, border-radius 0.5s, box-shadow 0.5s ; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper{ transition: border 0.5s, border-radius 0.5s, box-shadow 0.5s ; } .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-5 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-3 .betterdocs-sidebar-content .betterdocs-single-category-wrapper.active .betterdocs-single-category-inner .betterdocs-category-header{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6#betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-6 .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6 .betterdocs-sidebar-list-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{ transition:background 0.5s,  border 0.5s, border-radius 0.5s, box-shadow 0.5s ; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts, .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts span{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar.betterdocs-sidebar-layout-7 .betterdocs-sidebar-content .betterdocs-category-grid-wrapper .betterdocs-category-grid-inner-wrapper .betterdocs-single-category-wrapper .betterdocs-single-category-inner .betterdocs-category-header .betterdocs-category-header-inner .betterdocs-category-items-counts{ transition: border 0.5s, border-radius 0.5s, box-shadow 0.5s ; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-category-header{ transition: border 0s, border-radius 0s, box-shadow 0s ; } .betterdocs-sidebar-ge3iyo6.betterdocs-sidebar .betterdocs-sidebar-content .betterdocs-sidebar-list-wrapper .betterdocs-sidebar-list-inner .betterdocs-sidebar-list.betterdocs-sidebar-layout-6.active .betterdocs-sidebar-list-inner .betterdocs-body{ transition: border 0s, border-radius 0s, box-shadow 0s ; } .betterdocs-sidebar-ge3iyo6 .betterdocs-search-popup .betterdocs-searchform{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-header{ transition:background 0.5s; } .betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-info-tab .betterdocs-tab-items{ transition: border 0.5s, border-radius 0.5s, box-shadow 0.5s ; } .betterdocs-sidebar-ge3iyo6 .betterdocs-search-wrapper .betterdocs-search-details .betterdocs-search-content .betterdocs-search-items-wrapper .betterdocs-search-item-content .betterdocs-search-item-list{ transition: border 0.5s, border-radius 0.5s, box-shadow 0.5s ; }"},"sidebar_layout":"layout-7","box_title_color_layout_7":"#3f5876"} /--></div>
                    <!-- /wp:column -->

                    <!-- wp:column {"width":"66.66%","style":{"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"layout":{"type":"default"}} -->
                    <div class="wp-block-column" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;flex-basis:66.66%"><!-- wp:betterdocs/breadcrumb {"blockId":"betterdocs-breadcrumb-7sehttm","blockMeta":{"desktop":" .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm { display:flex; justify-content:left } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ font-size: 12px; padding: 0px; margin: 0px; color:#566e8b; } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .breadcrumb-delimiter .breadcrumb-delimiter-icon{ margin: 0px; padding: 0px; color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 { display:flex; justify-content:left } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ font-size: 12px; padding: 0px; margin: 0px; color:#667085; } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .breadcrumb-delimiter .breadcrumb-delimiter-icon path{ margin: 0px; padding: 0px; color:#566e8b !important; } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 ul.betterdocs-breadcrumb-list { background:#F9FAFB; } ","tab":" .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .breadcrumb-delimiter .breadcrumb-delimiter-icon{ color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .breadcrumb-delimiter .breadcrumb-delimiter-icon path{ color:#566e8b } ","mobile":" .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm .breadcrumb-delimiter .breadcrumb-delimiter-icon{ color:#566e8b } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item a, .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .betterdocs-breadcrumb-list .betterdocs-breadcrumb-item span{ color:#667085 } .betterdocs-breadcrumb.betterdocs-breadcrumb-7sehttm.layout-2 .breadcrumb-delimiter .breadcrumb-delimiter-icon path{ color:#566e8b !important; } "},"layout":"layout-2"} /-->

                    <!-- wp:betterdocs/archive-header {"blockId":"archive-header-28tvywi","blockMeta":{"desktop":".archive-header-28tvywi.betterdocs-main-category-folder{  padding-top: 20px; padding-right: 20px; padding-left: 20px; padding-bottom: 40px;  margin-top: 0px; margin-right: 0px; margin-left: 0px; margin-bottom: 36px;  background-color: #F9FAFB;   }.archive-header-28tvywi.betterdocs-main-category-folder .betterdocs-category-header-inner .betterdocs-category-icon .betterdocs-folder-icon{ width:56px; }.archive-header-28tvywi.betterdocs-main-category-folder .betterdocs-category-header-inner .betterdocs-category-title{ color: #1D2939; font-size: 32px;  }.archive-header-28tvywi.betterdocs-main-category-folder .betterdocs-category-header-inner .betterdocs-sub-category-items-counts{ color: #1D2939; font-size: 18px;  }","tab":"","mobile":"","desktopHover":"","tabHover":"","mobileHover":"","extraStyles":" .archive-header-28tvywi.betterdocs-main-category-folder{ transition:background 0.5s; }"},"archiveHeaderDocCountColor":"#1D2939"} /-->

                    <!-- wp:betterdocs/archive-doc-list {"layout":"layout-3","blockId":"betterdocs-archive-list-shqtgue","blockMeta":{"desktop":".betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li a{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li svg, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li i, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li img{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li svg:hover, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li i:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 span{ width:32px;height:32px; background-color: #F2F4F7;   }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-title p{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-title .betterdocs-entry-heading{ color: #566e8b; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 a{  font-size: 20px; color: #1D2939; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 span svg path{ fill: rgb(196, 196, 196); }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list p{ color: #475467; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list .update-date{ color: #475467; background-color: #FFFCF5;   }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-single-category-inner .betterdocs-body ul li a p{ color: #15063f; }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-body ul li \u003e p{ color: #707070; }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-single-category-inner .betterdocs-body ul li a p:hover{ color: #15063f; }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-single-category-inner .betterdocs-body ul li a svg{ fill: #000000; }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-single-category-inner .betterdocs-body ul li a svg:hover{ fill: #000000; }","tab":"","mobile":"","desktopHover":".betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li a:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li svg, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li i, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li img:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li svg:hover, .betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-body ul li i:hover:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-title p:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.betterdocs-content-area .betterdocs-entry-title .betterdocs-entry-heading:hover{ color: #566e8b; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 a:hover{ color: #1D2939; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 span svg path:hover{ fill: rgb(196, 196, 196); }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list p:hover{ color: #475467; }.betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list .update-date:hover{ color: #475467; }.betterdocs-archive-list-shqtgue.betterdocs-taxonomy-doc-category .betterdocs-category-grid-list-inner-wrapper.layout-6 .betterdocs-body ul li \u003e p:hover{ color: #707070; }","tabHover":"","mobileHover":"","extraStyles":" .betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list h2 span{ transition:background 0.5s; } .betterdocs-archive-list-shqtgue.doc-category-layout-7 .betterdocs-title-excerpt-lists .betterdocs-title-excerpt-list .update-date{ transition:background 0.5s; }"}} /--></div>
                    <!-- /wp:column --></div>
                    <!-- /wp:columns --></div>
                    <!-- /wp:group --></div>
                    <!-- /wp:group -->',
                'categories'    => array( 'betterdocs-catgory' ),
                'keywords'      => array( 'betterdocs', 'doc archive' ),
                'viewportWidth' => 1600,
            )
        );
        register_block_pattern(
            'betterdocs/doc-category',
            array(
                'title'         => __( 'Category Archive Classic Layout', 'betterdocs' ),
                'description'   => _x( 'Doc Category Archive Layout', 'Block pattern description', 'betterdocs' ),
                'content'       => '<!-- wp:group {"style":{"color":{"background":"#f2f4f7"},"spacing":{"padding":{"bottom":"50px"}}},"layout":{"type":"default"}} -->
                <div
                    class="wp-block-group has-background"
                    style="background-color: #f2f4f7; padding-bottom: 50px"
                >
                    <!-- wp:group {"style":{"color":{"background":"#f7f7f7"}},"layout":{"backgroundColor":"#f2f4f7","inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                    <div
                        class="wp-block-group has-background"
                        style="background-color: #f7f7f7"
                    >
                        <!-- wp:betterdocs/searchbox /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:group {"layout":{"backgroundColor":"#f2f4f7","inherit":true,"contentSize":"1400px","type":"constrained"}} -->
                    <div class="wp-block-group">
                        <!-- wp:columns {"align":"wide"} -->
                        <div class="wp-block-columns alignwide">
                            <!-- wp:column {"width":"33.33%"} -->
                            <div class="wp-block-column" style="flex-basis: 33.33%">
                                <!-- wp:betterdocs/sidebar /-->
                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"66.66%","style":{"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}}},"backgroundColor":"base"} -->
                            <div class="wp-block-column has-base-background-color has-background" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px;flex-basis:66.66%">
                                <!-- wp:betterdocs/breadcrumb /-->
                                <!-- wp:betterdocs/archive-doc-list /-->
                            </div>
                            <!-- /wp:column -->
                        </div>
                        <!-- /wp:columns -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->',
                'categories'    => array( 'betterdocs-catgory' ),
                'keywords'      => array( 'betterdocs', 'doc archive' ),
                'viewportWidth' => 1600,
            )
        );
    }
}
