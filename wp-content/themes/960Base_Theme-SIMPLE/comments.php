<?php
/*
 * Theme Name: 960Base Theme SIMPLE
 * Theme URI: http://960basetheme.kiuz.it
 * Description: Wordpress theme based on 960 Grid System
 * Author: Domenico Monaco
 * Author URI: http://www.kiuz.it
 * Version: 1.0.0
 */
?>
<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<div class="box">
<h2><a href="##">Comment Form (Show / Hide)</a></h2>
<div id="forms" class="block" style="margin: 0px;">

<?php if ( have_comments() ) : ?>

	<h4 class="txt1"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>

	<ol class="commentlist">
	<?php wp_list_comments('avatar_size=48'); ?>
	</ol>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
		<div class="fix"></div>
	</div>
 
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
<div id="comments_wrap">
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>
</div> <!-- end #comments_wrap -->

	<?php endif; ?>

<?php endif; ?>

<div id="respond">
<?php if ('open' == $post->comment_status) : ?>

<h4 class="txt1"><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h4>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form class="form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comments">

<?php if ( $user_ID ) : ?>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<p class="logged-in">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<p><textarea class="textarea" name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<?php else : ?>

<ol class="fieldset">

	<li class="field">
	<input class="text" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
		
	
	</li>

	<li class="field">
			<input class="text" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		<label for="email">Email <?php if ($req) echo "(required)"; ?></label>

	
	</li>

	<li class="field">
	<input class="text" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url">Website</label>
		
	
	</li>

	<li class="field">
	
		<textarea class="textarea" name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
	
	</li>

</ol>

<?php endif; // If logged in ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p class="submit">
<input class="btinput" name="submit" type="submit" id="submit" tabindex="5" value="Submit" /></p>

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>


<?php endif; // if you delete this the sky will fall on your head ?>

</div> <!-- end #respond -->

</div>
</div>
