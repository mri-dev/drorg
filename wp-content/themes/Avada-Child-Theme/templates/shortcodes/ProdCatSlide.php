<div class="holder">
  <div class="list hide-on-mobile">
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
  <div class="list show-on-mobile">
  <?php if (count($datas) != 0): ?>
    <div class="catgroup">
      <?php  foreach ($datas as $cat): $ci++; ?>
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
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  </div>

  <script type="text/javascript">
    (function($){
      resizeBoxHeight();
      var ww = $(document).width();

      $(window).resize(function(){
        resizeBoxHeight();
      });

      $('.product-categories-holder.style-boxslide .list').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        speed: 2000,
        delay: 6000,
        responsive: [
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: true
            }
          }
        ]
      });

      function resizeBoxHeight() {
        var ww = $(document).width();
        var ismobile = (ww < 1000) ? true : false;
        var css = (!ismobile) ? '.list.hide-on-mobile' : '.list.show-on-mobile';
        $('.product-categories-holder '+css+' .catgroup .cat .wrapper').css({
          height: $('.product-categories-holder '+css+' .catgroup .cat').width()
        });
      }
    })(jQuery);
  </script>
</div>
