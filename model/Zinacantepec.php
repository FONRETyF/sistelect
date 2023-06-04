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
        
        public function get_infoZin($usuario){
            switch ($usuario) {
                case 'zin01':
                    try {
                        $statement = $this->db->prepare('SELECT id,nomcom,estatvoto,turnvoto FROM public.padronzin ORDER BY id asc');
                        $statement->execute();
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                        return $results;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    break;

                case 'zinaM':
                    try {
                        $statement = $this->db->prepare('SELECT id,nomcom,cveelector,estatvoto,turnvoto FROM public.padronzinmuj ORDER BY id asc');
                        $statement->execute();
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                        return $results;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    break;
                    
                case 'zin02':
                    try {
                        $statement = $this->db->prepare('SELECT id,nomcom,estatvoto,turnvoto FROM public.padronzin ORDER BY id asc');
                        $statement->execute();
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                        return $results;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    break;
                case 'zin03':
                    try {
                        $statement = $this->db->prepare('SELECT id,nomcom,estatvoto,turnvoto FROM public.padronzin ORDER BY id asc');
                        $statement->execute();
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                        return $results;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    break;

                case 'zinaJ':
                    try {
                        $statement = $this->db->prepare('SELECT id,nomcom,cveelector,estatvoto,turnvoto FROM public.padronzinjov ORDER BY id asc');
                        $statement->execute();
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                        return $results;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
                    break;

                default:
                    # code...
                    break;
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

        public function update_votoM($idPersona,$turno,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzinmuj SET estatvoto='1', turnvoto='".$turno."', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\Throwable $th) {
                echo $th;
            }
        }

        public function update_votoJ($idPersona,$turno,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzinjov SET estatvoto='1', turnvoto='".$turno."', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
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

        public function corrige_votoM($idPersona,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzinmuj SET estatvoto='0', turnvoto='', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } catch (\Throwable $th) {
                echo $th;
            }
        }

        public function corrige_votoJ($idPersona,$cveusu){
            $fecha = "";
            $fecha = date("Y-m-d H:i:s");
            try {
                $query="UPDATE public.padronzinjov SET estatvoto='0', turnvoto='', horavoto='".$fecha."', usureg='".$cveusu."' WHERE id='".$idPersona."'";
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