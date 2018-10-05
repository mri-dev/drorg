<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);
      $vidID = getYoutubeID(get_the_excerpt($pid));
      $img = "//img.youtube.com/vi/".$vidID."/mqdefault.jpg";
    ?>
    <div class="item">
      <div class="wrapper">
        <?php if ($img): ?>
          <div class="image">
            <a title="<? echo the_title(); ?>" href="<? echo the_permalink(); ?>"><img src="<?=$img?>" alt="<? echo the_title(); ?>"></a>
          </div>
        <?php endif; ?>
        <div class="title">
          <a title="<? echo the_title(); ?>" href="<? echo the_permalink(); ?>"><? echo the_title(); ?></a>
        </div>
        <div class="read">
          <a href="<? echo the_permalink(); ?>"><? echo __('Tovább a videóra', TD); ?> <i class="fa fa-long-arrow-right"></i></a>
        </div>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); ?>
  <? endif; ?>
  </div>
  <?php if ($style == 'slide'): ?>
  <script type="text/javascript">
    (function($){
      $('.videos-holder.style-slide .list').slick({
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
  <?php endif; ?>
  <?php if (!is_archive()): ?>
  <div class="read-list">
    <a href="/videok"><?php echo __('További videók',TD); ?></a>
  </div>
  <?php endif; ?>
</div>
