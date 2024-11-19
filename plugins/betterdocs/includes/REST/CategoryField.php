<?php

namespace WPDeveloper\BetterDocs\REST;
use WPDeveloper\BetterDocs\Core\BaseAPI;

class CategoryField extends BaseAPI {
    /**
     * @return mixed
     */
    public function register() {
        $this->register_field( 'doc_category', 'doc_category_order', [
            'get_callback' => [$this, 'doc_category_order']
        ] );
        $this->register_field( 'doc_category', 'thumbnail', [
            'get_callback' => [$this, 'thumbnail_image']
        ] );
        $this->register_field( 'doc_category', 'handbookthumbnail', [
            'get_callback' => [$this, 'handbook_thumbnail_image']
        ] );
        $this->register_field('doc_category', 'subcategories_count',[
            'get_callback' => [$this, 'get_subcategory_count']
        ]);
        $this->register_field('doc_category', 'total_docs_count',[
            'get_callback' => [$this, 'total_docs_count']
        ]);
        $this->register_field('doc_category', 'last_updated_time', [
            'get_callback' => [$this, 'last_updated_time']
        ]);
    }

    public function last_updated_time( $object ) {
        $date = betterdocs()->query->latest_updated_date( $object['taxonomy'], $object['slug'] );
        return $date;
    }

    public function doc_category_order( $object ) {
        $doc_category_order = get_term_meta( $object['id'], 'doc_category_order', true );
        if ( ! $doc_category_order ) {
            return;
        }

        return $doc_category_order;
    }

    public function thumbnail_image( $object ) {
        $attachment_id = get_term_meta( $object['id'], 'doc_category_image-id', true );
        if ( ! $attachment_id ) {
            return;
        }

        return wp_get_attachment_url( $attachment_id );
    }

    public function handbook_thumbnail_image( $object ) {
        $handbook_img_id = get_term_meta( $object['id'], 'doc_category_thumb-id', true );

        if ( !  $handbook_img_id ) {
            return;
        }

        return wp_get_attachment_url( $handbook_img_id );
    }

    public function get_subcategory_count($object) {
        $sub_terms_count = count( betterdocs()->query->get_all_child_term_ids( 'doc_category',  $object['id'] ) );;
        return $sub_terms_count;
    }

    public function total_docs_count( $object ) {
        $docs_count = betterdocs()->query->get_docs_count( (object)$object, false );
        return $docs_count;
    }
}
