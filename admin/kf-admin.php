<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeanbaptisteaudras.com
 * @author     audrasjb <audrasjb@gmail.com>
 * @since      1.0
 *
 * @package    kf
 * @subpackage kf/admin
 */

/**
 *
 * Plugin options in appearance section
 *
 */

// Enqueue styles
add_action( 'admin_enqueue_scripts', 'enqueue_styles_key_figures_admin' );
function enqueue_styles_key_figures_admin() {
	wp_enqueue_style( 'wp-color-picker' );
//	wp_enqueue_style( 'kf-admin-styles', plugin_dir_url( __FILE__ ) . 'css/kf-admin.css', array(), '', 'all' );
}
	
// Enqueue scripts
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_key_figures_admin' );
function enqueue_scripts_key_figures_admin() {
	wp_enqueue_script( 'kf-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/kf-admin.js', array( 'jquery', 'wp-color-picker' ), '', false );
}	

add_action( 'admin_menu', 'kf_add_admin_menu' );
add_action( 'admin_init', 'kf_settings_init' );


function kf_add_admin_menu(  ) { 
	
	add_theme_page( __('Key Figures settings', 'key-figures'), __('Key figures', 'key-figures'), 'manage_options', 'key-figures', 'kf_options_page' );

}


function kf_settings_init(  ) { 

	register_setting( 'key_figures_page', 'kf_settings' );

	// Main section
	add_settings_section(
		'kf_key_figures_page_section', 
		__( 'Key figures settings', 'key-figures' ), 
		'kf_settings_section_callback', 
		'key_figures_page'
	);

	// Default figure color
	add_settings_field( 
		'kf_field_figure_default_color', 
		__( 'Figures color', 'key-figures' ), 
		'kf_field_figure_default_color_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);

	// Default figure size
	add_settings_field( 
		'kf_field_figure_default_size', 
		__( 'Figures size', 'key-figures' ), 
		'kf_field_figure_default_size_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);

	// Default figure animation
	add_settings_field( 
		'kf_field_figure_default_animation', 
		__( 'Figures animation', 'key-figures' ), 
		'kf_field_figure_default_animation_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);
	
	// Default text color
	add_settings_field( 
		'kf_field_text_default_color', 
		__( 'Text color', 'key-figures' ), 
		'kf_field_text_default_color_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);

	// Default text size
	add_settings_field( 
		'kf_field_text_default_size', 
		__( 'Text size', 'key-figures' ), 
		'kf_field_text_default_size_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);

}


function kf_field_figure_default_color_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_color'])) {
		$optionFigureDefaultColor = $options['kf_field_figure_default_color'];
	} else {
		$optionFigureDefaultColor = '';		
	}
	?>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_figure_default_color]" value="<?php echo $optionFigureDefaultColor; ?>" />
	<?php
}


function kf_field_figure_default_size_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_size'])) {
		$optionFigureDefaultSize = $options['kf_field_figure_default_size'];
	} else {
		$optionFigureDefaultSize = '';		
	}
	?>
	<input type="number" name="kf_settings[kf_field_figure_default_size]" value="<?php echo $optionFigureDefaultSize; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<?php
}


function kf_field_figure_default_animation_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_animation'])) {
		$optionFigureAnimationDefault = $options['kf_field_figure_default_animation'];
	} else {
		$optionFigureAnimationDefault = '';		
	}
	?>
	<select name='rp_settings[kf_field_figure_default_animation]'>
		<option value="none" <?php selected( $optionFigureAnimationDefault, 'none' ); ?>><?php echo __('No animation', 'key-figures'); ?></option>
		<option value="counter" <?php selected( $optionFigureAnimationDefault, 'counter' ); ?>><?php echo __('Counter', 'key-figures'); ?></option>
		<option value="fadein" <?php selected( $optionFigureAnimationDefault, 'fadein' ); ?>><?php echo __('Fade in', 'key-figures'); ?></option>
	</select>
	<?php /*<p class="description"><?php echo __('Note: custom position is not ok with all WordPress themes. It needs a fixed element to stick the progressbar on it. <br />You may need some custom CSS to put the progressbar on the right place as it uses absolute positionning.', 'key-figures'); ?></p> */ ?>
<?php
}


function kf_field_text_default_color_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_text_default_color'])) {
		$optionTextDefaultColor = $options['kf_field_text_default_color'];
	} else {
		$optionTextDefaultColor = '';		
	}
	?>
	<input type="text" class="kf-colorpicker" name="kf_settings[kf_field_text_default_color]" value="<?php echo $optionTextDefaultColor; ?>" />
	<?php
}


function kf_field_text_default_size_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_text_default_size'])) {
		$optionTextDefaultSize = $options['kf_field_text_default_size'];
	} else {
		$optionTextDefaultSize = '';		
	}
	?>
	<input type="number" name="kf_settings[kf_field_text_default_size]" value="<?php echo $optionTextDefaultSize; ?>" />
	<span class="description"><?php echo __('Pixels (px)', 'key-figures'); ?></span>
	<?php
}


function kf_settings_section_callback(  ) { 

	echo __( 'Manage key figures default options below.', 'key-figures' );

}


function kf_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'key_figures_page' );
		do_settings_sections( 'key_figures_page' );
		submit_button();
		?>

	</form>
	<?php

}