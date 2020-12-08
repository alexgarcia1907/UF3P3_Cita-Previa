<?php

function ctrl_portada($sesio,$usuario,$cita,$diesdeportada,$festius,$error = ""){
  if (!$sesio -> sesiousuari()) {
        header("Location: index.php?r=login");
        die();
    }

    if($error == 1){
        echo("<div class=alert>Aquesta hora ja esta reservada.</div>" );
    }

    $calendar = creaCalendari(new DateTime(), $diesdeportada, $festius);

    $data = new DateTime();    

    $modals = "";

    $rol = $usuario -> getrol($sesio->obtenirnom());

    if ($rol != "admin") {
        for ($i = 0; $i < $diesdeportada; $i++) {

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
                        <div class="reservs">
                            <h5>Les meves reserves</h5>';
                            $citesara = citesdia($cita, $data, $sesio, $usuario);
                            $modals = $modals.('<table class="table table-striped table-hover"><tr><th>Data/Hora</th><th>Comentari</th></tr>');
                            foreach($citesara as $cita1) {
                                $modals = $modals.('<tr><td>'.explode(" ",$cita1["data"])[1].'</td><td>'.$cita1["comentari"].'</td></tr>');       
                            }
        
                        $modals = $modals.'</table>
        
                        </div>
        
                        <form action="index.php" method="post">
                            <div class="formulari">
                                <p>L\'horari disponible és de 9:00 a 13:00.</p>
                                <p>Per evitar l\'aglomeració de clients, les reserves disponibles seran cada 30 minuts.</p>
                                <label>Escull l\'hora:</label>

                                <select type="select" name="hora">';
                                    $data->setTime(9,0,0);
                                    for ($j = 0; $j < 9; $j++) {
                                        $veras = existeixlahora($data->format("Y-m-d")." ".$data->format("H:i:s"), $cita);
                                        if ($veras) {
                                            $modals = $modals . '<option disabled>'. $data -> format("H:i").' - (No disponible)</option>';
                                        } else {
                                            $modals = $modals .'<option>'. $data -> format("H:i").'</option>';
                                        }
                                        
                                        $data->modify("+30 minutes");
                                    }

                                $modals = $modals .'</select><br>

                                <input name="dia" hidden value="'.$data->format("Y-m-d").'">
                                <input name="r" hidden value="vportada">
                                <label>Explica\'ns alguna cosa:</label>
                                <input name="coment" type="text">
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
            $data->modify("+1 day");

            }
          
            include "../src/vistes/portada.php";
            
    } else {
        for ($i = 0; $i < $diesdeportada; $i++) {

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
        
                        <div class="reservs">
                            <h5>Les meves reserves</h5>';
                            $citesara = citesdiaadmin($cita, $data, $sesio, $usuario);
                            $modals = $modals.('<table class="table table-striped table-hover"><tr><th>Usuari</th><th>Data/Hora</th><th>Comentari</th></tr>');
                            foreach($citesara as $cita1) {
                                $modals = $modals.('<tr><td>'.$cita1["nom"].'</td><td>'.explode(" ",$cita1["data"])[1].'</td><td>'.$cita1["comentari"].'</td></tr>');       
                            }
        
                        $modals = $modals.'</table>
        
                        </div>
        
                        <form action="index.php" method="post">
                            <div class="formulari">
                                <p>L\'horari disponible és de 9:00 a 13:00.</p>
                                <p>Per evitar l\'aglomeració de clients, les reserves disponibles seran cada 30 minuts.</p>
                                <label>Escull l\'hora:</label>
                                <select type="select" name="hora">';
                                    $data->setTime(9,0,0);
                                    for ($j = 0; $j < 9; $j++) {
                                        $veras = existeixlahora($data->format("Y-m-d")." ".$data->format("H:i:s"), $cita);
                                        if ($veras) {
                                            $modals = $modals . '<option disabled>'. $data -> format("H:i").' - (No disponible)</option>';
                                        } else {
                                            $modals = $modals .'<option>'. $data -> format("H:i").'</option>';
                                        }
                                        
                                        $data->modify("+30 minutes");
                                    }

                                $modals = $modals .'</select><br>

                                <input name="dia" hidden value="'.$data->format("Y-m-d").'">
                                <input name="r" hidden value="vportada">
                                <label>Explica\'ns alguna cosa:</label>
                                <input name="coment" type="text">
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
            $data->modify("+1 day");

            }
          
        include "../src/vistes/portadadmin.php";
    }
}

function citesdia($modelcita, $data, $modelsessio,$modelusuari) {

    $dataparam = ($data->format("Y-m-d"));
    $cites = $modelcita->getdades($modelusuari->getid($modelsessio->obtenirnom()),$dataparam);
        
    return $cites;
}

function citesdiaadmin($modelcita, $data, $modelsessio,$modelusuari) {
    $dataparam = ($data->format("Y-m-d"));
    $cites = $modelcita->obtenircitesundia($dataparam);
    return $cites;
}

function existeixlahora($diahora, $modelcita) {
    return $modelcita-> existeixlacita($diahora);
}
