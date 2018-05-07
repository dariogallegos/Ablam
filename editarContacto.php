<?php
  include 'lib/conexion.php';
  if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/listacontactos.css">
</head>

<body>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="col-md-12">
            <div class="card w-100 h-25 bg-secondary border-secondary">
              <h3 class="mb-4 text-dark text-center">Editar contacto</h3>
              <form action="" method="post" class="text-dark">
                <div class="form-group w-100">
                  <input type="text" name = 'nombre'class="form-control" placeholder="Nombre"> </div>
                <div class="form-group">
                  <input type="text" name = 'numero'class="form-control" placeholder="Numero"> </div>
                <button type="submit" name ="editar" class="btn btn-primary my-2 text-center btn-block">editar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php
              if(isset($_POST['editar'])){
                $idUsuario = $_SESSION['id'];
                $mysqli = conexion::getConection();
                $sql = "SELECT idContacto FROM `usuarios-contactos` WHERE idUsuario = $idUsuario";
                $query = mysqli_query($mysqli,$sql);
                while($fila= mysqli_fetch_assoc($query)){
                  $idContacto = $fila['idContacto'];
                  
                  /*A partir de aqui vamos a mostar los valores de cada campo*/
                  if(!empty($_POST['nombre'])){
                    $nombre = $_POST['nombre'];
                    $sqlContacto = "SELECT * FROM contactos WHERE idContacto = $idContacto and nombre = '$nombre'";
                  }
                  else if(!empty($_POST['numero'])){
                    $numero = $_POST['numero'];
                    $sqlContacto = "SELECT * FROM contactos WHERE idContacto = $idContacto and numero = $numero";
                  }

                  if(!empty($_POST['numero']) or !empty($_POST['nombre'])){
                  $table = mysqli_query($mysqli,$sqlContacto);
                  /*estructura para mostar los datos*/
                  foreach ($table as $key => $value) {
                    $_SESSION['contacto'] = $value['idContacto'];
                    
                    echo'<div class="row w-100">';
                      echo'<div class="p-3 col-md-6 col-lg-4">';
                        echo'<div class="card bg-light py-3">';
                          echo'<img class="img-fluid rounded-circle w mx-auto mt-3" src='.$value['imagen'].' alt="Card image">';
                          echo'<div class="card-body">';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';
                      echo'<div class="col-md-6">';
                        echo '<div class="col-md-12 p-3">
                              <form  method="post" action="">
                                <div class="form-group" >
                                  <label >Nombre</label>
                                  <input type="text" class="form-control" name="nombreE" value="'.$value['nombre'].'" required > </div>
                                <div class="form-group">
                                  <label >Numero</label>
                                  <input type="text" class="form-control" name="numeroE" value="'.$value['numero'].'" required > </div>
                                <div class="form-group">
                                  <label >Correo electronico </label>
                                  <input type="text" class="form-control" name="emailE" value="'.$value['email'].'" required > </div>
                                <div class="form-group">
                                  <label >Direccion</label>
                                  <input type="text" class="form-control" name="direccionE" value="'.$value['direccion'].'" required > </div>
                                <button type="submit" name ="confirmar"class="btn my-2 text-center btn-block btn-secondary"> Confirmar </button>
                              </form>
                              </div>
                            </div>
                          </div>';/*end of form*/
                        echo'</div>';
                      echo'</div>';
                    echo'</div>';
                    }/*end if*/
                  }/*end foreach*/
                } /*end while*/
              }/*end if*/
            ?>

            <?php
              if(isset($_POST['confirmar'])){
                  $nombreE = $_POST['nombreE'];
                  $numeroE = $_POST['numeroE'];
                  $emailE = $_POST['emailE'];
                  $direccionE = $_POST['direccionE'];
                  $idContactoE= $_SESSION['contacto'];
                  $mysqli = conexion::getConection();
                  $sql = "UPDATE  contactos SET nombre='$nombreE', numero = $numeroE, email ='$emailE', direccion ='$direccionE' WHERE idContacto = $idContactoE";
                  $query = mysqli_query($mysqli,$sql);

                  if($query){
                    echo '<div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <div class="col-md-12">
                                <h2 class="text-center" contenteditable="true">Se ha editado correctamente</h2>
                              </div>
                            </div>
                            <div class="col-md-4"></div>
                          </div>';
                    /*header( "Refresh:2; url=listaContactos.php", true, 303);*/
                  }
              }
            ?>


        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <a class="btn btn-block btn-lg m-0 btn-link" href="listaContactos.php">Volver a la lista de usuarios </a>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row"></div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>