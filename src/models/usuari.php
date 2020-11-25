<?php

class usuari {
    public function conecta() {
        $parambbdd = 'mysql:dbname=uf3p3_cita_previa;host=sikuu.ddns.net;';
        $user = "victor";
        $pass = "2001";

        try {
            $this->sql = new PDO($parambbdd, $user, $pass);
        } catch (PDOException $e) {
            die('Bro... this is shit --> ' . $e->getMessage());
        }
    }

    public function afegir($dadesusuari) {
        $query = $this ->sql -> prepare('insert into usuari
        (usuari,correu,contrasenya) values (:usuari,:correu,:contrasenya);');

        $result = $query -> execute([':usuari' => $dadesusuari["usuari"],
        ':correu' => $dadesusuari["correu"],
        ':password' => $dadesusuari["password"]]);
    }

    public function getdades($nomusuari) {
        $query =$this->sql->prepare('select * from usuari where nom =  :nom;');
        $result = $query->execute([':nom' => $nomusuari]);
        return $result;
    }

    public function getid($nomusuari){
        $query =$this->sql->prepare('select id from usuari where nom = :nom;');
        $result = $query->execute([':nom' => $nomusuari]);
        return $result;
    }

}
$hola = new usuari;
$hola->conecta();