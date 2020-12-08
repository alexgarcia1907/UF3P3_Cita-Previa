<?php

function ctrlEliminaCita($post, $cita, $usuari, $sesio) {

    $rol = $usuari -> getrol($sesio->obtenirnom());
    
    if ($rol != "admin") {
        header("Location: index.php");
        die();
    } else {
        if (isset($post["cita"]) && $post["cita"] != ""){

            $idcita = trim(filter_var($post["cita"], FILTER_SANITIZE_STRING));

            $cita->borrarunacita($idcita);
            header("Location: index.php?r=configadmin");

        }
    }
}