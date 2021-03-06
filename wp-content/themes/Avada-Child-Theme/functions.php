<?php
define('PROTOCOL', 'https');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('TARGETDOMAIN', DOMAIN);
define('IFROOT', str_replace(get_option('siteurl'), '//'.DOMAIN, get_stylesheet_directory_uri()));
define('DEVMODE', true);
define('IMG', IFROOT.'/images');
define('GOOGLE_API_KEY', 'AIzaSyA0Mu8_XYUGo9iXhoenj7HTPBIfS2jDU2E');
define('LANGKEY','hu');
define('FB_APP_ID', '305162130074910');
define('METAKEY_PREFIX', 'drorg_'); // Textdomain
define('DEFAULT_LANGUAGE', 'hu_HU');
define('TD', 'drorg');
define('CAPTCHA_SITE_KEY', '6LemSzsUAAAAAMo_zYX4_iZrkJflAmCdXqAnUJFv');
define('CAPTCHA_SECRET_KEY', '6LemSzsUAAAAAB3gw2paRrXodpkS8LsojL73_siW');

// Includes
require_once "includes/include.php";

$app_settings = new Setup_General_Settings();

function get_site_title( $site = '' )
{
  global $wpdb;

  $site = ($site == '') ? : $site.'_';
  $q = "SELECT option_value FROM sbe_{$site}options WHERE option_name = 'blogname'";
  $title = $wpdb->get_var($q);

  return $title;
}

