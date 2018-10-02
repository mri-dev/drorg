<?php
  get_header();
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="fusion-row">
    <h1><?php echo __('Facebook bejegyzéseink', TD); ?></h1>
    <?php echo do_shortcode('[facebook-post-list limit="-1"]'); ?>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
