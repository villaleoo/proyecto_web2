<?php
require_once './app/controller/dbControllers/LeagueController.php';
require_once './app/model/Model.php';
class LeaguesModel extends Model {

  
    public function getAllItems(){
        $request= $this->db->prepare("SELECT * FROM ligas WHERE 1");
        $request->execute();
        $arrTeams=$request->fetchAll(PDO::FETCH_OBJ);
        
        return $arrTeams;
    }

    public function addItem($league){
        $dataLeague= $league[0];
        $type=$league[1];
        $varbinary_logo = pack("H*",bin2hex($dataLeague["imagen_logo"]));
        $varbinary_country = pack("H*",bin2hex($dataLeague["imagen_pais"]));
        $dateFundation=date("Y-m-d", strtotime($dataLeague["fecha_fundacion"]));

        $request=$this->db->prepare("INSERT INTO ligas (
        `nombre`,
        `pais`,
        `formato`,
        `reglas`,
        `cant_partidos`,
        `division`,
        `fecha_fundacion`,
        `descripcion`,
        `temporada`,
        `imagen_logo`,
        `imagen_pais`,
        `entidad`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        $request->execute([
            $dataLeague["nombre"],
            $dataLeague["pais"],
            $dataLeague["formato"],
            $dataLeague["reglas"],
            $dataLeague["cant_partidos"],
            $dataLeague["division"],
            $dateFundation,
            $dataLeague["descripcion"],
            $dataLeague["temporada"],
            $varbinary_logo,
            $varbinary_country,
            $type]);
    }

    public function getItem($id){
        $request=$this->db->prepare("SELECT * FROM ligas WHERE id= ?");
        $request->execute([$id]);
        $league = $request->fetch(PDO::FETCH_OBJ);

        return $league;
    }

    public function updateItem ($league){
        $dataForm=$league[0];
        $idLeague=$league[1];

        $varbinary_logo = pack("H*",bin2hex($dataForm["imagen_logo"]));
        $varbinary_country = pack("H*",bin2hex($dataForm["imagen_pais"]));
        $dateFundation=date("Y-m-d", strtotime($dataForm["fecha_fundacion"]));

        $request= $this->db->prepare("UPDATE ligas SET 
        nombre= ?,
        pais=?,
        formato=?,
        reglas=?,
        cant_partidos=?,
        division=?,
        fecha_fundacion=?,
        descripcion=?,
        temporada=?,
        imagen_logo=?,
        imagen_pais=? WHERE id = ?");

        $request->execute([
            $dataForm["nombre"],
            $dataForm["pais"],
            $dataForm["formato"],
            $dataForm["reglas"],
            $dataForm["cant_partidos"],
            $dataForm["division"],
            $dateFundation,
            $dataForm["descripcion"],
            $dataForm["temporada"],
            $varbinary_logo,
            $varbinary_country,
            $idLeague]);
    }

    public function deleteItem($idLeague){
        $request=$this->db->prepare("DELETE FROM ligas WHERE id = ?");
        $request->execute([$idLeague]);
    }

    public function getTeamsOfLeague($id_liga){
        $request= $this->db->prepare("SELECT clubes.* FROM clubes JOIN ligas ON clubes.id_liga = ligas.id WHERE ligas.id = ?");
        $request->execute([$id_liga]);
        $teams= $request->fetchAll(PDO:: FETCH_OBJ);

        return $teams;
    }
 
}

?>