function get_site_prefix()
{
  $d = explode(".", DOMAIN);

  switch ($d[0]) {
    case 'gastro': return 'gbc'; break;
    case 'sport': return 'sbe'; break;
    case 'consulting': return 'sbc'; break;
  }
}

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css?' );
    wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css', array(), '1.12.1' );
    wp_enqueue_style( 'slick', IFROOT . '/assets/vendors/slick/slick.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_style( 'angular-material','//ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.css');
    //wp_enqueue_style( 'angualardatepick', IFROOT . '/assets/vendors/md-date-range-picker/md-date-range-picker.min.css?t=' . ( (DEVMODE === true) ? time() : '' ) );

    //wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?sensor=false&language='.get_locale().'&region=hu&libraries=places&key='.GOOGLE_API_KEY);
    wp_enqueue_script( 'recaptcha', '//www.google.com/recaptcha/api.js');
    wp_enqueue_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1');
    wp_enqueue_script( 'jquery-ui-loc-hu', IFROOT . '/assets/js/jquery-ui-loc-hu.js');
    wp_enqueue_script( 'slick', IFROOT . '/assets/vendors/slick/slick.min.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
    wp_enqueue_script( 'dimail', 'https://admin.dimail.hu/r/popup/4d6a82157593fac5bf8d514a3b81c90de14c4e13');

    //wp_enqueue_script( 'fontasesome', '//use.fontawesome.com/releases/v5.0.6/js/all.js');
    //wp_enqueue_script( 'angularjs', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js');
    //wp_enqueue_script( 'angular-moment', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js');
    //wp_enqueue_script( 'angular-animate', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js');
    //wp_enqueue_script( 'angular-aria', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js');
    //wp_enqueue_script( 'angular-message', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js');
    //wp_enqueue_script( 'angular-material', '//ajax.googleapis.com/ajax/libs/angular_material/1.1.4/angular-material.min.js');
    //wp_enqueue_script( 'angular-sanitize', '//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-sanitize.min.js');
    //wp_enqueue_script( 'mocjax', IFROOT . '/assets/vendors/autocomplete/scripts/jquery.mockjax.js');
    //wp_enqueue_script( 'autocomplete', IFROOT . '/assets/vendors/autocomplete/dist/jquery.autocomplete.min.js');
    //wp_enqueue_script( 'angualardatepick', IFROOT . '/assets/vendors/md-date-range-picker/md-date-range-picker.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_script( 'angualar-timer-bower', IFROOT . '/assets/vendors/angular-timer/dist/assets/js/angular-timer-bower.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
    //wp_enqueue_script( 'angualar-timer-all', IFROOT . '/assets/vendors/angular-timer/dist/assets/js/angular-timer-all.min.js?t=' . ( (DEVMODE === true) ? time() : '' ) );

    //wp_enqueue_script('calendar-ang', IFROOT . '/assets/js/calendar.ang.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function app_enqueue_styles()
{
  wp_enqueue_style( 'app', IFROOT . '/assets/css/style.css?t=' . ( (DEVMODE === true) ? time() : '' ) );

}
add_action( 'wp_enqueue_scripts', 'app_enqueue_styles', 100 );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

function app_locale( $locale )
{
  /*
    $lang = explode('/', $_SERVER['REQUEST_URI']);
    if(array_pop($lang) === 'en'){
      $locale = 'en_US';
    }else{
      $locale = 'gr_GR';
    }*/
    //$locale = 'en_US';

    return $locale;
}

add_filter('locale','app_locale', 10);

function facebook_og_meta_header()
{
  global $wp_query;

  $title = get_option('blogname');
  $image = '';
  $desc  = get_option('blogdescription');
  $url   = get_option('site_url');

  echo '<meta property="fb:app_id" content="'.FB_APP_ID.'"/>'."\n";
  echo '<meta property="og:title" content="' . $title . '"/>'."\n";
  echo '<meta property="og:type" content="article"/>'."\n";
  echo '<meta property="og:url" content="' . $url . '/"/>'."\n";
  echo '<meta property="og:description" content="' . $desc . '/"/>'."\n";
  echo '<meta property="og:site_name" content="'.get_option('blogname').'"/>'."\n";
  echo '<meta property="og:image" content="' . $image . '"/>'."\n";

}
add_action( 'wp_head', 'facebook_og_meta_header', 5);

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/langs';
	load_child_theme_textdomain( 'rd', $lang );

  $ucid = ucid();

  $ucid = $_COOKIE['uid'];
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function ucid()
{
  $ucid = $_COOKIE['ucid'];

  if (!isset($ucid)) {
    $ucid = mt_rand();
    setcookie( 'ucid', $ucid, time() + 60*60*24*365*2, "/");
  }

  return $ucid;
}

function app_custom_template($template) {
  global $post, $wp_query;

  if(isset($wp_query->query_vars['custom_page'])) {

    if ('jelentkezes' == $wp_query->query_vars['custom_page']) {
      add_filter( 'body_class','jelentkezes_class_body' );
      add_filter( 'document_title_parts', 'jelentkezes_custom_title' );
    }
    return get_stylesheet_directory() . '/'.$wp_query->query_vars['custom_page'].'.php';
  } else {
    return $template;
  }
}
add_filter( 'template_include', 'app_custom_template' );

function jelentkezes_class_body( $classes ) {
  $classes[] = 'jelentkezes-form';
  $classes[] = 'active-campaign-form-page';
  return $classes;
}

function jelentkezes_custom_title( $title )
{
  $title['title'] = __('Jelentkezés', TD);
  return $title;
}

function readCSV($csvFile){
  $file_handle = fopen($csvFile, 'r');
  while (!feof($file_handle) ) {
      $line_of_text[] = fgetcsv($file_handle, 1024, ";");
  }
  fclose($file_handle);
  return $line_of_text;
}

function csvTAGPrepare( $csv )
{
  global $wpdb;

  $csvnew = array();
  foreach ((array)$csv as $cs)
  {
    $csvnew[] = array(
      'cikkszam' => $cs[0],
      'tags' => rtrim(str_replace(", ", ",",utf8_encode($cs[1])),","),
      'postID' => foundPostIDByMetaValue('cikkszam', trim($cs[0]))
    );
  }

  return $csvnew;
}

function csvImagePrepare( $csv )
{
  global $wpdb;

  $csvnew = array();
  $updir = wp_upload_dir();
  foreach ((array)$csv as $cs) {
    $file = $updir['baseurl'].'/products/'.$cs[1].'/'.$cs[2].'.jpg';
    $imgpath =$cs[1].'/'.$cs[2].'.jpg';
    $csvnew[] = array(
      'cikkszam' => $cs[0],
      'mappa' => $cs[1],
      'img' => $cs[2],
      'imgpath' => $imgpath,
      'url' => $file,
      'exists' => file_exists($updir['basedir'].'/products/'.$cs[1].'/'.$cs[2].'.jpg'),
      'postID' => foundPostIDByMetaValue('cikkszam', trim($cs[0]))
    );
  }

  return $csvnew;
}

function foundPostIDByMetaValue( $meta, $value )
{
  $qry = new WP_Query(array(
    'post_type' => 'termekek',
    'meta_key' => METAKEY_PREFIX.$meta,
    'meta_value' => $value
  ));

  if( $qry->have_posts() ) {
    while( $qry->have_posts() ) {
      $qry->the_post();
      return get_the_ID();
    } // end while
  } // end if
  wp_reset_postdata();
}

function updateUploadedProductImages( $csv )
{
  foreach ((array)$csv as $e) {
    if (!$e['exists'] || empty($e['postID'])) {
      continue;
    }

    auto_update_post_meta( $e['postID'], METAKEY_PREFIX . 'productprofil', trim($e['imgpath']) );
  }
}

function updateUploadedProductTags( $csv )
{
  foreach ((array)$csv as $e) {
    if (empty($e['postID']) || empty($e['tags'])) {
      continue;
    }

    wp_set_post_tags( $e['postID'], $e['tags'], false );
  }
}

function findProductUploadedImage( &$img, $postid )
{
  $imgsrc = get_post_meta($postid, METAKEY_PREFIX.'productprofil', true);
  $updir = wp_upload_dir();

  if ($imgsrc != '') {
    $img = $updir['baseurl'].'/products/'.$imgsrc;
  }

  return $img;
}

function rd_init()
{
  date_default_timezone_set('Europe/Budapest');
  setlocale(LC_TIME, "hu_HU");

  add_rewrite_rule('^jelentkezes/([0-9]+)/?', 'index.php?custom_page=jelentkezes&ac_id=$matches[1]', 'top');

  add_image_size( 'post500thumbnail', 500, 9999 );
  add_theme_support('category-thumbnails');

  /* * /
  // TAG UPDATE
  $kat_src = get_stylesheet_directory() . '/tags.csv';
  $csv = csvTAGPrepare(readCSV($kat_src));
  updateUploadedProductTags($csv);
  /* */

  /* * /
  // IMAGE UPDATE
  $kat_src = get_stylesheet_directory() . '/drorganic_termek_kepek_lista.csv';
  $csv = csvImagePrepare(readCSV($kat_src));
  updateUploadedProductImages($csv);
  /* */

  /* * /
  echo '<pre>';
  print_r($csv);
  echo '</pre>';
  /* */


  create_custom_posttypes();
}
add_action('init', 'rd_init');

add_action( 'kategoria_edit_form_fields', 'kategoria_taxonomy_custom_fields', 10, 2 );
add_action( 'kategoria_add_form_fields', 'kategoria_taxonomy_custom_fields', 10, 2 );
add_action( 'csoportok_edit_form_fields', 'kategoria_taxonomy_custom_fields', 10, 2 );
add_action( 'csoportok_add_form_fields', 'kategoria_taxonomy_custom_fields', 10, 2 );

function kategoria_taxonomy_custom_fields($tag) {
   // Check for existing taxonomy meta for the term you're editing
    $t_id = $tag->term_id; // Get the ID of the term you're editing
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check
?>

<tr class="form-field">
	<th scope="row" valign="top">
		<label for="boritokep"><?php _e('Borítókép'); ?></label>
	</th>
	<td>
		<input type="text" name="term_meta[boritokep]" id="term_meta[boritokep]" size="25" style="width:100%;" value="<?php echo $term_meta['boritokep'] ? $term_meta['boritokep'] : ''; ?>">
	</td>
</tr>

<?php
}

add_action( 'create_kategoria', 'save_kategoria_tax_field' );
add_action( 'edited_kategoria', 'save_kategoria_tax_field' );
add_action( 'create_csoportok', 'save_kategoria_tax_field' );
add_action( 'edited_csoportok', 'save_kategoria_tax_field' );
function save_kategoria_tax_field( $term_id ){
  if ( isset( $_POST['term_meta'] ) ) {
      $t_id = $term_id;
      $term_meta = get_option( "taxonomy_term_$t_id" );
      $cat_keys = array_keys( $_POST['term_meta'] );
          foreach ( $cat_keys as $key ){
          if ( isset( $_POST['term_meta'][$key] ) ){
              $term_meta[$key] = $_POST['term_meta'][$key];
          }
      }
      //save the option array
      update_option( "taxonomy_term_$t_id", $term_meta );
  }
}

function app_query_vars($aVars) {
  $aVars[] = "ac_id";
  $aVars[] = "custom_page";
  return $aVars;
}
add_filter('query_vars', 'app_query_vars');

function create_custom_posttypes()
{
  // Programok
  $products = new PostTypeFactory( 'termekek' );
	$products->set_textdomain( TD );
	$products->set_icon('tag');
	$products->set_name( 'Termék', 'Termékek' );
	$products->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
  $products->add_taxonomy( 'csoportok', array(
    'rewrite' => 'csoportok',
    'name' => array('Termékcsoport', 'Termékcsoportok'),
    'labels' => array(
      'menu_name' => 'Termékcsoportok',
      'add_new_item' => 'Új %s',
      'search_items' => '%s keresése',
      'all_items' => '%s',
    )
  ) );
  $products->add_taxonomy( 'kategoria', array(
    'rewrite' => 'termek-kategoria',
    'name' => array('Termék kategória', 'Termék kategóriák'),
    'labels' => array(
      'menu_name' => 'Termék kategóriák',
      'add_new_item' => 'Új %s',
      'search_items' => '%s keresése',
      'all_items' => '%s',
    )
  ) );

  /**/
  $prod_metabox = new CustomMetabox(
    'termekek',
    __('Termék adatok', TD),
    new ProductsMetaboxSave(),
    'termekek',
    array(
      'class' => 'productssettings-postbox'
    )
  );
  /* * /

  $programcontent_metabox = new CustomMetabox(
    'programok',
    __('Dinamikus tartalmak', TD),
    new ProgramContentMetaboxSave(),
    'programcontents',
    array(
      'class' => 'programcontents-postbox'
    )
  );
  */

  $products->create();
  add_post_type_support( 'termekek', 'excerpt' );

  // Viszonteladók
  $resellers = new PostTypeFactory( 'viszonteladok' );
	$resellers->set_textdomain( TD );
	$resellers->set_icon('admin-users');
	$resellers->set_name( 'Viszonteladó', 'Viszonteladók' );
	$resellers->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );

  $resellers_metabox = new CustomMetabox(
    'viszonteladok',
    __('Egyéb paraméterek', TD),
    new ViszonteladoMetaboxSave(),
    'viszonteladok',
    array(
      'class' => 'viszonteladoksettings-postbox'
    )
  );

  $resellers->create();
  add_post_type_support( 'viszonteladok', 'excerpt' );

  // Díjak
  $dijak = new PostTypeFactory( 'dijak' );
	$dijak->set_textdomain( TD );
	$dijak->set_icon('welcome-learn-more');
	$dijak->set_name( 'Díj', 'Díjak' );
	$dijak->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
  $dijak->create();
  add_post_type_support( 'dijak', 'excerpt' );

  // Videók
  $videos = new PostTypeFactory( 'videok' );
	$videos->set_textdomain( TD );
	$videos->set_icon('video-alt3');
	$videos->set_name( 'Videó', 'Videók' );
	$videos->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
  $videos->create();
  add_post_type_support( 'videok', 'excerpt' );

  // Facebook posts
  $fb = new PostTypeFactory( 'facebook' );
	$fb->set_textdomain( TD );
	$fb->set_icon('facebook');
	$fb->set_name( 'Facebook bejegyzés', 'Facebook bejegyzések' );
	$fb->set_labels( array(
		'add_new' => 'Új %s',
		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
		'not_found' => 'Nincsenek %s a listában.',
		'add_new_item' => 'Új %s létrehozása',
	) );
  $fb->create();
  add_post_type_support( 'facebook', 'excerpt' );


}

function getYoutubeID( $url )
{
  preg_match_all("#((http://|https://)?(www.)?youtube\.com/watch\?[=a-z0-9-&_;]+)#i", $url ,$m);
  $vURL = $m[0][0];
  $pos = strpos($vURL,'v=');
	$id = substr($vURL,$pos+2,11);

  return $id;
}


function rd_query_vars($aVars) {
  return $aVars;
}
add_filter('query_vars', 'rd_query_vars');

/**
* AJAX REQUESTS
*/
function ajax_requests()
{
  $ajax = new AjaxRequests();
  $ajax->contact_form();
  $ajax->Calendar();
}
add_action( 'init', 'ajax_requests' );

// AJAX URL
function get_ajax_url( $function )
{
  return admin_url('admin-ajax.php?action='.$function);
}

function after_logo_content()
{

}
add_filter('avada_logo_append', 'after_logo_content');


function memory_convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

function admpage_szinvalaszto_konfigurator() {
	//add_menu_page( 'Ajánlat színválasztó konfigurátor', 'Színválasztó', 'manage_options', 'szinvalaszto_konfigurator', 'szinvalaszto_konfigurator' );
}
add_action( 'admin_menu', 'admpage_szinvalaszto_konfigurator' );

function szinvalaszto_konfigurator() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

  $content = (new ShortcodeTemplates('adminpage_'.__FUNCTION__))->load_template();
  echo $content;
}

