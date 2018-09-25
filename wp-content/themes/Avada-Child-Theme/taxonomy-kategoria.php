<?php
  global $taxonomy;
  get_header();
  $taxonomy = get_queried_object();
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="borito">
    <div class="wrapper">
      <div class="felirat">
        <h1><?php echo $taxonomy->name; ?></h1>
        <div class="desc">
          <?php echo $taxonomy->description; ?>
        </div>
      </div>
      <img src="" alt="">
    </div>
  </div>

  <div class="fusion-row">
    <?php echo get_template_part('termeklista'); ?>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
