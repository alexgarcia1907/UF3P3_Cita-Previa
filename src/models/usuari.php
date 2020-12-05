<?php

class usuari {
    public function conecta($nombd,$hostbd,$userbd,$passbd) {
        $parambbdd = "mysql:dbname=$nombd;host=$hostbd;";
        $user = $userbd;
        $pass = $passbd;

        try {
            $this->sql = new PDO($parambbdd, $user, $pass);
        } catch (PDOException $e) {
            die('Bro... this is shit --> ' . $e->getMessage());
            echo("$nombd, $hostbd, $userbd, $passbd");
        }
    }

    public function afegir($dadesusuari) {
        $query = $this ->sql -> prepare('insert into usuari (nom,correu,contrasenya) values (:nom,:correu,:contrasenya);');

        $result = $query -> execute([':nom' => $dadesusuari["nom"],
        ':correu' => $dadesusuari["correu"],
        ':contrasenya' => $dadesusuari["contrasenya"]]);
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
        return $query->fetch(\PDO::FETCH_ASSOC)["id"];
    }

    public function getrol($nomusuari) {
        $query =$this->sql->prepare('select rol from usuari where nom = :nom;');
        $result = $query->execute([':nom' => $nomusuari]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}