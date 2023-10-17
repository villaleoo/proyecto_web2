<?php 
abstract class ItemView{
    public abstract function renderItemList($arrData);
    public abstract function renderItemDetail($arrData);
    public function renderError(){
        require('./app/templates/error/genericError.phtml');
    }

}

?>