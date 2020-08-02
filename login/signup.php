<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['nombreUsuario']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['foto'])) {
  
    $sql = "INSERT INTO usuarios (nombre, apellido, nombreUsuario, email, password, foto) VALUES (:nombre, :apellido, :nombreUsuario, :email, :password, :foto)";
    $stmt = $conn->prepare($sql);
 
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':nombreUsuario', $_POST['nombreUsuario']);
    $stmt->bindParam(':email', $_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    $stmt->bindParam(':foto', $_POST['foto']);

    

    if ($stmt->execute()) {
      $message = 'Usuario creado exitosamente.';
    } else {
      $message = 'Disculpe, su cuenta no ha sido creada. Intentelo de nuevo.';
      var_dump($stmt->execute());
      exit();
    }
  }
?>


<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>sing in</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  </head>

  <?php require '../headerYfooter/header.php' ?>
  

  <body class="text-center">

    <form action="signup.php" method="POST" class="form-signin container" style="width: 350px" >
    <br>
    <img class="mb-3" src="../assets/add_group.png" alt="" width="100" height="100"></img>
  <h1 class="h3 mb-3 font-weight-normal">Please Sign up</h1>or <a href="login.php">sing in</a> 
  <?php echo $message; ?>
  <hr>
  <label for="nombre" class="sr-only">Nombre</label>
  <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="" autofocus="">
  <br>
  <label for="apellido" class="sr-only">Apellido</label>
  <input type="text" name="apellido" class="form-control" placeholder="Apellido" required="" autofocus="">
  <br>
  <label for="nombreUsuario" class="sr-only">Nombre de Usuario</label>
  <input type="text" name="nombreUsuario" class="form-control" placeholder="Nombre de Usuario" required="" autofocus="">
  <br>
  <label for="email" class="sr-only">Email address</label>
  <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
  <br>
  <label for="password" class="sr-only">Password</label>
  <input type="password" name="password" class="form-control" placeholder="Password" required="">
  <div class="checkbox mb-3">
  <br>
  <label for="foto" class="sr-only">Foto de Perfil</label>
  <input type="file" name="foto" class="form-control" placeholder="Foto de Perfil" required="" autofocus="">
  <hr>
  
  </div>

  <button class="btn btn-lg  btn-block btn-outline-primary" type="submit"> Sing up</button>

  

</form>

<?php require '../headerYfooter/footer.php' ?>
</body>

</html>