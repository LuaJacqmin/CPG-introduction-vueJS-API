<?php 
  //if page
  if(isset($_GET['page'])):
    $route = $_GET['page'];
    $user = $_GET['user'];
    /* get one particular notes */
    if(isset($_GET['id'])):
      $id = $_GET['id'];
      $get_notes_by_id = sprintf(
        "SELECT * FROM $route WHERE id_notes='%s' AND user_id=%s",
        $id,
        $user
      );
      $req = $connect->query($get_notes_by_id);
      echo $connect->error;

    /* get notes by categories */
    elseif(isset($_GET['cat'])):
      $cat = $_GET['cat'];
      $get_notes_by_cat = sprintf(
        "SELECT * FROM $route WHERE categorie='%d' AND user_id=%s",
        addslashes($cat),
        $user
      );
      $req = $connect->query($get_notes_by_cat);
      echo $connect->error;

    /* get fave notes */
    elseif(isset($_GET['fav'])):
      $fav = $_GET['fav'];

      $get_notes_by_fav = sprintf(
        "SELECT * FROM $route WHERE favorite=%s AND user_id=%s",
        $fav,
        $user
      );
      $req = $connect->query($get_notes_by_fav);
      echo $connect->error;

    /* get all notes */
    else:
      $get_notes = "SELECT * FROM $route WHERE user_id=$user";
      $req = $connect->query($get_notes);
      echo $connect->error;
    endif;
     
    //if not empty response
    if($req->num_rows > 0):
      while($oneNote = $req->fetch_object()):
        $allNotes[] = $oneNote;
      endwhile;
    else:
      $allNotes["err"] = "Aucune note";
    endif;

    $arrayData = $allNotes;

    echo json_encode($arrayData);

    die();
  endif;
?>