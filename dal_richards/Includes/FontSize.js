if (document.images) {

	//Preload images for rollovers
  
  pic4= new Image();
  pic4.src="Images/FontSize/smallOff.jpg";
  
  pic5= new Image();
  pic5.src="Images/FontSize/smallOn.jpg";
  
  pic6= new Image();
  pic6.src="Images/FontSize/smallHover.jpg";
  
  
  pic7= new Image();
  pic7.src="Images/FontSize/mediumOff.jpg";
  
  pic8= new Image();
  pic8.src="Images/FontSize/mediumOn.jpg";
  
  pic9= new Image();
  pic9.src="Images/FontSize/mediumHover.jpg";
 
 
  pic10= new Image();
  pic10.src="Images/FontSize/largeOff.jpg";
  
  pic11= new Image();
  pic11.src="Images/FontSize/largeOn.jpg";
  
  pic12= new Image();
  pic12.src="Images/FontSize/largeHover.jpg"; 
  
}

function FontSize(size) {
  var el = document.getElementById('Content');

  var sml = document.getElementById('FontSmall');
  var med = document.getElementById('FontMedium');
  var lrg = document.getElementById('FontLarge');

  if (size == 'small') { 
   el.style.fontSize = "10px"; 
   sml.style.background = "url('Images/FontSize/smallOn.jpg') top left no-repeat";
   med.style.background = "url('Images/FontSize/mediumOff.jpg') top left no-repeat";
   lrg.style.background = "url('Images/FontSize/largeOff.jpg') top left no-repeat";   
  }
  
  if (size == 'medium') { 
   el.style.fontSize = "12px"; 
   sml.style.background = "url('Images/FontSize/smallOff.jpg') top left no-repeat";
   med.style.background = "url('Images/FontSize/mediumOn.jpg') top left no-repeat";
   lrg.style.background = "url('Images/FontSize/largeOff.jpg') top left no-repeat";   
  }
  
  if (size == 'large') { 
   el.style.fontSize = "14px"; 
   sml.style.background = "url('Images/FontSize/smallOff.jpg') top left no-repeat";
   med.style.background = "url('Images/FontSize/mediumOff.jpg') top left no-repeat";
   lrg.style.background = "url('Images/FontSize/largeOn.jpg') top left no-repeat";   
  }  
  
}
