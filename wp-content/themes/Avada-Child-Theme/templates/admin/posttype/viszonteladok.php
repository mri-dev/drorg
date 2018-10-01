<table class="<?=TD?>">
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'website'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Viszonteladó weboldala</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
</table>
