<?php
    session_start();

    class Toluca{
        private $db;
        private $infotoluca;
        
        public function __construct()
        {
            require_once("/var/www/html/sistelect/config/db.php");
            $pdo = new db();
            $this->db=$pdo->conexion();
            $this->infotoluca = array();
        }
        
        public function get_infoTol(){
            try {
                $statement = $this->db->prepare('SELECT id,nomcom,estatvoto,turnvoto FROM public.padrontol WHERE id>0 and id<=1000 ORDER BY id asc');
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
                $query="UPDATE public.padrontol SET estatvoto='1', turnvoto='".$turno."', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
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
                $query="UPDATE public.padrontol SET estatvoto='0', turnvoto='', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
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