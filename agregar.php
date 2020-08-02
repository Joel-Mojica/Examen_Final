<?php
require './login/database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
 
  header('location: ./login/login.php');
}

//Validamos formulario post para cambiar titulo y descripcion
if(!isset($_POST['titulo']) && !isset($_POST['descripcion'])){
    header('index.php');
}else{

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$date = (date("Y")."/".date("m")."/".date("d")." ".date("h:i:sa"));

$records = $conn->prepare("INSERT INTO publicaciones(titulo,descripcion,fecha) VALUES (?,?,?)");
$results = $records->execute([$titulo,$descripcion,$date]);

if($results === true){
    header('location: index.php');
}else{
    echo "Ha ocurrido un error de insercion";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<?php require './headerYfooter/header.php' ?>
 

<body>

<form action="agregar.php" method="post">

<div class="card mt-3 container" style="width: 900px">
          <div class="card-body">
            <p class="text-muted" style="text-align: right"><?php echo date("d")."/".date("m")."/".date("Y")." ".date("h:i:sa") ?></p>
           <h4 class="card-title" style="margin-bottom: 1.75rem;">Titulo <br>
           <input type="text" name="titulo" style="width: 400px">
           </h4>
           <h4 class="card-subtitle mb-2 text-muted"> Descripcion <br>
           <input type="text" name="descripcion" style="width: 800px" class="container">
           </h4>
           <hr>
           <br>
           <input type="submit" class="btn btn-lg  btn-block btn-primary"></input> <br>
           <a href="index.php" class="btn btn-lg  btn-block btn-outline-danger borrar ">Cancelar</a>
         </div>
    </div>

    </form>
 <?php require './headerYfooter/footer.php' ?>
</body>
</html>