<?php 
  $route = $_GET['page'];
  $put = file_get_contents("php://input"); //utiliser le flux si json envoyé
  $put = json_decode($put);

  $updateEl = "UPDATE $route SET ";
  $i = 1;

  foreach($put as $col => $value):
    if($i < count((array)$put)) :
      if($value != ''):
        $updateEl .= 
          gettype($value) == "integer" ?
         "$col='".$value."', " :
         "$col='".addslashes($value)."', ";
      else:
        $updateEl .= "$col= 'NULL',";
      endif;
    else :
      if($value != ''):
        $updateEl .= 
          gettype($value) == "integer" ?
         "$col='".$value."', " :
         "$col='".addslashes($value)."', ";
      else:
        $updateEl .= "$col= 'NULL'";
      endif;
    endif;
    $arrayDatas[]['message'] = "Update de $col dans $route. Nouvelle donnée = $value";

    $i++;
  endforeach;
  
  $updateEl .= " WHERE id_notes = ".$put->id_notes;
  $connect->query($updateEl);
  echo $connect->error;

  echo json_encode($arrayDatas);

  die();
?>