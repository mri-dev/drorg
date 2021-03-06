<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid, 'post500thumbnail');
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);
    ?>
    <div class="item">
      <div class="wrapper">
        <?php if ($img): ?>
          <div class="image">
            <a href="<? echo the_permalink(); ?>"><img src="<?=$img?>" alt="<? echo the_title(); ?>"></a>
          </div>
        <?php endif; ?>
        <div class="date">
          <?php echo the_date(); ?>
        </div>
        <div class="title">
          <h3><a href="<? echo the_permalink(); ?>"><? echo the_title(); ?></a></h3>
        </div>
        <div class="desc">
          <?php echo the_excerpt('...'); ?>
        </div>
        <div class="read">
          <a href="<? echo the_permalink(); ?>"><? echo __('Részletek', TD); ?> <i class="fa fa-long-arrow-right"></i></a>
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
  <script type="text/javascript">
    (function($){
      $('.blog-list-holder.style-slide.wantslide .list').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    })(jQuery);
  </script>
</div>
