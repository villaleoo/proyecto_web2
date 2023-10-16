<?php
include_once './app/view/ItemView.php';
class LeagueView extends ItemView{

    public function renderItemList($arrData){
        require('./app/templates/categoryTemplates/leagueList.phtml');

    }
    public function renderItemDetail($arrData){
        require('./app/templates/categoryTemplates/leagueDetail.phtml');
    }
    


    
}
?>