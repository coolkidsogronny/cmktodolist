<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="iso-8859-1"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/themes/app_style.min.css" />
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
<script>
$(document).on('swipeleft', '[data-role="page"]', function(event){    
    if(event.handled !== true) // This will prevent event triggering more then once
    {    
        var nextpage = $(this).next('[data-role="page"]');
        // swipe using id of next page if exists
        if (nextpage.length > 0) {
            $.mobile.changePage(nextpage, {transition: "slide", reverse: false}, true, true);
        }
        event.handled = true;
    }
    return false;         
});

$(document).on('swiperight', '[data-role="page"]', function(event){   
    if(event.handled !== true) // This will prevent event triggering more then once
    {      
        var prevpage = $(this).prev('[data-role="page"]');
        if (prevpage.length > 0) {
            $.mobile.changePage(prevpage, {transition: "slide", reverse: true}, true, true);
        }
        event.handled = true;
    }
    return false;            
});
</script>
</head>


	
<body>

  <div data-role="page" id="article1">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <h1>Articles 1</h1>
    </div>
    <div data-role="content">
      
    </div>
    <div data-role="footer" data-theme="b" data-position="fixed" data-id="footer">
      <h1>Footer</h1>    
    </div>
  </div>

  <div data-role="page" id="article2">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <a href="#article1" data-icon="home" data-iconpos="notext">Home</a>
      <h1>Articles 2</h1>
    </div>
    <div data-role="content">
      
    </div>
    <div data-role="footer" data-theme="b" data-position="fixed" data-id="footer">
      <h1>Footer</h1>
    </div>
  </div>

  <div data-role="page" id="article3">
    <div data-role="header" data-theme="b" data-position="fixed" data-id="footer">
      <a href="#article1" data-icon="home" data-iconpos="notext">Home</a>
      <h1>Articles 3</h1>
    </div>
    <div data-role="content">
      
    </div>
    <div data-role="footer" data-theme="b" data-position="fixed" data-id="footer">
      <h1>Footer</h1>
    </div>
  </div>
    
</body>
</html>




