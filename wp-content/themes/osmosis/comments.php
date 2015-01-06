<?php

	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( __( 'This page cannot be opened directly!', GRVE_THEME_TRANSLATE ) );
	}

	if ( post_password_required() ) {
?>
		<div class="help">
			<p class="no-comments"><?php echo __( 'This post is password protected. Enter the password to view comments.', GRVE_THEME_TRANSLATE ); ?></p>
		</div>
<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<nav class="grve-comment-nav">
		<ul>
	  		<li><?php previous_comments_link(); ?></li>
	  		<li><?php next_comments_link(); ?></li>
	 	</ul>
	</nav>

	<!-- Comments -->
	<div id="grve-comments" class="grve-section">
		<h5 class="grve-comments-number">
			<?php comments_number( __( 'no comments', GRVE_THEME_TRANSLATE ), __( '1 comment', GRVE_THEME_TRANSLATE ), '% ' . __( 'comments', GRVE_THEME_TRANSLATE ) ); ?>
		</h5>
		<ul>
		<?php wp_list_comments( 'type=comment&callback=grve_comments' ); ?>
		</ul>
	</div>
	<!-- End Comments -->

	<nav class="grve-comment-nav">
		<ul>
	  		<li><?php previous_comments_link(); ?></li>
	  		<li><?php next_comments_link(); ?></li>
		</ul>
	</nav>

<?php else : // no comments ?>

	<?php if ( comments_open() ) : ?>
    	<!-- If comments are open, but no comments. -->

	<?php else : // comments are closed ?>

	<p class="no-comments"><?php _e( 'Comments are closed.', GRVE_THEME_TRANSLATE ); ?></p>

	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'grve-comment-submit-button',
			'title_reply'       => __( 'Leave a Reply', GRVE_THEME_TRANSLATE ),
			'title_reply_to'    => __( 'Leave a Reply to', GRVE_THEME_TRANSLATE ) . ' %s',
			'cancel_reply_link' => __( 'Cancel Reply', GRVE_THEME_TRANSLATE ),
			'label_submit'      => __( 'Submit Comment', GRVE_THEME_TRANSLATE ),

			'comment_field' =>
				'<div class="grve-form-textarea">'.
				'<textarea style="resize:none;" id="comment" name="comment" placeholder="' . __( 'Your Comment Here...', GRVE_THEME_TRANSLATE ) . '" cols="45" rows="25" aria-required="true">' .
				'</textarea></div><div class="clear"></div>',

			'must_log_in' =>
				'<p class="must-log-in">' . __( 'You must be', GRVE_THEME_TRANSLATE ) .
				'<a href="' .  wp_login_url( get_permalink() ) . '">' . __( 'logged in', GRVE_THEME_TRANSLATE ) . '</a> ' . __( 'to post a comment.', GRVE_THEME_TRANSLATE ) . '</p>',

			'logged_in_as' =>
				'<p class="logged-in-as">' .  __('Logged in as',GRVE_THEME_TRANSLATE) .
				'<a href="' . admin_url( 'profile.php' ) . '"> ' . $user_identity . '</a>. ' .
				'<a href="' . wp_logout_url( get_permalink() ) . '" title="' . __( 'Log out of this account', GRVE_THEME_TRANSLATE ) . '"> ' . __( 'Log out', GRVE_THEME_TRANSLATE ) . '</a></p>',

			'comment_notes_before' =>
				'<p class="comment-notes">' .
				__( 'Your email address will not be published.', GRVE_THEME_TRANSLATE ) .
				'</p>',

			'comment_notes_after' => '' ,

			'fields' => apply_filters(
				'comment_form_default_fields',
				array(
					'author' =>
						'<div class="grve-form-input">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
						' placeholder="' . __( 'Name', GRVE_THEME_TRANSLATE ) . ' ' . ( $req ? __( '(required)', GRVE_THEME_TRANSLATE ) : '' ) . '" />' .
						'</div>',

					'email' =>
						'<div class="grve-form-input">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
						' placeholder="' . __( 'E-mail', GRVE_THEME_TRANSLATE ) . ' ' . ( $req ? __( '(required)', GRVE_THEME_TRANSLATE ) : '' ) . '" />' .
						'</div>',

					'url' =>
						'<div class="grve-form-input">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' .
						' placeholder="' . __( 'Website', GRVE_THEME_TRANSLATE )  . '" />' .
						'</div>',
					)
				),
		);
?>


			<?php
				//Use comment_form() with no parameters if you want the default form instead.
				comment_form( $args );
			?>


<?php endif;  ?>