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
            header('Location:InTolVotAle.php');
        }elseif ($bandera["lugarpage"] === "ZINACANTEPEC") {
            header('Location:InZinVotAle.php');
        }
        //header('Location:InTol.php');
    }else{
        $error = "<li>Las claves son incorrectas</li>";
        header("Location:index.php?error=".$error);
    }
    
?>