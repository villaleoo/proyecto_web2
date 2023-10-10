<?php 
require_once './app/model/Model.php';

class TeamsModel extends Model{
    
    public function getTeams(){
        $request= $this->db->prepare("SELECT * FROM clubes WHERE 1");
        $request->execute();
        $arrTeams=$request->fetchAll(PDO::FETCH_OBJ);
        
        
        return $arrTeams;
    }

    public function getLeagueNameOfTeam($idLeague){
        $request=$this->db->prepare("SELECT nombre FROM ligas WHERE id_liga= ?");
        $request->execute([$idLeague]);
        $nameLeague = $request->fetch(PDO::FETCH_OBJ);

        return $nameLeague;
    }

    
}

?>