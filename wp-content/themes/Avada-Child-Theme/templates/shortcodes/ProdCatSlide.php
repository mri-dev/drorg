<div class="holder">
  <div class="list">
  <?php if (count($datas) != 0): ?>
    <div class="catgroup">
      <?php $ci = 0; foreach ($datas as $cat): $ci++; ?>
      <div class="cat">
        <div class="wrapper">
          <a href="<?=get_term_link($cat)?>">
          <div class="cimke">
            <?php echo $cat->name; ?>
          </div>
          <?php if (has_category_thumbnail($cat->term_id)): $img = get_the_category_data($cat->term_id); ?>
            <img src="<?=$img->url?>" alt="<?php echo $cat->name; ?>">
          <?php endif; ?>
          </a>
        </div>
      </div>
      <?php if ($ci%8 === 0): ?>
      </div>
      <div class="catgroup">
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  </div>
  <script type="text/javascript">
    (function($){
      resizeBoxHeight();

      $(window).resize(function(){
        resizeBoxHeight();
      });

      $('.product-categories-holder.style-boxslide .list').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
      });

      function resizeBoxHeight() {
        $('.product-categories-holder .catgroup .cat .wrapper').css({
          height: $('.product-categories-holder .catgroup .cat').width()
        });
      }
    })(jQuery);
  </script>
</div>
