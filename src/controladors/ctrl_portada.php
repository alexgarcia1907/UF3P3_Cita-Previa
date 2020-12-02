<?php

function ctrl_portada($sesio,$usuario,$cita){

  if (!$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
      }

    $citesusu = $cita -> getdades($usuario -> getid("test"));

    echo(creaCalendari(11,2020,10));

}