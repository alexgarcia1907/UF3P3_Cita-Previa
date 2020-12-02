<?php

/**
 * Funcio crear calendari
 *
 * @param numeromes $mesfuncio
 * @param numeroany $anyfuncio
 * @param numsdiesfesta $festius
 * @return calendarienhtml
 */
include "config.php";

function creaCalendari($mesfuncio,$anyfuncio,$festius = array()) {

    $muchotexto = "";
    $diessetmana = array("Lun","Mar","Mie", "Jue","Vie","Sab","Dom");
   
    $muchotexto = $muchotexto.('<table class="mes">
    <tr>
      <th colspan="7">');
      $muchotexto = $muchotexto.date("F",mktime(0,0,0,$mesfuncio,10));

      $muchotexto = $muchotexto.('</th>
    </tr>
    <tr>');

      for ($i=0;$i<7;$i++) {
        $muchotexto = $muchotexto.("<td>").$diessetmana[$i].("</td>");
      }

      $muchotexto = $muchotexto.('</tr>');

      return $muchotexto;
}