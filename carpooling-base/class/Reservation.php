<?php 

namespace App;


class Reservation
{

    // Déclaraition des attributs
    private $id;
    private $id_voiture;
    private $id_covoiturage;
    private $name_client;
    private $tele_client;
    private $mail_client 

    
    // Le constructeur de la classe Reservation, elle sera ensuite exécutée pour initaliser les attributs de la classe.
    public function __construct($id,$id_voiture,$id_covoiturage,$name_client,$tele_client,$mail_client)
    {
        $this->id = $id;
        $this->id_voiture = $id_voiture;
        $this->id_covoiturage = $id_covoiturage;
        $this->name_client = $name_client;
        $this->tele_client = $tele_client;
        $this->mail_client = $mail_client;
    }


    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id) : void
    {
        $this->id = $id;
    }


    public function getIdVoiture() : int
    {
        return $this->id_voiture;
    }

    public function setIdVoiture($id_voiture) : void
    {
        $this->id_voiture = $id_voiture;
    }


    public function getIdCovoiturage() : int
    {
        return $this->id_covoiturage;
    }

    public function setIdCovoiturage($id_covoiturage) : void
    {
        $this->id_covoiturage = $id_covoiturage;
    }


    public function getNameClient() : String
    {
        return $this->name_client;
    }

    public function setNameClient($name_client) : void
    {
        $this->name_client = $name_client;
    }


    public function getTeleClient() : int
    {
        return $this->tele_client;
    }

    public function setTeleClient($tele_client) : void
    {
        $this->tele_client = $tele_client;
    }


    public function getMailClient() : String
    {
        return $this->mail_client;
    }

    public function setMailClient($mail_client) : void
    {
        $this->mail_client = $mail_client;
    }

}