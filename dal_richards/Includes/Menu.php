    <div id="MenuBar">
      <ul>
        <li class="First"><a <?php if($CurPage == "AboutDal") { echo(" class=\"Current\" "); } ?> href="AboutDal.php">ABOUT DAL</a></li>
        <li class="MenuLink"><a <?php if($CurPage == "Calendar") { echo(" class=\"Current\" "); } ?> href="Calendar.php">CALENDAR</a></li>
        <li class="MenuLink"><a <?php if($CurPage == "BigBand") { echo(" class=\"Current\" "); } ?> href="BigBand.php">BIG BAND</a></li>
        <li class="MenuLink"><a <?php if($CurPage == "ComboBand") { echo(" class=\"Current\" "); } ?> href="Combo.php">COMBO BAND</a></li>
        <li id="EventsLink"><a <?php if($CurPage == "News") { echo(" class=\"Current\" "); } ?> href="News.php">NEWS</a></li>
        <li class="Last"><a <?php if($CurPage == "Contact") { echo(" class=\"Current\" "); } ?> href="Contact.php">CONTACT</a></li>
      </ul>
    </div>