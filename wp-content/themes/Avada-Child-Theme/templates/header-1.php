<div class="fusion-header-sticky-height"></div>
<div class="fusion-header">
	<div class="fusion-row">
		<div class="logo">
      <?php $settings = Avada::settings(); ?>
      <a href="<?php echo get_option('siteurl'); ?>"><img src="<?php echo $settings['logo']['url']; ?>" alt="<?php echo get_option('blogname'); ?>"></a>
    </div>
    <div class="nav">
      <div class="navmenu">
        <?php
        wp_nav_menu(array(
          'menu' => 'Főmenü',
          'walker' => new CustomMenuWalker()
        ));
      ?>
      </div>
      <div class="searcher">
        <form class="" action="" method="get">
          <div class="wrapper">
            <div class="inp">
              <input autocomplete="off" type="text" name="s" value="" placeholder="<?php echo __('Keresés', TD); ?>">
            </div>
            <div class="button">
              <button type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
	</div>
</div>