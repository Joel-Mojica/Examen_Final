<?php

  session_start();

  $message = '';

  if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
  }
  require 'database.php';

  //preparativos para tomar id, etc
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email  = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    

    //Condicion para verificar usuario
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
       echo $_SESSION['user_id'] = $results['id'];
        header("Location: ../index.php");
      
    } else {
      $message = 'Lo sentimos su usuario/contraseña no coinciden';
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

    <form action="login.php" method="POST" class="form-signin container " style="width: 350px" >
    <br>
  <img class="mb-3" src="../assets/user_group.png" alt="" width="100" height="100"></img>
  <h1 class="h3 mb-3 font-weight-normal">Please Log in</h1>
  <?php echo $message; ?>
  <hr>
  <label for="email" class="sr-only">Email address</label>
  <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
  <br>
  <label for="password" class="sr-only">Password</label>
  <input type="password" name="password" class="form-control" placeholder="Password" required="">
  <div class="checkbox mb-3">
  <hr>
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
  <br>
  <a href="signup.php"><button class="btn btn-lg  btn-block btn-outline-primary" type="button"> Sing up</button></a>

 

</form>


<?php require '../headerYfooter/footer.php' ?>
</body>

</html>