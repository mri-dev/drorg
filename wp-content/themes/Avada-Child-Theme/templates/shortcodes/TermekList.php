<?php if ($products->have_posts()): ?>
  <div class="products">
    <?php while ( $products->have_posts() ) { $products->the_post(); ?>
    <?php
      $img = get_the_post_thumbnail_url(get_the_ID());
      findProductUploadedImage($img, get_the_ID());
      $img = ($img) ?: IMG.'/no-product-image.png';
    ?>
    <div class="product">
      <div class="wrapper">
        <div class="image">
          <a href="<?php the_permalink(); ?>"><img src="<?=$img?>" alt="<?php the_title(); ?>"></a>
        </div>
        <div class="datas">
          <div class="title">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          </div>
          <div class="bt">
            <a href="<?php the_permalink(); ?>"><?php echo __('Részletek', TD); ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php } wp_reset_postdata(); ?>
  </div>
<?php endif; ?>
