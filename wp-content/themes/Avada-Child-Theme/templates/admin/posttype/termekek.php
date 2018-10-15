<h3>Cikkszám</h3>
<?php $metakey = METAKEY_PREFIX . 'cikkszam'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<input type="text" name="<?=$metakey?>" value="<?=$value?>">

<h3>Összetevők</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_osszetevok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Használat</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_hasznalat'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Tanácsadási információk</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_tanacsok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>
