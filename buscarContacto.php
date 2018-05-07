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
              <h3 class="mb-4 text-dark text-center">Introduce tu contacto</h3>
              <form action="" method="post" class="text-dark">
                <div class="form-group w-100">
                  <input type="text" name = 'nombre'class="form-control" placeholder="Nombre"> </div>
                <div class="form-group">
                  <input type="text" name = 'numero'class="form-control" placeholder="Numero"> </div>
                <button type="submit" name ="buscar" class="btn btn-primary my-2 text-center btn-block">buscar</button>
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
              if(isset($_POST['buscar'])){
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
                    
                    echo'<div class="row w-100">';
                      echo'<div class="p-2 col-md-2 col-lg-4">';
                        echo'<div class="card bg-light">';
                          echo'<img class="img-fluid rounded-circle w mx-auto mt-3" src='.$value['imagen'].' alt="Card image">';
                          echo'<div class="card-body">';
                            echo'<h5 class="card-title text-center">'.$value['nombre'].'</h5>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';
                      echo'<div class="col-md-6">';
                        echo'<div class="col-md-12 p-3">';
                          echo'<div class="card border-secondary">';
                            echo'<li class="list-group-item">';
                              echo'<i class="fa fa-fw fa-phone fa-lg"></i> Telefono </li>';
                               echo'<p class="card-text px-3">'.$value['numero'].'</p>';
                              echo'<li class="list-group-item">';
                              echo'<i class="fa fa-fw fa-at fa-lg"></i>Email </li>';
                                echo'<p class="card-text px-3">'.$value['email'].'</p>';
                              echo'<li class="list-group-item text-left">';
                              echo'<i class="fa fa-fw fa-address-book-o fa-lg"></i> Direccion </li>';
                                echo'<p class="card-text px-3">'.$value['direccion'].'<br></p>';
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';
                    echo'</div>';
                    }/*end if*/
                  }/*end foreach*/
                } /*end while*/
              }/*end if*/
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