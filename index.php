<?php 
  require("config.php"); //connect to db
  include("headers.php"); //headers

  /* Variables */

  /* POST ELEMENT */
  if($_SERVER['REQUEST_METHOD'] == 'POST'):
    if(isset($_GET['page'])):
      include("new_notes.php");
    else: 
      include("auth.php");
    endif;
  endif;

  if($_SERVER['REQUEST_METHOD'] == 'PUT'):
    if(isset($_GET['page'])):
      include("update_note.php");
    else: 
      echo "impossible to update";
    endif;
  endif;

  /* GET ELEMENT */
  if($_SERVER['REQUEST_METHOD'] == 'GET'):
    if(isset($_GET['page'])):
      include("get_notes.php");
    else:
      echo "No notes available";
    endif;
  endif;

?>