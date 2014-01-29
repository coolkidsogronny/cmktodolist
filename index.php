<?php
require_once("php/functions.php");
if(! isset($_SESSION['USER'])){     
  header('Location: login.php');
  exit;
}
?>


<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/themes/app_style.min.css" />
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>

</head>

<body>
<section data-role="page"  id="page">
  <section data-role="header" data-theme="b" data-position="fixed">
  <a href="index.php"  data-role="button" data-icon="home">Home</a>
    <h1><?php echo $_SESSION['USER']['navn']; ?></h1><!--tekst fra databassen-->
    <a href="index.php?page=help" data-role="button" data-icon="info" data-iconpos="right">Hjælp</a>
 
</section><!--end of header-->
  <section data-role="content" id="content"><!--start of content--> 
    <?php
                
               
				
				 if( isset($_GET['page'])) 
    {
        include( 'side/'. $_GET['page'].'.php');
    }
	else
	{
		include('side/forside.php');
	}

            ?>
  </section><!--end og content-->
  <section data-role="footer" data-position="fixed" class="ui-bar"><!--footer er fixed til bunden-->  
<a href="index.php?page=opret"  data-role="button"  data-icon="plus" class="left" data-inline="true">Tilføj</a>
<a href="index.php?page=profil"  data-role="button"  data-icon="user" class="right" data-inline="true" data-iconpos="right">Profil</a>

</section><!--end of footer-->
</body>
</html>




