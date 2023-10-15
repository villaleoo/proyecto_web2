<?php
include_once './app/model/TeamsModel.php';
include_once './app/view/TeamView.php';
include_once './app/controller/siteControllers/LayoutController.php';

class TeamController{
    private $model;
    private $view;
    private $layout;
    
    public function __construct(){
        $this->model= new TeamsModel();
        $this->view=new TeamView();
        $this->layout = new LayoutController();
        
    }

    public function getTeams(){                                                     /*COMPARTE CON LIGAS */
        $arrTeams= $this->model->getTeams();
        return $arrTeams;
    }

    public function showTeamsList(){                                            /*COMPARTE CON LIGAS */
       
        $this->layout->showHeader("Clubes");
        $this->view->renderTeamsList($this->getTeams());
        $this->layout->showFooter();
    }

    public function getIndexTeam($teamId){                                              /*COMPARTE CON LIGAS */
        $pos=0;

        while ($pos < count($this->getTeams()) && $this->getTeams()[$pos]->id_club != intval($teamId) ) {
            $pos++;
        }

        if($pos < count($this->getTeams()) ){
            return $pos;
        }
        return -1;
    }

    

    public function showTeam($teamId){                                          /*COMPARTE CON LIGAS */
        $arrTeams= $this->getTeams();
       

        if($this->getIndexTeam($teamId) >= 0){
            $posInArrayTeam=$this->getIndexTeam($teamId);
            $title = strtoupper(substr($arrTeams[$posInArrayTeam]->nombre, 0, 1)) . substr($arrTeams[$posInArrayTeam]->nombre, 1); 
            $leagueOfTeam=$this->model->getLeagueNameOfTeam($arrTeams[$posInArrayTeam]->id_liga);
            
            $dataTeam= array("equipo"=>$arrTeams[$posInArrayTeam], "liga" => $leagueOfTeam);

            $this->layout->showHeader($title);
            $this->view->renderTeam($dataTeam);
            $this->layout->showFooter();
        }else{
            echo "404 ERROR CLUB INEXISTENTE";
        }
    }

    public function getTeam($id){                                       /*COMPARTE CON LIGAS */
        $team= $this->model->getTeam($id);
        return $team;
    }

    public function updateTeam($team){                                  /*COMPARTE CON LIGAS */
       $this->model->updateTeam($team);
    }
    public function addTeam($team){                                     /*COMPARTE CON LIGAS */
        $this->model->addTeam($team);
    }

    public function removeTeam($idTeam){                                    /*COMPARTE CON LIGAS */
        if($this->getIndexTeam(intval($idTeam)) > 0){
            $this->model->deleteTeam(intval($idTeam));

        }else{
            echo "ERROR NO EXISTE teamController";
        }
    }
    
}
?>