<?php
require './login/database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
  header('location: ./login/login.php');
}

if(!isset($_GET['id'])){
    header('location: index.php');
}

$id = $_GET['id'];

$records = $conn->prepare("DELETE FROM publicaciones WHERE id = ?;");
$results = $records->execute([$id]);

if($results === true){
    header('location: index.php');
}else{
    echo "Ha ocurrido un error de insercion";
}


?>
