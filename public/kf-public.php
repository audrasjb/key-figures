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

			if (isset($kfSettings['kf_field_figure_default_animation_duration'])) :
				$optionFigureAnimationDurationDefault = $kfSettings['kf_field_figure_default_animation_duration'];
				if ($optionFigureAnimationDurationDefault) : 
					$optionFigureAnimationDuration = $optionFigureAnimationDurationDefault;
					else : 
					$optionFigureAnimationDuration = "1500";				
				endif; 
			else : 
				$optionFigureAnimationDuration = "1500";				
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

			if (isset($kfSettings['kf_field_box_default_bgcolor'])) :
				$optionBoxDefaultBgColor = $kfSettings['kf_field_box_default_bgcolor'];
				if ($optionBoxDefaultBgColor) : 
					$optionBoxBgColor = $optionBoxDefaultBgColor;
				else : 
					$optionBoxBgColor = "#fff";				
				endif; 
			else : 
				$optionBoxBgColor = "#fff";				
			endif;

			if (isset($kfSettings['kf_field_box_default_border_color'])) :
				$optionBoxDefaultBorderColor = $kfSettings['kf_field_box_default_border_color'];
				if ($optionBoxDefaultBorderColor) : 
					$optionBoxBorderColor = $optionBoxDefaultBorderColor;
				else : 
					$optionBoxBorderColor = "#fff";				
				endif; 
			else : 
				$optionBoxBorderColor = "#fff";				
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
				background-color: ' . $optionBoxBgColor . ';
				border: ' . $optionBoxBorderColor . ';
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
				if ($optionFigureAnimation == "counter") :
				echo '
				<script>
				jQuery(window).load(function() {
					var keyFigures = new Array();
					jQuery(".keyfigure_bloc_figure").each(function() {
						keyFigures.push(0);
						var counterFinalValue = jQuery(this).text();
						jQuery(this).attr("data-value", counterFinalValue);
					});
					jQuery(window).scroll(function() {
						var i = 0;
						jQuery(".keyfigure_bloc_figure").each(function() {
							var oTop = jQuery(this).offset().top - window.innerHeight;
							if (keyFigures[i] == 0 && jQuery(window).scrollTop() > oTop) {
								var counter = jQuery(this);
								countTo = counter.children(this).attr("data-value");
								jQuery({
									countNum: 0
								}).animate({
									countNum: parseFloat(counter.text())
								}, {
									duration: ' . $optionFigureAnimationDuration . ',
									easing: "swing",
									step: function() {
										counter.text(Math.floor(this.countNum));
									},
									complete: function() {
										counter.text(this.countNum);
									}
								});
								keyFigures[i] = 1;
							}
							i++;
						});
					});
				});
				</script>
				';
				elseif ($optionFigureAnimation == 'fadein') :
				echo '
				<script>
				jQuery(window).load(function() {
					var keyFigures = new Array();
					jQuery(".keyfigure_bloc_figure").each(function() {
						jQuery(this).hide();
						keyFigures.push(0);
					});
					jQuery(window).scroll(function() {
						var i = 0;
						jQuery(".keyfigure_bloc_figure").each(function() {
							var oTop = jQuery(this).offset().top - window.innerHeight;
							if (keyFigures[i] == 0 && jQuery(window).scrollTop() > oTop) {
								jQuery(this).fadeIn(' . $optionFigureAnimationDuration . ');
								keyFigures[i] = 1;
							}
							i++;
						});
					});
				});
				</script>
				';
				endif ;		
			endif;
		}
	}
