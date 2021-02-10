<?php
// Attention c'est un antislash
namespace myFramework\Controllers;

class MainController extends CoreController {
    public function home()
    {
        // $dbData = new DBData();

        $this->show('home',[
            'title' => "accueil"
        ]);
            
            // 'homeCategories' => $dbData->getHomeCategories()
    
    }
    public function mentionsLegales()
    {
        $this->show('layout/mentions-legales');
    }
   
    public function lists(){
        // On crée une instance de la base de donnée
        // ex : $dbData = new DBdata ne pas oublié le "use"
        // On récupère les infos
        // ex: $list = $dbData->getLists
        //  et on les affiche
        // dump($list);
        echo 'je retourne les donnees';
    }
    // TEST
    // Le model étend du CoreModel il herite de sa methode findAll en déclarant dans le modele la proprité table  ex protected static $table = 'list';
    // public function getLists()
    // {
    //     $lists = ListModel::findAll();
    //     dump($lists);
    // }
}