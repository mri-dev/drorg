<?php
  global $taxonomy;
  $arg = array(
    'post_type' => 'termekek',
    'posts_per_page' => 20,
    'tax_query' => array(
      array(
        'taxonomy' => 'kategoria',
        'field'    => 'term_id',
        'terms'    => $taxonomy->term_id
      ),
    )
  );
  if (isset($_GET['src']) && $_GET['src'] != '') {
    $src = explode(" ", $_GET['src']);
    $is_searched = implode(",",$src);
    $arg['tag'] = $is_searched;
  }
  $products = new WP_Query($arg);
?>
<div class="term-list">
  <div class="header">
    <div class="nav">
      <ul class="nav">
        <li><a href="/"><?php echo __('Főoldal', TD); ?></a></li>
        <li><a href="/termekek"><?php echo __('Termékek', TD); ?></a></li>
        <li><a href="<?=get_term_link($taxonomy)?>"><?php echo $taxonomy->name; ?></a></li>
      </ul>
    </div>
    <div class="filters">
      <div class="info">
        <strong><?php echo sprintf(__('%d db termék', TD), $products->found_posts); ?></strong>
        <?php if ($is_searched): ?>
           &bull; <span class="src-result"><?php echo __('Keresési kifejezések:', TD); ?> <span class=srckeys><span><? echo  implode("</span><span>",$src); ?></span></span>
        <?php endif; ?>
      </div>
      <div class="filter">
        <form class="" id="filter" action="" method="get">
        <div class="wrapper">
          <div class="t">
            <?php echo __('Rendezés mint', TD); ?>
          </div>
          <div class="o">
            <div class="wrapper">
              <select class="" name="order" onchange="jQuery('form#filter').submit();">
                <option value="name-ASC" <?=(!isset($_GET['order']) || $_GET['order'] == 'name-ASC')?'selected="selected"':''?>><?php echo __('Név: A-Z', TD); ?></option>
                <option value="name-DESC" <?=(isset($_GET['order']) && $_GET['order'] == 'name-DESC')?'selected="selected"':''?>><?php echo __('Név: Z-A', TD); ?></option>
                <option value="date-ASC" <?=(isset($_GET['order']) && $_GET['order'] == 'date-ASC')?'selected="selected"':''?>><?php echo __('Régi termékek előre', TD); ?></option>
                <option value="date-DESC" <?=(isset($_GET['order']) && $_GET['order'] == 'date-DESC')?'selected="selected"':''?>><?php echo __('Új termékek előre', TD); ?></option>
              </select>
            </div>
          </div>
          <div class="s">
            <input type="text" placeholder="<?=__('Keresés...', TD)?>" name="src" value="<?=$_GET['src']?>">
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="c">
    <?php if ($products->have_posts()): ?>
      <div class="products">
        <?php while ( $products->have_posts() ) { $products->the_post(); ?>
        <?php
          $img = get_the_post_thumbnail_url(get_the_ID());
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
    <?php else: ?>
      <div class="no-products">
        <h3><?php echo __('Nincsenek termékek.', TD); ?></h3>
        <?php echo __('A keresési feltételek alapján nem találtunk Önnek termékeket.', TD); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
