<?php

    class homeController{
        private $MODEL;

        public function __construct()
        {
            require_once("/var/www/html/sistelect/model/homeModel.php");
            $this->MODEL = new homeModel();

        }

        public function limpiarusuario($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
            $campo = htmlspecialchars($campo);
            return $campo;
        }

        public function limpiarcadena($campo){
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_UNSAFE_RAW);
            $campo = htmlspecialchars($campo);
            return $campo;
        }

        public function verificarusuario($usuario,$contraseña){
            $a_resul_verif = array();

            $keydb = $this->MODEL->obtenerclave($usuario);

            if($contraseña==$keydb[0][0]){
                $a_result_verif["keybd"]=true;
                $a_result_verif["lugarpage"]=$keydb[0][1];
                return($a_result_verif);
            }else{
                $a_result_verif["keybd"]=false;
                $a_result_verif["lugarpage"]="";
                return($a_result_verif);
            }
        }
    }
?>