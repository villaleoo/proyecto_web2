<?php 
include_once './app/controller/adminController/AdminController.php';
include_once './app/controller/dbControllers/LeagueController.php';

class AdminLeagueController extends AdminController {
    
    public function __construct(){
        parent::__construct(new LeagueController(), "ligas", 11);
        
    }

    public function showCRUD($arrData, $idItemEdit= null){
        if($idItemEdit){
            $leagueEdit= $this->getItemById($idItemEdit);
            if($leagueEdit){
                $this->view->renderLeagueCRUD($arrData,null,$leagueEdit); 
            }else{
                $this->showError();
            }
            
        }else{
            $this->view->renderLeagueCRUD($arrData);
        }

    }
    
    public function getData(){
        $arrData;
        $arrItems= $this->controller->getArrItems();
        $arrData= array($this->titleSection => $arrItems, "categoria" => $this->titleSection);

        return $arrData;
    }

    public function showErrorForm($arrData, $idItemEdit=null ){
        $leagueEdit=null;
        if($idItemEdit){
            $leagueEdit= $this->getItemById($idItemEdit);
        }
        $this->layout->showHeader("Admin");
        $this->view->renderLeagueCRUD($arrData, "Campo/s requeridos incompleto/s.", $leagueEdit);
        $this->layout->showFooter();
    }





   

   

}





?>