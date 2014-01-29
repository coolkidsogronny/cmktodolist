<?php
  require_once('php/functions.php');

  $error = "";
  $errors = 0;
  if(isset($_POST["opret_bruger"]))
  {   

    $Email = $_POST['email'];
    $name = $_POST['navn'];
    $Password = $_POST['kodeord'];
    $retype_password = $_POST['kodeord2'];
	//$tekst	=	" du er blive opret på to do list. \r\n klik på linke og begynd din liste <a heft='livingsmartthings.dk/mobile'>to do list</a>";

    //Cheker email felterne om de er tomme
    if($Email == "" || $name == "" || $Password == "" || $retype_password == "")
    {  
      $error = "Tomt felt!";
      echo $error;
      $errors++;
    }

    if ($Password != $retype_password){
      $error = "de 2 kodeord er ikke ens!";
      echo $error;
      $email_errors++;
    }

    //Hvis ingen errors udfør updaten
    if (! $errors)    
    {
		$to      = trim($_POST["email"]);
		$message = $tekst. "\r\n". "kære ".$name. "\r\n". "Dit password er". $Password;
		$headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
		$subject = "du er nu opret på to du list";
		mail($to,$subject, $message,$headers);
      User_Create($conn, $name, $Email, $Password);
    }
  }

  
?>
<!doctype html>
<html>
<head>
<title>huske app as 2014</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/themes/app_style.min.css" />
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
</head>

<body>
<section data-role="page"  id="index">
  <section data-role="header" data-theme="b" data-position="fixed">
  <a href="" data-role="button" data-rel="back">Tilbage</a>
    <h1>opret</h1><!--tekst fra databassen-->
</section><!--end of header-->
  <section data-role="content" id="content"><!--start of content-->

    
    <form action="" method="post" id="">
    	<input type="email" 	  name="email" 	     placeholder="navn@email.com" /><!-- email (brugernavn) -->
    	<input type="text" 		  name="navn" 	     placeholder="dit navn"><!-- navn -->
    	<input type="password" 	name="kodeord" 	   placeholder="kodeord"><!-- password -->
    	<input type="password" 	name="kodeord2" 	 placeholder="gentag kodeord"><!-- gentag password så de matcher hindanen -->
    	<input type="submit"    name="opret_bruger" value="Opret din profil">
	</form>        

                        
  </section><!--end og content-->
  <footer data-role="footer" data-position="fixed" ><!--footer er fixed til bunden--> 
  <h3>huske app as 2014</h3>
</footer><!--end of footer-->
</section><!--end of page-->
</body>
</html>