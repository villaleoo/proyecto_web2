<?php
include_once './app/controller/adminController/AdminController.php';
include_once './app/controller/dbControllers/TeamController.php';
include_once './app/controller/dbControllers/LeagueController.php';

class AdminTeamController extends AdminController{
    private $secondaryController;
    
    public function __construct(){
        parent::__construct(new TeamController(), "clubes", 16);
        $this->secondaryController= new LeagueController();
    }

    public function showCRUD($arrData, $idItemEdit= null){
        if($idItemEdit){
            $teamEdit= $this->getItemById($idItemEdit);
            if($teamEdit){
                $this->view->renderTeamCRUD($arrData,null,$teamEdit); 
            }else{
                $this->showError();
            }
            
        }else{
            $this->view->renderTeamCRUD($arrData);
        }
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

    public function getData(){
        $arrData;
        $arrTeams=$this->controller->getArrItems();
        $arrLeagues= $this->secondaryController->getArrItems();
        $arrData= array($this->titleSection => $arrTeams, "ligas" => $arrLeagues, "categoria" => $this->titleSection);

        return $arrData;
    }



  


    


}





?>