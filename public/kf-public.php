<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @author     audrasjb <audrasjb@gmail.com>
 * @since      1.0.0
 *
 * @package    kf
 * @subpackage kf/public
 */

 	add_action( 'wp_enqueue_scripts', 'enqueue_styles_key_figures_public' );
	function enqueue_styles_key_figures_public() {
		wp_enqueue_style( 'kf-public-styles', plugin_dir_url( __FILE__ ) . 'css/kf-public.css', array(), '', 'all' );
	}

 	add_action( 'wp_enqueue_scripts', 'enqueue_scripts_key_figures_public' );
	function enqueue_scripts_key_figures_public() {
		wp_enqueue_script( 'kf-public-scripts', plugin_dir_url( __FILE__ ) . 'js/kf-public.js', array( 'jquery' ), '', false );
	}
