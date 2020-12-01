<?php

/**
 * Controlador per registrar l'usuari.
 * Controlem que l'usuari ja estigui registrat, inserim la password encriptada.
 *
 * @param [$_POST] $parametre
 * @param [$_SESSION] $sessio
 * @param [model usuari] $usuaris
 */
function ctrlRegistrar($parametre, $sessio, $usuaris){
include "../src/config.php";
$error = "";

    if (isset($parametre["mail"]) && isset($parametre["usuarireg"]) && isset($parametre["contrasenyareg"]) && $parametre["mail"] != "" && $parametre["usuarireg"] != "" && $parametre["contrasenyareg"] != "" ){
        if ($parametre["contrasenyareg"] == $parametre["contrasenya2reg"]) {
            $usuarisregistrats = $usuaris -> getdades($parametre["usuarireg"]);
            if (empty($usuarisregistrats)) {
                $validarcontra = trim(filter_var( $parametre["contrasenyareg"], FILTER_SANITIZE_STRING));
                $hash = password_hash($validarcontra, PASSWORD_DEFAULT, $config["hash"]);
           
                $dadesregister = [];
                $dadesregister["nom"] = trim(filter_var( $parametre["usuarireg"], FILTER_SANITIZE_STRING));
                $dadesregister["correu"] = trim(filter_var( $parametre["mail"], FILTER_SANITIZE_EMAIL));
                $dadesregister["contrasenya"]  = $hash;

                $usuaris -> afegir($dadesregister);
                $sessio-> insertarusuari(true, $dadesregister["nom"]);

                header("Location: index.php");
            }   
            else {
                $error = $error . ("<div class=alert>Aquest usuari ja existeix.</div>" );
                echo($error);
                include "../src/vistes/login.php";
                die();
            }
        }
        else {
            $error = $error . ("<div class=alert>Les contrasenyes no coincideixen.</div>" );
            echo($error);
            include "../src/vistes/login.php";
            die();
    }
}
else {
    include "../src/vistes/login.php";
    die();
}
}