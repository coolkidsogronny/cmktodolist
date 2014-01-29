<?php
if(! isset($_SESSION)){
	session_start();
}

//require_once($_SERVER['DOCUMENT_ROOT']."/php/mysqlconnection.php");
/*
retunerer en connection til vores databaseer der angivet som parameter, 
hvis der ikke angives en database laves connectionen til default databasen 
der hedder test som er preoprettet på xampp
*/

function MySqlIConnProceduralStyle($db=""){	
	$db=($db=="")? "test" : $db;
	$conn = mysqli_connect("mydb25.surftown.dk", "jesper8_jesper", "1a2b3c4d5e", $db );
	if (!$conn) {
		echo "Der opstod en fejl.".mysqli_error($conn);		
	}
	mysqli_set_charset($conn, "utf8");
	return $conn;
}


/*
dette er en general function der sletter række der har den id i den tabel, der kommer over som parameter 
*/
function Delete($conn, $id, $tbl){
	$sql = "DELETE FROM $tbl WHERE id = $id";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}

/*
dette er en general function der henter hele den række der er i den tabel, der kommer over som parameter 
*/
// login.php
function Read($conn, $id, $tbl){
	$sql = "select * from $tbl where id = $id";	
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));		
	$ar = mysqli_fetch_assoc($rs);	
	return $ar;
}

/*
læsser alle poster i den angivne tabel
*/
// inc_forside
function ReadAll($conn, $tbl){
	$ar=array();
	$sql = "SELECT * FROM $tbl";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));	
	while($arr = mysqli_fetch_assoc($rs) ){	
		$ar[]= $arr;
	}	
	return $ar;
}



/***************** User **************** */ 
/*
checker brugerens brugernavn/password, hvis brugernavn/password passer retuneres bruger id, ellers 0
functionen bruges til login
*/
// login.php
function User_CheckPassword($conn, $username, $pw){
	$id=0;
	// $pw = hash('sha256', $pass);	
	$sql = "select * from tbl_bruger where email = '$username' and kodeord = '$pw' ";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			
	if ($rs){
		$row = mysqli_fetch_assoc($rs);
		$id = $row['id'];		
	}
	if (strlen($id)==0) $id = 0; // 0 kan ikke forkomme i tabeller der er autonummereret		
	return $id;
}

/*
insetter en bruger i databasen
*/
// create_user.php
function User_Create($conn, $name, $Email, $Password){
	$sql ="INSERT INTO tbl_bruger (navn, email, kodeord) 	VALUES ('$name', '$Email', '$Password')";				 
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));   
}


/*
retunerer brugerens id hvis brugeren er oprettet, og ellers 0
*/
// glemt_pw.php
function User_IsCreated($conn, $email){
	$id=0;
	$sql = "select * from tbl_bruger where email = '$email'";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			
	if ($rs){
		$row = mysqli_fetch_assoc($rs);
		$id = $row['id'];		
	}
	if (strlen($id)==0) $id = 0; // 0 kan ikke forkomme i tabeller der er autonummereret		
	return $id;
}

/*
updaterer brugerens pw
*/
// glemt_pw.php, inc_user_change_pw.php
function User_Update_Pw($conn, $userid, $pw){
	$sql = "UPDATE tbl_bruger SET kodeord = '$pw' WHERE id = $userid";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}

/*
updaterer brugerens mail, skal bruges til ændring af mail
*/
function User_Update_Mail($conn, $userid, $email){
	$sql = "UPDATE tbl_bruger SET email = '$email' WHERE id = $userid";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}



/* **********  map_opgave_bruger *********** */



/* **************** opgaver **************** */ 
/*
henter alle opgaver der ikke er færdige
*/

