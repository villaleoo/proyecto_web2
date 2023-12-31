<?php 
require_once './app/model/Model.php';

class TeamsModel extends Model{
   
    
    public function getAllItems(){
        $request= $this->db->prepare("SELECT * FROM clubes WHERE 1");
        $request->execute();
        $arrTeams=$request->fetchAll(PDO::FETCH_OBJ);
        
        
        return $arrTeams;
    }

    public function getNameOfLeague($idLeague){
        $request=$this->db->prepare("SELECT nombre FROM ligas WHERE id= ?");
        $request->execute([$idLeague]);
        $nameLeague = $request->fetch(PDO::FETCH_OBJ);

        return $nameLeague;
    }

    public function getItem($id){
        $request=$this->db->prepare("SELECT * FROM clubes WHERE id= ?");
        $request->execute([$id]);
        $team = $request->fetch(PDO::FETCH_OBJ);

        return $team;

    }

    public function updateItem($team){
        $dataForm=$team[0];
        $idTeam=$team[1];
       
        $varbinary_logo = base64_decode($dataForm["imagen_logo"]);
        $varbinary_stadium = base64_decode($dataForm["imagen_estadio"]);
        $dateFundation=date("Y-m-d", strtotime($dataForm["fecha_fundacion"]));


      
        $request= $this->db->prepare("UPDATE clubes SET nombre= ?, ciudad =?, id_liga =?, nombre_estadio=?,capacidad_estadio=?,descripcion_historia=?,apodo=?,fecha_fundacion=?,imagen_logo=?,temporada_analisis=?,cant_partidos_jugados=?, goles_en_liga=?,goles_en_copa=?,promedio_edad_equipo=?,cantidad_jugadores=?,imagen_estadio=? WHERE id = ?");

        $request->execute([$dataForm["nombre"], $dataForm["ciudad"], 2,$dataForm["nombre_estadio"],intval($dataForm["capacidad_estadio"]),$dataForm["descripcion_historia"],$dataForm["apodo"],$dateFundation, $varbinary_logo, intval($dataForm["temporada_analisis"]), intval($dataForm["cant_partidos_jugados"]), intval($dataForm["goles_en_liga"]),intval($dataForm["goles_en_copa"]),intval($dataForm["promedio_edad_equipo"]),intval($dataForm["cantidad_jugadores"]),$varbinary_stadium, $idTeam]);
       
    }

    public function addItem($team){
        $dataTeam= $team[0];
        $type=$team[1];
        $varbinary_logo = base64_decode($dataTeam["imagen_logo"]);
        $varbinary_stadium = base64_decode($dataTeam["imagen_estadio"]);
        $dateFundation=date("Y-m-d", strtotime($dataTeam["fecha_fundacion"]));


       $request=$this->db->prepare("INSERT INTO clubes (
       `nombre`,
       `ciudad`,
       `id_liga`,
       `nombre_estadio`,
       `capacidad_estadio`,
       `descripcion_historia`,
       `apodo`,
       `fecha_fundacion`,
       `imagen_logo`,
       `temporada_analisis`,
       `cant_partidos_jugados`,
       `goles_en_liga`,
       `goles_en_copa`,
       `promedio_edad_equipo`,
       `cantidad_jugadores`,
       `imagen_estadio`,
       `entidad`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $request->execute([$dataTeam["nombre"],
        $dataTeam["ciudad"],
        intval($dataTeam["id_liga"]),
        $dataTeam["nombre_estadio"],
        intval($dataTeam["capacidad_estadio"]),
        $dataTeam["descripcion_historia"],
        $dataTeam["apodo"],
        $dateFundation,
        $varbinary_logo,
        intval($dataTeam["temporada_analisis"]),
        intval($dataTeam["cant_partidos_jugados"]),
        intval($dataTeam["goles_en_liga"]),
        intval($dataTeam["goles_en_copa"]),
        intval($dataTeam["promedio_edad_equipo"]),
        intval($dataTeam["cantidad_jugadores"]),
        $varbinary_stadium,
        $type]);

    }

    public function deleteItem($idTeam){
        $request=$this->db->prepare("DELETE FROM clubes WHERE id = ?");
        $request->execute([$idTeam]);
    }

    
}

?>