<?php 
include_once './app/controller/siteControllers/LayoutController.php';
abstract class ItemController{
    protected $layout;
    protected $view;
    protected $model;

    public function __construct($view, $model){
        $this->layout = new LayoutController();
        $this->view= $view;
        $this->model= $model;
    }

    public function getArrItems(){                                                     /*COMPARTE CON LIGAS */
        $arrItems= $this->model->getAllItems();
        return $arrItems;
    }

    public function getIndexByItemId($id){                                              /*COMPARTE CON LIGAS */
        $pos=0;

        while ($pos < count($this->getArrItems()) && $this->getArrItems()[$pos]->id != intval($id) ) {
            $pos++;
        }

        if($pos < count($this->getArrItems()) ){
            return $pos;
        }
        return -1;
    }

    public function getItem($id){                                       /*COMPARTE CON LIGAS */
        $item= $this->model->getItem($id);
        return $item;
    }

    public function addItem($item){                                     /*COMPARTE CON LIGAS */
        $this->model->addItem($item);
    }

    public function updateItem($item){                                  /*COMPARTE CON LIGAS */
        $this->model->updateItem($item);
    }

    public function removeItem($id){                                    /*COMPARTE CON LIGAS */
        if($this->getIndexByItemId(intval($id)) > 0){
            $this->model->deleteItem(intval($id));

        }else{
            echo "ERROR NO EXISTE teamController";
        }
    }
    
    public function showItemList($titleSection){                                            /*COMPARTE CON LIGAS */
       
        $this->layout->showHeader($titleSection);
        $this->view->renderItemList($this->getArrItems());
        $this->layout->showFooter();
    }
    
    public abstract function showItemDetail($id);


}



?>