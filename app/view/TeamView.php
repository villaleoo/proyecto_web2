<?php 
class TeamView{


    public function renderTeamsList($arrData){
        require('./app/templates/teamList.phtml');

    }
    public function renderTeam($teamData){
        require('./app/templates/teamDetail.phtml');
    }
}

?>