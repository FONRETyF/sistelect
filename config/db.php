<?php
    /*echo("config bd <br>");
    $varrr = new db;
    var_dump($varrr);
    $valor = $varrr->conexion();
    var_dump($valor);*/

    
    class db{
        public function conexion(){
            try {
                //$PDO = new PDO("pgsql:host=localhost; port=5432; dbname=bdelec; user=postgres; password='admin*&'");
                $PDO = new PDO("pgsql:host=fonretyf-db.csqe5ka3i07r.us-east-1.rds.amazonaws.com; port=5432; dbname=usuarios; user=postgres; password='Fonre.21-24'");
                return $PDO;  
            } catch (PDOException $error) {

                die("Error en la conexion, error: ".$error->getMessage());
            }
        }
    }
    
?>
