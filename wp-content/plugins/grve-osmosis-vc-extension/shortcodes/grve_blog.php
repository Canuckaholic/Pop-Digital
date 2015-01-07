<?php
/**
 * Blog Shortcode
 */

if( !function_exists( 'grve_blog_shortcode' ) ) {

	function grve_blog_shortcode( $atts, $content ) {

		$output = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'categories' => '',
					'blog_style' => 'large-media',
					'blog_columns' => '4',
					'auto_excerpt' => '',
					'excerpt_length' => '55',
					'excerpt_more' => '',
					'hide_comments' => '',
					'posts_per_page' => '10',
					'order_by' => 'date',
					'order' => 'DESC',
					'disable_pagination' => '',

					'items_per_page' => '4',
					'slideshow_speed' => '3000',
					'navigation_type' => '1',
					'navigation_color' => 'light',
					'pause_hover' => 'no',

					'margin_bottom' => '',
					'el_class' => '',
				),
				$atts
			)
		);

		$style = grve_vce_build_margin_bottom_style( $margin_bottom );

		$blog_classes = array( 'grve-element' );

		array_push( $blog_classes, grve_vce_get_blog_class( $blog_style ) );
		if ( !empty ( $el_class ) ) {
			array_push( $blog_classes, $el_class);
		}
		$blog_class_string = implode( ' ', $blog_classes );

		global $paged;
		$paged = 1;

		if ( 'yes' != $disable_pagination ) {
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}
		}

		$args = array(
			'post_type' => 'post',
			'post_status'=>'publish',
			'posts_per_page' => $posts_per_page,
			'cat' => $categories,
			'paged' => $paged,
			'ignore_sticky_posts' => 1,
			'orderby' => $order_by,
			'order' => $order,
		);

		$query = new WP_Query( $args );

		ob_start();

		if ( $query->have_posts() ) :

?>
		<div class="<?php echo esc_attr( $blog_class_string ); ?>" style="<?php echo $style; ?>" <?php grve_vce_print_blog_data( $blog_style, $blog_columns ); ?>>
<?php
		if ( 'large-media' == $blog_style || 'small-media' == $blog_style ) {
?>
			<div class="grve-standard-container">
<?php
		} else if ( 'carousel' == $blog_style ) {
			$disable_pagination = 'yes';
			$data_string = ' data-items="' . esc_attr( $items_per_page ) . '" data-slider-speed="' . esc_attr( $slideshow_speed ) . '" data-slider-pause="' . esc_attr( $pause_hover ) . '"';
?>
			<?php if ( 0 != $navigation_type ) { ?>
			<div class="grve-carousel-navigation grve-<?php echo $navigation_color; ?>" data-navigation-type="<?php echo $navigation_type; ?>">
				<div class="grve-carousel-buttons">
					<div class="grve-carousel-prev grve-icon-nav-left"></div>
					<div class="grve-carousel-next grve-icon-nav-right"></div>
				</div>
			</div>
			<?php } ?>
			<div class="grve-carousel grve-carousel-element"<?php echo $data_string; ?>>
<?php
		} else {
?>
			<div class="grve-isotope-container">
<?php
		}

		$grve_isotope_start = $grve_isotope_end = $bg_white = '';
		if ( 'large-media' != $blog_style ) {
			$grve_isotope_start = '<div class="grve-isotope-item-inner">';
			$grve_isotope_end = '</div>';
		}
		if ( 'masonry' == $blog_style ) {
			$bg_white = 'grve-white-bg';
		}

		while ( $query->have_posts() ) : $query->the_post();

			$post_format = get_post_format();
			if ( 'link' == $post_format || 'quote' == $post_format ) {
				$grve_post_class = grve_vce_get_post_class( $blog_style, 'grve-label-post' );
			} else {
				$grve_post_class = grve_vce_get_post_class( $blog_style );
			}

			if ( 'carousel' == $blog_style ) {

?>
				<div class="grve-carousel-item">
					<article class="format-gallery grve-post-item">
						<?php grve_vce_print_carousel_media(); ?>
						<div class="grve-content">
							<?php grve_vce_print_post_title( $blog_style, $post_format ); ?>
							<div class="grve-caption">
								<?php grve_vce_print_post_date(); ?>
							</div>
						</div>
					</article>
				</div>
<?php
			} else {
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?>>
				<?php echo $grve_isotope_start; ?>
					<?php grve_vce_print_post_feature_media( $blog_style, $post_format ); ?>

					<?php if ( 'link' != $post_format && 'quote' != $post_format ) { ?>
						<div class="grve-post-content <?php echo $bg_white; ?>">
							<?php grve_vce_print_post_title( $blog_style, $post_format ); ?>
							<div class="grve-post-meta">
								<?php grve_vce_print_post_author_by( $blog_style ); ?>
								<?php grve_vce_print_post_date(); ?>
								<?php
									if( function_exists( 'grve_print_like_counter' ) ) {
										grve_print_like_counter();
									}
								?>
							</div>
							<?php grve_vce_print_post_excerpt( $blog_style, $post_format, $auto_excerpt, $excerpt_length, $excerpt_more ); ?>
						</div>
					<?php } else { ?>
						<?php grve_vce_print_post_title( $blog_style, $post_format ); ?>
					<?php }?>

				<?php echo $grve_isotope_end; ?>
			</article>

<?php
			}

		endwhile;
