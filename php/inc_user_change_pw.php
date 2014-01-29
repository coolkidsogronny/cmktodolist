<?php
$ErrorMsg="";
if(isset($_POST['update_pw'])){
  $ErrorArray = array();
  $ErrorCount=0;
  $pass0=trim($_POST["kodeord0"]);
  $pass1=trim($_POST["kodeord1"]);
  if($pass0 == "") {
      $ErrorArray[] = "Du skal indtaste et kodeord.<br>";
      $ErrorCount++;
  }  
  if($pass1 == "") {
      $ErrorArray[] = "Du skal indtaste dit kodeord igen.<br>";
      $ErrorCount++;
  }
  if($pass0 != $pass1){
      $ErrorArray[] = "de 2 kodeord er ikke ens.<br>";
      $ErrorCount++;
  }
  if($ErrorCount == 0){
    User_Update_Pw($conn, $_SESSION['USER']['id'], $pass0);    
    header('Location: index.php');
    exit();     
  }
  else{ 
      for($i=0;$i<$ErrorCount;$i++){
        $ErrorMsg .=$ErrorArray[$i]; 
      }     
  }
}
?>

    <?php
    require_once("php/inc_header_menu.php");
  ?>
  <section data-role="content" id="content"><!--start of content-->
<?php
  echo $ErrorMsg;
  ?>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=user_change_pw">    	
    	<input type="password" 	name="kodeord0" 	placeholder="kodeord"><!-- password -->
    	<input type="password" 	name="kodeord1" 	placeholder="gentag kodeord"><!-- gentag password så de matcher hindanen -->
    	<input type="Submit" name="update_pw" value="updater kodeord">
	</form>        

                        
  </section><!--end og content-->
  <footer data-role="footer" data-position="fixed" ><!--footer er fixed til bunden--> 
  <h3>huske app as 2014</h3>
</footer><!--end of footer-->