<?php
include "../models/cita.php";
include "../models/sessio.php";
include "../models/usuari.php";
include "../funcions.php";

$sesio = new Sessio;
$usuario = new Usuari;
$cita = new cita;

$sesio -> inciar();
$usuario -> conecta($bbdd,$host,$user,$pass);
$cita -> conecta($bbdd,$host,$user,$pass);

ctrl_portada($sesio,$usuario,$cita);

function ctrl_portada($sesio,$usuario,$cita){

  include "../config.php";

      /*if ( !$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
      }*/

    $citesusu = $cita -> getdades($usuario -> getid("test"));
    print_r($citesusu);
    echo(creaCalendari($mesactual,$añoactual));
}