?>
			</div>
<?php
			if ( 'yes' != $disable_pagination ) {
				$total = $query->max_num_pages;
				$big = 999999999; // need an unlikely integer
				if( $total > 1 )  {
					 echo '<div class="grve-pagination">';

					 if( !$current_page = $paged )
						 $current_page = 1;
					 if( get_option('permalink_structure') ) {
						 $format = 'page/%#%/';
					 } else {
						 $format = '&paged=%#%';
					 }
					 echo paginate_links(array(
						'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'		=> $format,
						'current'		=> max( 1, $paged ),
						'total'			=> $total,
						'mid_size'		=> 2,
						'type'			=> 'list',
						'prev_text'	=> '<i class="grve-icon-nav-left"></i>',
						'next_text'	=> '<i class="grve-icon-nav-right"></i>',
					 ));
					 echo '</div>';
				}
			}
?>
		</div>
<?php
		else :
		endif;

		wp_reset_postdata();

		return ob_get_clean();


	}
	add_shortcode( 'grve_blog', 'grve_blog_shortcode' );

}

/**
 * Add shortcode to Visual Composer
 */

vc_map( array(
	"name" => __( "Blog", "grve-osmosis-vc-extension" ),
	"description" => __( "Display a Blog element in multiple styles", "grve-osmosis-vc-extension" ),
	"base" => "grve_blog",
	"class" => "",
	"icon"      => "icon-wpb-grve-blog",
	"category" => __( "Content", "js_composer" ),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( "Style", "grve-osmosis-vc-extension" ),
			"param_name" => "blog_style",
			"admin_label" => true,
			'value' => array(
				__( 'Large Media', 'grve-osmosis-vc-extension' ) => 'large-media',
				__( 'Small Media', 'grve-osmosis-vc-extension' ) => 'small-media',
				__( 'Masonry' , 'grve-osmosis-vc-extension' ) => 'masonry',
				__( 'Grid' , 'grve-osmosis-vc-extension' ) => 'grid',
				__( 'Carousel' , 'grve-osmosis-vc-extension' ) => 'carousel',
			),
			"description" => __( "Select your Blog Style.", "grve-osmosis-vc-extension" ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Columns", "grve-osmosis-vc-extension" ),
			"param_name" => "blog_columns",
			"value" => array( '2', '3', '4' ),
			"std" => 4,
			"description" => __( "Select your Blog Columns.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Auto excerpt", "grve-osmosis-vc-extension" ),
			"param_name" => "auto_excerpt",
			"description" => __( "Adds automatic excerpt to all posts in Large Media style. If auto excerpt is not selected, blog will show all content, a desired 'cut-off' point can be inserted in each post with more quicktag.", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Activate auto excerpt.", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'large-media' ) ),
		),
		array(
			"type" => 'textfield',
			"heading" => __( "Excerpt length", "grve-osmosis-vc-extension" ),
			"param_name" => "excerpt_length",
			"description" => __( "Type how many words you want to display in your post excerpts.", "grve-osmosis-vc-extension" ),
			"value" => '55',
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'large-media', 'small-media','grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Read more", "grve-osmosis-vc-extension" ),
			"param_name" => "excerpt_more",
			"description" => __( "Adds a read more button after the excerpt or more quicktag", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Add more button", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'large-media', 'small-media','grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Disable Pagination", "grve-osmosis-vc-extension" ),
			"param_name" => "disable_pagination",
			"description" => __( "If selected, pagination will not be shown.", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Disable Pagination.", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'large-media', 'small-media','grid', 'masonry' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Hide Comments", "grve-osmosis-vc-extension" ),
			"param_name" => "hide_comments",
			"description" => __( "If selected, blog overview will not show comments.", "grve-osmosis-vc-extension" ),
			"value" => Array( __( "Hide Comments.", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'large-media', 'small-media','grid', 'masonry' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Posts per Page", "grve-osmosis-vc-extension" ),
			"param_name" => "posts_per_page",
			"value" => "10",
			"description" => __( "Enter how many posts per page you want to display.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
		),

		//Gallery ( carousel )
		array(
			"type" => "dropdown",
			"heading" => __( "Items per page", "grve-osmosis-vc-extension" ),
			"param_name" => "items_per_page",
			"value" => array( '3', '4', '5' ),
			"description" => __( "Number of items per page", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "textfield",
			"heading" => __( "Slideshow Speed", "grve-osmosis-vc-extension" ),
			"param_name" => "slideshow_speed",
			"value" => '3000',
			"description" => __( "Slideshow Speed in ms.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => 'checkbox',
			"heading" => __( "Pause on Hover", "grve-osmosis-vc-extension" ),
			"param_name" => "pause_hover",
			"value" => Array( __( "If selected, carousel will be paused on hover", "grve-osmosis-vc-extension" ) => 'yes' ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Navigation Type", "grve-osmosis-vc-extension" ),
			"param_name" => "navigation_type",
			'value' => array(
				__( 'Style 1' , 'grve-osmosis-vc-extension' ) => '1',
				__( 'Style 2' , 'grve-osmosis-vc-extension' ) => '2',
				__( 'Style 3' , 'grve-osmosis-vc-extension' ) => '3',
				__( 'Style 4' , 'grve-osmosis-vc-extension' ) => '4',
				__( 'No Navigation' , 'grve-osmosis-vc-extension' ) => '0',
			),
			"description" => __( "Select your Navigation type.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'carousel' ) ),
		),
		array(
			"type" => "dropdown",
			"heading" => __( "Navigation Color", "grve-osmosis-vc-extension" ),
			"param_name" => "navigation_color",
			'value' => array(
				__( 'Light' , 'grve-osmosis-vc-extension' ) => 'light',
				__( 'Dark' , 'grve-osmosis-vc-extension' ) => 'dark',
			),
			"description" => __( "Select the background Navigation color.", "grve-osmosis-vc-extension" ),
			"dependency" => Array( 'element' => "blog_style", 'value' => array( 'carousel' ) ),
		),
		$grve_vce_add_order_by,
		$grve_vce_add_order,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,
		array(
			"type" => "grve_multi_checkbox",
			"heading" => __("Categories", "grve-osmosis-vc-extension" ),
			"param_name" => "categories",
			"value" => grve_vce_get_post_categories(),
			"description" => __( "Select all or multiple categories.", "grve-osmosis-vc-extension" ),
			"admin_label" => true,
			"group" => __( "Categories", "grve-osmosis-vc-extension" ),
		),
	)
) );

?>