<?php
require_once './app/controller/LeagueController.php';
require_once './app/model/Model.php';
class LeaguesModel extends Model {

    public function getLeagueVinculedTeam($leagueId){
        $request = $this->db->prepare("SELECT * FROM ligas WHERE id = ?");
        $request->execute([$leagueId]);
        $league = $request->fetch(PDO::FETCH_OBJ);

        return $league;
    }
}

?>