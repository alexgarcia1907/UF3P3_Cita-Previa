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
  include "../src/config.php";
  $muchotexto = "";
    $diessetmana = array("Lun","Mar","Mie", "Jue","Vie","Sab","Dom");
    $diaactualsetmana = date("N");

   
    $muchotexto = $muchotexto.('<table class="mes">
    <tr class="mesu">
      <th colspan="7">');
      $muchotexto = $muchotexto.date("F",mktime(0,0,0,$mesfuncio,10));

      $muchotexto = $muchotexto.('</th>
    </tr>
    <tr class="setmana">');

      for ($i=0;$i<7;$i++) {
        $muchotexto = $muchotexto.("<td>").$diessetmana[$i].("</td>");
      }

      $muchotexto = $muchotexto.('</tr>');

      $totalceldas = $diaactualsetmana-1 + $diesamostrar + (7-(($diesamostrar + $diaactualsetmana-1)%7));
      $celdasquellevo = 0;

      if (date("N") != 1) {
        $muchotexto = $muchotexto . '<tr class="white">';

      }

      for ($i = 0; $i < date("N") -1; $i++) {
        $muchotexto = $muchotexto . '<tr class="white">';

        $muchotexto = $muchotexto . '<td></td>';
        $celdasquellevo++;
      }

      for ($i = 0; $i < $diesamostrar; $i++) {
        if($celdasquellevo % 7 == 0) {
          $muchotexto = $muchotexto . '<tr class="white">';
        }

          $muchotexto = $muchotexto . '<td><button class="white" data-toggle="modal" data-target="#'.$i.'Modal">'.$diaactual->format("M j").'</button></td>';

          $diaactual->modify("+1 day");

        if ($celdasquellevo % 7 == 6) {
          $muchotexto = $muchotexto . "</tr>";
        }
        $celdasquellevo++;
      }

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


function mostrardatos($cita){
  $datos = $cita -> obtenirtot();
  $todo = "";

  $todo = $todo . ('<table>
            <tr>
            <th>');
            $todo = $todo . ('Nom');
            $todo = $todo . ('</th> <th>');
            $todo = $todo . ('Dia i hora');
            $todo = $todo . ('</th> <th>');
            $todo = $todo . ('Comentari');
            $todo = $todo . ('</th> </tr>');

            foreach ($datos as $fila){
                $todo = $todo . ('<tr><td>'.$fila["nom"].'</td><td>'.$fila["data"].'</td><td>'.$fila["comentari"].'</td></tr>');
            }
            $todo = $todo . ('</table>');
            return $todo;
}