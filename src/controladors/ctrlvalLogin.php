<?php
/**
 * Funcio per comprovar que l'usuari del login ha introduit be les credencials.
 *
 * @param $sessio comprovar usuari de la sessio.
 * @param $parametre parametres que ens pasen per post.
 * @param $usuaris comprovar els usuaris de la base de dades.
 * @return void
 */

function ctrlvalLogin($parametre, $sessio, $usuaris){
    if (isset($parametre["usuarilogin"]) && isset($parametre["contrasenyalogin"]) && $parametre["usuarilogin"] != "" && $parametre["contrasenyalogin"] != "") {
        $usuari = trim(filter_var($parametre["usuarilogin"], FILTER_SANITIZE_STRING));
        $contrasenya = trim(filter_var($parametre["contrasenyalogin"], FILTER_SANITIZE_STRING));
    }else{
        $errorlogin = "campsbuits";

        include "../src/vistes/login.php";
        die();
    }

    $info = $usuaris -> getdades($usuari);

 


    if (empty($info)){
        $errorlogin = "incorrecte";

        include "../src/vistes/login.php";
        die();
    }else{
        if(password_verify($contrasenya, $info[0]["contrasenya"])===true){
            $sessio-> insertarusuari(true, $usuari);
            header("Location: index.php");
        }else{
            $errorlogin = "incorrecte";
            include "../src/vistes/login.php";
            die();
        }
    }
}