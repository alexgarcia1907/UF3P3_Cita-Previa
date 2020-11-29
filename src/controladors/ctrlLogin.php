<?php
/**
 * Controlador que ens comprova si l'usuari esta logat.
 *
 * @param $sessio comprovar usuari de la sessio
 * @return void
 */
function ctrlLogin($sessio){
    if(!$sessio -> sesiousuari()){
        include "../src/vistes/login.php";
    } else {
        header("Location: index.php");
    }

    
}