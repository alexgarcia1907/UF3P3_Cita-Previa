<?php

/**
 * Funció per comprovar si és l'admin el que esta intentant entrar a la configuració.
 *
 * @param [type] $usuari
 * @param [type] $sesio
 */
function ctrlConfigAdmin($usuari,$sesio){

    $rol = $usuari -> getrol($sesio->obtenirnom());

    if ($rol != "admin") {
        header("Location: index.php");
        die();
    }
    else{
        $todo = $cita -> obtenirtot();
    
        include "../vistes/portadaconfig.php";
    }
}

