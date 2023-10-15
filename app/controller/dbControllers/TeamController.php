<?php
include_once './app/model/TeamsModel.php';
include_once './app/view/TeamView.php';
require_once './app/controller/dbControllers/ItemController.php';

class TeamController extends ItemController{
   
    public function __construct(){
        parent::__construct(new TeamView(),new TeamsModel());
        
    }

    public function showItemDetail($id){                                         
        $arrItems= $this->getArrItems();
       

        if($this->getIndexByItemId($id) >= 0){
            $posInArray=$this->getIndexByItemId($id);
            $title = strtoupper(substr($arrItems[$posInArray]->nombre, 0, 1)) . substr($arrItems[$posInArray]->nombre, 1); 
            
            $nameOfLeague=$this->model->getNameOfLeague($arrItems[$posInArray]->id_liga);
            
            $arrData= array($arrItems[$posInArray]->entidad =>$arrItems[$posInArray], "liga" => $nameOfLeague);

            $this->layout->showHeader($title);
            $this->view->renderItemDetail($arrData);
            $this->layout->showFooter();
        }else{
            echo "404 ERROR CLUB INEXISTENTE";
        }
    }
  
}
?>