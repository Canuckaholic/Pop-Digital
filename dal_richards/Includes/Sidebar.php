   <div id="Container">
      <div id="SideBar">
        <div class="SidebarElement" id="SidebarNews">
          <div id="NewsTOP">
            &nbsp;
          </div>

          <div id="News">
            <h2 id="UpcomingEvents">Upcoming Events</h2>

<?php 
if (isset($_SESSION['login']))
   {
	   $OutputFormat = "Admin";
   } else {
		 $OutputFormat = "Short";
   }
     
include("DB/FileRead.php"); 
?>


          </div>

          <div id="NewsBOTTOM">
            &nbsp;
          </div>
        </div>

        <div class="SidebarElement" id="SidebarRadio">
          <a href="DalsPlace.php"><span>Listen to Dal's Place! Weekends on 600 AM</span></a>
        </div>

        <div class="SidebarElement" id="SidebarCDs">
          <a href="CDInfo.php"><span>Dal's latest CD now available!</span></a>
        </div>

        <div class="SidebarElement" id="SidebarLine">
          <div class="SidebarHR">
            &nbsp;
          </div>
        </div>

        <div class="SidebarElement" id="SidebarBookDal">
          <p>Interested in booking Dal and his band for your wedding, gala or other special event?</p><a href="Booking.php">Click here for booking information</a>
        </div>
        
        <div class="SidebarElement" id="SidebarDalTV">
	        <a href="DalTV_Harmony_Arts_Festival.php"><span>DalTV</span></a>
        </div>        
      </div>

      <div id="Content">

      <div id="Fontsize">
       <div id="FontTitle"><span>Font Size:</span></div>
       <div id="FontSmall"><a href="#Small" onClick="javascript:FontSize('small'); javascript:urchinTracker('/font-size/small'); return false;" title="Small"><span>small</span></a></div>
       <div id="FontMedium"><a href="#Medium" onClick="javascript:FontSize('medium'); javascript:urchinTracker('/font-size/medium'); return false;" title="Medium"><span>medium</span></a></div>
       <div id="FontLarge"><a href="#Large" onClick="javascript:FontSize('large'); javascript:urchinTracker('/font-size/large'); return false;" title="Large"><span>large</span></a></div>
       <div class="Clearer">&nbsp;</div>
      </div>
