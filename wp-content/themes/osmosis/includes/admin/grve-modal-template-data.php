<?php
/**
 * Greatives Modal Backbone Templates
 */
?>
<div>
	<script type="text/html" id='grve_backbone_modal_window'>
		<div class="grve-modal">
			<a class="grve-modal-close" href="#" title="<?php echo __( 'Close' , GRVE_THEME_TRANSLATE );?>">
				<span class="grve-modal-icon ir"><?php echo __( 'Close' , GRVE_THEME_TRANSLATE );?></span>
			</a>
			<div class="grve-modal-content">
				<section class="grve-modal-main" role="main">
					<header><h1></h1></header>
					<article class="grve-modal-article"></article>
					<footer>
						<div class="inner text-right">
							<button id="grve-modal-btn-cancel" class="button button-large"><?php echo __( 'Cancel' , GRVE_THEME_TRANSLATE );?></button>
							<button id="grve-modal-btn-ok" class="button button-primary button-large"><?php echo __( 'Save' , GRVE_THEME_TRANSLATE );?></button>
						</div>
					</footer>
				</section>
			</div>
		</div>
	</script>

	<?php
	/**
	 * The Modal Backdrop
	 */
	?>
	<script type="text/html" id='grve_backbone_modal_backdrop'>
		<div class="grve-modal-backdrop">&nbsp;</div>
	</script>

	<?php
	/**
	 * Button Templates
	 */
	?>
	<script type="text/html" id='grve-select-button-target-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_button_target_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-button-color-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_button_color_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-button-size-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_button_size_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-button-shape-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_button_shape_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-button-type-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_button_type_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<?php
	/**
	 * Overlay Templates
	 */
	?>

	<script type="text/html" id='grve-select-pattern-overlay-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_pattern_overlay_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-color-overlay-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_color_overlay_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-opacity-overlay-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_opacity_overlay_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-text-animation-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_text_animation_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<?php
	/**
	 * Layout/Style Templates
	 */
	?>
	<script type="text/html" id='grve-select-align-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_align_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-header-style-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_header_style_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-style-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
					<?php grve_print_media_style_selection(); ?>
				</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-color-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_color_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-bg-position-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_bg_position_selection(); ?>
			</select>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-select-bg-effect-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
			<select name="<%= name %>" data-meta-id="<%= id %>" data-meta-value="<%=value%>" class="grve-modal-select">
				<?php grve_print_media_bg_effect_selection(); ?>
			</select>
			</div>
		</div>
	</script>



	<?php
	/**
	 * Generic Templates
	 */
	?>

	<script type="text/html" id='grve-label-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element-full grve-modal-element-left grve-modal-label-element">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-textfield-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<input type="text" name="<%= name %>" data-meta-id="<%= id %>" class="grve-modal-textfield" value="<%= value %>"/>
			</div>
		</div>
	</script>

	<script type="text/html" id='grve-textarea-template'>
		<div class="grve-modal-element-container">
			<div class="grve-modal-element grve-modal-element-left">
				<span class="grve-modal-label"><%= title %></span>
				<span class="grve-modal-description"><%= desc %></span>
			</div>
			<div class="grve-modal-element grve-modal-element-left">
				<textarea name="<%= name %>" data-meta-id="<%= id %>" class="grve-modal-textarea"><%= value %></textarea>
			</div>
		</div>
	</script>

</div>
