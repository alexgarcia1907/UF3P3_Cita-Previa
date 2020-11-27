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
        $query = $this ->sql -> prepare('insert into usuari (usuari,correu,contrasenya,rol) values (:usuari,:correu,:contrasenya);');

        $result = $query -> execute([':usuari' => $dadesusuari["usuari"],
        ':correu' => $dadesusuari["correu"],
        ':password' => $dadesusuari["password"]]);
    }

    public function getdades($nomusuari) {
        $dades = [];

        $query =$this->sql->prepare('select * from usuari where nom =  :nom;');
        $result = $query->execute([':nom' => $nomusuari]);

        while ($value =$query-> fetch(\PDO::FETCH_ASSOC)) {
            $dades[] = $value;
        }
        return $dades;
    }

    public function getid($nomusuari){
        $query =$this->sql->prepare('select id from usuari where nom = :nom;');
        $result = $query->execute([':nom' => $nomusuari]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getrol($nomusuari) {
        $query =$this->sql->prepare('select rol from usuari where nom = :nom;');
        $result = $query->execute([':nom' => $nomusuari]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}