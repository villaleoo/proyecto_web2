<?php 
require_once './app/controller/siteControllers/LayoutController.php';
require_once './app/controller/dbControllers/LeagueController.php';
require_once './app/controller/dbControllers/TeamController.php';
require_once './app/view/HomeView.php';

class HomeController {
    private $title;
    private $layoutController;   /*Esto se siguio con la logica de: el home tiene un header y un footer por lo tanto tiene una relacion con el layout */
    private $leagueController;      
    private $teamController;    /*puede tener relacion con los controladores de ligas y equipos si necesita info de la bbdd de las ligas y equipos */
    private $view;

    public function __construct(){
        $this->title= "Inicio";
        $this->layoutController= new LayoutController();
        $this->leagueController= new LeagueController();
        $this->teamController= new TeamController();
        $this->view=new HomeView();
        
    }


    /*getData funciona igual a la que esta contenida en LayoutController, en caso de necesitar info de la bbdd que se muestre en el home se hace uso*/
    public function getData(){
        
        $categories= array("ligas" =>["liga1","liga2"], "equipos" =>["equipo1", "equipo2"]);    /*arreglo asociativo que guarda categorias e items */

        return $categories;

    }

   /*la funcion showHome le pide al controlador layout que renderice el header, manda a renderizar el contenido del home y luego pide layout que renderice el footer  */
   /*le puedo pedir al layout que me mande a renderizar otras secciones que esten viculadas al layout */
    public function showHome(){
        $homeData= $this-> getData();

        $this->layoutController->showHeader($this->title);
        $this->view->renderHome($homeData);    
        $this->layoutController->showFooter();
    }
}
?>