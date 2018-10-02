<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();
      $url = get_the_permalink($pid);
      $posturl = get_the_excerpt($pid);
    ?>
    <div class="item">
      <div class="wrapper">
        <iframe src="https://www.facebook.com/plugins/post.php?href=<?=$posturl?>&width=370&show_text=true&appId=<?=FB_APP_ID?>&height=490" width="370" height="490" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); ?>
  <? endif; ?>
  </div>
  <?php if (!is_archive()): ?>
  <div class="read-list">
    <a href="/facebook"><?php echo __('További bejegyzések',TD); ?></a>
  </div>
  <?php endif; ?>
</div>
