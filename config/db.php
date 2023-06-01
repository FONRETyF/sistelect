<?php
    /*echo("config bd <br>");
    $varrr = new db;
    var_dump($varrr);
    $valor = $varrr->conexion();
    var_dump($valor);*/

    
    class db{
        public function conexion(){
            try {
                $PDO = new PDO("pgsql:host=localhost; port=5432; dbname=bdelec; user=postgres; password='admin*&'");
                return $PDO;  
            } catch (PDOException $error) {

                die("Error en la conexion, error: ".$error->getMessage());
            }
        }
    }
    
?>
