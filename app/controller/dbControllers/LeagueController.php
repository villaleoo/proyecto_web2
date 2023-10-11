<?php
require_once './app/view/LeagueView.php';
require_once './app/model/LeaguesModel.php';

class LeagueController {
    private $view;
    private $model;

    public function __construct(){
        $this->view= new LeagueView();
        $this->model= new LeaguesModel();
    }

    




}


?>