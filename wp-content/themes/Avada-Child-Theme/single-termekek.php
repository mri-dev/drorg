<?php
  global $taxonomy;
  get_header();
  $taxonomy = get_queried_object();
  $termopt = get_option('taxonomy_term_'.$taxonomy->term_id);

  function tax_nav( $tax )
  {
    $taxarr = array();
    $ct = $tax;
    $taxoname = $tax->taxonomy;
    $has_parent = ($ct->parent != 0) ? true : false;

    if ($has_parent) {
      while( $has_parent )
      {
        if( $ct->parent == 0 ) $has_parent = false;
        $taxarr[] = $ct;
        $ct = get_term($ct->parent, $taxoname);
      }
    } else {
      $taxarr[] = $ct;
    }

    $taxarr = array_reverse($taxarr);

    return $taxarr;
  }
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <?php while (have_posts()): the_post();
      $img = get_the_post_thumbnail_url(get_the_ID());
      $kat_terms = wp_get_post_terms(get_the_ID(), 'kategoria');
      $csop_terms = wp_get_post_terms(get_the_ID(), 'csoportok');
      $tags = wp_get_post_terms(get_the_ID(), 'post_tag');

      $csop_terms_nav = tax_nav( $csop_terms[0] );
  ?>
  <div class="content-wrapper">
    <div class="nav">
      <ul class="nav">
        <li><a href="/"><?php echo __('Főoldal', TD); ?></a></li>
        <li><a href="/termekek"><?php echo __('Termékek', TD); ?></a></li>
        <?php if ($csop_terms_nav): ?>
          <?php foreach ($csop_terms_nav as $tn): ?>
          <li><a href="<?=get_term_link($tn)?>"><?php echo $tn->name; ?></a></li>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($kat_terms): ?>
        <li><a href="<?=get_term_link($kat_terms[0])?>"><?=$kat_terms[0]->name?></a></li>
        <?php endif; ?>
        <li><?php the_title(); ?></li>
      </ul>
    </div>
    <div class="cont">
      <div class="image">
        <div class="wrapper">
          <img src="<?=$img?>" alt="">
        </div>
      </div>
      <div class="prod-body">
        <h1><?php echo the_title(); ?></h1>
        <div class="description">
          <?php echo the_content(); ?>
        </div>
        <div class="terms">
          <?php if ($kat_terms): ?>
            <div class="term">
              <?=__('Termék kategória', TD)?>: <?php foreach ($kat_terms as $t): ?>
                <a href="<?=get_term_link($t)?>"><?=$t->name?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($csop_terms): ?>
            <div class="term">
              <?=__('Termék csoport', TD)?>: <?php foreach ($csop_terms as $t): ?>
                <a href="<?=get_term_link($t)?>"><?=$t->name?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($tags): ?>
            <?php $itag = ''; foreach ($tags as $tag) { $itag .= '<a href="/termekek/?src='.$tag->name.'">'.$tag->name.'</a>, '; } $itag = rtrim($itag, ', '); ?>
            <div class="term">
              <?=__('Kulcsszavak', TD)?>: <?=$itag?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
