<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/meta.php"); ?>
<title>Dal's CD</title>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/js_include.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/css_include.php"); ?>
<script> 
 
$(document).ready(function(){
 
	var playItem = 1;
 
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
<div class="textBoxOne">
<div class="largeTextTitle">Dal's Latest CD Now Available!</div>
<div class="smallTextTitle">To Order Your Dal Richards CD:</div>
<p>Autographed copies available directly from Dal. Send an e-mail to <a href="mailto:dal@dalrichards.com" onClick="javascript:urchinTracker('/email/cd-info/dal-dalrichards.com');">dal@dalrichards.com</a>.  CD's are $23.00. Send a cheque with a name clearly spelled for an autographed copy.</p>
<p>You can listen to Dal's CD's at <a href="http://www.beanstreamcarts.com/stores/pacificmusic/group.asp?c=0&groupid=3033" onClick="javascript:urchinTracker('/outgoing/cd-info/pacific-music');" target="_blank">www.pacificmusic.net</a> and purchase directly from the Pacific Music Online Store.</p>
<hr />
<div class="smallTextTitle">Dal Richards and Friends: One More Time</div>
<p>Legendary Vancouver bandleader Dal Richards releases a new big band CD, Dal Richards &amp; Friends One More Time. Joined by his regular big band vocalists Jamie Croil, Jennifer Hayes, Diane Lines, Bria Skonberg and by special guest artist bluesman Jim Byrnes, the CD, Dal Richards &amp; Friends One More Time, features more than a dozen songs of big band music at its finest.</p>
<img src="/Images/CD/dal_friends_one_more_time_small.jpg" alt="Dal Richards and Friends" name="CDDalandFriends" width="156" height="155" class="pictureFloatRight" id="CDDalandFriends" />
<div class="CDTrackList">
    <ol>
		<li>Sway</li>
		<li>Opus One</li>
        <li>Glenn Miller Medley</li>
        <li>The Nearness Of You</li>
        <li>Theme from Mr. Lucky</li>
        <li>Why Don't You Do Right</li>
        <li>St. Louis Blues</li>
        <li>For Once in My Life</li>
        <li>A Tisket A Tasket</li>
        <li>Walkin' My Baby Back Home</li>
        <li>Just One Of Those Things</li>
        <li>Dancing in the Dark</li>
        <li>You'd Be So Nice To Come Home To</li>
        <li>Swingin' with Dal</li>
        <li>Remembering The Roof –
          <ul>
            <li> I'll See You in My Dreams</li>
            <li>Dream</li>
            <li>Does your Heart Beat for Me</li>
            <li>Dancing in the Dark</li>
          </ul>
        </li>
        <li> The Hour of Parting</li>
    </ol>
</div>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><div align="center"><a href="/Images/CD/cd_and_back_cover.jpg" class="fancy_image" rel="CD" title="Dal Richards & Friends CD Front and Back"><img src="/Images/CD/cd_and_back_cover_thumb.jpg" width="156" height="136" border="0" /></a><br />
    <div style="font-size: 10px; font-style: italic;"><strong>CD Cover and Back</strong><br />(click to enlarge)</div></div></td>
    <td><div align="center"><a href="/Images/CD/cd_liner_notes.jpg" class="fancy_image" rel="CD" title="Dal Richards & Friends CD Liner Notes"><img src="/Images/CD/cd_liner_notes_thumb.jpg" width="156" height="136" border="0" /></a><br />
    <div style="font-size: 10px; font-style: italic;"><strong>Liner Notes</strong><br />(click to enlarge)</div></div></td>
  </tr>
</table>
<p>&nbsp;</p>

	<!-- jQuery jPlayer plugin -->
  	<div id="jquery_jplayer"></div>
 
    <div id="player_container">
      <ul id="player_controls">
        <li id="player_play">play</li>
            <li id="player_pause">pause</li>
            <li id="player_stop">stop</li>
            <li id="player_volume_min">min volume</li>
            <li id="player_volume_max">max volume</li>
            <li id="ctrl_prev">previous</li>
            <li id="ctrl_next">next</li>
      </ul>
        <div id="play_time"></div>
        <div id="total_time"></div>
      <div id="player_progress">
        <div id="player_progress_load_bar">
          <div id="player_progress_play_bar"></div>
            </div>
        </div>
        <div id="player_volume_bar">
          <div id="player_volume_bar_value"></div>
        </div>
    </div>
     
    <div id="playlist_list">
        <ul>
            <!-- The function displayPlayList() uses this unordered list -->
        </ul>
    </div>
     
  <div id="jplayer_info"></div>
  
  <p align="center"><a href="/pdf/Dal_CD_Press_Release.pdf" target="_blank">CD Press Release</a></p>

<hr />
<div class="smallTextTitle">Dal Richards and Friends:</div>
<p>Dal took his sixteen-piece orchestra into Armoury Studios to produce an exciting new live big band CD. Joined by his regular big band vocalists Bria Skonberg, Diane Lines, Jamie Croil and Jennifer Hayes and by special guest artist bluesman Jim Byrnes, the CD '<strong>Dal Richards and Friends</strong>' features more than a dozen cuts of big band music at its best.</p>
<img id="CDDalandFriends" alt="Dal Richards and Friends" src="/Pictures/DalandFriends.jpg" height="138" width="141" class="pictureFloatRight" />
<div class="CDTrackList">
    <ol>
		<li><strong>The Girl From Ipanema</strong> (Jobin/Gimbel) 2:08</li>
		<li><strong>What a Wonderful World</strong> - Jennifer Hayes (Thiele/Weiss) 3:58</li>
		<li><strong>In the Mood</strong> (Garland) 3:37</li>
		<li><strong>Stepping Out With My Baby</strong> - Diane Lines (Berlin) 3:11</li>
		<li><strong>Blues in the Night</strong> - Jim Byrnes (Arlen/Mercer) 3:30</li>
		<li><strong>My Heart Belongs to Daddy</strong> - Bria Skonberg (Porter) 3:17</li>
		<li><strong>Chattanooga Choo Choo/Tuxedo Junction</strong> - Jamie Croil & Diane Lines (Warren/Mack & Dash/Feyne/Hawkins/Johnson) 3:29</li>
		<li><strong>These Foolish Things</strong> - Jennifer Hayes (Marvell/Strachey/Link) 3:58</li>
		<li><strong>All of Me</strong> - Bria Skonberg and Jamie Croil (Marks/Simons) 2:41</li>
		<li><strong>Where or When</strong> - Dal Richards (Rodgers/Hart) 2:28</li>
		<li><strong>Caravan</strong> - Jennifer Hayes (Ellington/Mills/Tizol) 4:08</li>
		<li><strong>Route 66</strong> (Troup) 3:00</li>
		<li><strong>Deed I Do</strong> - Bria Skonberg (Hirsch/Rose) 2:39</li>
		<li><strong>As Time Goes By</strong> - Dal Richards (Hupfeld) 3:41</li>
		<li><strong>I Love Being Here With You</strong> - Diane Lines (Lee/Schluger/Loesser) 3:11</li>
		<li><strong>Sing Sing Sing</strong> (Prima) 3:07</li>
		<li><strong>Dal Introduces Theme</strong> 0:15</li>
		<li><strong>The Hour of Parting</strong> (Spoliansky/Kahn) 2:13</li>											
	</ol>
</div>
<hr />
<div class="smallTextTitle">The Swinging Years:</div>
<p>His latest CD, "The Swinging Years" captures highlights of a remarkable career spanning seven decades! "The Swinging Years" is a blend of Dal’s unique stylings heard on "Live From The Panorama Roof" – a staple on national radio for a quarter century – and today’s contemporary Dal Richards Orchestra. Trumpet-laying vocalist Jamie Croil and talented singer-keyboardist Diane Lines complement the vocalizations of the former boy singer and now mature crooner, Dal Richards, resulting in a recording that captures much of the secret of Dal’s success.</p>
<img id="CDSwingingYears" alt="The Swinging Years" src="/Pictures/TheSwingingYears.jpg" height="138" width="141" class="pictureFloatRight" />
<div class="CDTrackList">
<ol>
<li><strong>What Is This Thing Called Love</strong> - Diane Lines (Porter) 2:19</li>
<li><strong>New York New York</strong> (Kander/Ebb) 2:46</li>
<li><strong>Choo Choo Cho Boogie</strong> – Diane Lines (Horton/Gabler/Darling) 3:05</li>
<li><strong>Sweetheart of Sigma Chi</strong> – Dal Richards (Stokes/Kernor) 2:29</li>
<li><strong>How high The Moon</strong> (Lewis/Hamilton) 1:53</li>
<li><strong>Kansas City</strong> – Jamie Croil (Stoller/Lieber) 2:38</li>
<li><strong>Girl from Ipanema</strong> (Jobim/Gimbel) 2:06</li>
<li><strong>Stella by Starlight</strong> – Dal Richards (Young/Washington) 4:21</li>
<li><strong>Speak Low</strong> – Lorraine McAllister (Weil/Nash) 3:17</li>
<li><strong>Cha Cha Medley</strong> 3:27
<br /><strong>In A Little Spanish Town</strong>  (Lewis/Wayne/Young)
<br /><strong>Cocktails for Two</strong> (Koslow/Johnston)
<br /><strong>On the Isle of Capri</strong> (Grosz/Kennedy)</li>
<li><strong>L-O-V-E – Diane Lines</strong> (Kaempfert/Gabler) 2:58</li>
<li><strong>Where or When</strong> – Dal Richards (Rodgers/Hart) 2:33</li>
<li><strong>Theme from Mr. Lucky</strong> (Mancini) 2:25</li>
<li><strong>Get to Getting</strong> – Diane Lines (A.Smith/M.Wilson) 3:03</li>
<li><strong>Goodnight Medley</strong> 3:44
<br /><strong>I’ll See You in My Dreams</strong> (Kahn/Jones)
<br /><strong>Does Your Heart Beat for Me</strong> (Parrish/Morgan)
<br /><strong>Dancing in the Dark</strong> (Dietz/Schwartz)</li>
<li><strong>Dal Introduces Theme</strong> 0:15</li>
<li><strong>The Hour of Parting</strong> (Spoliansky) 2:13</li>
</ol>
</div>
<hr />
<div class="smallTextTitle">A Tribute to the Crooners:</div>
<p><strong>From Dal's introduction:</strong> My Harvard Dictionary of Music describes crooning this way:</p>
<p><em>"to sing relatively softly and with inflections of pitch as in the style of such singers of popular sentimental songs as Rudy Vallee, Bing Crosby, Perry Como and Frank Sinatra. It was the dominant male singing style in popular music from the 1930's into the 50's and has survived alongside other styles ever since."</em></p>
<p>That covers it very nicely, I would say. Today the unforgettable music of the 30s, 40s and 50s is heard regularly on adult radio and crooners – both male and female – are the artists of choice to pay homage to the golden ear of songwriting. They are so well known and reputed/ loved that only their first names need be mentioned to bring smiles of recognition. Frank, Ella, Dean, Nat, Perry, Tony, Bing, Matt, Dinah, Rosemary and the many others. This is their songbook.</p>
<img id="CDTributeToCrooners" alt="A Tribute to the Crooners" src="/Pictures/TributetotheCrooners.jpg" height="138" width="141" class="pictureFloatRight" />
<div class="CDTrackList">
<ol>
<li><strong>Where or When</strong> - Richard Rodgers/Lorenz Hart</li>
<li><strong>As Time Goes</strong> - Herman Hupfeld</li>
<li><strong>Dancing in the Dark</strong> - Dietz Howard/Arthur Schwartz</li>
<li><strong>I’ll Never Smile Again</strong> - Ruth Lowe</li>
<li><strong>Lollipops and Roses </strong> -Anthony Velona</li>
<li><strong>It Had to Be You</strong> - Isham Jones/Gus Kahn</li>
<li><strong>Stardust Hoagy</strong> - Carmichael/Mitchell Parrish</li>
<li><strong>Red Roses for a Blue Lady</strong> - Ray Bennett/Sid Tepper</li>
<li><strong>Dear Heart</strong> - Henry Mancini</li>
<li><strong>Cheek to Cheek</strong> - Irving Berlin</li>
<li><strong>The Hour of Parting</strong> - Michael Spoliansky/Gus Kahn</li>
</ol>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/leftColumn.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/Common/footer.php"); ?>
</body>
</html>
