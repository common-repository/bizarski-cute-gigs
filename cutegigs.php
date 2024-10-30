<?php
/**
 * @package Bizarski Cute Gigs
 */
/*
Plugin Name: Bizarski Cute Gigs
Description: Gigs management for rock bands. For documentation, visit my website. 
Plugin URI: http://cuteplugins.com/wordpress-cute-gigs/
Version: 1.2.0
Author: Bizarski
License: GPLv2 or later
*/

$cutegigs_thumb_w = get_option('cutegigs_thumb_w');
$cutegigs_thumb_w = $cutegigs_thumb_w ? $cutegigs_thumb_w : 150;

$cutegigs_thumb_h = get_option('cutegigs_thumb_h');
$cutegigs_thumb_h = $cutegigs_thumb_h ? $cutegigs_thumb_h : 212;

$cutegigs_side_w = get_option('cutegigs_side_w');
$cutegigs_side_w = $cutegigs_side_w ? $cutegigs_side_w : 200;

$cutegigs_side_h = get_option('cutegigs_side_h');
$cutegigs_side_h = $cutegigs_side_h ? $cutegigs_side_h : 283;

$cutegigs_cont_css = get_option('cutegigs_cont_css');
$cutegigs_cont_css = $cutegigs_cont_css ? $cutegigs_cont_css : 'width: 500px; background: rgba(0,0,0,.1); color: #000';

$cutegigs_but_css = get_option('cutegigs_but_css');
$cutegigs_but_css = $cutegigs_but_css ? $cutegigs_but_css : 'border-bottom: 1px solid rgba(0,0,0,.2)';

$cutegigs_but_css_h = get_option('cutegigs_but_css_h');
$cutegigs_but_css_h = $cutegigs_but_css_h ? $cutegigs_but_css_h : 'border-bottom: 1px solid rgba(0,0,0,.5); text-decoration: none';

define('cutegigs_THUMB_WIDTH', $cutegigs_thumb_w);
define('cutegigs_THUMB_HEIGHT', $cutegigs_thumb_h);
define('cutegigs_SIDE_WIDTH', $cutegigs_side_w);
define('cutegigs_SIDE_HEIGHT', $cutegigs_side_h);
define('cutegigs_CONT_CSS', $cutegigs_cont_css);
define('cutegigs_BUT_CSS', $cutegigs_but_css);
define('cutegigs_BUT_CSS_H', $cutegigs_but_css_h);

