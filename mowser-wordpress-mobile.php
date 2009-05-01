<?php
/*
Plugin Name: Mowser Wordpress Mobile
Plugin URI: http://pub.mowser.com/wiki/Main/WordPressPlugin
Description: This plugin will detect mobile phones, and redirect to Mowser.com. 
Version: 2.6
Author: Mike Rowehl
Author URI: http://www.mowser.com
*/

/*  Copyright 2007 Mike Rowehl (email : info@mowser.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


function mowser_mobile_url() {
    $alt_base = get_option('mowser_alternatebaseurl');
    if ( $alt_base && !empty($alt_base) ) {
        return 'http://' . $alt_base . $_SERVER['REQUEST_URI'];
    }
    return 'http://m.mowser.com/web/' . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}


function mowser_headers() {
	echo "\n\n<!-- Added by Mowser Wordpress Mobile -->\n" . '<link rel="alternate" type="text/html" media="handheld" href="' . mowser_mobile_url() . '" title="Mobile/PDA" />' . "\n";

	$admobid = get_option('mowser_admobid');
	if ( ($admobid !== false) && !empty($admobid) ) {
		echo '<meta scheme="admob" name="siteid" content="' . $admobid . '" />' . "\n";
    }

    $mobilecss = get_option('mowser_mobilecss');
    if ( $mobilecss === false ) {
        $mobilecss = mowser_default_mobilecss();
    }
    if ( !empty($mobilecss) ) {
        echo '<link rel="stylesheet" type="text/css" media="handheld" href="' . $mobilecss . '" />' . "\n";
    }
}


function mowser_redirect() {

	$isMobile = false;

	$op = strtolower($_SERVER['HTTP_X_OPERAMINI_PHONE']);
	$no = strtolower($_SERVER['HTTP_X_MOBILE_GATEWAY']);
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ac = strtolower($_SERVER['HTTP_ACCEPT']);
	$ip = $_SERVER['REMOTE_ADDR'];

	$isMobile = strpos($ac, 'application/vnd.wap.xhtml+xml') !== false
        || $op != ''
        || $no != '' 
        || strpos($ua, 'sony') !== false 
        || strpos($ua, 'symbian') !== false 
        || strpos($ua, 'nokia') !== false 
        || strpos($ua, 'samsung') !== false 
        || strpos($ua, 'mobile') !== false
        || strpos($ua, 'windows ce') !== false
        || strpos($ua, 'epoc') !== false
        || strpos($ua, 'opera mini') !== false
        || strpos($ua, 'nitro') !== false
        || strpos($ua, 'j2me') !== false
        || strpos($ua, 'midp-') !== false
        || strpos($ua, 'cldc-') !== false
        || strpos($ua, 'netfront') !== false
        || strpos($ua, 'mot') !== false
        || strpos($ua, 'up.browser') !== false
        || strpos($ua, 'up.link') !== false
        || strpos($ua, 'audiovox') !== false
        || strpos($ua, 'blackberry') !== false
        || strpos($ua, 'ericsson,') !== false
        || strpos($ua, 'panasonic') !== false
        || strpos($ua, 'philips') !== false
        || strpos($ua, 'sanyo') !== false
        || strpos($ua, 'sharp') !== false
        || strpos($ua, 'sie-') !== false
        || strpos($ua, 'portalmmm') !== false
        || strpos($ua, 'blazer') !== false
        || strpos($ua, 'avantgo') !== false
        || strpos($ua, 'danger') !== false
        || strpos($ua, 'palm') !== false
        || strpos($ua, 'series60') !== false
        || strpos($ua, 'palmsource') !== false
        || strpos($ua, 'pocketpc') !== false
        || strpos($ua, 'smartphone') !== false
        || strpos($ua, 'rover') !== false
        || strpos($ua, 'ipaq') !== false
        || strpos($ua, 'au-mic,') !== false
        || strpos($ua, 'alcatel') !== false
        || strpos($ua, 'ericy') !== false
        || strpos($ua, 'up.link') !== false
        || strpos($ua, 'vodafone/') !== false
        || strpos($ua, 'wap1.') !== false
        || strpos($ua, 'wap2.') !== false;

	 // PHP Code to redirect to Mowser: 

	if($isMobile){
	   header('Location: ' . mowser_mobile_url());
	   exit();
	}

}


function mowser_admin() {
	if (function_exists('add_submenu_page')) {
		add_options_page('Mowser Setup', 'Mowser', 10, basename(__FILE__), 'mowser_admin_page');
	}
}

function mowser_default_mobilecss() {
    return 'http://pub.mowser.com/media/stylesheets/wordpress.css';
}

function mowser_admin_page() {
	if (isset($_POST['mowser_options_submit'])) {
		update_option('mowser_admobid', $_POST['mowser_admobid']);
		update_option('mowser_alternatebaseurl', $_POST['mowser_alternatebaseurl']);
        update_option('mowser_mobilecss', $_POST['mowser_mobilecss']);

		echo '<div id="message" class="updated fade"><p><strong>';
		_e('Options saved.');
		echo '</strong></p></div>';
	}

	$admobid = get_option('mowser_admobid');
	if ($admobid === false) {
		$admob_id = '';
	}

	$altbaseurl = get_option('mowser_alternatebaseurl');
	if ($altbaseurl === false) {
		$altbaseurl = '';
    }

	$mobilecss = get_option('mowser_mobilecss');
	if ($mobilecss === false) {
		$mobilecss = mowser_default_mobilecss();
    }
?>
	<div class="wrap">
	<h2>Mowser Options Page</h2>

	<form name="mowser_options_form" action="<?php echo $_SERVER['PHP_SELF'] . '?page=' . basename(__FILE__); ?>" method="post">
	<ul style="width:75%">
	<li><strong>AdMob Site ID</strong>: <input type="text" name="mowser_admobid" id="mowser_admobid" value="<?php echo $admobid;?>" /> (optional)<br />
    You can get an AdMob site ID by registering for free at <a href="http://www.admob.com">AdMob</a> and configuring a site.</li>
    <li><strong>Mobile Domain Name</strong>: <input type="text" name="mowser_alternatebaseurl" value="<?php echo $altbaseurl;?>" /> (optional)<br />
    If you have Mowser configured to use a mobile specific domain for your site you can enter that here and the plugin will use that instead of m.mowser.com when constructing mobile links local to your site.</li>
    <li><strong>Handheld Stylesheet</strong>: <input type="text" name="mowser_mobilecss" value="<?php echo $mobilecss;?>" /> (optional)<br />
    Handheld stylesheet to include when displaying the mobile version of your blog.  We have a default version hosted at <?php echo mowser_default_mobilecss(); ?> which you can either use as is, or copy locally and modify to suit your preferences. Visit the <a href="http://pub.mowser.com/wiki/Main/WordPressPlugin">Mowser publisher wiki</a> for handheld stylesheets for other Wordpress themes.</li>
	</ul>
	<div class="submit" style="float:right">
	<input type="submit" name="mowser_options_submit" value="<?php _e('Update Options &raquo;') ?>"/>
	</div>
	</form>
<?php
}

function mowser_widget_init() {
  if ( !function_exists('register_sidebar_widget') ) {
    return;
  }

  function mowser_widget($args) {
    extract($args);
    echo $before_widget;
    echo $before_title.'Mobile Version'.$after_title;
    echo "<a href='" . mowser_mobile_url() . "'>Switch to mobile view:</a>";
    echo "<a href='" . mowser_mobile_url() . "'><img style='border:none;' width='91' height='18' src='http://pub.mowser.com/media/mobileweb.png' /></a><br />";
    echo $after_widget;
  }
  register_sidebar_widget('Mowser Widget', 'mowser_widget');
}

add_action('wp_head', 'mowser_headers');
add_action('template_redirect', 'mowser_redirect');
add_action('admin_menu', 'mowser_admin');
add_action('plugins_loaded', 'mowser_widget_init');

?>
