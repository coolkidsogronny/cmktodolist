  <?php
    require_once("php/inc_header_menu.php");
  ?>  
  
 <section data-role="content" id="content"><!--start of content--> <div id="swipe" class="swipe"></div>
    <ol data-role="listview"><!--liste-->
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
            $str.='<li class="swipe"><a href="#">'.$arr[$k]['navn'].'</a></li>';
            $str.="\n";
          }          
        }         
        echo $str;   
      ?>

      <li data-role="list-divider">Tidsplan</li><!--overskrift i en anden fave-->
        <!-- <div class="swipe"><li><a href="#">a</a></li></div> -->
      <li class="swipe"><a href="#">b</a></li>
      <li class="swipe"><a href="#">c</a></li>
        <li data-role="list-divider">Aflevering</li><!--overskrift i en anden fave-->
      <li class="swipe"><a href="#">a</a></li>
      <li class="swipe"><a href="#">b</a></li>
      <li class="swipe"><a href="#">c</a></li>
        <li data-role="list-divider">Logbog</li><!--overskrift i en anden fave-->
       <li class="swipe"><a href="#">a</a></li>
      <li class="swipe"><a href="#">b</a></li>
      <li class="swipe"><a href="#">c</a></li> 
    </ol><!--slut liste-->
  </section><!--end og content-->

<section data-role="footer" data-position="fixed" class="ui-bar"><!--footer er fixed til bunden-->  
<a href="#panel"  data-role="button"  data-icon="plus" class="left" data-inline="true">Tilføj</a>
<a href="#panel"  data-role="button"  data-icon="user" class="right" data-inline="true" data-iconpos="right">Profil</a>
<a href="index.php?page=user_change_pw"  data-role="button"  data-icon="eye" class="right" data-inline="true">skift kodeord</a>
</section><!--end of footer-->