function admin_external_scripts( $hook )
{
  wp_enqueue_script('jquery-ui-datepicker');

  wp_register_style( 'jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );
  wp_enqueue_style( 'jquery-ui' );
  //wp_enqueue_style('ang-colorpicker', IFROOT . '/assets/vendors/angular-colorpicker/css/color-picker.min.css' );

  //wp_enqueue_script('angularjs', '//cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js');
  //wp_enqueue_script('ang-colorpicker', IFROOT . '/assets/vendors/angular-colorpicker/js/color-picker.min.js' );
  //wp_enqueue_script('szinvalaszto-ang', IFROOT . '/assets/js/szinvalaszto.ang.js?t=' . ( (DEVMODE === true) ? time() : '' ) );
}
add_action( 'admin_enqueue_scripts', 'admin_external_scripts' );

add_action('admin_head', 'my_custom_fonts', 999);
function my_custom_fonts() {
  echo '<style>
    .wp-picker-holder{
      position: absolute !important;
      z-index: 100 !important;
      top: 32px !important;
    }
    .wp-picker-container > a{
      height: 32px !important;
      width: 32px !important;
      border: 1px solid #f1f1f1 !important;
      display: block !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .wp-picker-container{
      height: 25px !important;
      position: relative !important;
    }
    .wp-color-result{
      float:left !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider, .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color_alpha .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider, .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-typography-container .wp-picker-container .iris-picker .iris-picker-inner > .iris-strip.iris-alpha-slider{
      margin-left: 15px !important;
    }
    .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color input[type="text"], .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-container-color_alpha input[type="text"], .avadaredux-container #avadaredux-form-wrapper .avadaredux-main .avadaredux-typography-container .wp-picker-container input[type="text"]{
      display: block !important;
      float: left !important;
    }
    table.'.TD.'{
      width: 100%;
    }
    table.'.TD.' td{
      padding: 10px;
      vertical-align: top;
    }
    table.'.TD.' input[type=text],
    table.'.TD.' input[type=time],
    table.'.TD.' input[type=number],
    table.'.TD.' select{
      width: 100%;
      padding: 8px;
      height: auto;
    }
    .programcontents > .wrapper{
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
    }
    .programcontents > .wrapper > .ct-groups{
      flex-basis: 30%;
    }
    .programcontents > .wrapper > .ct-groups .inputs .newinputs .new{
      margin: 5px 0;
    }
    .programcontents > .wrapper > .ct-groups .inputs .input:not(.new){
      background: #e8e8e8;
      padding: 5px 5px 5px 30px;
      margin: 2px 0;
      position: relative;
    }
    .programcontents > .wrapper > .ct-groups .inputs .input:not(.new) i{
      position: absolute;
      left: 12px;
      top: 50%;
      color: #c3c2c2;
      font-size: 13px;
      -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
    }
    .programcontents > .wrapper > .ct-groups .new-adder{
      text-align: right;
      margin: 5px 0;
      display: block;
      text-decoration: none;
    }
    .programcontents > .wrapper > .ct-sets{
      flex: 1;
      padding: 0 0 0 25px;
    }
    .programcontents > .wrapper > .ct-sets .content-sets .set{
      margin: 0 0 15px 0;
    }
    .programcontents > .wrapper > .ct-sets .content-sets .set input[type=text] {
        width: 100%;
        margin: 5px 0;
    }
    .programcontents > .wrapper > .ct-sets .content-sets .set label {
      display: block;
      margin: 0 0 10px 0;
      font-size: 1.2em;
    }
    .programcontents > .wrapper > .ct-groups input[type=text]{
      width: 100%;
    }
  </style>';
}

function header_custom_js()
{
    echo '<script>
    (function($) {
      $(document).ready(function(){
        $(\'#mobilnavtgl\').click(function(){
          $(\'.navmenu\').slideToggle(400);
        });
      });
    })( jQuery );
    </script>';
}
add_action( 'wp_head', 'header_custom_js' );

function header_scripts_tracking()
{
  if (defined('DEVMODE') && DEVMODE === false) {
  ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-50056233-1"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-50056233-1');
  </script>
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '204687183535500');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=204687183535500&ev=PageView&noscript=1"
/></noscript>
 <?php
 }
}
add_action( 'wp_head', 'header_scripts_tracking', 99 );

function auto_update_post_meta( $post_id, $field_name, $value = '' )
{
    if ( empty( $value ) OR ! $value )
    {
      delete_post_meta( $post_id, $field_name );
    }
    elseif ( ! get_post_meta( $post_id, $field_name ) )
    {
      add_post_meta( $post_id, $field_name, $value );
    }
    else
    {
      update_post_meta( $post_id, $field_name, $value );
    }
}

function getRecommendedPostIDSByTags( $posttype = 'posts', $postid = 0 )
{
  $tagids = array();
  $tags = wp_get_post_tags( $postid );

  foreach ( (array)$tags as $tag ) {
    $posts = new WP_Query(array(
      'post_type' => $posttype,
      'tag__in' => $tag->term_id,
      'posts_per_page' => -1,
      'post__not_in' => array($postid)
    ));

    if ($posts->have_posts()) {
      while ( $posts->have_posts() ) {
        $posts->the_post();
        $tagids[get_the_ID()]['postid'] = get_the_ID();
        $tagids[get_the_ID()]['tn'] += 1;
        $tagids[get_the_ID()]['tags'][] = $tag->name;
    	}
      wp_reset_postdata();
    }
  }

  usort($tagids, function ($item1, $item2) {
    if ($item1['tn'] == $item2['tn']) return 0;
    return $item1['tn'] < $item2['tn'] ? 1 : -1;
  });

  foreach ( (array)$tagids as $ti ) {
    $ids[] = $ti['postid'];
  }
  unset($tagids);
  unset($posts);

  return $ids;
}
