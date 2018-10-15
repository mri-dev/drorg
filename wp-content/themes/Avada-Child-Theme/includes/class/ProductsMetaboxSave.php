<?php
  class ProductsMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'cikkszam', $_POST[METAKEY_PREFIX . 'cikkszam'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_hasznalat', $_POST[METAKEY_PREFIX . 'leiras_hasznalat'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_osszetevok', $_POST[METAKEY_PREFIX . 'leiras_osszetevok'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_tanacsok', $_POST[METAKEY_PREFIX . 'leiras_tanacsok'] );
    }
  }
?>
