<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal Richards Welcomes You</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
<script> 
 
$(document).ready(function(){
 
	var playItem = 0;
 
	var myPlayList = [
		{name:"Sway",mp3:"http://www.dalrichards.com/mp3/1_Sway.mp3"},
		{name:"Opus One",mp3:"http://www.dalrichards.com/mp3/2_Opus_One.mp3"},
		{name:"Glen Miller Medley",mp3:"http://www.dalrichards.com/mp3/3_Glen_Miller_Medley.mp3"},
		{name:"The Nearness Of You",mp3:"http://www.dalrichards.com/mp3/4_The_Nearness_Of_You.mp3"},
		{name:"Theme From Mr Lucky",mp3:"http://www.dalrichards.com/mp3/5_Theme_From_Mr_Lucky.mp3"}
	]; 
 
	$("#jquery_jplayer").jPlayer({
		ready: function() {
			displayPlayList();
			playListInit(true); // Parameter is a boolean for autoplay.
			demoInstanceInfo($(this), $("#jplayer_info"));
		},
		oggSupport: false
	})
	.jPlayerId("play", "player_play")
	.jPlayerId("pause", "player_pause")
	.jPlayerId("stop", "player_stop")
	.jPlayerId("loadBar", "player_progress_load_bar")
	.jPlayerId("playBar", "player_progress_play_bar")
	.jPlayerId("volumeMin", "player_volume_min")
	.jPlayerId("volumeMax", "player_volume_max")
	.jPlayerId("volumeBar", "player_volume_bar")
	.jPlayerId("volumeBarValue", "player_volume_bar_value")
	.onProgressChange( function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
		var myPlayedTime = new Date(playedTime);
		var ptMin = (myPlayedTime.getUTCMinutes() < 10) ? "0" + myPlayedTime.getUTCMinutes() : myPlayedTime.getUTCMinutes();
		var ptSec = (myPlayedTime.getUTCSeconds() < 10) ? "0" + myPlayedTime.getUTCSeconds() : myPlayedTime.getUTCSeconds();
		$("#play_time").text(ptMin+":"+ptSec);
 
		var myTotalTime = new Date(totalTime);
		var ttMin = (myTotalTime.getUTCMinutes() < 10) ? "0" + myTotalTime.getUTCMinutes() : myTotalTime.getUTCMinutes();
		var ttSec = (myTotalTime.getUTCSeconds() < 10) ? "0" + myTotalTime.getUTCSeconds() : myTotalTime.getUTCSeconds();
		$("#total_time").text(ttMin+":"+ttSec);
	})
	.onSoundComplete( function() {
		playListNext();
	});
 
	$("#ctrl_prev").click( function() {
		playListPrev();
		return false;
	});
 
	$("#ctrl_next").click( function() {
		playListNext();
		return false;
	});
 
	function displayPlayList() {
		for (i=0; i < myPlayList.length; i++) {
			$("#playlist_list ul").append("<li id='playlist_item_"+i+"'>"+ myPlayList[i].name +"</li>");
			$("#playlist_item_"+i).data( "index", i ).hover(
				function() {
					if (playItem != $(this).data("index")) {
						$(this).addClass("playlist_hover");
					}
				},
				function() {
					$(this).removeClass("playlist_hover");
				}
			).click( function() {
				var index = $(this).data("index");
				if (playItem != index) {
					playListChange( index );
				} else {
					$("#jquery_jplayer").play();
				}
			});
		}
	}
 
	function playListInit(autoplay) {
		if(autoplay) {
			playListChange( playItem );
		} else {
			playListConfig( playItem );
		}
	}
 
	function playListConfig( index ) {
		$("#playlist_item_"+playItem).removeClass("playlist_current");
		$("#playlist_item_"+index).addClass("playlist_current");
		playItem = index;
		$("#jquery_jplayer").setFile(myPlayList[playItem].mp3, myPlayList[playItem].ogg);
	}
 
	function playListChange( index ) {
		playListConfig( index );
		$("#jquery_jplayer").play();
	}
 
	function playListNext() {
		var index = (playItem+1 < myPlayList.length) ? playItem+1 : 0;
		playListChange( index );
	}
 
	function playListPrev() {
		var index = (playItem-1 >= 0) ? playItem-1 : myPlayList.length-1;
		playListChange( index );
	}
	
	$("a.fancy_image").fancybox();
});
 
</script>
 
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Home/home_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/leftColumn.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/footer.php"); ?>
</body>
</html>
