<section data-role="content" id="content"><!--start of content--> 
   	<form action="#" method="post" id="check-user"  >
               <fieldset>
<?php
//rettes
require_once('php/functions.php');
$opgave_id = $_GET['idopg'];
$row = Read($conn, $opgave_id, "tbl_opgave");

echo "	 <label for='overskrift'></label>
<input type='text' value='" . $row['navn'] . "' name='overskrift' id='overskrift'/>
<label for='tekst'></label>
<textarea type='tekst' name='tekst' id='tekst'/>" . $row['tekst'] . "</textarea>
<label for='dato'></label>
<input type='datetime-local' value='" . $row['start'] . "' name='dato' id='dato'/>
<label for='dato1'></label>
<input type='datetime-local' value='" . $row['slut'] . "' name='dato1' id='dato1'/>";



?>


<fieldset data-role="controlgroup">
<label for='done'>opgave udf??rt:</label>
<input type="checkbox" name="done" id="done" class="custom" />
<label for="checkbox-1">done</label>
</fieldset>
                   <input type="submit" data-theme="b" name="update" id="update" value="update">
               </fieldset>
</form>                              

<?php
function Opgave_Update($conn, $opgave_id,$navn, $tekst, $start, $slut, $done=0){
$sql = "UPDATE tbl_opgave SET navn = '$navn', tekst='$tekst', start='$start', slut='$slut', done='$done' WHERE id = $opgave_id";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}



// Opdater opgaven
if(isset($_POST['update'])){
$opgave_navn  = $_POST['overskrift'];
$opgave_tekst = $_POST['tekst'];
$opgave_start = $_POST['dato'];
$opgave_slut  = $_POST['dato1'];
$done = isset($_POST['done']) ? 1:0;
Opgave_Update($conn, $opgave_id,$opgave_navn, $opgave_tekst, $opgave_start, $opgave_slut,$done);
}
?>
     

 </section><!--end og content-->
 
