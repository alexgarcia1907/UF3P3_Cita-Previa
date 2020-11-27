<?php
class cita {
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

    public function afegir($dadescita) {
        $query = $this ->sql -> prepare('insert into cita
        (idusuari,data,comentari) values (:idusuari,:data,:comentari);');

        $result = $query -> execute([':idusuari' => $dadescita["idusuari"],
        ':data' => $dadesusuari["data"],
        ':comentari' => $dadesusuari["comentari"]]);
    }

    public function getdades($idusuari) {
        $query =$this->sql->prepare('select * from cita where idusuari =  :idusuari;');
        $result = $query->execute([':idusuari' => $idusuari]);
        return $result;
    }

    public function borrardades($idusuari) {
        $query =$this->sql->prepare('delete from cita where idusuari =  :idusuari;');
        $result = $query->execute([':idusuari' => $idusuari]);
    }
}