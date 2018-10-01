<?php
  get_header();

  $arg = array(
    'post_type' => 'dijak',
    'posts_per_page' => -1,
  );

  $dijak = new WP_Query($arg);
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="borito" style="<?php if (isset($termopt) && !empty($termopt['boritokep'])): ?>background-image: url('<?=$termopt['boritokep']?>');<?php endif; ?>">
    <div class="wrapper">
      <div class="felirat">
        <h1><?php echo __('Díjak',TD); ?></h1>
        <div class="desc">
          <?php echo $taxonomy->description; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="fusion-row">
    <div class="dijak-lista">
      <?php if (!$dijak->have_posts()): ?>
        <?php echo __('Jelenleg nincs megjelenítendő adat.',TD); ?>
      <?php else: ?>
        <?php while ( $dijak->have_posts() ) { $dijak->the_post(); ?>
        <?php
          $img = get_the_post_thumbnail_url(get_the_ID());
        ?>
        <div class="dij">
          <div class="wrapper">
            <div class="image">
              <img src="<?=$img?>" alt="<?php the_title(); ?>">
            </div>
            <div class="datas">
              <div class="title">
                <h4><?php the_title(); ?></h4>
              </div>
              <div class="cont">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php } wp_reset_postdata(); ?>
      <?php endif; ?>

    </div>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
