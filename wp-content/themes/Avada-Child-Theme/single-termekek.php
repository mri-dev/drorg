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
        <?php
          $leiras_osszetevok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_osszetevok', true);
          $leiras_tanacsok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_tanacsok', true);
          $leiras_hasznalat = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_hasznalat', true);
        ?>
        <ul class="tabs">
          <li class="desc active"><a href="#desc" onclick="switchTab('desc')"><?=__('Termék leírás', TD)?></a></li>
          <?php if ($leiras_osszetevok!=''): ?>
          <li class="osszetevok"><a href="#osszetevok" onclick="switchTab('osszetevok')"><?=__('Összetevők', TD)?></a></li>
          <?php endif; ?>
          <?php if ($leiras_hasznalat!=''): ?>
          <li class="hasznalat"><a href="#hasznalat" onclick="switchTab('hasznalat')"><?=__('Használati utasítás', TD)?></a></li>
          <?php endif; ?>
          <?php if ($leiras_tanacsok!=''): ?>
          <li class="tanacsok"><a href="#tanacsok" onclick="switchTab('tanacsok')"><?=__('Tanácsok', TD)?></a></li>
          <?php endif; ?>
        </ul>
        <div class="desc tab-content active">
          <?php echo the_content(); ?>
        </div>
        <?php if ($leiras_osszetevok!=''): ?>
        <div class="tab-content osszetevok">
          <?php echo apply_filters( 'the_content', $leiras_osszetevok); ?>
        </div>
        <?php endif; ?>
        <?php if ($leiras_hasznalat!=''): ?>
        <div class="tab-content hasznalat">
          <?php echo apply_filters( 'the_content', $leiras_hasznalat); ?>
        </div>
        <?php endif; ?>
        <?php if ($leiras_tanacsok!=''): ?>
        <div class="tab-content tanacsok">
          <?php echo apply_filters( 'the_content', $leiras_tanacsok); ?>
        </div>
        <?php endif; ?>
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
        <script type="text/javascript">
          (function($){
            $(function($){
              var anchor_tag = window.location.hash.substr(1);

              if (anchor_tag) {
                switchTab(anchor_tag);
              }
            });
          })(jQuery);
          function switchTab( tab ) {
            jQuery('ul.tabs li.active').removeClass('active');
            jQuery('ul.tabs li.'+tab).addClass('active');

            jQuery('.tab-content.active').removeClass('active');
            jQuery('.tab-content.'+tab).addClass('active');
          }
        </script>
      </div>
    </div>
  </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
