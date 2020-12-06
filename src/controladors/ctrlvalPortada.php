<?php

function ctrlvalPortada($post, $sesio, $usuari, $cita){
    if(!$sesio -> sesiousuari()){
        include "../src/vistes/login.php";
    } else {
        if (isset($post["hora"]) && isset($post["coment"]) && $post["hora"] != ""){

            $dadescita = [];
            $error = "";

            $hora = trim(filter_var($post["hora"], FILTER_SANITIZE_STRING));
            $comentari = trim(filter_var($post["coment"], FILTER_SANITIZE_STRING));
            $dia = trim(filter_var($post["dia"], FILTER_SANITIZE_STRING));

            $fecha = $dia ." ". $hora .":00";

            $dadescita["idusuari"] = $usuari -> getid($sesio -> obtenirnom());
            $dadescita["data"] = $fecha;
            $dadescita["comentari"] = $comentari;

            

            if(!$cita -> afegir($dadescita)){
                $error = 1;//("<div class=alert>Aquesta hora ja esta reservada.</div>" );
            }

            header("Location: index.php?error=$error");
            //ctrl_portada($sesio,$usuari,$cita,$error);
        }
        else{
            header("Location: index.php");
        }
    }  
}