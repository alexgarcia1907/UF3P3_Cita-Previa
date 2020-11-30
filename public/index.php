<?php


include "../src/models/sessio.php";
include "../src/models/usuari.php";
include "../src/models/cita.php";

include "../src/config.php";
include "../src/funcions.php";

include "../src/controladors/ctrlLogin.php";
include "../src/controladors/ctrlvalLogin.php";
include "../src/controladors/ctrl_portada.php";
include "../src/controladors/ctrlvalRegister.php";

if (isset($_REQUEST["r"])) {
    $r = $_REQUEST["r"];
} else {
    $r = "res";
}

$modelusuari = new usuari;
$modelcita = new cita;
$modelsessio = new Sessio;

$modelusuari -> conecta($bbdd,$host,$user,$pass);
$modelcita -> conecta($bbdd,$host,$user,$pass);
$modelsessio -> inciar();

if ($r == "login") {
    ctrlLogin($modelsessio);
} else if ($r == "vlogin") {
    ctrlvalLogin($_POST, $modelsessio, $modelusuari);
} else if ($r == "register") {
    ctrlRegistrar($_POST, $modelsessio, $modelusuari);
} else if ($r == "vportada"){
    ctrlvalPortada($_POST, $modelsessio, $modelusuari, $modelcita);
} else {
    ctrl_portada($modelsessio,$modelusuari,$modelcita);
}