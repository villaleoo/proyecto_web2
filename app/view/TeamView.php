<?php 
include_once './app/view/ItemView.php';

class TeamView extends ItemView{
    public function renderItemList($arrData){
        require('./app/templates/itemTemplates/teamList.phtml');

    }
    public function renderItemDetail($arrData){
        require('./app/templates/itemTemplates/teamDetail.phtml');
    }
}

?>