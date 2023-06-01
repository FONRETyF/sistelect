<?php 
    
    if(!empty($_SESSION['usuario'])){
      //header("Location:inicio.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>   VOTALE  </title>
    <link rel="shortcut icon" href="img/elecciones.png">
    <link rel="stylesheet" type="text/css" href="css/Estilos.css">
    <link rel="stylesheet" type="text/css" href="css/Esltilos_Inic.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fae5672c64.js" crossorigin="anonymous"></script>
    
    <script src="libs/datatables/jquery-3.6.0.js"></script>
    <script src="libs/datatables/jquery-3.6.0.min.js"></script> 
    
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>  

    <link href="libs/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="libs/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <link href="libs/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="libs/datatables/select2.min.css" rel="stylesheet">

  </head>
<body> 
  <div id="SecLogin">
  <section >
    <article>
      <div class="contenedor">
        <div class="frame">
          <div ng-app ng-init="checked = false">
  				      <form class="inicses" action="verificar.php" method="POST" name="formulario" class="col-3 login" autocomplete="off">
                  <div class="datsentrad"> 
                    <label for="usuario">Usuario: </label>
                    <br>
                    <input class="inptIniSes" type="text" name="usuario" id="usuario" placeholder="Escriba su clave de usuario" required/>
                    <br>
                    <br>
                  </div>
                  <div class="datsentrad">
                    <label for="exampleInputPassword">Contraseña: </label>
                    <div class="box-eye">
                      <button type="button" onclick="mostrarContraseña('contraseña','eyepassword')">
                        <i id="eyepassword" class="fa-solid fa-eye changePassword fa-eye-slash"></i>
                      </button>
                      <input class="inptIniSes" type="password" name="contraseña" id="contraseña" placeholder="***" required/>
                    </div>
                    <?php if(!empty($_GET['error'])):?>
                      <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                        <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
                      </div>
                      <?php endif;?>
                  </div>
                  <div class="boton">
                    <button id="BtnIniSes" name="BtnIniSes" class="BtnIniSes">ENTRAR</button>
                  </div>
                  
  				      </form>
          </div>
        </div>
      </div>
    </article>
  </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="asset/main.js"></script>
    </body>
</html>

