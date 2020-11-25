<?php
/**
 * Controlador que ens comprova si l'usuari esta logat.
 *
 * @param $sessio comprovar usuari de la sessio
 * @return void
 */
function ctrlLogin($sessio){
    if(!$sessio -> sesiousuari()){
        header("Location: index.php?r=login");
        die();
    }

    include "../src/vistes/portada.php";
}