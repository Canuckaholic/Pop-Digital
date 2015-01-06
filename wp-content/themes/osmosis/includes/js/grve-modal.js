/**
 * Greatives Backbone Modal File
 */

/**
 * @type {Object} JavaScript namespace for our application.
 */
var grve = {
	modal : {
		__instance : undefined
	}
};

grve.modal.Templates = Backbone.View.extend(
	{
		/**
		 * @var string Event name for the templates loaded event
		 */
		loadEvent : "templatesLoaded" ,

		/**
		 * @var {Object} hash of the compiled templates
		 */
		compiled  : {} ,

		initialize : function () {
			"use strict";

			_.bindAll( this, 'load', 'done', 'fail', 'get' );
		} ,

		load : function () {
			"use strict";

			var data = {
				action : "grve_get_modal_template_data"
			};
			jQuery.get( ajaxurl , data , "html" )
				.done( this.done )
				.fail( this.fail );
		} ,

		done : function ( data ) {
			"use strict";

			this.setElement( data );
			this.trigger( this.loadEvent );
		} ,

		fail : function () {
			"use strict";
			alert("fail");
		} ,

		get : function ( template ) {
			"use strict";

			if ( this.compiled[ template ] === undefined ) {
				this.compiled[ template ] = _.template( this.$( template ).html() );
			}
			return this.compiled[ template ];
		}
	} );

/**
 * Primary Modal Application Class
 */
grve.modal.Application = Backbone.View.extend(
	{
		id : "grve-modal-dialog" ,
		events : {
			"click .grve-modal-close" : "closeModal" ,
			"click #grve-modal-btn-cancel" : "closeModal" ,
			"click #grve-modal-btn-ok" : "saveModal"
		} ,
		templates : undefined ,
		collection : new Backbone.Collection() ,
		options: {
			title: "Settings",
			mode: "simple",
			size: "auto"
		},

		ui : {
			title   : '' ,
			content : undefined
		} ,

		initialize : function () {
			"use strict";

			_.bindAll( this, 'render', 'preserveFocus', 'closeModal', 'saveModal' );
			this.templates = new grve.modal.Templates();
			this.templates
				.on( this.templates.loadEvent , this.render )
				.load();
		} ,

		render : function () {
			"use strict";

			this.templates.off( this.templates.loadEvent ) ;

			this.$el.attr( 'tabindex' , '0' )
				.append( this.templates.get( '#grve_backbone_modal_window' )() )
				.append( this.templates.get( '#grve_backbone_modal_backdrop' )() );

			var that = this;
			this.collection.forEach(function(model){
				that.$( '.grve-modal-article' ).append(
					that.templates.get(
						model.get('template_id') )( {
							id : model.get('field_id'),
							name : model.get('name'),
							title : model.get('title'),
							desc : model.get('desc'),
							value : model.get('value')
						}
					)
				);
			});
			this.ui.content = this.$( '.grve-modal-article' );
			this.ui.title = this.$( '.grve-modal-main header h1' ).html(this.options.title);


			// Handle any attempt to move focus out of the modal.
			jQuery( document ).on( "focusin" , this.preserveFocus );
			jQuery( "body" ).addClass('grve-noscroll').append( this.$el );
			//this.$el.focus();

			if ( 'small' == this.options.size ) {
				jQuery('.grve-modal').addClass('grve-modal-small');
			} else if ( 'medium' == this.options.size ) {
				jQuery('.grve-modal').addClass('grve-modal-medium');
			}

			this.$( '.grve-modal-article .grve-modal-select' ).each(function () {
				var selector = jQuery(this);
				selector.val( selector.data("meta-value") );
			});

			jQuery( '.grve-modal-spinner' ).hide();

		} ,

		preserveFocus : function ( e ) {
			"use strict";
			if ( this.$el[0] !== e.target && !this.$el.has( e.target ).length ) {
				this.$el.focus();
			}
		} ,

		closeModal : function ( e ) {
			"use strict";

			e.preventDefault();
			this.undelegateEvents();
			jQuery( document ).off( "focusin" );
			jQuery( "body" ).removeClass('grve-noscroll');
			this.remove();
			grve.modal.__instance = undefined;
		} ,

		saveModal : function ( e ) {
			"use strict";


			this.$( '.grve-modal-article :input' ).each(function () {
				var thisID = jQuery(this).data("meta-id");
				var thisValue = jQuery(this).val();
				jQuery( '#' + thisID ).val(thisValue);
			});

			this.closeModal( e );

		} ,

		doNothing : function ( e ) {
			"use strict";
			e.preventDefault();
		}

	} );

