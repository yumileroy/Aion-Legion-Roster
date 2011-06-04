OFC = {};

OFC.jquery = {
    name: "jQuery",
    version: function(src) { return $('#'+ src)[0].get_version() },
    rasterize: function (src, dst) { $('#'+ dst).replaceWith(OFC.jquery.image(src)) },
    image: function(src) { return "<img src='data:image/png;base64," + $('#'+src)[0].get_img_binary() + "' />"},
    popup: function(src) {
        var img_win = window.open('', 'Charts: Export as Image')
        with(img_win.document) {
            write('<html><head><title>Charts: Export as Image<\/title><\/head><body>' + OFC.jquery.image(src) + '<\/body><\/html>') }
		// stop the 'loading...' message
		img_win.document.close();
     }
}

OFC.jqueryie = {
    name: "jQuery IE",
    version: function(src) { return $('#'+ src)[0].get_version() },
    rasterize: function (src, dst) { $('#'+ dst).replaceWith(OFC.jquery.image(src)) },
    image: function(src) { return "<img src='data:image/png;base64," + $('#'+src)[0].get_img_binary() + "' />"},
    popup: function(src) {
     var img_data = "image/png;base64,"+$("#"+src)[0].get_img_binary();
     var img_win = window.open('', 'imagesave');
     with(img_win.document) {
      write('<html>');
      write('<head>');
      write('<title>imagesave<\/title>');
      write('<\/head>');
      write('<body onload="document.forms[0].submit()">');
      write('<form action=".\/base64post.php" method="post">');
      write('<input type="hidden" name="d" id="data" value="'+img_data+'" \/>');
      write('<\/form>');    
      write('<div><img src="\/ofc\/ajax-loader.gif" border="0" alt="" \/><\/div>');
      write('<div style="font-family: Verdana;">Please wait<br \/>After you can save the   image<\/div>');
      write('<\/body>');
      write('<\/html>');
     }
     img_win.document.close();
    }
}

// Using an object as namespaces is JS Best Practice. I like the Control.XXX style.
//if (!Control) {var Control = {}}
//if (typeof(Control == "undefined")) {var Control = {}}
if (typeof(Control == "undefined")) {var Control = {OFC: OFC.jquery}}
 
 
function save_image() { // this function is automatically called
  if ($.browser.msie)
    OFC.jqueryie.popup('my_chart'); // only for IE navigators
  else
    OFC.jquery.popup('my_chart'); // for the others
}