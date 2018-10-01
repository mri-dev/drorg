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
            <a title="<? echo the_title(); ?>" href="<? echo the_permalink(); ?>"><img src="<?=$img?>" alt="<? echo the_title(); ?>"></a>
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
      });
    })(jQuery);
  </script>
</div>
