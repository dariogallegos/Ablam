<?php
  include 'lib/conexion.php';

  if(isset($_SESSION['usuario'])){
    header("Location: listaContactos.php");
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Styleguide</title>
  <meta name="author" content="Pingendo">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/aquamarine.css">
</head>

<body>
  <div class="bg-primary p-3">
    <div class="container">
      <div class="row"> </div>
    </div>
  </div>
  <div class="bg-primary p-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card p-5 w-100 bg-primary">
            <div class="card-body">
              <h1 class="mb-4 text-dark text-center" contenteditable="true"> Bienvenido a
                <b>Ab</b>lam</h1>
              <form  method="post" action="" class="text-dark">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="usuario"> </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="pass"> </div>
                <button type="submit" name="login" class="btn btn-primary my-2 text-center btn-block">Login</button>
              </form>
            </div>
            <a class="btn btn-link m-2" href="#">¿Olvidaste tu contraseña?</a>
          </div>
        </div>
        <div class="col-md-6 bg-light border">
          <div class="col-12 col-md-12">
            <div class="col-md-12">
              <img class="d-block mx-auto img-fluid py-2" src="img/login_happy2.png">
              <p class="lead text-center">
                <b>¿No te has registrado todavía?</b>
              </p>
              <p class="text-center px-5">No te preocupes. ¡Eres más que bienvenido/a!</p>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3 offset-md-1">
                  <a class="btn btn-dark m-0" href="./registro.php">
                    <b>CREAR UNA CUENTA</b>
                    <br> </a>
                </div>
                <div class="col-md-4 offset-md-2"></div>
              </div>
            </div>
          </div>
        </div>
		
		<?php

          if(isset($_POST['login'])){
            $mysqli = conexion::getConection();

            $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
            $pass = mysqli_real_escape_string($mysqli,$_POST['pass']);
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass = '$pass'";
            $query = mysqli_query($mysqli,$sql);
            $cnt = mysqli_num_rows($query);
  
            if($cnt == 1) {
              while($row = mysqli_fetch_array($query)){
                if($usuario = $row['usuario'] && $pass = $row['pass']){
                  $_SESSION['usuario'] = $row['usuario'];
                  $_SESSION['id'] = $row['idusuario'];
                  header('Location: listaContactos.php'); //redireccion del php a index.php
                }
              }
            }else { 
              echo '<div class="card-body">';
              echo '<h4 class="mb-4 text-dark text-center" contenteditable="true"> Los datos introducidos no son correctos</h4>';
              echo '</div>';
            }
          }
		?>
      </div>
    </div>
  </div>
  <div class="bg-primary p-3">
    <div class="container">
      <div class="row"> </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container"></div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
  </div>
  <script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>

</html>