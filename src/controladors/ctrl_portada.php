<?php

function ctrl_portada($sesio,$usuario,$cita){
  include "../src/config.php";
  if (!$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
      }

    $citesusu = $cita -> getdades($usuario -> getid("test"));

    $calendar = creaCalendari($mesactual, $añoactu, 60, $festius);
    include "../src/vistes/portadadmin.php";

    
}