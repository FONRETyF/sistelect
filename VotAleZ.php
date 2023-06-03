<?php
    session_start();
    
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
    <header>
    
    </header>

    <section class="contenidoGral">
        <form class="FormcontenidoGral" action="" method="POST" name="" id="form_toluca">
            <section class="sectNavegador">
                <div class="DivBotnsNav">
                    <div id="DivFechaActual">
                        <?php date_default_timezone_set('America/Mexico_City'); echo("Toluca, México a  " .date("d-m-y"));?>
                    </div>
                    <div>
                        <div><a href="logout.php">Cerrar Sesion</a></div>
                    </div>
                </div>
            </section>
            <section id="secInfoTol">
                <div id="divGeneraArchivo">
                    <div id="divRadsBtnsTurnos">
                        <div class="divsRadBtns"><input type="radio" id="RadBtnTurno1" class="RadBtnsOptions" name="RdBtnsTurns" value="T1" checked><label for="RadBtnTurno1">Reporte 1</label></div>
                        <div class="divsRadBtns"><input type="radio" id="RadBtnTurno2" class="RadBtnsOptions" name="RdBtnsTurns" value="T2"><label for="RadBtnTurno2">Reporte 2</label></div>
                        <div class="divsRadBtns"><input type="radio" id="RadBtnTurno3" class="RadBtnsOptions" name="RdBtnsTurns" value="T3"><label for="RadBtnTurno3">Reporte 3</label></div>
                        <div class="divsRadBtns"><input type="radio" id="RadBtnTurno4" class="RadBtnsOptions" name="RdBtnsTurns" value="T4"><label for="RadBtnTurno4">Reporte 4</label></div>
                    </div>
                    </div>
                    <div>
                    <a id="Reporte" name="Reporte" href="#"><img src="img/xls.png" alt="Reporte" title="Reporte" height="35" width="35"></a> 
                    </div>
                </div>
                <div id="ResultConsult">
                    <table id ="zina_data" class="table display responsive nowrap">
                        <thead class="tab_zina">
                            <tr>
                                <th class="wd-15p"> Num </th>
                                <th class="wd-15p"> Nombre </th>
                                <th class="wd-15p"> Voto </th>
                                <th class="wd-15p">Reporte 1</th>
                                <th class="wd-15p">Reporte 2</th>
                                <th class="wd-15p">Reporte 3</th>
                                <th class="wd-15p">Reporte 4</th>
                                <th class="wd-15p">Corregir</th>
                            </tr>
                        </thead>
                        <tbody id="tbodToluca" class="tbodToluca">
                        </tbody>
                    </table>
                </div>
            </section>
        </form>
    </section>

<script src="libs/datatables/jquery-3.6.0.js"></script>
<script src="libs/datatables/jquery-3.6.0.min.js"></script>  

<script src="libs/datatables/moment.js"></script> 
<script src="libs/datatables/jquery-ui.js"></script>
<script src="libs/datatables/jquery.peity.js"></script>
<script src="libs/datatables/jquery.dataTables.js"></script>
<script src="libs/datatables/jquery.dataTables.min.js"></script>


<script src="libs/datatables-responsive/dataTables.responsive.js"></script>
<script src="libs/datatables/dataTables.buttons.min.js"></script>
<script src="libs/datatables/buttons.html5.min.js"></script>
<script src="libs/datatables/buttons.colVis.min.js"></script>
<script src="libs/datatables/jszip.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="libs/datatables/select2.min.js"></script>

<script type="text/javascript" src="asset/infozina.js"></script>

</body>