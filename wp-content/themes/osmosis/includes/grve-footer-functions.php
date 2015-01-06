<?php

/*
*	Footer Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Prints Bottom Bar Area
 */
function grve_print_bottom_bar() {

	if ( grve_visibility( 'bottom_bar_enabled' ) ) {
		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_bottom_bar' ) ) {
			return;
		}
		if( grve_woocommerce_enabled() ) {
			// Disabled botom Bar in Shop
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_bottom_bar' ) ) {
				return false;
			}
		}

?>
			<!-- Section bottom Bar -->
			<div id="grve-above-footer">
				<div class="grve-container">
<?php
			if ( grve_visibility( 'bottom_bar_social_visibility' ) ) {

				global $grve_social_list;
				$options = grve_option('bottom_bar_social_options');
				$social_options = grve_option('social_options');

				if ( !empty( $options ) && !empty( $social_options ) ) {
					?>
						<ul class="grve-element grve-social">
					<?php
					foreach ( $social_options as $key => $value ) {
						if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
							if ( 'skype' == $key ) {
								echo '<li><a href="' . $value . '">' . $grve_social_list[$key] . '</a></li>';
							} else {
								echo '<li><a href="' . esc_url( $value ) . '" target="_blank">' . $grve_social_list[$key] . '</a></li>';
							}
						}
					}
					?>
						</ul>
					<?php
				}
			}
			if ( grve_visibility( 'bottom_bar_newsletter_visibility' ) ) {

?>
				<!-- Newsletter -->
				<div class="grve-newsletter">
					<?php
					if ( class_exists( 'MC4WP_Lite' ) ) {
						echo do_shortcode('[mc4wp_form]');
					}
					?>
				</div>
				<!-- End News Letter -->
<?php
			}
?>
				</div>
			</div>
			<!-- End Section Bottom Bar -->

<?php
	}
}

/**
 * Prints Footer Widgets
 */
function grve_print_footer_widgets() {

	if ( grve_visibility( 'footer_widgets_visibility' ) ) {

		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_footer' ) ) {
			return;
		}
		if( grve_woocommerce_enabled() ) {
			// Disabled Footer Widgets in Shop
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_footer' ) ) {
				return false;
			}
		}

		$grve_footer_columns = grve_option('footer_widgets_layout');

		switch( $grve_footer_columns ) {
			case 'footer-1':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-3-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-4-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
				);
			break;
			case 'footer-2':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-2',
						'tablet-column' => '1',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-3-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
				);
			break;
			case 'footer-3':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-3-sidebar',
						'column' => '1-2',
						'tablet-column' => '1',
					),
				);
			break;
			case 'footer-4':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-2',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-2',
						'tablet-column' => '1-2',
					),
				);
			break;
			case 'footer-5':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-3',
						'tablet-column' => '1-3',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-3',
						'tablet-column' => '1-3',
					),
					array(
						'sidebar-id' => 'grve-footer-3-sidebar',
						'column' => '1-3',
						'tablet-column' => '1-3',
					),
				);
			break;
			case 'footer-6':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '2-3',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-3',
						'tablet-column' => '1-2',
					),
				);
			break;
			case 'footer-7':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-3',
						'tablet-column' => '1-2',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '2-3',
						'tablet-column' => '1-2',
					),
				);
			break;
			case 'footer-8':
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-3',
					),
					array(
						'sidebar-id' => 'grve-footer-2-sidebar',
						'column' => '1-2',
						'tablet-column' => '1-3',
					),
					array(
						'sidebar-id' => 'grve-footer-3-sidebar',
						'column' => '1-4',
						'tablet-column' => '1-3',
					),
				);
			break;
			case 'footer-9':
			default:
				$footer_sidebars = array(
					array(
						'sidebar-id' => 'grve-footer-1-sidebar',
						'column' => '1',
						'tablet-column' => '1',
					),
				);
			break;
		}

		$section_type = grve_option( 'footer_section_type', 'fullwidth-background' );
?>
		<div id="grve-footer-area" class="grve-section" data-section-type="<?php echo esc_attr( $section_type ); ?>">
			<div class="grve-row">
<?php

			foreach ( $footer_sidebars as $footer_sidebar ) {
				echo '<div class="grve-column-' . $footer_sidebar['column'] . ' grve-tablet-column-' . $footer_sidebar['tablet-column'] . '">';
				dynamic_sidebar( $footer_sidebar['sidebar-id'] );
				echo '</div>';
			}
?>
			</div>
		</div>
<?php

	}
}

/**
 * Prints Footer Bar Area
 */
function grve_print_footer_bar() {

	if ( grve_visibility( 'footer_copyright_visibility' ) ) {
		if ( is_singular() && 'yes' == grve_post_meta( 'grve_disable_copyright' ) ) {
			return;
		}
		if( grve_woocommerce_enabled() ) {
			// Disabled Footer Copyright in Shop
			if ( is_shop() && !is_search() && 'yes' == grve_post_meta_shop( 'grve_disable_copyright' ) ) {
				return false;
			}
		}
		$section_type = grve_option( 'footer_bar_section_type', 'fullwidth-background' );
		$align_center = grve_option( 'footer_bar_align_center', 'no' );
		$second_area = grve_option( 'second_area_visibility', '1' );
?>
		<div id="grve-footer-bar" class="grve-section" data-section-type="<?php echo esc_attr( $section_type ); ?>" data-align-center="<?php echo esc_attr( $align_center ); ?>">

			<div class="grve-row">
				<div class="grve-column-1-2">
					<div class="grve-copyright">
						<?php echo do_shortcode( grve_option( 'footer_copyright_text' ) ); ?>
					</div>
				</div>
				<?php if ( '2' == $second_area ) { ?>
				<div class="grve-column-1-2">
					<nav id="grve-second-menu">
						<?php grve_footer_nav(); ?>
					</nav>
				</div>
				<?php
				} else if ( '3' == $second_area ) { ?>
				<div class="grve-column-1-2">
					<?php
					global $grve_social_list;
					$options = grve_option('footer_social_options');
					$social_options = grve_option('social_options');

					if ( !empty( $options ) && !empty( $social_options ) ) {
						?>
							<ul class="grve-element grve-social">
						<?php
						foreach ( $social_options as $key => $value ) {
							if ( isset( $options[$key] ) && 1 == $options[$key] && $value ) {
								if ( 'skype' == $key ) {
									echo '<li><a href="' . $value . '">' . $grve_social_list[$key] . '</a></li>';
								} else {
									echo '<li><a href="' . esc_url( $value ) . '" target="_blank">' . $grve_social_list[$key] . '</a></li>';
								}
							}
						}
						?>
							</ul>
						<?php
					}
					?>
				</div>
				<?php
				}
				?>

			</div>
		</div>

<?php
	}
}

/**
 * Prints Custom javascript code
 */
add_action( 'wp_footer', 'grve_print_custom_js_code', 100 );
if ( !function_exists('grve_print_custom_js_code') ) {

	function grve_print_custom_js_code() {
		$custom_js_code = grve_option( 'custom_js' );
		if ( !empty( $custom_js_code ) ) {
			echo "<script type='text/javascript'>";
			echo $custom_js_code;
			echo "</script>";
		}
	}
}

?>