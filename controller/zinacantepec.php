<?php
    session_start();
    require_once "/var/www/html/sistelect/model/Zinacantepec.php";
    $infoZin = new Zinacantepec();

    if ($_SESSION["usuario"] <> '') {
        switch ($_GET["op"]) {
            case "listar":
                $a_get_infoZina = $infoZin->get_infoZin($_SESSION["usuario"]);
                $a_infoZina = Array();
                foreach($a_get_infoZina as $row){
                    $a_prep_infoZin = array();
                    $a_prep_infoZin[] = $row["id"];
                    $a_prep_infoZin[] = $row["nomcom"];
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
                    $a_prep_infoZin[] = $row["estatvoto"];
                    $a_prep_infoZin[] = "<button type='button' onclick='updateT1(".$row['id'].");' id='".$row['id']."'class='BtVerde' style='background-color:".$color1."'><div></div></button>";
                    $a_prep_infoZin[] = "<button type='button' onclick='updateT2(".$row['id'].");'  id='".$row['id']."'class='BtAzul' style='background-color:".$color2."'><div></div></button>";
                    $a_prep_infoZin[] = "<button type='button' onclick='updateT3(".$row['id'].");'  id='".$row['id']."'class='BtAmarillo' style='background-color:".$color3."'><div></div></button>";
                    $a_prep_infoZin[] = "<button type='button' onclick='updateT4(".$row['id'].");'  id='".$row['id']."'class='BtRojo' style='background-color:".$color4."'><div></div></button>";
                    $a_prep_infoZin[] = "<button type='button' onclick='updateDelete(".$row['id'].");'  id='".$row['id']."'class='BtGoma'><div><img src='img/goma-de-borrar.png' alt='eliminar' title='eliminar' height='21' width='21'></div></button>";
                    $a_infoZina[] = $a_prep_infoZin;  
                }
    
                $a_result_infoZin = array(
                    "sEcho"=> 1,
                    "iTotalRecords"=>count($a_infoZina),
                    "iTotalDisplayRecords"=>count($a_infoZina),
                    "aaData"=>$a_infoZina);
                echo json_encode($a_result_infoZin);
                break;

            case 'listarM':
                $a_get_infoZinaM = $infoZin->get_infoZin($_SESSION["usuario"]);
                $a_infoZinaM = Array();
                foreach($a_get_infoZinaM as $row){
                    $a_prep_infoZinM = array();
                    $a_prep_infoZinM[] = $row["id"];
                    $a_prep_infoZinM[] = $row["nomcom"];
                    $a_prep_infoZinM[] = $row["cveelector"];
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
                    $a_prep_infoZinM[] = $row["estatvoto"];
                    $a_prep_infoZinM[] = "<button type='button' onclick='updateT1(".$row['id'].");' id='".$row['id']."'class='BtVerde' style='background-color:".$color1."'><div></div></button>";
                    $a_prep_infoZinM[] = "<button type='button' onclick='updateT2(".$row['id'].");'  id='".$row['id']."'class='BtAzul' style='background-color:".$color2."'><div></div></button>";
                    $a_prep_infoZinM[] = "<button type='button' onclick='updateT3(".$row['id'].");'  id='".$row['id']."'class='BtAmarillo' style='background-color:".$color3."'><div></div></button>";
                    $a_prep_infoZinM[] = "<button type='button' onclick='updateT4(".$row['id'].");'  id='".$row['id']."'class='BtRojo' style='background-color:".$color4."'><div></div></button>";
                    $a_prep_infoZinM[] = "<button type='button' onclick='updateDelete(".$row['id'].");'  id='".$row['id']."'class='BtGoma'><div><img src='img/goma-de-borrar.png' alt='eliminar' title='eliminar' height='21' width='21'></div></button>";
                    $a_infoZinaM[] = $a_prep_infoZinM;  
                }
    
                $a_result_infoZinM = array(
                    "sEcho"=> 1,
                    "iTotalRecords"=>count($a_infoZinaM),
                    "iTotalDisplayRecords"=>count($a_infoZinaM),
                    "aaData"=>$a_infoZinaM);
                echo json_encode($a_result_infoZinM);
                break;

                case 'listarJ':
                    $a_get_infoZinaJ = $infoZin->get_infoZin($_SESSION["usuario"]);
                    $a_infoZinaJ = Array();
                    foreach($a_get_infoZinaJ as $row){
                        $a_prep_infoZinJ = array();
                        $a_prep_infoZinJ[] = $row["id"];
                        $a_prep_infoZinJ[] = $row["nomcom"];
                        $a_prep_infoZinJ[] = $row["cveelector"];
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
                        $a_prep_infoZinJ[] = $row["estatvoto"];
                        $a_prep_infoZinJ[] = "<button type='button' onclick='updateT1(".$row['id'].");' id='".$row['id']."'class='BtVerde' style='background-color:".$color1."'><div></div></button>";
                        $a_prep_infoZinJ[] = "<button type='button' onclick='updateT2(".$row['id'].");'  id='".$row['id']."'class='BtAzul' style='background-color:".$color2."'><div></div></button>";
                        $a_prep_infoZinJ[] = "<button type='button' onclick='updateT3(".$row['id'].");'  id='".$row['id']."'class='BtAmarillo' style='background-color:".$color3."'><div></div></button>";
                        $a_prep_infoZinJ[] = "<button type='button' onclick='updateT4(".$row['id'].");'  id='".$row['id']."'class='BtRojo' style='background-color:".$color4."'><div></div></button>";
                        $a_prep_infoZinJ[] = "<button type='button' onclick='updateDelete(".$row['id'].");'  id='".$row['id']."'class='BtGoma'><div><img src='img/goma-de-borrar.png' alt='eliminar' title='eliminar' height='21' width='21'></div></button>";
                        $a_infoZinaJ[] = $a_prep_infoZinJ;  
                    }
        
                    $a_result_infoZinJ = array(
                        "sEcho"=> 1,
                        "iTotalRecords"=>count($a_infoZinaJ),
                        "iTotalDisplayRecords"=>count($a_infoZinaJ),
                        "aaData"=>$a_infoZinaJ);
                    echo json_encode($a_result_infoZinJ);
                    break;

            case 'actualizarVoto':
                $a_get_actVoto = $infoZin->update_voto($_POST['idPersona'],$_POST['turno'],$_SESSION['usuario']);
                echo json_encode($a_get_actVoto, JSON_FORCE_OBJECT);
                break;
                
            case 'actualizarVotoM':
                $a_get_actVotoM = $infoZin->update_votoM($_POST['idPersona'],$_POST['turno'],$_SESSION['usuario']);
                echo json_encode($a_get_actVotoM, JSON_FORCE_OBJECT);
                break;
            
            case 'actualizarVotoJ':
                $a_get_actVotoJ = $infoZin->update_votoJ($_POST['idPersona'],$_POST['turno'],$_SESSION['usuario']);
                echo json_encode($a_get_actVotoJ, JSON_FORCE_OBJECT);
                break;

            case 'corregirVoto':
                $a_get_corregirVoto = $infoZin->corrige_voto($_POST['idPersona'],$_SESSION['usuario']);
                echo json_encode($a_get_corregirVoto, JSON_FORCE_OBJECT);
                break; 

            case 'corregirVotoM':
                $a_get_corregirVotoM = $infoZin->corrige_votoM($_POST['idPersona'],$_SESSION['usuario']);
                echo json_encode($a_get_corregirVotoM, JSON_FORCE_OBJECT);
                break;   
            
            case 'corregirVotoJ':
                $a_get_corregirVotoJ = $infoZin->corrige_votoJ($_POST['idPersona'],$_SESSION['usuario']);
                echo json_encode($a_get_corregirVotoJ, JSON_FORCE_OBJECT);
                break;
        }
    }
    

?>