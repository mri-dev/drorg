<?php
class AwardListSC
{
  const SCTAG = 'award-list';

  public function __construct()
  {
      add_action( 'init', array( &$this, 'register_shortcode' ) );
  }

  public function register_shortcode() {
      add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
  }

  public function do_shortcode( $attr, $content = null )
  {
      /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
            'style' => 'style'
          )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      $meta_query = array();

      $param = array(
        'post_type' => 'dijak',
        'posts_per_page' => -1
      );

      $datas = new WP_Query( $param );

      $attr['datas'] = $datas;
      $pass_data = $attr;

      $output = '<div class="'.self::SCTAG.'-holder style-'.$attr['style'].'">';
      $output .= (new ShortcodeTemplates('AwardList'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new AwardListSC();

?>
