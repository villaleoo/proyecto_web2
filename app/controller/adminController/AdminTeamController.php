<?php
include_once './app/controller/adminController/AdminController.php';
include_once './app/controller/dbControllers/TeamController.php';
include_once './app/controller/dbControllers/LeagueController.php';

class AdminTeamController extends AdminController{
    private $secondaryController;
    private $quantityData=14;

    public function __construct(){
        parent::__construct(new TeamController(), "clubes");
        $this->secondaryController= new LeagueController();
    }


    public function showErrorForm($arrData , $idItemEdit = null){
        $teamEdit=null;
        if($idItemEdit){
            $teamEdit= $this->_getTeamById($idItemEdit);
        }
        $this->layout->showHeader("Admin");
        $this->view->renderTeamCRUD($arrData, "Campo/s requeridos incompleto/s.", $teamEdit);
        $this->layout->showFooter();
    }


    public function createNewItem($postContent){
        $newTeam= array(0 => $postContent, 1 => 'club');
        $this->controller->addItem($newTeam);
    }


    public function getData(){
        $arrData;
        $arrTeams=$this->controller->getArrItems();
        $arrLeagues= $this->secondaryController->getArrItems();
        $arrData= array($this->titleSection => $arrTeams, "ligas" => $arrLeagues, "categoria" => $this->titleSection);

        return $arrData;
    }

    public function showCRUD($arrData, $idItemEdit= null){
        if($idItemEdit){
            $teamEdit= $this->_getTeamById($idItemEdit);
            if($teamEdit){
                $this->view->renderTeamCRUD($arrData,null,$teamEdit); /*agregar param team */
            }else{
                $this->showError();
            }
            
        }else{
            $this->view->renderTeamCRUD($arrData);
        }
    }

    private function _getTeamById($id){
        if($this->controller-> getIndexByItemId($id) < 0){
            return null;
        }
        $team= $this->controller->getItem($id);
        return $team;
    }

    public function validationLenghtInput($arrForm){
        return count($arrForm) != $this->quantityData;
    }


    


}





?>