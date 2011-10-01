function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;
function siteHeader_DoFSCommand(command, args) {
  var myFlashObj = InternetExplorer ? siteHeader : document.siteHeader;
  if (command == "showAboutUs") {	  
	  MM_showHideLayers('aboutUsMenu','','show','becomeExtraMenu','','hide','hideDropMenus','','show');
  } else if (command == "showBecomeExtra") {	  
	  MM_showHideLayers('aboutUsMenu','','hide','becomeExtraMenu','','show','hideDropMenus','','show');
  } else if (command == "hideAll") {	  
	  MM_showHideLayers('aboutUsMenu','','hide','becomeExtraMenu','','hide','hideDropMenus','','hide');
  }
}

if (navigator.appName && navigator.appName.indexOf("Microsoft") != -1 && navigator.userAgent.indexOf("Windows") != -1 && navigator.userAgent.indexOf("Windows 3.1") == -1) {
  document.write('<SCRIPT LANGUAGE=VBScript\> \n');
  document.write('on error resume next \n');
  document.write('Sub siteHeader_FSCommand(ByVal command, ByVal args)\n');
  document.write(' call siteHeader_DoFSCommand(command, args)\n');
  document.write('end sub\n');
  document.write('</SCRIPT\> \n');
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}