<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid);
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);
    ?>
    <div class="item">
      <div class="wrapper">
        <div class="image">

        </div>
        <div class="date">
          <?php echo the_date(); ?>
        </div>
        <div class="title">
          <h3><a href="#"><? echo the_title(); ?></a></h3>
        </div>
        <div class="desc">
          <?php echo the_excerpt(); ?>
        </div>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); else: ?>
    <div class="no-item">
      <h3><?php echo __('Nincs találat.',TD); ?></h3>
      <?php echo __('Jelenleg nincs aktuális program ajánlatunk. Kérjük nézzen vissza később!',TD); ?>
    </div>
  <? endif; ?>
  </div>
</div>
