<?php
include "../models/cita.php";
include "../models/sessio.php";
include "../models/usuari.php";

$sesio = new Sessio;
$usuario = new Usuari;
$cita = new cita;

$sesio -> inciar();
$usuario -> conecta();
$cita -> conecta();


ctrl_portada($sesio,$usuario,$cita);

function ctrl_portada($sesio,$usuario,$cita){

   /* if ( !$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
      }*/

    $citesusu = $cita -> getdades($usuario -> getid("test"));
    print_r($citesusu);
}