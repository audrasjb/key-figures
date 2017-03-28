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
	wp_enqueue_style( 'kf-admin-styles', plugin_dir_url( __FILE__ ) . 'css/kf-admin.css', array(), '', 'all' );
	add_editor_style( plugin_dir_url( __FILE__ ) . 'css/kf-admin-editor.css' );
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
		__( 'Figures animation type', 'key-figures' ), 
		'kf_field_figure_default_animation_render', 
		'key_figures_page', 
		'kf_key_figures_page_section' 
	);

	// Default figure size
	add_settings_field( 
		'kf_field_figure_default_animation_duration', 
		__( 'Animation duration', 'key-figures' ), 
		'kf_field_figure_default_animation_duration_render', 
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
		$optionFigureAnimationDefault = 'none';		
	}
	?>
	<select name='kf_settings[kf_field_figure_default_animation]'>
		<option value="none" <?php selected( $optionFigureAnimationDefault, 'none' ); ?>><?php echo __('No animation', 'key-figures'); ?></option>
		<option value="counter" <?php selected( $optionFigureAnimationDefault, 'counter' ); ?>><?php echo __('Counter', 'key-figures'); ?></option>
		<option value="fadein" <?php selected( $optionFigureAnimationDefault, 'fadein' ); ?>><?php echo __('Fade in', 'key-figures'); ?></option>
	</select>
	<?php /*<p class="description"><?php echo __('Note: custom position is not ok with all WordPress themes. It needs a fixed element to stick the progressbar on it. <br />You may need some custom CSS to put the progressbar on the right place as it uses absolute positionning.', 'key-figures'); ?></p> */ ?>
<?php
}


function kf_field_figure_default_animation_duration_render(  ) { 
	$options = get_option( 'kf_settings' );
	if (isset($options['kf_field_figure_default_animation_duration'])) {
		$optionFigureDefaultAnimationDuration = $options['kf_field_figure_default_animation_duration'];
	} else {
		$optionFigureDefaultAnimationDuration = '1500';		
	}
	?>
	<input type="number" name="kf_settings[kf_field_figure_default_animation_duration]" value="<?php echo $optionFigureDefaultAnimationDuration; ?>" />
	<span class="description"><?php echo __('If you selected an animation type below, you can choose it’s duration in milliseconds (1 second = 1000 milliseconds)', 'key-figures'); ?></span>
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

/**
 *
 * Plugin button in WordPress visual editor
 *
 */

class TinyMCE_KF {
	/**
	* Plugin constructor.
	*/
	function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array(  $this, 'setup_tinymce_kf' ) );
		}
	}
	/**
	* Check if the current user can edit Posts or Pages, and is using the Visual Editor
	* If so, add some filters
	*/
	function setup_tinymce_kf() {
		// Check if the logged in WordPress User can edit Posts or Pages
		// If not, don't register
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        	return;
		}

		// Check if the logged in WordPress User has the Visual Editor enabled
		// If not, don't register
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		// Setup filters
		add_action( 'plugins_loaded', 'load_languages_tinymce_kf' );
		add_action( 'before_wp_tiny_mce', array( &$this, 'translate_tinymce_kf' ) );
		add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_kf' ) );
		add_filter( 'mce_buttons_2', array( &$this, 'add_tinymce_kf_toolbar_button' ) );		
	}	

	/**
	* Adds the plugin to the TinyMCE / Visual Editor instance
	*	
	* @param array $plugin_array Array of registered TinyMCE Plugins
	* @return array Modified array of registered TinyMCE Plugins
	*/
	function add_tinymce_kf( $plugin_array ) {
		$plugin_array['tinymce_kf_class'] = plugin_dir_url( __FILE__ ) . 'js/tinymce-kf-class.js';
		return $plugin_array;
	}

	/**
	* Plugin's internationalization 
	*	
	* First load translation files
	* Then add translation strings to a javascript variable
	*/
	function load_languages_tinymce_kf() {
	    load_plugin_textdomain( 'key-figures', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
	// Adding i18n tinymce strings
	function translate_tinymce_kf() {
		if (isset($options['kf_field_figure_default_animation'])) {
			$optionFigureAnimationDefault = $options['kf_field_figure_default_animation'];
		} else {
			$optionFigureAnimationDefault = 'none';		
		}
		$translations = json_encode(
			array( 
				'kf_add_button' 	=> __('Key figure', 'key-figures'),
				'kf_delete_button' 	=> __('Delete figure', 'key-figures'),
				'kf_figure_label' 	=> __('Figure', 'key-figures'),
				'kf_figure_help' 	=> __('Enter number', 'key-figures'),
				'kf_text_label' 	=> __('Text', 'key-figures'),
				'kf_text_help' 		=> __('Enter text', 'key-figures'),
			)
		);
		echo '<script>var kfTranslations = ' . $translations . ';</script>';
	}

	/**
	* Adds a button to the TinyMCE / Visual Editor which the user can click
	* to insert the kf node tag.
	*
	* @param array $buttons Array of registered TinyMCE Buttons
	* @return array Modified array of registered TinyMCE Buttons
	*/
	function add_tinymce_kf_toolbar_button( $buttons ) {
		array_push( $buttons, 'tinymce_kf_class' );
		return $buttons;
	}
}
$TinyMCE_kf = new TinyMCE_KF;