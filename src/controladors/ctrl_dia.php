<?php
function ctrldia($sesio,$usuario,$cita,$get) {

  if (!$sesio -> sesiousuari()) {
    header("Location: index.php?r=login");
    die();
    }
    $data = new DateTime();
    $rol = $usuario -> getrol($sesio->obtenirnom());
    $modalsbody = "";
    if ($rol != "admin") {

            $modalsbody = $modalsbody . '<div id="containsmodal">
                        <div class="reservs">
                            <h5>Les meves reserves</h5>';
                            $citesara = citesdia($cita, $get["dia"], $sesio, $usuario);
                            $modalsbody = $modalsbody.('<table class="table table-striped table-hover"><tr><th>Data/Hora</th><th>Comentari</th></tr>');
                            foreach($citesara as $cita1) {
                                $modalsbody = $modalsbody.('<tr><td>'.explode(" ",$cita1["data"])[1].'</td><td>'.$cita1["comentari"].'</td></tr>');       
                            }
        
                        $modalsbody = $modalsbody.'</table>
        
                        </div>
        
                        <form action="index.php" method="post">
                            <div class="formulari">
                                <p>L\'horari disponible és de 9:00 a 13:00.</p>
                                <p>Per evitar l\'aglomeració de clients, les reserves disponibles seran cada 30 minuts.</p>
                                <label>Escull l\'hora:</label>

                                <select type="select" name="hora">';
                                    $data->setTime(9,0,0);
                                    $contador = 0;
                                    for ($j = 0; $j < 9; $j++) {
                                        $veras = existeixlahora($_GET["dia"]." ".$data->format("H:i:s"), $cita);
                                        if ($veras) {
                                            $modalsbody = $modalsbody . '<option disabled>'. $data -> format("H:i").' - (No disponible)</option>';
                                            $contador++;
                                            if ($contador > 8) {
                                                $modalsbody = $modalsbody.'<script>$(\'button[data-target="#'.$i.'Modal"]\').parent().addClass("bg-ple");</script>';
                                                
                                            }
                                        
                                        } else {
                                            $modalsbody = $modalsbody .'<option>'. $data -> format("H:i").'</option>';
                                        }
                                        
                                        $data->modify("+30 minutes");
                                    }

                                $modalsbody = $modalsbody .'</select><br>

                                <input name="dia" hidden value="'.$_GET["dia"].'">
                                <input name="r" hidden value="vportada">
                                <label>Explica\'ns alguna cosa:</label>
                                <input name="coment" type="text">
                                <div class="opcions">
                                <button type="submit" class="btn btn-dark">Reserva</button>
                                </div> 
                            </div> 
                        </form>
                        </div>
                        ';


            
          
            //include "../src/vistes/portada.php";
            
    } else {


            $modalsbody = $modalsbody . '
            <div id="containsmodal">
                        <div class="reservs">
                            <h5>Les meves reserves</h5>';
                            $citesara = citesdiaadmin($cita, $get["dia"], $sesio, $usuario);
                            $modalsbody = $modalsbody.('<table class="table table-striped table-hover"><tr><th>Usuari</th><th>Data/Hora</th><th>Comentari</th></tr>');
                            foreach($citesara as $cita1) {
                                $modalsbody = $modalsbody.('<tr><td>'.$cita1["nom"].'</td><td>'.explode(" ",$cita1["data"])[1].'</td><td>'.$cita1["comentari"].'</td></tr>');       
                            }
        
                        $modalsbody = $modalsbody.'</table>
        
                        </div>
        
                        <form action="index.php" method="post">
                            <div class="formulari">
                                <p>L\'horari disponible és de 9:00 a 13:00.</p>
                                <p>Per evitar l\'aglomeració de clients, les reserves disponibles seran cada 30 minuts.</p>
                                <label>Escull l\'hora:</label>
                                <select type="select" name="hora">';
                                    $data->setTime(9,0,0);
                                    $contador2 = 0;

                                    for ($j = 0; $j < 9; $j++) {
                                        $veras = existeixlahora($get["dia"]." ".$data->format("H:i:s"), $cita);
                                        if ($veras) {
                                            $modalsbody = $modalsbody . '<option disabled>'. $data -> format("H:i").' - (No disponible)</option>';
                                            $contador2++;
                                            if ($contador2 > 8) {
                                                $modalsbody = $modalsbody.'<script>$(\'button[data-target="#'.$i.'Modal"]\').parent().addClass("bg-ple");</script>';
                                                
                                            }
                                        } else {
                                            $modalsbody = $modalsbody .'<option>'. $data -> format("H:i").'</option>';
                                        }
                                        
                                        $data->modify("+30 minutes");
                                    }

                                $modalsbody = $modalsbody .'</select><br>

                                <input name="dia" hidden value="'.$get["dia"].'">
                                <input name="r" hidden value="vportada">
                                <label>Explica\'ns alguna cosa:</label>
                                <input name="coment" type="text">
                                <div class="opcions">
                                <button type="submit" class="btn btn-dark">Reserva</button>
                                </div> 
                            </div> 
                        </form>
                        </div>';

        //include "../src/vistes/portadadmin.php";

            }
          
    echo($modalsbody);
}

function citesdia($modelcita, $data, $modelsessio,$modelusuari) {

    $cites = $modelcita->getdades($modelusuari->getid($modelsessio->obtenirnom()),$data);
        
    return $cites;
}

function citesdiaadmin($modelcita, $data, $modelsessio,$modelusuari) {

    $cites = $modelcita->obtenircitesundia($data);
    return $cites;
}

function existeixlahora($diahora, $modelcita) {
    return $modelcita-> existeixlacita($diahora);
}
