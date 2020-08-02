<?php
require './login/database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
 
  header('location: ./login/login.php');

//Validacion para entrar al login
}else if(!isset($_GET['id'])){
   // header('location: index.php');
}else{
    $id = $_GET['id'];
    $records = $conn->prepare("SELECT * FROM publicaciones WHERE id = ?;");
    $records->execute([$id]);
    $resultsPublics = $records->fetch(PDO::FETCH_OBJ);
}

//Validamos formulario post para editar titulo y descripcion y fecha
if(!isset($_POST['titulo']) && !isset($_POST['descripcion'])){
   header('index.php');
}else{

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha = (date("Y")."/".date("m")."/".date("d")." ".date("h:i:sa"));


$records = $conn->prepare("UPDATE publicaciones SET titulo= ?, descripcion= ?, fecha = ? WHERE id= ?");
$results = $records->execute([$titulo,$descripcion,$fecha,$id]);

header('location: index.php');

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<?php require './headerYfooter/header.php' ?>
 

<body>  

<form action="editar.php?id=<?php echo $id ?>" method="post">

<div class="card mt-3 container" style="width: 900px">
          <div class="card-body">
            <p class="text-muted" style="text-align: right"><?php echo $resultsPublics->fecha ?></p>
           <h4 class="card-title"  style="margin-bottom: 1.75rem;">Titulo <br>
           <input type="text" name="titulo" style="width: 400px" value="<?php echo $resultsPublics->titulo ?>">
           </h4>
           <h4 class="card-subtitle mb-2 text-muted"> Descripcion
           <input class="container" type="text" name="descripcion" style="width: 800px" value="<?php echo $resultsPublics->descripcion ?>">
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