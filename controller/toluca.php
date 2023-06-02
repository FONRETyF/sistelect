<?php
    session_start();
    require_once "/var/www/html/sistelect/model/Toluca.php";
    $infoTol = new Toluca();

    switch ($_GET["op"]) {
        case "listar":
            $a_get_infoToluca = $infoTol->get_infoTol();

            $a_infoToluca = Array();

            foreach($a_get_infoToluca as $row){
                $a_prep_infoTol = array();
                $a_prep_infoTol[] = $row["id"];
                $a_prep_infoTol[] = $row["nomcom"];
                if ($row["turnvoto"]=='1') {
                    $color1="green";
                    $color2="white";
                    $color3="white";
                    $color4="white";

                } elseif ($row["turnvoto"]=='2') {
                    $color1="white";
                    $color2="blue";
                    $color3="white";
                    $color4="white";
                } elseif ($row["turnvoto"]=='3') {
                    $color1="white";
                    $color2="white";
                    $color3="yellow";
                    $color4="white";
                }elseif ($row["turnvoto"]=='4') {
                    $color1="white";
                    $color2="white";
                    $color3="white";
                    $color4="red";
                }else {
                    $color1="grewhiteen";
                    $color2="white";
                    $color3="white";
                    $color4="white";
                }
              
                $a_prep_infoTol[] = $row["estatvoto"];
                $a_prep_infoTol[] = "<button type='button' onclick='updateT1(".$row['id'].");' id='".$row['id']."'class='BtVerde' style='background-color:".$color1."'><div></div></button>";
                $a_prep_infoTol[] = "<button type='button' onclick='updateT2(".$row['id'].");'  id='".$row['id']."'class='BtAzul' style='background-color:".$color2."'><div></div></button>";
                $a_prep_infoTol[] = "<button type='button' onclick='updateT3(".$row['id'].");'  id='".$row['id']."'class='BtAmarillo' style='background-color:".$color3."'><div></div></button>";
                $a_prep_infoTol[] = "<button type='button' onclick='updateT4(".$row['id'].");'  id='".$row['id']."'class='BtRojo' style='background-color:".$color4."'><div></div></button>";
                $a_prep_infoTol[] = "<button type='button' onclick='updateDelete(".$row['id'].");'  id='".$row['id']."'class='BtGoma'><div><img src='img/goma-de-borrar.png' alt='eliminar' title='eliminar' height='21' width='21'></div></button>";
                $a_infoToluca[] = $a_prep_infoTol;  
            }

            $a_result_infoTol = array(
                "sEcho"=> 1,
                "iTotalRecords"=>count($a_infoToluca),
                "iTotalDisplayRecords"=>count($a_infoToluca),
                "aaData"=>$a_infoToluca);
            echo json_encode($a_result_infoTol);
            break;
        case 'actualizarVoto':
            $a_get_actVoto = $infoTol->update_voto($_POST['idPersona'],$_POST['turno'],$_SESSION['usuario']);
            echo json_encode($a_get_actVoto, JSON_FORCE_OBJECT);
            break;

        case 'corregirVoto':
            $a_get_corregirVoto = $infoTol->corrige_voto($_POST['idPersona'],$_SESSION['usuario']);
            echo json_encode($a_get_corregirVoto, JSON_FORCE_OBJECT);
            break;       
        
    }

?>