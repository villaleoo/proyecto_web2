<?php 
include_once './app/controller/adminController/AdminController.php';
include_once './app/controller/dbControllers/LeagueController.php';

class AdminLeagueController extends AdminController {
    private $quantityData=11;
    public function __construct(){
        parent::__construct(new LeagueController(), "ligas");
        
    }

    public function showErrorForm($arrData, $idItemEdit=null ){
        $leagueEdit=null;
        if($idItemEdit){
            $leagueEdit= $this->_getLeagueById($idItemEdit);
        }
        $this->layout->showHeader("Admin");
        $this->view->renderLeagueCRUD($arrData, "Campo/s requeridos incompleto/s.", $leagueEdit);
        $this->layout->showFooter();
    }

    public function createNewItem($postContent){
        $newLeague= array(0 => $postContent, 1 => 'liga');
        $this->controller->addItem($newLeague);
    }


    public function getData(){
        $arrData;
        $arrItems= $this->controller->getArrItems();
        $arrData= array($this->titleSection => $arrItems, "categoria" => $this->titleSection);

        return $arrData;
    }


    public function showCRUD($arrData, $idItemEdit= null){
        if($idItemEdit){
            $leagueEdit= $this->_getLeagueById($idItemEdit);
            if($leagueEdit){
                $this->view->renderLeagueCRUD($arrData,null,$leagueEdit); /*agregar param team */
            }else{
                $this->showError();
            }
            
        }else{
            $this->view->renderLeagueCRUD($arrData);
        }

    }

    private function _getLeagueById($id){
        if($this->controller-> getIndexByItemId($id) < 0){
            return null;
        }

        $league= $this->controller->getItem($id);
        return $league;

    }
    public function validationLenghtInput($arrForm){
        return count($arrForm) != $this->quantityData;
    }

}





?>