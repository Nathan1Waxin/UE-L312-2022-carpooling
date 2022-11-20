<?php

namespace covoiturage;

class covoiturage
{
    private $id;
    private $nomentreprise;
    private $adresse;
    private $datefondation;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getNomentreprise(): string
    {
        return $this->nomentreprise;
    }

    public function setNomentreprise(string $nomentreprise): void
    {
        $this->nomentreprise = $nomentreprise;
    }

    public function getPointend(): string
    {
        return $this->pointend;
    }

    public function setPointend(string $pointend): void
    {
        $this->pointend = $pointend;
    }

    public function getAdresse(): string
    {
        return $this-> adresse;
    }

    public function setAdresse( string $adresse): void
    {
        $this-> adresse = $adresse;
    }

    public function getDatefondation(): DateTime
    {
        return $this->datefondation;
    }

    public function setDatefondation(DateTime $datefondation): void
    {
        $this->datefondation = $datefondation;
    }
}
