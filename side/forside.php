
<script>

	
$(document).ready(function() {   
          
    $('#1').bind('swipeleft', function(){
		 $('bnt').append('<a href="#" data-role="button" data-icon="delete" id="bnt_slet">Delete</a>');
		 console.log('left');
	}); 
    
	
	
    $('#1').bind('swiperight', function(){
		  $("#bnt_slet").remove();
		console.log('right');
	 }); 
});
</script>
</head>



  <section data-role="content" id="content"><!--start of content--> 
    <ol data-role="listview" ><!--liste-->
      <?php              
        $ar = ReadAll($conn, "tbl_kategori");
        $str="";        
        for($i=0, $lng=count($ar); $i<$lng; $i++){          
          $arr = ReadMyOpenTaskInCategory($conn, $_SESSION['USER']['id'], $ar[$i]['id']);
          $lngk=count($arr);
          // visser kun kategorier der er noget i
          if($lngk>0){ 
              $str.='<li data-role="list-divider">'.$ar[$i]['navn'].'</li><!--overskrift i en anden fave-->';
              $str.="\n";
          }
          for($k=0; $k<$lngk; $k++){
            $str.='<li class="swipe"><a href="opgaver.php#article'.$arr[$k]['id'].'" rel="external">'.$arr[$k]['navn'].'</a></li>'; // id = opgave_id
            $str.="\n";
          }          
        }         
        echo $str;   
      ?>


      <li data-role="list-divider" >faste data kun tilo test</li><!--overskrift i en anden fave-->
