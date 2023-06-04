<?php  

    require_once("/var/www/html/sistelect/controller/homeController.php");
    session_start();
    $obj = new homeController();
    $usuario = $obj->limpiarusuario($_POST['usuario']);
    $contraseña = $obj->limpiarcadena($_POST['contraseña']);
    $bandera = $obj->verificarusuario($usuario,$contraseña);

    if($bandera["keybd"]){
        $_SESSION['usuario'] = $usuario;
        if ($bandera["lugarpage"] === "TOLUCA") {
            header('Location:VotAleT.php');
        }elseif ($bandera["lugarpage"] === "ZINACANTEPEC") {
            if ($usuario == "zin01") {
                header('Location:VotAleZ.php');
            } elseif ($usuario == "zinaM") {
                header('Location:VotAleZM.php');
            } elseif ($usuario == "zinaJ") {
                header('Location:VotAleZJ.php');
            } elseif (($usuario == "zin02" || $usuario == "zin03")) {
                header('Location:VotAleZina.php');
            }            
        }
    }else{
        $error = "<li>Las claves son incorrectas</li>";
        header("Location:index.php?error=".$error);
    }
    
?>