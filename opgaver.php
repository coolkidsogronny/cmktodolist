<?php
require_once("php/functions.php");
$conn = mysqli_connect("localhost", "root", "", $db );
?>
<?php
$info = $_GET['opgave'];
?>
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
$(document).ready(function() {

     $('#page').('swipeleft swiperight',function(event){
        console.log(event.type);
        if (event.type == "swipeleft") {
            var prev = $("opgaver.php?opgave=<?php echo $info-1;?>" );
             if (prev.length) {
                 var prevurl = $(prev).attr("href");
                 console.log(prevurl);
             }
         }
         if (event.type == "swiperight") {
             var next = $("opgaver.php?opgave=<?php echo ++$info;?>" );
             if (next.length) {
                 var nexturl = $(next).attr("href");
                 console.log(nexturl);
             }
         }
     });
});


</script>
</head>


	
<body>

  <section data-role="page" id="article<?php echo $antal; ?>">
     <section data-role="header" data-theme="b" data-position="fixed">
  <a href="index.php"  data-role="button" data-icon="home" rel="external">Home</a>
    <h1><?php echo $_SESSION['USER']['navn']; ?></h1><!--tekst fra databassen-->
    <a href="index.php?page=rediger&&idopg=<?php echo $info;?>" data-role="button" data-icon="edit" data-iconpos="right" rel="external">rediger</a>
 
</section><!--end of header-->
    <div data-role="content" id="page">
  
    <?php
	
	
	if(isset($_GET['opgave']))
	{
	  $info = $_GET['opgave'];
	  $antal = 1 * $info;
     $sql = "SELECT * FROM tbl_opgave WHERE id = '$info'";
	$rs = mysqli_query($conn, $sql);	
	while($arr = mysqli_fetch_assoc($rs) ){	
		
	 
		echo "<div class='opgaver'>".$arr['navn']."</div>"; 
		echo "<div class='opgaver'>".$arr['tekst']."</div>"; 
		echo "<div class='opgaver'>".$arr['start']."</div>"; 
		echo "<div class='opgaver'>".$arr['slut']."</div>"; 
	 }
	 
	}

	 ?>
    </div>
     <section data-role="footer" data-position="fixed" class="ui-bar"><!--footer er fixed til bunden-->  
<a href="index.php?page=opret"  rel="external" data-role="button"  data-icon="plus" class="left" data-inline="true" >Tilføj</a>
<a href="index.php?page=profil"  rel="external" data-role="button"  data-icon="user" class="right" data-inline="true" data-iconpos="right">Profil</a>

</section><!--end of footer-->
  </section>

  
    
</body>
</html>




