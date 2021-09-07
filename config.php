<?php
define('DB_HOST','localhost');
define('DB_USER', 'root');
define('DB_PASS','');
define('DB_NAME','my_notes');

define('MODE','dev'); // dev ou prod

define('ROOT', 'http://localhost/cpg-ex-2-API/');

$connect = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connect->connect_error) {
    echo 'Erreur de connexion à la base de données';
    exit;
}
else {
    $connect->set_charset("utf8");
}

session_start();
?>
