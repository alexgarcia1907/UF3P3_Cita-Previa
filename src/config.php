<?php

$festius = array(
    1 => array(1),
    2 => array(),
    3 => array(),
    4 => array(10),
    5 => array(1),
    6 => array(),
    7 => array(),
    8 => array(15),
    9 => array(),
    10 => array(12),
    11=> array(),
    12 => array(8,25)
);

$añoactu = new DateTime();
$añoactual = $añoactu -> format('Y');

$diaactual = new DateTime();
$diaactu = $diaactual -> format('D');


$mesactu = new DateTime();
$mesactual = $mesactu -> format ('m');

//Param conexio bbdd

$host = 'sikuu.ddns.net';
$bbdd = 'uf3p3_cita_previa';
$user = 'victor';
$pass = '2001';

//No estic regalant un usuari amb permissos de root
//L'usuari victor ha estat creat expressament per aquesta
//practica i nomes té access a aquesta base de dades