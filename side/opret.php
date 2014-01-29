<?php
  if(isset($_POST['opret']))
  {
	  $name			=		$_POST['overskrift'];
	  $tekst		=		$_POST['tekst'];
	  $start		=		$_POST['start'];
	  $slut			=		$_POST['slut'];
	  $kategori		=		$_POST['kategori'];
	  


   if(!$name ) {
      echo "<p class=error_text>"."Du skal indtaste dit overskrift</p>";
  				}  
  elseif(empty($tekst))
      {
          $fejlbesked = "<p class=error_text>Du skal indtaste en tekst</p><br />";
          echo $fejlbesked;
      }
      elseif(empty($start))
      {
          $fejlbesked = "<p class=error_text>Du skal indtaste en start dato</p><br />";
          echo $fejlbesked;
      }
    else{ 
       $Opgave_id = Opgave_Insert($conn, $name, $tekst, $start, $slut);
	   
	}
	{
		
	Kategori_Create($conn, $kategori, $Opgave_id);
	}
  }
  ?>
  <section data-role="content" id="content"><!--start of content--> 
    <form action="#" method="post">
                <fieldset>
                   
                        <label for="overskrift"></label>
                        <input type="text" value="" name="overskrift" id="overskrift" placeholder="overskrift:"/>
                                                  
                                                        
                        <label for="tekst"></label>
                        <textarea type="tekst" value="" name="tekst" id="tekst" placeholder="skiv noget"/></textarea>
                        
                        <label for="start"></label>
                        <input type="datetime-local" value="" name="start" id="start" placeholder="start dato"/>
                        
                        <label for="slut"></label>
                        <input type="datetime-local" value="" name="slut" id="slut" placeholder="slut dato"/>
                     
                            <select name="kategori">
                            <option value="1">Vælg kategori...</option>
         <?php				
		 					 $arr = Opgave_kategori($conn);
                             for($i=0, $lng=count($arr); $i<$lng;$i++){  
							   echo "<option value='" . $arr[$i]['id'] . "' >" . $arr[$i]['navn'] . "</option>";
							 }
                            ?>
                        </select>
                  
                    <input type="submit" data-theme="b" name="opret" id="opret" value="opret">
                </fieldset>
            </form>                              
      
 
  </section><!--end og content-->
  



