<?php
require_once './app/view/LayoutView.php';
/*se comunica con controladores que necesiten una vista web (header, footer, otras secciones genericas)*/
class LayoutController {
    private $layoutView;

    public function __construct(){
        $this->layoutView= new LayoutView();
    }

    /*si necesita informacion de la bbdd en cualquiera de las secciones genericas, la pide a los controladores de las tablas bbdd */
    /*POR EJEMPLO CREAR NAVBARS CON MUCHOS DATOS -> LIGAS-> [liga1,liga2,liga3] */
    public function getCategories(){
        // $leagues= $this->leagueController->getLeagues();
        // $teams = $this->teamController->getTeams();
      
        /*por el momento no se hace pedido a la bbdd pero podria hacerse */
        $categories= array("ligas" =>["liga1","liga2"], "clubes" =>["equipo1", "equipo2"]);    /*guarda categorias e items */
     
        return $categories;
    }

    /*pide las categorias que puede mostrar y renderiza el header, ademas se le pasa por parametro el titulo de la seccion con la que se va a mostrar el header
    en caso de que haya una seccion sin header, no caberia en este layout y se debera establecer un mecanismo de titulo para esa seccion en particular (un html nuevo)
    ya que le html del header se usa como plantilla en todo el sitio*/
    public function showHeader($title){
        $categories= $this->getCategories();
        $titleTransform = strtoupper(substr($title, 0, 1)) . substr($title, 1); 
        $this->layoutView->renderHeader($categories, $titleTransform);
    }
    /*muestra el footer y puede pedir categorias si lo desea a traves de getCategories */
    public function showFooter(){
        $this->layoutView->renderFooter();
    }


}


?>