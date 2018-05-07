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
              <h3 class="mb-4 text-dark text-center">Añade tu contacto</h3>
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
          <div class="row w-100">
              <div class="p-3 col-md-6 col-lg-4">
                <img class="d-block mx-auto img-fluid py-2" src="img/empty_cart2.png">
              </div>
              <div class="col-md-6">
                  <div class="col-md-12 p-3">
                    <form  action="anadirContacto.php" method="post" enctype="multipart/form-data">
                        <div class="form-group" >
                          <label >Nombre</label>
                          <input type="text" class="form-control" name="nombre"required > </div>
                        <div class="form-group">
                          <label >Numero</label>
                          <input type="text" class="form-control" name="numero" required > </div>
                        <div class="form-group">
                          <label >Correo electronico </label>
                          <input type="text" class="form-control" name="email" required > </div>
                        <div class="form-group">
                          <label >Direccion</label>
                          <input type="text" class="form-control" name="direccion" required > </div>
                        <div class="form-group">
                          <label ></label>
                          <input type="file" name="fileToUpload" id="fileToUpload"  required> </div>
                          <br></br>
                        <button type="submit" name ="anadir"class="btn my-2 text-center btn-block btn-secondary"> Añadir </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		        <?php

              if(isset($_POST['anadir'])){

                $target_dir = "img/";
                $imageFileType = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                $idUsuario = $_SESSION['id'];
                $mysqli = conexion::getConection();
                $sql = "SELECT idContacto FROM `usuarios-contactos` WHERE idUsuario = $idUsuario";
                $query = mysqli_query($mysqli,$sql);
                $encontrado = false;

                while(!$encontrado and $fila= mysqli_fetch_assoc($query)){
                  $idContacto = $fila['idContacto'];
                  $sqlContacto = "SELECT numero FROM contactos WHERE idContacto = $idContacto and numero = ".$_POST['numero'];
                  $table = mysqli_query($mysqli,$sqlContacto);

                  if(empty($table)){
                    $encontrado = true;
                  }
                } /*end while*/

                if(!$encontrado){

                    $nombre = $_POST['nombre']; $direccion = $_POST['direccion']; $email = $_POST['email']; $numero = $_POST['numero'];                   
                    $sql= "INSERT INTO contactos (nombre,direccion,email,numero,imagen) values ('$nombre','$direccion','$email',$numero,'$imageFileType')";

                    $insetar = mysqli_query($mysqli,$sql);
                    if($insetar){
                      echo '<div class="row">
                              <div class="col-md-4"></div>
                              <div class="col-md-4">
                                <div class="col-md-12">
                                  <div class="card w-100 h-25 bg-secondary border-secondary">
                                    <h3 class="mb-4 text-dark text-center">Se ha añadido un nuevo contacto</h3>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4"></div>
                            </div>';
                    }
                     $sql2 = "SELECT idContacto FROM contactos WHERE numero = $numero ";
                     $query2 = mysqli_query($mysqli,$sql2);

                    foreach ($query2 as $key => $value) {
                      $sql = "INSERT INTO `usuarios-contactos` (idContacto, idUsuario) values (" . $value['idContacto'] . ",".$idUsuario.")";
                      $insetar = mysqli_query($mysqli,$sql);
                    }
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