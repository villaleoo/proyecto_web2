<?php
include_once './app/view/ItemView.php';
class LeagueView extends ItemView{

    public function renderItemList($arrData){
        require('./app/templates/leagueList.phtml');

    }
    public function renderItemDetail($arrData){
        require('./app/templates/leagueDetail.phtml');
    }


    
}
?>