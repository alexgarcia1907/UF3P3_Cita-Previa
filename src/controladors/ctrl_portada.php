<?php

/**
 * Controlador per mostrar la portada amb totes les dades necessaries.
 *
 * @param [$_SESSION] $sesio
 * @param [Model usuari] $usuario
 * @param [Model cita] $cita
 * @param [Dies a mostrar] $diesdeportada
 * @param [Array festius] $festius
 * @param string $error
 * @return void
 */
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
            $modals = $modals . '<div class="modal fade" id="0Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reserves</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <div class="modal-body">
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·la</button>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>';
    if ($rol != "admin") {

            include "../src/vistes/portada.php";
            
    } else {

        include "../src/vistes/portadadmin.php";
    }
}


