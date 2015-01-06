<?php
/**
 * Plugin Name: Greatives Latest Portfolio
 * Description: A widget that displays latest portfolio.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */


add_action( 'widgets_init', 'grve_widget_latest_portfolio' );

function grve_widget_latest_portfolio() {
	register_widget( 'GRVE_Widget_Latest_Portfolio' );
}

class GRVE_Widget_Latest_Portfolio extends WP_Widget {

	function GRVE_Widget_Latest_Portfolio() {
		$widget_ops = array(
			'classname' => 'grve-latest-portfolio',
			'description' => __( 'A widget that displays latest portfolio items.', GRVE_THEME_TRANSLATE ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 350,
			'id_base' => 'grve-widget-latest-portfolio',
		);
		$this->WP_Widget( 'grve-widget-latest-portfolio', '(Greatives) ' . __( 'Latest Portfolio', GRVE_THEME_TRANSLATE ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $_wp_additional_image_sizes;

		$image_size = 'grve-image-extrasmall-square';

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters( 'widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$num_of_posts = $instance['num_of_posts'];
		$cats = '';
		if ( empty( $num_of_posts ) ) {
			$num_of_posts = 5;
		}

		echo $before_widget;

		// Display the widget title
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$portfolio_cat = "";
		if( ! empty( $categories ) ) {
			$portfolio_category_list = explode( ",", $categories );
			foreach ( $portfolio_category_list as $category_list ) {
				$category_term = get_term( $category_list, 'portfolio_category' );
				$portfolio_cat = $portfolio_cat.$category_term->slug . ', ';
			}
		}
		$args = array(
			'post_type' => 'portfolio',
			'post_status'=>'publish',
			'paged' => 1,
			'portfolio_category' => $portfolio_cat,
			'posts_per_page' => $num_of_posts,
		);

		$query = new WP_Query( $args );
		//Loop portfolio

		if ( $query->have_posts() ) :
		?>
			<ul>
		<?php

		while ( $query->have_posts() ) : $query->the_post();

		?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail( $image_size ); ?>
						<?php } else { ?>
						<img src="<?php echo get_template_directory_uri() . '/images/empty/grve-image-extrasmall-square.jpg'; ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
						<?php } ?>
					</a>
				</li>

		<?php
		endwhile;
		?>
			</ul>
		<?php

		else :
		?>

			<?php _e( 'No Portfolio Items Found!', GRVE_THEME_TRANSLATE ); ?>

		<?php
		endif;
		wp_reset_postdata();

		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = implode(',',$new_instance['categories']);
		$instance['num_of_posts'] = strip_tags( $new_instance['num_of_posts'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'categories' => '',
			'num_of_posts' => '4',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', GRVE_THEME_TRANSLATE ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num_of_posts' ); ?>"><?php echo __( 'Number of Portfolio Items:', GRVE_THEME_TRANSLATE ); ?></label>
			<select  name="<?php echo $this->get_field_name( 'num_of_posts' ); ?>" style="width:100%;">
				<?php
				for ( $i = 1; $i <= 20; $i++ ) {
					$selected = '';
					if ( $i == $instance['num_of_posts'] ) {
						$selected = 'selected="selected"';
					}
				?>
				    <option value="<?php echo $i; ?>" <?php echo $selected;?>><?php echo $i; ?></option>
				<?php
				}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php echo __( 'Categories:', GRVE_THEME_TRANSLATE ) ?></label>
			<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>[]" multiple="multiple" style="width:100%;">
				<option value=""><?php echo __( 'Choose Categories ...', GRVE_THEME_TRANSLATE ) ?></option>
			<?php
				$categories = get_terms( 'portfolio_category' );
				foreach ( $categories as $category ) {
					$selected = '';
					$cats = explode( ',', $instance['categories'] );
					foreach ( $cats as $cat ) {
						if ( $cat == $category->term_id ){
							$selected = 'selected="selected"';
							break;
						}
					}
				?>
				<option value="<?php echo $category->term_id; ?>" <?php echo $selected; ?> >
					<?php echo $category->name; ?>
				</option>
			<?php
				}
			?>
			</select>
		</p>


	<?php
	}
}

?>