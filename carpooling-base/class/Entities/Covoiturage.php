<?php

namespace App\Entities;

use DateTime;

class Covoiturage
{
    private $id;
    private $pointstart;
    private $pointend;
    private $date;
    private $available_place;
    private $price;

    // Le constructeur de la classe reservation, elle sera ensuite exécutée pour initaliser les attributs de la classe.
    // public function __construct($id,$pointstart,$pointend,$date,$available_place,$price)
    // {
    //     $this->id = $id;
    //     $this->pointstart = $pointstart;
    //     $this->pointend = $pointend;
    //     $this->date = $date;
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

    public function setAvailableplace($available_place): void
    {
        $this->available_place = $available_place;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getVoitures(): ?array
    {
        return $this->voitures;
    }

    public function setVoitures(array $voitures)
    {
        $this->voitures = $voitures;

        return $this;
    }
}
