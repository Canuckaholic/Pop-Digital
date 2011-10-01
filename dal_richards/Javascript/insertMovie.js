function insertQTMovie(movieName)
{
document.write('<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="256" width="320">\n');
document.write('<param name="src" value="'+movieName+'" />\n');
document.write('<param name="autoplay" value="true">\n');
document.write('<param name="type" value="video/quicktime" height="256" width="320">\n');
document.write('<embed src="'+movieName+'" height="256" width="320" autoplay="true" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/" />\n');
document.write('</object>\n');
}
    