define('cutegigs_VER', '1.2.0');
define('cutegigs_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('cutegigs_PLUGIN_PATH', dirname(__FILE__));

//define('CUTEGIGS_DIRS', '\\'); //localhost
define('CUTEGIGS_DIRS', '/');

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

include_once dirname( __FILE__ ) . '/widget.php';

class BizarskiCuteGigs { 

	function init() { 
	
		wp_register_style('cutegigs.css', cutegigs_PLUGIN_URL . 'cutegigs.css');
		wp_enqueue_style('cutegigs.css');
		
		if(!is_admin()) { 
			wp_register_script('fancybox', cutegigs_PLUGIN_URL . 'script/fancybox/jquery.fancybox-1.3.4.js', array('jquery'));
			wp_enqueue_script('fancybox');
			wp_register_script('cutegigs-front', cutegigs_PLUGIN_URL . 'cutegigs.front.js.php', array('jquery', 'fancybox'));
			wp_enqueue_script('cutegigs-front');
			
			wp_register_style('fancybox', cutegigs_PLUGIN_URL . 'script/fancybox/jquery.fancybox-1.3.4.css');
			wp_enqueue_style('fancybox');
		} else { 
			wp_register_script('cutegigs-back', cutegigs_PLUGIN_URL . 'cutegigs.js.php', array('jquery'));
			wp_enqueue_script('cutegigs-back');
		}
		if (!session_id()) {
			session_start();
		}
	}
	
	function admin() {
		if(is_super_admin()) { 
			require_once dirname( __FILE__ ) . '/include/admin.php';
		}
	}
	
	function admin_settings() {
		if(is_super_admin()) { 
			require_once dirname( __FILE__ ) . '/include/admin_settings.php';
		}
	}
	
	function admin_actions() {
		self::battle_scripts();
		if(is_super_admin()) { 
			add_menu_page("Cute Gigs", "Cute Gigs", 'add_users', "cutegigs-admin", array("BizarskiCuteGigs", "admin"), false);
			add_submenu_page("cutegigs-admin", "Manage Gigs", "Manage Gigs", 'add_users', 'cutegigs-admin', array("BizarskiCuteGigs", "admin"));
			add_submenu_page("cutegigs-admin", "Settings", "Settings", 'add_users', 'cutegigs-settings', array("BizarskiCuteGigs", "admin_settings"));
		}
	}
	
	function battle_scripts() { 
		wp_register_script('jquery-ui-core', cutegigs_PLUGIN_URL . 'script/jquery.ui.core.js', array('jquery'));
		wp_enqueue_script('jquery-ui-core');
		wp_register_script('jquery-ui-widget', cutegigs_PLUGIN_URL . 'script/jquery.ui.widget.js', array('jquery', 'jquery-ui-core'));
		wp_enqueue_script('jquery-ui-widget');
		wp_register_script('datepicker', cutegigs_PLUGIN_URL . 'script/datepicker.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget'));
		wp_enqueue_script('datepicker');
		
		wp_register_style('jquery.ui.all.css', cutegigs_PLUGIN_URL . 'script/base/jquery.ui.all.css');
		wp_enqueue_style('jquery.ui.all.css');
		wp_register_style('datePicker.css', cutegigs_PLUGIN_URL . 'script/datePicker.css');
		wp_enqueue_style('datePicker.css');
	}
	
	function install() { 
		global $wpdb;
		$cutegigs_ver = get_option("cutegigs_ver");

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		$table = "CREATE TABLE ".$wpdb->prefix."cutegigs (
		id int(11) NOT NULL auto_increment,
		date DATE NOT NULL DEFAULT '0000-00-00', 
		place VARCHAR(128) DEFAULT NULL,
		starttime VARCHAR(64) DEFAULT NULL,
		price VARCHAR(64) DEFAULT NULL,
		otherbands text DEFAULT NULL,
		poster VARCHAR(128) DEFAULT NULL,
		button1_label VARCHAR(64) DEFAULT NULL,
		button1_url VARCHAR(256) DEFAULT NULL,
		button1_target TINYINT(1) NOT NULL DEFAULT '0',
		button2_label VARCHAR(64) DEFAULT NULL,
		button2_url VARCHAR(256) DEFAULT NULL,
		button2_target TINYINT(1) NOT NULL DEFAULT '0',
		button3_label VARCHAR(64) DEFAULT NULL,
		button3_url VARCHAR(256) DEFAULT NULL,
		button3_target TINYINT(1) NOT NULL DEFAULT '0',
		PRIMARY KEY  (id) 
		);";

		dbDelta($table);
		
		if(!$cutegigs_ver) { 
			add_option("cutegigs_ver", cutegigs_VER);
		}
	}
	
	function check_db_version() { 
		global $wpdb;
		$cutegigs_ver = get_option("cutegigs_ver");
		if($cutegigs_ver != cutegigs_VER || !$cutegigs_ver) { 
			self::install();
			update_option("cutegigs_ver", cutegigs_VER);
		}
	}
	
	function button_style() { 
		echo '<style type="text/css" media="screen">';
		echo 'a.cutegigs_button { '.cutegigs_BUT_CSS.' }';
		echo 'a.cutegigs_button:hover { '.cutegigs_BUT_CSS_H.' }';
		echo '</style>';
	}
	
	function display_upcoming_gigs() { 
		
		self::button_style();
		
		global $wpdb; 
		
		$uploads = wp_upload_dir();
		$baseurl = $uploads['baseurl'];
		
		$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."cutegigs WHERE date >= CURRENT_DATE ORDER BY date ASC");
		$content = '';
		if(count($results) > 0) { 
			foreach($results as $gig) { 
				$content .= '<div class="cutegigs_container cutegigs_upcoming" style="'.cutegigs_CONT_CSS.'">';
				$content .= '<a href="'.$baseurl.'/posters/'.esc_attr($gig->poster).'" class="cutegigs-fancybox"><img alt="" src="'.$baseurl.'/posters/thumbs/'.esc_attr($gig->poster).'" width="'.cutegigs_THUMB_WIDTH.'"></a>';
				$content .= '<h3 class="cutegigs_date">'.date("d.m.Y", strtotime($gig->date)).'</h3><br>';
				$content .= '<h4 class="cutegigs_details"><span class="cutegigs_place">'.stripslashes($gig->place).'</span></h4><br>';
				$content .= '<p class="cutegigs_details"><span class="cutegigs_starttime">'.stripslashes($gig->starttime).'</span>, <span class="cutegigs_price">'.stripslashes($gig->price).'</span></p><br>';
				if($gig->otherbands) { 
					$content .= '<div class="cutegigs_otherbands">with: <br><div class="cutegigs_otherbands_names">'.stripslashes(nl2br($gig->otherbands)).'</div></div>';
				}
				
				if(($gig->button1_label && $gig->button1_url)
				|| ($gig->button2_label && $gig->button2_url) 
				|| ($gig->button3_label && $gig->button3_url)) { 
					$content .= '<br><div class="cutegigs_buttons">';
					if($gig->button1_label && $gig->button1_url) { 
						$content .= '<a'.($gig->button1_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button1_url).'" class="cutegigs_button cutegigs_butn_1">'.stripslashes($gig->button1_label).'</a>';
					}
					if($gig->button2_label && $gig->button2_url) { 
						$content .= '<a'.($gig->button2_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button2_url).'" class="cutegigs_button cutegigs_butn_2">'.stripslashes($gig->button2_label).'</a>';
					}
					if($gig->button3_label && $gig->button3_url) { 
						$content .= '<a'.($gig->button3_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button3_url).'" class="cutegigs_button cutegigs_butn_3">'.stripslashes($gig->button3_label).'</a>';
					}
					$content .= '</div>';
				}
				
				$content .= '</div>';
			}
			$content .= '<div style="clear: both"></div>';
		}  else { 
			$content .= '<p>No upcoming shows.</p>';
		}
		return $content;
	}
	
	function display_past_gigs($args) { 
	
		self::button_style();
	
		global $wpdb; 
		
		$uploads = wp_upload_dir();
		$baseurl = $uploads['baseurl'];
		
		$content = '';
		$limit = $args['limit'] ? " LIMIT ".$args['limit']." " : '';
		$offset = $args['offset'] ? " OFFSET ".$args['offset']." " : '';
		$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."cutegigs WHERE date < CURRENT_DATE ORDER BY date DESC".$limit.$offset);
		if(count($results) > 0) { 
			foreach($results as $gig) { 
				$content .= '<div class="cutegigs_container cutegigs_past" style="'.cutegigs_CONT_CSS.'">';
				$content .= '<a href="'.$baseurl.'/posters/'.esc_attr($gig->poster).'" class="cutegigs-fancybox"><img alt="" src="'.$baseurl.'/posters/thumbs/'.esc_attr($gig->poster).'" width="'.cutegigs_THUMB_WIDTH.'"></a>';
				$content .= '<h3 class="cutegigs_date">'.date("d.m.Y", strtotime($gig->date)).'</h3><br>';
				$content .= '<h4 class="cutegigs_details"><span class="cutegigs_place">'.stripslashes($gig->place).'</span></h4><br>';
				$content .= '<p class="cutegigs_details"><span class="cutegigs_starttime">'.stripslashes($gig->starttime).'</span>, <span class="cutegigs_price">'.stripslashes($gig->price).'</span></p><br>';
				if($gig->otherbands) { 
					$content .= '<div class="cutegigs_otherbands">with: <br><div class="cutegigs_otherbands_names">'.stripslashes(nl2br($gig->otherbands)).'</div></div>';
				}
				
				if(!$args['hide_buttons']) { 
					if(($gig->button1_label && $gig->button1_url)
					|| ($gig->button2_label && $gig->button2_url) 
					|| ($gig->button3_label && $gig->button3_url)) { 
						$content .= '<br><div class="cutegigs_buttons">';
						if($gig->button1_label && $gig->button1_url) { 
							$content .= '<a'.($gig->button1_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button1_url).'" class="cutegigs_button cutegigs_butn_1">'.stripslashes($gig->button1_label).'</a>';
						}
						if($gig->button2_label && $gig->button2_url) { 
							$content .= '<a'.($gig->button2_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button2_url).'" class="cutegigs_button cutegigs_butn_2">'.stripslashes($gig->button2_label).'</a>';
						}
						if($gig->button3_label && $gig->button3_url) { 
							$content .= '<a'.($gig->button3_target ? ' target="_blank"' : '').' href="'.esc_attr($gig->button3_url).'" class="cutegigs_button cutegigs_butn_3">'.stripslashes($gig->button3_label).'</a>';
						}
						$content .= '</div>';
					}
				}
				
				$content .= '</div>';
			}
			$content .= '<div style="clear: both"></div>';
		} 
		return $content;
	}
	
}

register_activation_hook(__FILE__,array('BizarskiCuteGigs', 'install'));
add_action('init', array('BizarskiCuteGigs', 'init'));
add_action('plugins_loaded', array('BizarskiCuteGigs', 'check_db_version'));
add_action('admin_menu', array('BizarskiCuteGigs', 'admin_actions') );
add_shortcode('cutegigs_upcoming_gigs', array('BizarskiCuteGigs', 'display_upcoming_gigs'));
add_shortcode('cutegigs_past_gigs', array('BizarskiCuteGigs', 'display_past_gigs'));