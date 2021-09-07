<?php
require("config.php");
include("headers.php");
$_POST = file_get_contents("php://input"); //utiliser le flux si json envoyé
$_POST = json_decode($_POST);

if(isset($_POST->identifiant)):
    $sql = sprintf("SELECT * FROM users WHERE (pseudo = '%s' OR email = '%s')  AND password = '%s'",
            addslashes($_POST->identifiant),
            addslashes($_POST->identifiant),
            addslashes($_POST->password)
        );
    $rq = $connect->query($sql);
    echo $connect->error;

    if($rq->num_rows > 0):
        $userInfo = $rq->fetch_object();
        $userInfos = $userInfo->user_id;
    else:
    //erreur de login
        $userInfos['error'] = "erreur de login/password";
    endif;
    echo json_encode($userInfos);
    die();
endif;

?>