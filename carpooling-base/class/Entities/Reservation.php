<?php 

namespace App\Entities;


class Reservation
{

    // Déclaraition des attributs
    private $id;
    private $name_client;
    private $tele_client;
    private $mail_client;

    // Le constructeur de la classe Reservation, elle sera ensuite exécutée pour initaliser les attributs de la classe.
    // public function __construct($id,$name_client,$tele_client,$mail_client)
    // {
    //     $this->id = $id;
    //     $this->name_client = $name_client;
    //     $this->tele_client = $tele_client;
    //     $this->mail_client = $mail_client;
    // }


    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id) : void
    {
        $this->id = $id;
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

?>