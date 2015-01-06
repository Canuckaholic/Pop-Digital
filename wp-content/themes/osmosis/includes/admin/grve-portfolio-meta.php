<?php
/*
*	Greatives Portfolio Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'add_meta_boxes', 'grve_portfolio_options_add_custom_boxes' );
	add_action( 'save_post', 'grve_portfolio_options_save_postdata', 10, 2 );

	$grve_portfolio_options = array (
		array(
			'name' => 'Description',
			'id' => 'grve_portfolio_description',
		),
		array(
			'name' => 'Layout',
			'id' => 'grve_portfolio_layout',
		),
		array(
			'name' => 'Sidebar',
			'id' => 'grve_portfolio_sidebar',
		),
		array(
			'name' => 'Sidebar Background Color',
			'id' => 'grve_sidebar_bg_color',
		),
		array(
			'name' => 'Fixed Sidebar',
			'id' => 'grve_fixed_sidebar',
		),
		array(
			'name' => 'Details',
			'id' => 'grve_portfolio_details',
		),
		array(
			'name' => 'Main Navigation Menu',
			'id' => 'grve_main_navigation_menu',
		),
		array(
			'name' => 'Main Navigation Menu Type',
			'id' => 'grve_main_navigation_menu_type',
		),
		array(
			'name' => 'Disable Menu',
			'id' => 'grve_disable_menu',
		),
		array(
			'name' => 'Disable Menu Items',
			'id' => 'grve_disable_menu_items',
		),
		array(
			'name' => 'Disable Title',
			'id' => 'grve_disable_title',
		),
		array(
			'name' => 'Disable Safe Button',
			'id' => 'grve_disable_safe_button',
		),
		array(
			'name' => 'Disable Top Bar',
			'id' => 'grve_disable_top_bar',
		),
		array(
			'name' => 'Disable Fields Bar',
			'id' => 'grve_disable_portfolio_fields_bar',
		),
		array(
			'name' => 'Disable Recent',
			'id' => 'grve_disable_portfolio_recent',
		),
		array(
			'name' => 'Disable Comments',
			'id' => 'grve_disable_comments',
		),
		array(
			'name' => 'Disable Bottom Bar',
			'id' => 'grve_disable_bottom_bar',
		),
		array(
			'name' => 'Disable Footer',
			'id' => 'grve_disable_footer',
		),
		array(
			'name' => 'Disable Copyright',
			'id' => 'grve_disable_copyright',
		),
		//Media
		array(
			'name' => 'Media Selection',
			'id' => 'grve_portfolio_media_selection',
		),
		array(
			'name' => 'Video webm format',
			'id' => 'grve_portfolio_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => 'grve_portfolio_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => 'grve_portfolio_video_ogv',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => 'grve_portfolio_video_embed',
		),
		//Feature Section
		array(
			'name' => 'Feature Element',
			'id' => 'grve_page_feature_element',
		),
		array(
			'name' => 'Feature Size',
			'id' => 'grve_page_feature_size',
		),
		array(
			'name' => 'Feature Height',
			'id' => 'grve_page_feature_height',
		),
		array(
			'name' => 'Feature Header Integration',
			'id' => 'grve_page_feature_header_integration',
		),
		array(
			'name' => 'Feature Header Position',
			'id' => 'grve_page_feature_header_position',
		),
		array(
			'name' => 'Feature Header Style',
			'id' => 'grve_page_feature_header_style',
		),
		array(
			'name' => 'Feature effect',
			'id' => 'grve_page_feature_effect',
		),
		array(
			'name' => 'Feature go to section',
			'id' => 'grve_page_feature_go_to_section',
		),
	);

	function grve_portfolio_options_add_custom_boxes() {

		add_meta_box(
			'portfolio_options',
			__( 'Portfolio Options', GRVE_THEME_TRANSLATE ),
			'grve_portfolio_options_box',
			'portfolio'
		);
		add_meta_box(
			'portfolio_media_section',
			__( 'Portfolio Media', GRVE_THEME_TRANSLATE ),
			'grve_portfolio_media_section_box',
			'portfolio'
		);

		add_meta_box(
			'portfolio_feature_section',
			__( 'Feature Section', GRVE_THEME_TRANSLATE ),
			'grve_portfolio_feature_section_box',
			'portfolio'
		);

	}

	function grve_portfolio_options_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_save_nonce' );

		$portfolio_description = get_post_meta( $post->ID, 'grve_portfolio_description', true );
		$portfolio_details = get_post_meta( $post->ID, 'grve_portfolio_details', true );
		$portfolio_layout = get_post_meta( $post->ID, 'grve_portfolio_layout', true );
		$portfolio_sidebar = get_post_meta( $post->ID, 'grve_portfolio_sidebar', true );
		$fixed_sidebar = get_post_meta( $post->ID, 'grve_fixed_sidebar', true );
		$sidebar_bg_color = get_post_meta( $post->ID, 'grve_sidebar_bg_color', true );

		$grve_main_navigation_menu = get_post_meta( $post->ID, 'grve_main_navigation_menu', true );
		$grve_main_navigation_menu_type = get_post_meta( $post->ID, 'grve_main_navigation_menu_type', true );

		$grve_disable_menu = get_post_meta( $post->ID, 'grve_disable_menu', true );
		$grve_disable_menu_items = get_post_meta( $post->ID, 'grve_disable_menu_items', true );
		$grve_disable_title = get_post_meta( $post->ID, 'grve_disable_title', true );
		$grve_disable_safe_button = get_post_meta( $post->ID, 'grve_disable_safe_button', true );
		$grve_disable_top_bar = get_post_meta( $post->ID, 'grve_disable_top_bar', true );
		$grve_disable_portfolio_fields_bar = get_post_meta( $post->ID, 'grve_disable_portfolio_fields_bar', true );
		$grve_disable_portfolio_recent = get_post_meta( $post->ID, 'grve_disable_portfolio_recent', true );
		$grve_disable_comments = get_post_meta( $post->ID, 'grve_disable_comments', true );

		$grve_disable_bottom_bar = get_post_meta( $post->ID, 'grve_disable_bottom_bar', true );
		$grve_disable_footer = get_post_meta( $post->ID, 'grve_disable_footer', true );
		$grve_disable_copyright = get_post_meta( $post->ID, 'grve_disable_copyright', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-portfolio-description">
							<strong><?php _e( 'Description', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Enter your portfolio description.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-description" class="grve-meta-text" name="grve_portfolio_description" value="<?php echo esc_attr( $portfolio_description ); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-details">
							<strong><?php _e( 'Project Details', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Enter your project details.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<textarea id="grve-portfolio-details" name="grve_portfolio_details" cols="40" rows="5"><?php echo $portfolio_details; ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-layout">
							<strong><?php _e( 'Layout', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select portfolio content and sidebar alignment.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'Default is configured in Theme Options - Portfolio Options.', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_layout_selection( $portfolio_layout, 'grve-portfolio-layout', 'grve_portfolio_layout' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-portfolio-sidebar">
							<strong><?php _e( 'Sidebar', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select portfolio sidebar.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'Default is configured in Theme Options - Portfolio Options.', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_sidebar_selection( $portfolio_sidebar, 'grve-portfolio-sidebar', 'grve_portfolio_sidebar' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-sidebar-color">
							<strong><?php _e( 'Sidebar Background Color', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select sidebar background color.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'Default is configured in Appearance - Customize - Colors - Sidebars - Portfolio Sidebar Background Color', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-sidebar-bg-color" name="grve_sidebar_bg_color">
							<option value="" <?php selected( '', $sidebar_bg_color ); ?>><?php _e( 'Default', GRVE_THEME_TRANSLATE ); ?></option>
							<option value="none" <?php selected( 'none', $sidebar_bg_color ); ?>><?php _e( 'None', GRVE_THEME_TRANSLATE ); ?></option>
							<?php grve_print_media_color_selection( $sidebar_bg_color ); ?>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-fixed-sidebar">
							<strong><?php _e( 'Fixed Sidebar', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, sidebar will be fixed.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-fixed-sidebar" name="grve_fixed_sidebar" value="yes" <?php checked( $fixed_sidebar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-main-navigation-menu">
							<strong><?php _e( 'Main Navigation Menu', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select alternative main navigation menu.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'Default: Menus - Theme Locations - Header Menu.', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_menu_selection( $grve_main_navigation_menu, 'grve-main-navigation-menu', 'grve_main_navigation_menu', 'default' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-main-navigation-menu-type">
							<strong><?php _e( 'Main Navigation Menu Type', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Select main navigation menu type.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'Default is configured in Appearance - Customize - Logo Background & Menu Type - Menu Type', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<?php grve_print_menu_type_selection( $grve_main_navigation_menu_type, 'grve-main-navigation-menu-type', 'grve_main_navigation_menu_type' ); ?>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-menu">
							<strong><?php _e( 'Disable Main Menu', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, main menu will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-menu" name="grve_disable_menu" value="yes" <?php checked( $grve_disable_menu, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-menu-items">
							<strong><?php _e( 'Disable Main Menu Items', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, main menu items will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-menu-items" name="grve_disable_menu_items" value="yes" <?php checked( $grve_disable_menu_items, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-title">
							<strong><?php _e( 'Disable Title/Description', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, title and decription will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-title" name="grve_disable_title" value="yes" <?php checked( $grve_disable_title, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-safe-button">
							<strong><?php _e( 'Disable Safe Button', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, safe button will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-safe-button" name="grve_disable_safe_button" value="yes" <?php checked( $grve_disable_safe_button, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-top-bar">
							<strong><?php _e( 'Disable Top Bar', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, top bar will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-top-bar" name="grve_disable_top_bar" value="yes" <?php checked( $grve_disable_top_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-portfolio-fields-bar">
							<strong><?php _e( 'Disable Fields Bar', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, fields bar will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-portfolio-fields-bar" name="grve_disable_portfolio_fields_bar" value="yes" <?php checked( $grve_disable_portfolio_fields_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-portfolio-recent">
							<strong><?php _e( 'Disable Recent Entries', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, recent entries will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-portfolio-recent" name="grve_disable_portfolio_recent" value="yes" <?php checked( $grve_disable_portfolio_recent, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-comments">
							<strong><?php _e( 'Disable Comments', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, comments will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-comments" name="grve_disable_comments" value="yes" <?php checked( $grve_disable_comments, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-bottom-bar">
							<strong><?php _e( 'Disable Bottom Bar', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, bottom bar will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-bottom-bar" name="grve_disable_bottom_bar" value="yes" <?php checked( $grve_disable_bottom_bar, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-footer">
							<strong><?php _e( 'Disable Footer Widgets', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, footer widgets will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-footer" name="grve_disable_footer" value="yes" <?php checked( $grve_disable_footer, 'yes' ); ?>/>
					</td>
				</tr>
				<tr>
					<th>
						<label for="grve-disable-copyright">
							<strong><?php _e( 'Disable Footer Copyright', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'If selected, footer copyright area will be hidden.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="checkbox" id="grve-disable-copyright" name="grve_disable_copyright" value="yes" <?php checked( $grve_disable_copyright, 'yes' ); ?>/>
					</td>
				</tr>
			</tbody>
		</table>


	<?php
	}

	function grve_portfolio_media_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_media_save_nonce' );
		$portfolio_media = get_post_meta( $post->ID, 'grve_portfolio_media_selection', true );

		$grve_portfolio_video_webm = get_post_meta( $post->ID, 'grve_portfolio_video_webm', true );
		$grve_portfolio_video_mp4 = get_post_meta( $post->ID, 'grve_portfolio_video_mp4', true );
		$grve_portfolio_video_ogv = get_post_meta( $post->ID, 'grve_portfolio_video_ogv', true );
		$grve_portfolio_video_embed = get_post_meta( $post->ID, 'grve_portfolio_video_embed', true );

		$media_slider_items = get_post_meta( $post->ID, 'grve_portfolio_slider_items', true );
		$media_slider_settings = get_post_meta( $post->ID, 'grve_portfolio_slider_settings', true );
		$media_slider_speed = grve_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = grve_array_value( $media_slider_settings, 'direction_nav', '1' );

	?>
			<table class="form-table grve-metabox">
				<tbody>
					<tr>
						<th>
							<label for="grve-portfolio-media-selection">
								<strong><?php _e( 'Media Selection', GRVE_THEME_TRANSLATE ); ?></strong>
								<span>
									<?php _e( 'Choose your portfolio media.', GRVE_THEME_TRANSLATE ); ?>
									<br/>
									<strong><?php _e( 'In overview only Featured Image is displayed.', GRVE_THEME_TRANSLATE ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-selection" name="grve_portfolio_media_selection">
								<option value="" <?php if ( "" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'Featured Image', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="gallery" <?php if ( "gallery" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'Classic Gallery', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="gallery-vertical" <?php if ( "gallery-vertical" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'Vertical Gallery', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="slider" <?php if ( "slider" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'Slider', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="video" <?php if ( "video" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'YouTube/Vimeo Video', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="video-html5" <?php if ( "video-html5" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'HMTL5 Video', GRVE_THEME_TRANSLATE ); ?></option>
								<option value="none" <?php if ( "none" == $portfolio_media ) { ?> selected="selected" <?php } ?>><?php _e( 'None', GRVE_THEME_TRANSLATE ); ?></option>
							</select>
						</td>
					</tr>
				<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-video-webm">
							<strong><?php _e( 'WebM File URL', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Upload the .webm video file.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'This Format must be included for HTML5 Video.', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_webm" value="<?php echo esc_attr( $grve_portfolio_video_webm ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
					</td>
				</tr>
				<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-video-mp4">
							<strong><?php _e( 'MP4 File URL', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Upload the .mp4 video file.', GRVE_THEME_TRANSLATE ); ?>
								<br/>
								<strong><?php _e( 'This Format must be included for HTML5 Video.', GRVE_THEME_TRANSLATE ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_mp4" value="<?php echo esc_attr( $grve_portfolio_video_mp4 ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
					</td>
				</tr>
				<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-video-ogv">
							<strong><?php _e( 'OGV File URL', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Upload the .ogv video file (optional).', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_ogv" value="<?php echo esc_attr( $grve_portfolio_video_ogv ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php _e( 'Upload Media', GRVE_THEME_TRANSLATE ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php _e( 'Remove', GRVE_THEME_TRANSLATE ); ?>"/>
					</td>
				</tr>
				<tr class="grve-portfolio-media-item grve-portfolio-video-embed"<?php if ( "video" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-portfolio-video-embed">
							<strong><?php _e( 'Vimeo/YouTube URL', GRVE_THEME_TRANSLATE ); ?></strong>
							<span>
								<?php _e( 'Enter the full URL of your video from Vimeo or YouTube.', GRVE_THEME_TRANSLATE ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-portfolio-video-embed" class="grve-meta-text" name="grve_portfolio_video_embed" value="<?php echo esc_attr( $grve_portfolio_video_embed ); ?>"/>
					</td>
				</tr>

					<tr id="grve-portfolio-media-slider-speed" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-speed">
								<strong><?php _e( 'Slideshow Speed', GRVE_THEME_TRANSLATE ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="grve-page-slider-speed" name="grve_portfolio_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-direction-nav" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-direction-nav">
								<strong><?php _e( 'Navigation Buttons', GRVE_THEME_TRANSLATE ); ?></strong>
							</label>
						</th>
						<td>
							<select name="grve_portfolio_slider_settings_direction_nav">
								<option value="1" <?php if ( "1" == $media_slider_dir_nav ) { ?> selected="selected" <?php } ?>>
									<?php _e( 'Style 1', GRVE_THEME_TRANSLATE ); ?>
								</option>
								<option value="2" <?php if ( "2" == $media_slider_dir_nav ) { ?> selected="selected" <?php } ?>>
									<?php _e( 'Style 2', GRVE_THEME_TRANSLATE ); ?>
								</option>
								<option value="3" <?php if ( "3" == $media_slider_dir_nav ) { ?> selected="selected" <?php } ?>>
									<?php _e( 'Style 3', GRVE_THEME_TRANSLATE ); ?>
								</option>
								<option value="4" <?php if ( "4" == $media_slider_dir_nav ) { ?> selected="selected" <?php } ?>>
									<?php _e( 'Style 4', GRVE_THEME_TRANSLATE ); ?>
								</option>
								<option value="0" <?php if ( "0" == $media_slider_dir_nav ) { ?> selected="selected" <?php } ?>>
									<?php _e( 'No Navigation', GRVE_THEME_TRANSLATE ); ?>
								</option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label><?php _e( 'Media Items', GRVE_THEME_TRANSLATE ); ?></label>
						</th>
						<td>
							<input type="button" class="grve-upload-slider-button button-primary" value="<?php _e( 'Insert Images', GRVE_THEME_TRANSLATE ); ?>"/>
							<span id="grve-upload-slider-button-spinner" class="grve-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="grve-slider-container" data-mode="minimal" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
				<?php
					if( !empty( $media_slider_items ) ) {
						grve_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>


	<?php
	}

	function grve_portfolio_feature_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_feature_save_nonce' );

		$post_id = $post->ID;
		grve_admin_get_feature_section( $post_id );

	}

	function grve_portfolio_options_save_postdata( $post_id , $post ) {
		global $grve_portfolio_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST['grve_portfolio_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_portfolio_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'portfolio' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $grve_portfolio_options as $value ) {
			$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : '' );
			$meta_key = $value['id'];


			$meta_value = get_post_meta( $post_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}

		if ( isset( $_POST['grve_portfolio_media_save_nonce'] ) && wp_verify_nonce( $_POST['grve_portfolio_media_save_nonce'], 'grve_nonce_save' ) ) {


			//Media Slider Items
			$media_slider_items = array();
			if ( isset( $_POST['grve_media_slider_item_id'] ) ) {

				$num_of_images = sizeof( $_POST['grve_media_slider_item_id'] );
				for ( $i=0; $i < $num_of_images; $i++ ) {

					$this_image = array (
						'id' => $_POST['grve_media_slider_item_id'][ $i ],
					);
					array_push( $media_slider_items, $this_image );
				}

			}

			if( empty( $media_slider_items ) ) {
				delete_post_meta( $post->ID, 'grve_portfolio_slider_items' );
				delete_post_meta( $post->ID, 'grve_portfolio_slider_settings' );
			} else{
				update_post_meta( $post->ID, 'grve_portfolio_slider_items', $media_slider_items );

				$media_slider_speed = 3500;
				$media_slider_direction_nav = 'yes';
				if ( isset( $_POST['grve_portfolio_slider_settings_speed'] ) ) {
					$media_slider_speed = $_POST['grve_portfolio_slider_settings_speed'];
				}
				if ( isset( $_POST['grve_portfolio_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = $_POST['grve_portfolio_slider_settings_direction_nav'];
				}
				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
				);
				update_post_meta( $post->ID, 'grve_portfolio_slider_settings', $media_slider_settings );
			}

		}

		if ( isset( $_POST['grve_portfolio_feature_save_nonce'] ) && wp_verify_nonce( $_POST['grve_portfolio_feature_save_nonce'], 'grve_nonce_save' ) ) {

			grve_admin_save_feature_section( $post_id );

		}

	}

?>