function ReadMyOpenTaskInCategory($conn, $userid, $Categoryid){
$ar=array();
$sql = "SELECT tbl_opgave.*, tbl_map_opgave_bruger.*, tbl_map_opgave_kategori.*   
FROM tbl_opgave 
JOIN tbl_map_opgave_bruger 	ON tbl_opgave.id = tbl_map_opgave_bruger.opgave_id
JOIN tbl_map_opgave_kategori 	ON tbl_opgave.id = tbl_map_opgave_kategori.opgave_id
WHERE tbl_opgave.done = 0 AND tbl_map_opgave_bruger.bruger_id=$userid AND tbl_map_opgave_kategori.kategori_id = $Categoryid";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));	
	while($arr = mysqli_fetch_assoc($rs) ){	
		$ar[]= $arr;
	}	
	return $ar;
}


function ReadMyOpenTaskInCategory1($conn, $userid, $Categoryid){
$ar=array();
$sql = "SELECT tbl_opgave.*, tbl_map_opgave_bruger.*, tbl_map_opgave_kategori.*   
FROM tbl_opgave 
JOIN tbl_map_opgave_bruger 	ON tbl_opgave.id = tbl_map_opgave_bruger.opgave_id
JOIN tbl_map_opgave_kategori 	ON tbl_opgave.id = tbl_map_opgave_kategori.opgave_id
WHERE tbl_opgave.done = 1 AND tbl_map_opgave_bruger.bruger_id=$userid AND tbl_map_opgave_kategori.kategori_id = $Categoryid";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));	
	while($arr = mysqli_fetch_assoc($rs) ){	
		$ar[]= $arr;
	}	
	return $ar;
}





function Opgave_ReadAll($conn, $opgaver){
	$ar=array();
	$sql = "SELECT * FROM tbl_opgave WHERE id = '$opgaver'";
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));	
	while($arr = mysqli_fetch_assoc($rs) ){	
		
	}	
	return $ar;
}


/*
insetter en opgave i databasen
*/
function Opgave_Insert($conn, $name, $tekst, $start, $slut, $done=0){
	$sql ="INSERT INTO tbl_opgave (navn, done,  tekst, start, slut) VALUES ('$name', 'done', '$tekst', '$start', '$slut')";				 
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
	 return mysqli_insert_id ($conn); 
}

function Kategori_Create($conn, $kategori, $Opgave_id){
	$sql ="INSERT INTO tbl_map_opgave_kategori (kategori_id, opgave_id) VALUES ('$kategori', '$Opgave_id')";				 
	$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	return mysqli_insert_id ($conn);
}


function Opgave_kategori($conn)
{$ar=array(); 

$sql = "SELECT * FROM tbl_kategori";
                            $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                             while($arr = mysqli_fetch_assoc($rs)){
								 $ar[] = $arr;
							 }
                           return $ar;
}





/* 
jeg laver dette nummer for at kunne udvikle localt og ligge den op på min live server hos meebox, 
der prefixer alle databaser med sitename, så lokalt har jeg ikke prefix på min databaser, 
men får det hvis min server ip er forskellig fra localhost (::1 er ipv6 for 127.0.0.1 som man skriver i ipv4)
*/


$conn = MySqlIConnProceduralStyle("jesper8_todo_list");


/*****************************************************************************************/
/* andre frie functioner */

// glemt_pw.php
// http://www.eksperten.dk/spm/956600 #5
function RandPass($upper = 3, $lower = 3, $numeric = 3, $other = 2) {
    //we need these vars to create a password string
    $passOrder = Array();
    $passWord = '';

    //generate the contents of the password
    for ($i = 0; $i < $upper; $i++) {
        $passOrder[] = chr(rand(65, 90));
    }
    for ($i = 0; $i < $lower; $i++) {
        $passOrder[] = chr(rand(97, 122));
    }
    for ($i = 0; $i < $numeric; $i++) {
        $passOrder[] = chr(rand(48, 57));
    }
    for ($i = 0; $i < $other; $i++) {
        $passOrder[] = chr(rand(33, 47));
    }

    //randomize the order of characters
    shuffle($passOrder);

    //concatenate into a string
    foreach ($passOrder as $char) {
        $passWord .= $char;
    }

    //we're done
    return $passWord;
}
?>