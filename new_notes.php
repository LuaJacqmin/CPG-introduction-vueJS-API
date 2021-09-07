<?php 
  // if page not empty
  if(isset($_GET['page'])):
    $route = $_GET['page'];
    $user = $_GET['user'];
 
    $addNote = "INSERT INTO $route SET ";
    $_POST = file_get_contents("php://input"); //utiliser le flux si json envoyé
    $_POST = json_decode($_POST);
    
    foreach($_POST as $col => $value):
      if($value != ''):
        $addNote .= 
          gettype($value) == "integer" ?
         "$col='".$value."', " :
         "$col='".addslashes($value)."', ";
      else:
        $addNote .= "$col= 'NULL',";
      endif;
    endforeach;

    $addNote .= sprintf("user_id = %d", $user);

    $test = $connect->query($addNote);
    echo $connect->error;
  
    $arrayDatas['message'] = "Nouvel element créé dans $route";
    $arrayDatas['id_'.$route] = $connect->insert_id;

    echo json_encode($arrayDatas);
    
    die();
  endif;
?>