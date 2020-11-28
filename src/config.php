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