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
  <link rel="stylesheet" href="css/listacontactos.css" type="text/css"> </head>

<body>
   <nav class="navbar navbar-expand-md bg-secondary navbar-light bg-secondary py-3">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarLightSupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarLightSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item mx-1">
            <a class="nav-link" href="buscarContacto.php">
              <i class="fa fa-search d-inline fa-2x"></i> buscar</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link" href="anadirContacto.php">
              <i class="fa d-inline fa-user-plus fa-2x"></i> añadir</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link" href="borrarContacto.php">
              <i class="fa d-inline fa-user-times fa-2x"></i> borrar</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link" href="editarContacto.php">
              <i class="fa d-inline fa-wrench fa-2x"></i> editar</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link" href="logout.php">
              <i class="fa d-inline fa-power-off fa-2x"></i> salir</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Tus contactos</h2>
          <hr class="mb-4"> 
        </div>
      </div>
        <?php
            $idUsuario = $_SESSION['id'];
            $mysqli = conexion::getConection();
            $sql = "SELECT idContacto FROM `usuarios-contactos` WHERE idUsuario = $idUsuario";
            $query = mysqli_query($mysqli,$sql);
            while($fila= mysqli_fetch_assoc($query)){
              $idContacto = $fila['idContacto'];
              /*A partir de aqui vamos a mostar los valores de cada campo*/
              $sqlContacto = "SELECT * FROM contactos WHERE idContacto = $idContacto";
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
              }/*foreach*/
            }/*while*/
        ?>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>