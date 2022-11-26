<?php

namespace App\Entities;

use DateTime;


class Covoiturage
{
    private $id;
    private $pointstart;
    private $pointend;
    private $datee;
    private $available_place;
    private $price;

    // Le constructeur de la classe reservation, elle sera ensuite exécutée pour initaliser les attributs de la classe.
    // public function __construct($id,$pointstart,$pointend,$datee,$available_place,$price)
    // {
    //     $this->id = $id;
    //     $this->pointstart = $pointstart;
    //     $this->pointend = $pointend;
    //     $this->_ate = $datee;
    //     $this->available_place = $available_place;
    //     $this->price = $price;
    // }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPointstart(): string
    {
        return $this->pointstart;
    }

    public function setPointstart(string $pointstart): void
    {
        $this->pointstart = $pointstart;
    }

    public function getPointend(): string
    {
        return $this->pointend;
    }

    public function setPointend(string $pointend): void
    {
        $this->pointend = $pointend;
    }

    public function getAvailableplace(): int
    {
        return $this->available_place;
    }

    public function setAvailableplace(int $available_place): void
    {
        $this->available_place = $available_place;
    }

    public function getDate(): DateTime
    {
        return $this->datee;
    }

    public function setDate(DateTime $datee): void
    {
        $this->datee = $datee;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}