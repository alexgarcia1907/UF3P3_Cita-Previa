<?php

/**
 * Funcio crear calendari
 *
 * @param numeromes $mesfuncio
 * @param numeroany $anyfuncio
 * @param numsdiesfesta $festius
 * @return calendarienhtml
 */

function creaCalendari($mesfuncio,$anyfuncio,$festius = array()) {

    $muchotexto = "";
    $diessetmana = array("Lun","Mar","Mie", "Jue","Vie","Sab","Dom");
    $dia1mesactual = date("w",mktime(0,0,0,$mesfuncio,date("t"),$anyfuncio));
    $diesmesactual = date("t", mktime(0,0,0, $mesfuncio ,10, $anyfuncio));
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

    if ($dia1mesactual == 0) {
      $dia1mesactual = 7;
    }
    
    $totalceldas = $diesmesactual + $dia1mesactual-1 + (7-(($diesmesactual + $dia1mesactual-1)%7));
    if ((($diesmesactual + $dia1mesactual-1)%7) == 0) {
      $totalceldas = $totalceldas -7;
    }
    
    for ($i=1;$i<=$totalceldas; $i++) {

      if ($i % 7 == 1) {
        $muchotexto = $muchotexto.("<tr>");
      }
      
      if ($i < $dia1mesactual || $i > $diesmesactual + $dia1mesactual -1) {
        $muchotexto = $muchotexto.("<td></td>");

      } else {
        if (($i % 7) == 0 || in_array($i-$dia1mesactual+1,$festius[$mesfuncio])) {
          $muchotexto = $muchotexto.('<td class="festiu">'.($i-$dia1mesactual+1).'</td>');
      } else if ($i-$dia1mesactual+1 == date("j")) {
        $muchotexto = $muchotexto.('<td class="avui">'.($i-$dia1mesactual+1).'</td>');
      } else 
      $muchotexto = $muchotexto.(("<td>").($i-$dia1mesactual+1).("</td>"));
      }            

      if (($i % 7) == 0) {
        $muchotexto = $muchotexto.("</tr>");
      }
    }
    $muchotexto = $muchotexto.('</table>');

    return $muchotexto;
}
