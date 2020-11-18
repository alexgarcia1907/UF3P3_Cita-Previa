<?php
/**
 * Model per controlar la sessio amb les funcions necessàries.
 */
class Sessio{
    public function inciar(){
        session_start();
    }

    public function sesiousuari(){
        return $_SESSION["logat"];
    }

    public function insertarusuari($logat,$nomusuari){
        $_SESSION["logat"] = $logat;
        $_SESSION["nom"] = $nomusuari;
    }

    public function obtenirnom(){
        return $_SESSION["nom"];
    }

    public function tancat(){
        session_unset();
    }
    
}