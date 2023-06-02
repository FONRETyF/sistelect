<?php
    class homeModel{
        private $PDO;
        
        public function __construct()
        {
            require_once("/var/www/html/sistelect/config/db.php");
            $pdo = new db();
            $this->PDO = $pdo->conexion();
            
        }

        public function obtenerclave($usuario){
            try {
                $query="SELECT password,lugar FROM public.usuarios WHERE cveusu = :usuario";
                $statement = $this->PDO->prepare($query);
                $statement->bindParam(":usuario",$usuario);
                /*$statement->execute();
                $result=$statement->fetchAll() ;
                echo("dlkfjlkdfd");
                var_dump($result);*/
                return($statement->execute()) ? $statement->fetchAll() : false;
            } catch (\Throwable $th) {
                echo $th;
            }            
        }
            
    }

?>