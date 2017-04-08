<?php

/**
 * @link              https://jeanbaptisteaudras.com/portfolio/extension-wordpress-chiffre-cles/
 * @since             1.0
 * @package           Key Figures
 *
 * @wordpress-plugin
 * Plugin Name:       Key Figures
 * Plugin URI:        https://jeanbaptisteaudras.com/portfolio/extension-wordpress-chiffre-cles/
 * Description:       Display key figures with custom styles and animations in WordPress visual editor.
 * Version:           1.0
 * Author:            Jean-Baptiste Audras, project manager @ Whodunit
 * Author URI:        http://jeanbaptisteaudras.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       key-figures
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * i18n
 */
load_plugin_textdomain( 'key-figures', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

/**
 * Admin
 */
if (is_admin()) {
	require_once plugin_dir_path( __FILE__ ) . 'admin/kf-admin.php';
}
/**
 * Public
 */
require_once plugin_dir_path( __FILE__ ) . 'public/kf-public.php';
