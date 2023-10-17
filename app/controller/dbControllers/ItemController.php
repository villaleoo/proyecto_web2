<?php 
include_once './app/controller/siteControllers/LayoutController.php';
abstract class ItemController{
    protected $layout;
    protected $view;
    protected $model;

    /*esta clase une comportamientos/funciones que van a tener los controladores de ligas y equipos*/
    /*la vista y el modelo la determinan las clases hijas (leagueController y teamController) */
    public function __construct($view, $model){
        $this->layout = new LayoutController();
        $this->view= $view;
        $this->model= $model;
    }

    public function getArrItems(){                                        
        $arrItems= $this->model->getAllItems();
        return $arrItems;
    }

    public function getIndexByItemId($id){                                              
        $pos=0;

        while ($pos < count($this->getArrItems()) && $this->getArrItems()[$pos]->id != intval($id) ) {
            $pos++;
        }

        if($pos < count($this->getArrItems()) ){
            return $pos;
        }
        return -1;
    }

    public function getItem($id){                                       
        $item= $this->model->getItem($id);
        return $item;
    }

    public function addItem($item){ 
        $newItem= $this->_toLowerCaseData($item);                                   
        $this->model->addItem($newItem);
    }

    public function updateItem($item){  
        $itemEdit= $this->_toLowerCaseData($item);                               
        $this->model->updateItem($itemEdit);
    }

    public function removeItem($id){                                    
        if($this->getIndexByItemId(intval($id)) >= 0){
            $this->model->deleteItem(intval($id));

        }else{
            $this->layout->showHeader("error");
            $this->showError();
            $this->layout->showFooter();
        }
    }
    
    public function showItemList($titleSection){                                            
        $this->layout->showHeader($titleSection);
        $this->view->renderItemList($this->getArrItems());
        $this->layout->showFooter();
    }
    
    /*a esta funcion le llega la informacion de un form y transforma toda la data string a letra minuscula para guardarla en la bbdd */
    private function _toLowerCaseData($item){
        $formData= $item[0];
        foreach ($formData as $input => $value) {
            if (is_string($value)) { 
                $formData[$input] = strtolower($value); 
            }
        }
        $item = array(0 => $formData, 1=> $item[1]);
        
        return $item;
    }
    
    public function showError(){
        $this->view->renderError();
    }
    
    public abstract function showItemDetail($id);

}



?>