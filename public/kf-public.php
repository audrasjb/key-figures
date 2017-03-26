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

	add_action( 'wp_footer', 'kf_show_it', 200 );
	function kf_show_it() {
		if ( get_option( 'kf_settings' ) ) {
			$kfSettings = get_option( 'kf_settings' );
			
			if (isset($kfSettings['kf_field_figure_default_color'])) :
				$optionFigureDefaultColor = $kfSettings['kf_field_figure_default_color'];
				if ($optionFigureDefaultColor) : 
					$optionFigureColor = $optionFigureDefaultColor;
				else : 
					$optionFigureColor = "#333";				
				endif;
			else : 
				$optionFigureColor = "#333";				
			endif;
			
			if (isset($kfSettings['kf_field_figure_default_size'])) :
				$optionFigureDefaultSize = $kfSettings['kf_field_figure_default_size'];
				if ($optionFigureDefaultSize) : 
					$optionFigureSize = $optionFigureDefaultSize;
				else : 
					$optionFigureSize = "50";				
				endif;
			else:
				$optionFigureSize = "50";				
			endif;
			
			if (isset($kfSettings['kf_field_figure_default_animation'])) :
				$optionFigureAnimationDefault = $kfSettings['kf_field_figure_default_animation'];
				if ($optionFigureAnimationDefault) : 
					$optionFigureAnimation = $optionFigureAnimationDefault;
					else : 
					$optionFigureAnimation = "none";				
				endif; 
			else : 
				$optionFigureAnimation = "none";				
			endif;
			
			if (isset($kfSettings['kf_field_text_default_color'])) :
				$optionTextDefaultColor = $kfSettings['kf_field_text_default_color'];
				if ($optionFigureDefaultColor) : 
					$optionTextColor = $optionTextDefaultColor;
				else : 
					$optionTextColor = "#333";				
				endif; 
			else : 
				$optionTextColor = "#333";				
			endif;
			
			if (isset($kfSettings['kf_field_text_default_size'])) :
				$optionTextDefaultSize = $kfSettings['kf_field_text_default_size'];
				if ($optionFigureDefaultSize) : 
					$optionTextSize = $optionTextDefaultSize;
				else : 
					$optionTextSize = "18";				
				endif; 
			else : 
				$optionTextSize = "18";				
			endif;
			echo '<style>';
			echo '
			/**
			* Key Figures stylesheet
			*/
			.keyfigure_bloc {
				display: table;
				padding: 0;
				margin: 0;
			}
			.keyfigure_bloc_figure {
				display: table-cell;
				vertical-align: middle;
				font-size: ' . $optionFigureSize . 'px;
				color: ' . $optionFigureColor . ';
			}
			.keyfigure_bloc_text {
				display: table-cell;
				vertical-align: middle;
				padding-left: 1em;
				font-size: ' . $optionTextSize . 'px;
				color: ' . $optionTextColor . ';
			}
			';
			echo '</style>';
			if (isset($kfSettings['kf_field_figure_default_animation']) && $kfSettings['kf_field_figure_default_animation'] != 'none') :
				echo '<script>';
				echo 'jQuery(window).load(function() {';
				if ($optionFigureAnimation == 'counter') :
echo "
var a = 0;
jQuery(window).scroll(function() {

  var oTop = jQuery('.keyfigure_bloc').offset().top - window.innerHeight;
  if (a == 0 && jQuery(window).scrollTop() > oTop) {
    jQuery('.counter-value').each(function() {
      var counter = $(this),
        countTo = counter.attr('data-figure');
      jQuery({
        countNum: counter.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 2000,
          easing: 'swing',
          step: function() {
            counter.text(Math.floor(this.countNum));
          },
          complete: function() {
            counter.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
  }

});
";
				elseif ($optionFigureAnimation == 'fadein') :
				endif ;		
				echo '});';		
				echo '</script>';
			endif;
		}
	}
