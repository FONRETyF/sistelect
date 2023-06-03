<?php
    session_start();

    class Zinacantepec{
        private $db;
        private $infozinacan;
        
        public function __construct()
        {
            require_once("/var/www/html/sistelect/config/db.php");
            $pdo = new db();
            $this->db=$pdo->conexion();
            $this->infozinacan = array();
        }
        
        public function get_infoZin(){
            try {
                $statement = $this->db->prepare('SELECT id,nomcom,cveelector,curp,estatvoto,turnvoto FROM public.padronzin ORDER BY id asc');
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\Throwable $th) {
                echo $th;
            }
        }

        public function update_voto($idPersona,$turno,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzin SET estatvoto='1', turnvoto='".$turno."', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\Throwable $th) {
                echo $th;
            }
        }

        public function corrige_voto($idPersona,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzin SET estatvoto='0', turnvoto='', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }
?>