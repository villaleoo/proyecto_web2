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
            $title = strtoupper(substr($arrItems[$posInArray]->nombre, 0, 1)) . substr($arrItems[$posInArray]->nombre, 1); 
            
            $arrTeamsOfLeague=$this->model->getTeamsOfLeague($arrItems[$posInArray]->id); /*buscar en la tabla de clubes todos los clubes q tengan este id */
            
            $arrData= array($arrItems[$posInArray]->entidad =>$arrItems[$posInArray], "clubes" => $arrTeamsOfLeague);

            $this->layout->showHeader($title);
            $this->view->renderItemDetail($arrData);
            $this->layout->showFooter();
        }else{
            echo "404 ERROR CLUB INEXISTENTE";
        }
    }


}


?>