<?php 
class AdminView{


    public function renderTeamCRUD($arrData, $errorForm = null, $teamEdit=null){
        require('./app/templates/adminItemList.phtml');

        if(isset($teamEdit)){
            require('./app/templates/forms/updateTeam.phtml');
        }else{
            require('./app/templates/forms/formTeam.phtml');
        }   
    }

    public function renderLeagueCRUD($arrData, $errorForm = null, $leagueEdit=null){
        require('./app/templates/adminCategoryList.phtml');

        if(isset($leagueEdit)){
            require('./app/templates/forms/updateLeague.phtml');
        }else{
            require('./app/templates/forms/formLeague.phtml');
        }  
    }

    public function renderDeleteItem($item = null, $category){
        require('./app/templates/forms/deleteItem.phtml');
    }


}


?>