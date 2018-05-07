<?php
include 'lib/conexion.php';

ini_set('error_reporting',0); //para que no reporte cuando existan variables vacias
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/newaquamarine.css" type="text/css"> </head>

<body>
  <div class="p-3"></div>
  <div class="py-4">
    <div class="container">
      <div class="row"> </div>
      <div class="row">
        <div class="col-12 col-md-6">
          <img class="img-fluid d-block float-right" src="img/iphoneSF2.png"> </div>
        <div class="col-md-6">
          <div class="col-md-12 p-3">
            <h1 class="text-right mx-5">
              <b>Ab</b>lam</h1>
            <p class="lead text-center">Registrate para ver, buscar y guardar contactos.</p>
            <hr>
            <form class="" method="post" action="">
              <div class="form-group bg-light">
                <input type="text" class="form-control bg-info" id="disabledTextInput" name="usuario" placeholder="Nombre de usuario" value="<?php echo $_POST['usuario']; ?>" required> </div>
              <div class="form-group">
                <input type="text" class="form-control bg-info" id="disabledTextInput" name="nombre" placeholder="Nombre completo" value="<?php echo $_POST['nombre']; ?>" required> </div>
              <div class="form-group">
                <input type="text" class="form-control bg-info" id="disabledTextInput" name="email" placeholder="Correo electrónico"> </div>
              <div class="form-group">
                <input type="text" class="form-control bg-info" id="disabledTextInput" name="pass" placeholder="Contraseña"> </div>
              <div class="form-group">
                <input type="text" class="form-control bg-info" id="disabledTextInput" name="repass" placeholder="Confirmar contraseña"> </div>
              <button type="submit" class="btn btn-block btn-outline-primary" name= "registrar">Registrate</button>
            </form>

            <?php
                if(isset($_POST['registrar'])) { 

                  $mysqli = conexion::getConection();
                  $nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
                  $email = mysqli_real_escape_string($mysqli,$_POST['email']);
                  $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
                  $pass = mysqli_real_escape_string($mysqli,$_POST['pass']);
                  $repass = mysqli_real_escape_string($mysqli,$_POST['repass']);

                  $sqlUsuario ="SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
                  $sqlEmail = "SELECT email FROM usuarios WHERE email = '$email'";

                  $cntUsuario = mysqli_num_rows(mysqli_query($mysqli,$sqlUsuario));
                  $cntEmail = mysqli_num_rows(mysqli_query($mysqli,$sqlEmail));

                  if($cntUsuario >= 1){
                    echo "<p> El nombre de usuario esta en uso </p>";
                  }else{
                    if($cntEmail>= 1){
                        echo "<p> El email esta en uso </p>";
                    }else{
                      if($pass !=$repass){
                            echo "<p> Las contraseñas son distintas </p>";
                      }else{
                        $sql= "INSERT INTO usuarios (nombre,email,usuario,pass,fecha_reg) values ('$nombre','$email','$usuario','$pass',now())";
                        $insetar = mysqli_query($mysqli,$sql);
                        if($insetar){
                            echo "<p> Felicidades se ha registrado correctamente <p>";
                            header("Refresh:2; url=listaContactos.php", true, 303); //redireccion del php a index.php
                        }
                      }
                    }
                  }
                }  
            ?>
             <a href="login.php" class="text-center">Tengo actualmente una cuenta</a>
            <div class="col-12 col-md-12"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </pingendo>
</body>

</html>