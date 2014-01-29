<?php
require_once("php/functions.php");
/*
if(isset($_SESSION['USER'])){     
  unset($_SESSION['USER']);  
}
*/

$ErrorMsg="";
if(isset($_POST['login'])){
  $ErrorArray = array();
  $ErrorCount=0;

  $username=trim($_POST["brugernavn"]);
  $pass=trim($_POST["kodeord"]);

  echo $username;
  echo $pass; 
  if($pass == "") {
      $ErrorArray[] = "Du skal indtaste et kodeord.<br>";
      $ErrorCount++;
  }

  if($username == "") {
      $ErrorArray[] = "Du skal indtaste et email.<br>";
      $ErrorCount++;
  }
  else{
    if(! filter_var($username, FILTER_VALIDATE_EMAIL)){
      $ErrorArray[] = "Du har ikke indtasted en valid email addresse.<br>";
      $ErrorCount++;
    }
  }

  if($ErrorCount == 0){
     
    $id=User_CheckPassword($conn, $username, $pass);  
    if($id>0){
      $_SESSION['USER']=Read($conn, $id, "tbl_bruger");      
      header('Location: index.php?page=forside');      
      exit(); 
    } 
  }
  else{ 
      
      for($i=0;$i<$ErrorCount;$i++){
        $ErrorMsg .=$ErrorArray[$i]; 
      }
      $ErrorMsg = '<span class ="error_txt">'.$ErrorMsg.'<span>';      
  } 
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

<section data-role="page"  id="index">
  

  <section data-role="header" data-theme="b" data-position="fixed">
    <h1>to do list</h1><!--tekst fra databassen-->
</section><!--end of header-->
  <section data-role="content" id="content"><!--start of content-->
  <div class="opgaver"><h1>to do list</h1></div>
    <center><img src="img/logo-app.gif" width="25%"></center>
	<?php
  echo $ErrorMsg;
  ?>
              <form id="check-user" method="post" action="#">

                <fieldset>                   
                        <label for="brugernavn"></label>
                        <input type="text" value="" name="brugernavn" id="brugernavn" placeholder="Brugernavn:"/>
                        <label for="kodeord"></label>
                        <input type="password" value="" name="kodeord" id="kodeord" placeholder="Password:"/> 
                    <input type="submit" data-theme="b" name="login" id="login" value="login">
                </fieldset>
            </form>               
            <a href="opret_bruger.php" data-role="button" data-role="fieldcontain" style="float: left;">Opret bruger</a>
                    <a href="glemt_bruger.php" data-role="button" data-role="fieldcontain" style="float: right;">Glemt bruger</a>
               
  </section><!--end og content-->
  </section><!--end page-->
  
  <footer data-role="footer" data-position="fixed" ><!--footer er fixed til bunden-->  
  <h3>huske app as 2014</h3>
</footer><!--end of footer-->
</body>
</html>




