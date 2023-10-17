<?php
require_once './app/view/LeagueView.php';
require_once './app/model/LeaguesModel.php';
require_once './app/controller/dbControllers/ItemController.php';

class LeagueController extends ItemController{

    public function __construct(){
        parent::__construct(new LeagueView(), new LeaguesModel());
    }

    public function showItemDetail($id){                                         
        $arrItems= $this->getArrItems();
       
        if($this->getIndexByItemId($id) >= 0){
            $posInArray=$this->getIndexByItemId($id);
            
            $arrTeamsOfLeague=$this->model->getTeamsOfLeague($arrItems[$posInArray]->id); /*buscar en la tabla de clubes todos los clubes q tengan este id de liga */
            
            $arrData= array($arrItems[$posInArray]->entidad =>$arrItems[$posInArray], "clubes" => $arrTeamsOfLeague);

            $this->layout->showHeader($arrItems[$posInArray]->nombre);
            $this->view->renderItemDetail($arrData);
            $this->layout->showFooter();
        }else{
            $this->layout->showHeader("Error");
            $this->showError();
            $this->layout->showFooter();
        }
    }


}


?>