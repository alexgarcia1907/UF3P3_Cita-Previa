<?php

/**
 * Funcio crear calendari
 *
 * @param numeromes $mesfuncio
 * @param numeroany $anyfuncio
 * @param numsdiesfesta $festius
 * @return calendarienhtml
 */

function creaCalendari($mesfuncio,$anyfuncio, $diesamostrar, $festius = array()) {
  include "config.php";

    $muchotexto = "";
    $diessetmana = array("Lun","Mar","Mie", "Jue","Vie","Sab","Dom");
    $diaactualsetmana = date("N");

   
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

      $totalceldas = $diaactualsetmana-1 + $diesamostrar + (7-(($diesamostrar + $diaactualsetmana-1)%7));
      $celdasquellevo = 1;
      $muchotexto = $muchotexto . "<tr>";

      for ($i = 0; $i < date("N") -1; $i++) {
        $muchotexto = $muchotexto . '<td></td>';
        $celdasquellevo++;
      }

      for ($i = 0; $i < $diesamostrar; $i++) {
        if($celdasquellevo % 7 == 7) {
          $muchotexto = $muchotexto . '<tr>';
        }

          $muchotexto = $muchotexto . '<td>'. $diaactu.'</td>';
          $diaactu++;

        if ($celdasquellevo % 7 == 0) {
          $muchotexto = $muchotexto . "</tr>";
        }
        $celdasquellevo++;
      }
      $celdasquellevo--;

      for ($i = 0; 0 != ($celdasquellevo % 7); $i++) {
        $muchotexto = $muchotexto . '<td></td>';
        $celdasquellevo++;
      }
      
      $muchotexto = $muchotexto . "</tr>";

      /*for ($i = 1;$i <= $totalceldas; $i++) {
        if($i % 7 == 7) {
          $muchotexto = $muchotexto . '<tr>';
        }
        if ($i-1 >= $diaactu) {
          $muchotexto = $muchotexto . '<td>'. $diaactu.'</td>';
          $diaactu++;
        } else {
          $muchotexto = $muchotexto . '<td></td>';
        }

        if($i %7 == 0) {
          $muchotexto = $muchotexto . '</tr>';
        }
        
      }*/

      return $muchotexto;
}