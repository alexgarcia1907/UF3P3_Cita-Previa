<?php

function ctrl_portada($sesio,$usuario,$cita){
  include "../src/config.php";
  if (!$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
      }

    $calendar = creaCalendari($mesactual, $añoactu, 60, $festius);

    $data = new DateTime();
    $modals = "";
    for ($i = 0; $i < 60; $i++) {

    $modals = $modals . '<div class="modal fade" id="'.$i.'Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reserves</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <div class="modal-body">

                <div>';
                    $citesara = citesdia($cita, $data, $sesio, $usuario);
                    foreach($citesara as $cita1) {
                        $modals = $modals.$cita1["data"].$cita1["comentari"];
                        
                        
                    }

                $modals = $modals.'

                </div>

                <form action="index.php?r=vportada" method="post">
                    <div class="formulari">
                        <p>L\'horari disponible és de 9:00 a 13:00.</p>
                        <p>Per evitar l\'aglomeració de clients, les reserves disponibles seran cada 30 minuts.</p>
                        <label>Escull l\'hora:</label>
                        <input type="time" step="1800" min="09:00" max="13:00">
                        <label>Explica\'ns alguna cosa:</label>
                        <input type="text">
                        <div class="opcions">
                        <button type="submit" class="btn btn-dark">Reserva</button>
                        </div> 
                    </div> 
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·la</button>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>';
    }
  
    include "../src/vistes/portada.php";
    
}

function citesdia($modelcita, $data, $modelsessio,$modelusuari) {

    $dataparam = ($data->format("Y-m-d"));
    $data->modify("+1 day");
    //echo($dataparam);
   // echo($modelusuari->getid($modelsessio->obtenirnom()));
    $cites = $modelcita->getdades($modelusuari->getid($modelsessio->obtenirnom()),$dataparam);
        
    return $cites;
}