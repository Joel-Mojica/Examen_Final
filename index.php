<?php
  require './login/database.php';

  session_start();

  if (!isset($_SESSION['user_id'])) {
   
    header('location: ./login/login.php');

  //Validacion para entrar al login
  }else if(isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    //si es mayor a 1 user sera el resultado de la cadena mas abajo lo llamo de nuevo para validar que si esta lleno me muestre que entre con exito
    if (count($results) > 0) {
      $user = $results;
    }
    //Muestro el contenido de mi tabla publicacioes
    $records = $conn->query('SELECT * from publicaciones');
    $records->execute();
    $resultsPublics = $records->fetchAll(PDO::FETCH_ASSOC);

  }else{
    echo "Error en el systema";
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>

  <?php require './headerYfooter/header.php' ?>

  <body>

    <?php if(!empty($user)): ?>
    <br>
      <div class="text-center">

      <span style="text-align: center;"><img class="mb-3" src="./assets/welcome.png" alt="" width="100" height="100"></img></span>

      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
      <a href="./login/logout.php">Logout</a>
      </div>
      
      <?php if(empty($results)): ?>
        <div class="card mt-3 container" style="width: 900px">
                <h1 >No Tiene ningun Registro</h1>
                <a href="agregar.php"><button class="btn btn-success ml-3 mt-2">Pulse aqui para publicar</button></a>
         </div>     
      <?php else: ?>
      <br>
        <a href="agregar.php"><button class="btn btn-success  mt-2 container text-center" style="margin-left: 5rem!important;">Pulse aqui para publicar</button></a>

      <?php foreach($resultsPublics as $filas): ?>

    <div class="card mt-3 container" style="width: 900px">
          <div class="card-body">
            <p class="text-muted" style="text-align: right"><?php echo $filas['fecha']; ?></p>
           <h4 class="card-title"><?php echo $filas['titulo']; ?></h4>
           <h4 class="card-subtitle mb-2 text-muted"><?php echo $filas['descripcion']; ?></h4>
           <hr>
           <br>
           <a href="editar.php?id=<?php echo $filas['id'] ?>" class="btn btn-primary">Editar</a>
           <a href="borrar.php?id=<?php echo $filas['id']; ?>" class="btn btn-outline-danger borrar ">Borrar</a>
         </div>
    </div>
    <br>

      <?php endforeach; ?> 

        <?php endif; ?>


    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="./login/login.php">Login</a> or
      <a href="./login/signup.php">SignUp</a>
    
    <?php endif; ?>

    

  </body>
  <?php require './headerYfooter/footer.php' ?>
</html>
