<?php

function photostr($str){
  $table = array(" " => "_", "ï"=>"i",'ñ'=>'n',"'"=>"");
  return ucfirst(strtolower(strtr($str,$table)));
}

function descrstr($str){
    $table = array("!)"=>"!)","1."=>"1.","2."=>"2.","..."=>"...", "." => ".<br>","!!"=>"!!<br>","!!!"=>"!!<br>","!"=>"!<br>");
    return strtr($str,$table);
}
/*


FONCTIONS POUR LA HIERARCHIE

*/
function navbar_rec($array, $value,$i){
    if(!empty($array[$value]["sous-categorie"])){ // si la ss-categorie n'est pas vide
      echo '<li><span>'.$value.'</span>';
      echo '<ul class="sub_menu_'.$i.'">';
      $i++;
    foreach ($array[$value]['sous-categorie'] as $key => $value) {
      navbar_rec($array,$value,$i);
    }
    echo '</ul></li>';
  }
  else{
    echo '<li><a href="index.php?ingredients='. $value .'">'.$value .'</a></li>';
  }
}
function navbar($array,$root){
  ?>
      <nav>
        <ul class="nav">
          <li>
            <a href="index.php">Home</a>
          </li>
  <?php
      $i = 0;
      foreach ($array[$root]['sous-categorie'] as $key => $value) { // elt de la ss-categorie
        navbar_rec($array,$value,$i);
      }
      ?>
      <li class="connect_button"><?php connect_link()?></li>
      <li class="user_name"><span>Bonjour <?php echo "".(isset($_SESSION['user']) ? $_SESSION['user'] : "Anonymous");?></span></li>
        </ul>
      </nav>
<?php
}
?>
