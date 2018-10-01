<?php
  class ViszonteladoMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'website', $_POST[METAKEY_PREFIX . 'website'] );

    }
  }
?>
