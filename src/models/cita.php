<?php
class cita {
    public function conecta($nombd,$hostbd,$userbd,$passbd) {
        $parambbdd = "mysql:dbname=$nombd;host=$hostbd;";
        $user = $userbd;
        $pass = $passbd;

        try {
            $this->sql = new PDO($parambbdd, $user, $pass);
        } catch (PDOException $e) {
            die('Bro... this is shit --> ' . $e->getMessage());
        }
    }

    public function afegir($dadescita) {
        $query = $this ->sql -> prepare('insert into cita
        (idusuari,data,comentari) values (:idusuari,:data,:comentari);');

        $result = $query -> execute([':idusuari' => $dadescita["idusuari"],':data' => $dadescita["data"],
        ':comentari' => $dadescita["comentari"]]);

        return $result;
    }

    public function getdades($idusuari, $data) {
        $dades = [];
        $query = $this->sql->prepare('select * from cita where idusuari = :idusuari and data between :data and :data2;');
        $result = $query->execute([':idusuari' => $idusuari, ':data' => $data." 00:00:00", ':data2' => $data." 23:59:59"]);
        while ($value = $query -> fetch(\PDO::FETCH_ASSOC)) {
            $dades[] = $value;
        }
        return $dades;
    }

    public function borrardades($idusuari) {
        $query =$this->sql->prepare('delete from cita where idusuari =  :idusuari;');
        $result = $query->execute([':idusuari' => $idusuari]);
    }

    public function obtenirtot(){
        $dades = [];
        $query = $this->sql->prepare('select u.nom,c.data,c.comentari from cita c join usuari u where c.idusuari = u.id;');
        $result = $query->execute();

        while ($value = $query -> fetch(\PDO::FETCH_ASSOC)) {
            $dades[] = $value;
        }
        return $dades;
    }

    public function obtenircitesundia($data){
        $dades = [];
        $query = $this->sql->prepare('select u.nom,c.data,c.comentari from cita c join usuari u where c.idusuari = u.id and c.data between :data and :data2;');
        $result = $query->execute([':data' => $data." 00:00:00", ':data2' => $data." 23:59:59"]);

        while ($value = $query -> fetch(\PDO::FETCH_ASSOC)) {
            $dades[] = $value;
        }
        return $dades;
    }
}