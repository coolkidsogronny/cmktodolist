<?php
require_once("php/functions.php");



if(isset($_POST['send_email'])){
$to      = trim($_POST["email"]);
// generar nyt pw
$newpw = RandPass();
$userid = User_IsCreated($conn, $to);


  if($userid>0){
    // update bruger database
    User_Update_Pw($conn, $userid, $newpw);

    // send nyt pw
    
    // $to      = 'nobody@example.com';
    $subject = 'nyt password';
    $message = $newpw;
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
     mail($to, $subject, $message, $headers);
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
    <h1>overskrift fra db</h1><!--tekst fra databassen-->
</section><!--end of header-->
  <section data-role="content" id="content1"><!--start of content-->

    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="email"  name="email" placeholder="navn@email.com"><!-- send email til brugerens mail hvis han har glemt password -->
      
      <input type="submit" name="send_email" value="Send">
    </form>     

                        
  </section><!--end og content-->
  <footer data-role="footer" data-position="fixed" ><!--footer er fixed til bunden--> 
  <h3>huske app as 2014</h3>
</footer><!--end of footer-->
</section>
</body>
</html>