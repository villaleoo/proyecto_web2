<?php
require_once './app/controller/LeagueController.php';
require_once './app/controller/TeamController.php';
require_once './app/view/LayoutView.php';
/*La clase layout por ser solo una clase creada para ordenar la vista del sitio, solo se comunica con controladores (no con modelos) 
y les solicita que le brinden informacion de la bbdd para mostrar la informacion en el header o en el footer, de esta manera se puede tener informacion dinamica en
todas las secciones que incluyan un header y un footer. Esto serviria para por ejemplo mostrar un boton que diga "LIGAS" en la navbar y desplace varios items mas con todas
las ligas, que el usuario pueda hacer click en esa liga y direccionarlo a esa liga*/

/*Layout controller puede tener showHeader,showFooter o secciones como sidebar u otras que necesiten de informacion de las ligas y equipos */
class LayoutController {
    private $leagueController;   /*Para mostrar la informacion de inicio (categorias e items),el controlador del home necesita comunicarse con las categorias y los items */
    private $teamController;
    private $layoutView;

    public function __construct(){
        $this->leagueController= new LeagueController();
        $this->teamController= new TeamController();
        $this->layoutView= new LayoutView();
    }

    /*la funcion getCategories le pide a los controladores de categorias(ligas) e items(equipos) que le traiga los datos y los guarda y retorna en un arreglo asociativo */
    /*en el caso que no se necesite toda la info se pueden no pedir datos (por ejemplo traer solo las ligas pq el header no muestra mas que las ligas ) */
    public function getCategories(){
        // $leagues= $this->leagueController->getLeagues();
        // $teams = $this->teamController->getTeams();
        /*OBTENGO EL CAMPO "ENTIDAD" COMBINANDO LIGAS Y CLUBES*/
        $categories= array("ligas" =>["liga1","liga2"], "equipos" =>["equipo1", "equipo2"]);    /*arreglo asociativo que guarda categorias e items */

        return $categories;
    }

    /*pide las categorias que puede mostrar y renderiza el header, ademas se le pasa por parametro el titulo de la seccion con la que se va a mostrar el header
    en caso de que haya una seccion sin header, no caberia en este layout y se debera establecer un mecanismo de titulo para esa seccion en particular (un html nuevo)
    ya que le html del header se usa como plantilla en todo el sitio*/
    public function showHeader($title){
        $categories= $this->getCategories();
        $this->layoutView->renderHeader($categories, $title);
    }
    /*muestra el footer y puede pedir categorias si lo desea a traves de getCategories */
    public function showFooter(){
        $this->layoutView->renderFooter();

    }


}


?>