jQuery( function ( $ ) {
	"use strict";


	$('.grve-open-slider-modal').bind("click",(function(e){
		e.preventDefault();
		$(this).bindOpenSliderModal();
	}));
	$('.grve-open-image-modal').bind("click",(function(e){
		e.preventDefault();
		$(this).bindOpenImageModal();
	}));
	$('.grve-open-video-modal').bind("click",(function(e){
		e.preventDefault();
		$(this).bindOpenVideoModal();
	}));
	$('.grve-open-map-modal').bind("click",(function(e){
		e.preventDefault();
		$(this).bindOpenMapModal();
	}));

	$.fn.bindOpenMapModal = function(){

		var $container = $(this).parent();

		if ( grve.modal.__instance === undefined ) {

			var items = new Backbone.Collection;
			var index = 0;
			
			$container.find( '.grve-modal-spinner' ).show();
			$container.find('.grve-map-data-container input').each(function(){

				var $this = $(this),
				metaID = $this.attr('id'),
				metaTemplate = $this.data("meta-template") || '',
				metaValue = $this.val() || '',
				metaTitle = $this.data("meta-title") || '',
				metaDesc = $this.data("meta-desc") || '';
				if ( '' != metaTemplate ) {
					items.add([{ id : index++, template_id: metaTemplate, field_id: metaID, name: metaID, title: metaTitle, desc: metaDesc, value: metaValue }]);
				}
			});

			grve.modal.__instance = new grve.modal.Application( { collection: items } );
			
		}
	}

	$.fn.bindOpenVideoModal = function(){

		var $container = $(this).parent();

		if ( grve.modal.__instance === undefined ) {

			var items = new Backbone.Collection;
			var index = 0;
			
			$container.find( '.grve-modal-spinner' ).show();
			$container.find('.grve-video-data-container input').each(function(){

				var $this = $(this),
				metaID = $this.attr('id'),
				metaTemplate = $this.data("meta-template") || '',
				metaValue = $this.val() || '',
				metaTitle = $this.data("meta-title") || '',
				metaDesc = $this.data("meta-desc") || '';
				if ( '' != metaTemplate ) {
					items.add([{ id : index++, template_id: metaTemplate, field_id: metaID, name: metaID, title: metaTitle, desc: metaDesc, value: metaValue }]);
				}
			});

			grve.modal.__instance = new grve.modal.Application( { collection: items } );
		}
	}

	$.fn.bindOpenSliderModal = function(){

		var $container = $(this).parent();

		if ( grve.modal.__instance === undefined ) {

			var items = new Backbone.Collection;
			var index = 0;
			
			$container.find( '.grve-modal-spinner' ).show();
			$container.find('.grve-slider-data-container input').each(function(){

				var $this = $(this),
				metaID = $this.attr('id'),
				metaTemplate = $this.data("meta-template") || '',
				metaValue = $this.val() || '',
				metaTitle = $this.data("meta-title") || '',
				metaDesc = $this.data("meta-desc") || '';
				if ( '' != metaTemplate ) {
					items.add([{ id : index++, template_id: metaTemplate, field_id: metaID, name: metaID, title: metaTitle, desc: metaDesc, value: metaValue }]);
				}
			});

			grve.modal.__instance = new grve.modal.Application( { collection: items } );
		}
	}

	$.fn.bindOpenImageModal = function(){

		var $container = $(this).parent();

		if ( grve.modal.__instance === undefined ) {

			var items = new Backbone.Collection;
			var index = 0;
			
			$container.find( '.grve-modal-spinner' ).show();
			$container.find('.grve-image-data-container input').each(function(){

				var $this = $(this),
				metaID = $this.attr('id'),
				metaTemplate = $this.data("meta-template") || '',
				metaValue = $this.val() || '',
				metaTitle = $this.data("meta-title") || '',
				metaDesc = $this.data("meta-desc") || '';
				if ( '' != metaTemplate ) {
					items.add([{ id : index++, template_id: metaTemplate, field_id: metaID, name: metaID, title: metaTitle, desc: metaDesc, value: metaValue }]);
				}
			});

			grve.modal.__instance = new grve.modal.Application( { collection: items } );
		}
	}
} );