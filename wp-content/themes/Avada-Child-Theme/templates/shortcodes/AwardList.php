<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid, 'post500thumbnail');
      $url = get_the_permalink($pid);
      $cont = get_post_field('post_content', $pid);
    ?>
    <div class="item">
      <div class="wrapper">
        <?php if ($img): ?>
          <div class="image">
            <?php if (strlen($cont) != 0): ?>
              <a title="<? echo the_title(); ?>" href="<? echo the_permalink(); ?>"><img src="<?=$img?>" alt="<? echo the_title(); ?>"></a>
            <?php else: ?>
              <img title="<? echo the_title(); ?>" src="<?=$img?>" alt="<? echo the_title(); ?>">
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); ?>
  <? endif; ?>
  </div>
  <script type="text/javascript">
    (function($){
      $('.award-list-holder.style-slide .list').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        speed: 2000,
        delay: 1,
        responsive: [
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
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
