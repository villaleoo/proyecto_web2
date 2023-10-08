<?php 

class LayoutView {
  
    /*renderHeader requiere 2 parametos, lo datos de utilidad de la bbdd (params)(opcional por si no se necesita nada de la bbdd) 
    y el titulo de la seccion con la cual se va a renderizar */
    public function renderHeader($params = null, $title){
        require('./app/templates/layout/header.phtml');
    }
    /*renderFooter posee un parametro opcional por si necesita algun tipo de informacion de la bbdd o de la seccion*/
    public function renderFooter($params =null){
        require('./app/templates/layout/footer.phtml');
    }

}


?>