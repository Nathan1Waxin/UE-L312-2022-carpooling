<?php 

namespace App;

class Voiture{

    // Déclaraition des attributs
    private $model;
    private $couleur;
    private $vitesseMax;

    
    // Le constructeur de la classe voiture, elle sera ensuite exécutée pour initaliser les attributs de la classe.
    public function __construct($model,$couleur,$vitesseMax)
    {
        $this->model = $model;
        $this->couleur = $couleur;
        $this->vitesseMax = $vitesseMax;
    }


    // le but de cette fonction est de retourner toute les informations sur la voiture
    public function info() : string
    {
        return "Il s'agit d'une voiture de model " . $this->model . ", de couleur " . $this->couleur . ", et elle a une vitesse maximum qui s\'eleve à " . $this->vitesseMax .".";
    }


    //cette méthode retourne le model de la voiture
    public function getModel() : string
    {
        return $this->model;
    }


    //cette méthode change la valeur du model de la voiture, la methode strlen() s'assure de ne pas entrer une valeure null.
    public function setModel($modelX) : void
    {
        if(strlen($modelX) !=0 ) 
        {
            $this->model = $modelX;
        }
    }


    //cette méthode retourne le couleur de la voiture
    public function getCouleur() : string
    {
        return $this->couleur;
    }


    //cette méthode change la valeur de la couleur de la voiture.
    public function setCouleur($couleurX) : void
    {
        if(strlen($couleurX) !=0 ) 
        {
            $this->couleur = $couleurX;
        }
    }


    //cette méthode retourne le vitesse maximum de la voiture
    public function getVitesseMaxi() : int
    {
        return $this->vitesseMaxi;
    }


    //cette méthode change la valeur de la vitesse de la voiture. la vitesse max de la voiture doit être généralement entre 60 et 500.
    public function setVitesse($vitesseX) : void
    {
        if($vitesseX > 60 && $vitesseX < 500) 
        {
            $this->vitesseMax = $vitesseX;
        }
    }

}

?>