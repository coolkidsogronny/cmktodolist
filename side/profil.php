<?php
 require_once('php/functions.php'); 
 if(isset($_SESSION['USER'])){     
  
}
	
	// ***** UPDATE EMAIL! ***** //
	$email_error = "";
	$email_errors = 0;
	if(isset($_POST["skift_email"]))
	{		
		$userid = $_SESSION['USER']['id'];
		$email = $_POST['ny_email'];
		$retype_email = $_POST['ny_email2'];

		//Cheker email felterne om de er tomme
		if($email == "" || $retype_email == "" )
		{  
			$email_error = "Tomt email felt!";
			echo $email_error;
			$email_errors++;
		}
		//Cheker email felterne om de er ens
		if ($email != $retype_email){
			$email_error = "de 2 mail addresser er ikke ens!";
			echo $email_error;
			$email_errors++;
		}
		//Hvis ingen errors udfør updaten
		if (! $email_errors)		
		{
			$email = $_POST['ny_email'];
			User_Update_Mail($conn, $userid, $email);
		}
	}

	// ***** UPDATE PASSWORD! ***** //
	$password_error = "";
	$password_errors = 0;
	if(isset($_POST["skift_password"]))
	{		
		$userid = $_SESSION['USER']['id'];
		$ny_pw = $_POST['ny_pw'];
		$retype_pw = $_POST['ny_pw2'];

		//Cheker Passwprd(pw) felterne om de er tomme
		if($ny_pw == "" || $retype_pw == "" )
		{  
			$password_error = "Tomt password felt!";
			echo $password_error;
			$password_errors++;
		}
		//Cheker Passwprd(pw) felterne om de er ens
		if ($ny_pw != $retype_pw){
			$password_error = "de 2 mail password's er ikke ens!";
			echo $password_error;
			$password_errors++;
		}
		//Hvis ingen errors udfør updaten
		if (! $password_errors)		
		{
			$pw = $_POST['ny_pw'];
			User_Update_Pw($conn, $userid, $pw);
		}
	}
			
?>

<section data-role="content" id="content"><!--start of content-->
	<!-- Skift email --> 
	<form action="#" method="post" name="update_profile">
		<input type="email" 	name="ny_email"  	placeholder="ny email" />
		<input type="email" 	name="ny_email2" 	placeholder="gentag email" />
		<input type="submit" 	name="skift_email" 	 value="Gem ny email" />
	</form> 

	<!-- Skift kodeord -->
	<form action="#" method="post" name="update_profile">
		<input type="password" 	name="ny_pw"  	placeholder="ny kodeord" />
		<input type="password" 	name="ny_pw2"  	placeholder="gentag email" />
		<input type="submit" 	name="skift_password" 	 value="Gem ny password" />
	</form> 
    
    <?php
	if(isset($_POST['logaf']))
	{
		 unset($_SESSION['USER']);
		 header('Location: login.php');
	}
	?>
    <form action="#" method="post"> 
    <input type="submit"  name="logaf" value="log af"></input>
    </form>
    
</section><!--end og content-->