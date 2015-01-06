
(function($) {

	"use strict";
	var Map = {

		init: function() {
			//Map
			this.map();
		},
		map: function(){
			$('.grve-map').each( function() {
				var map = $(this),
					gmapLat = map.attr('data-lat'),
					gmapLng = map.attr('data-lng'),
					draggable = isMobile.any() ? false : true;

				var gmapZoom;
				( parseInt( map.attr('data-zoom') ) ) ? gmapZoom = parseInt( map.attr('data-zoom') ) : gmapZoom = 14 ;

				var gmapLatlng = new google.maps.LatLng( gmapLat, gmapLng );
				var gmapHueEnabled = parseInt(grve_maps_data.hue_enabled);

				var styles = [];
				if ( 1 == gmapHueEnabled ) {
					styles = [
					  {
						stylers: [
						  { hue: grve_maps_data.hue },
						  { saturation: grve_maps_data.saturation },
						  { lightness: grve_maps_data.lightness },
						  { gamma: grve_maps_data.gamma }
						]
					  }
					];
				} else {
					styles = [
					  {
						stylers: [
						  { saturation: grve_maps_data.saturation },
						  { lightness: grve_maps_data.lightness },
						  { gamma: grve_maps_data.gamma }
						]
					  }
					];
				}

				var mapOptions = {
					zoom: gmapZoom,
					center: gmapLatlng,
					draggable: draggable,
					scrollwheel: false,
					mapTypeControl:false,
					zoomControl: true,
					styles: styles,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.LEFT_CENTER
					}
				}
				var gmap = new google.maps.Map( map.get(0), mapOptions );

				var mapBounds = new google.maps.LatLngBounds();
				var markers = [];

				map.parent().children('.grve-map-point').each( function() {

					var mapPoint = $(this),
					gmapPointMarker = mapPoint.attr('data-point-marker'),
					gmapPointTitle = mapPoint.attr('data-point-title'),
					gmapPointLat = parseFloat( mapPoint.attr('data-point-lat') ),
					gmapPointLng = parseFloat( mapPoint.attr('data-point-lng') );
					var pointLatlng = new google.maps.LatLng( gmapPointLat , gmapPointLng );
					var marker = new google.maps.Marker({
					  position: pointLatlng,
					  map: gmap,
					  icon: gmapPointMarker,
					  title: gmapPointTitle,
					});

					var data = mapPoint.html();
					if ( '' != data ) {
						var infowindow = new google.maps.InfoWindow({
							content: data
						});

						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(gmap,marker);
						});
					}
					markers.push(marker);
					mapBounds.extend(marker.position);
				});

				if ( map.parent().children('.grve-map-point').length > 1 ) {
					gmap.fitBounds(mapBounds);
					$(window).resize(function() {
						gmap.fitBounds(mapBounds);
					});
				} else {
					$(window).resize(function() {
						gmap.panTo(gmapLatlng);
					});
				}


				map.css({'opacity':0});
				map.delay(600).animate({'opacity':1});

			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// GLOBAL VARIABLES
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	Map.init();

	$(window).on("orientationchange",function(){

		setTimeout(function () {
			Map.init();
		},500);

	});

})(jQuery);