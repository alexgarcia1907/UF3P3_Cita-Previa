<?php

/**
 * Funció per comprovar si és l'admin el que esta intentant entrar a la configuració.
 *
 * @param [Model usuari] $usuari
 * @param [$_SESSION] $sesio
 */
function ctrlTancaSess(){
    session_unset();
    header('Location: index.php'); 
}