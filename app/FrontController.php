<?php
namespace myFramework;

class FrontController
{
    private $router;
    public function __construct()
    {

    // On crée un objet $router avec AltoRouter
    // On utilise l'antislash pour retourner à la racine des namespace
    // Ici dans les vendors
    $this->router = new \AltoRouter();
    // La clé BASE_URI a été créée via le .htaccess
    $this->router->setBasePath($_SERVER['BASE_URI']);
    // On utilise cet objet pour mapper les routes et les associer à nos contrôleurs
    // MainController#home => Controller#method
    // 'home' => nom de la route
    $this->mapRoutes();
    }

    public function mapRoutes()
    {
        // MAINCONTROLLER
        $this->router->map('GET','/','MainController#home', 'home');
        $this->router->map('GET','/lists','MainController#lists', 'list');
        // $this->router->map('GET','/mentions-legales', 'MainController#mentionsLegales', 'mentions-legales');

    }

    public function run()
    {
    /* Match the current request 
    * MATCHING DISPATCHER
    */
    $match = $this->router->match();

    // dump($match);
    if($match === false) {
        // Si aucun match n'a été trouvé par AltoRouter,
        // On envoie la page 404
        $controllerName = 'ErrorController';
        $methodName = 'notFound';
    
    }else {
        // Je sépare les 2 parties se trouvant dans "target" ('MainController#home')
        $controllerAndMethod = explode('#', $match['target']);
        // dump($controllerAndMethod); // debug

        // Je stocke les noms dans des variables
        $controllerName = $controllerAndMethod[0];
        // echo '<br>$controllerName='.$controllerName.'<br>';
        $methodName = $controllerAndMethod[1];
    }
        // on appelle le namespace alors on concatene le namespace au controller (nom de la classe)
        $controllerName = 'myFramework\Controllers\\'.$controllerName;
        // J'instancie le controller
        // PHP va remplacer la variable $controllerName par sa valeur
        // puis va instancier la bonne classe "new MainController()" par exemple
        $controller = new $controllerName($this->router);

        // J'appelle la méthode correspond à la route
        // PHP va remplacer la variable $methodName par sa valeur
        // puis va appeler la bonne méthode "->home()" par exemple
        // On passe en argument le tableau des paramètres dynamiques de la route matchée
        $controller->$methodName($match['params']);

    
    }
}