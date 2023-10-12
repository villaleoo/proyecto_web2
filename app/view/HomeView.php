<?php

class HomeView  {
    /*renderHome tiene un parametro opcional por si se desea mostrar alguna informacion de la bbdd */
    public function renderHome($homeData = null){
        require('./app/templates/index.phtml');
    
    }
}


?>