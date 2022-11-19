<?php

namespace covoiturage;

class covoiturage
{
    private $id;
    private $pointstart;
    private $pointend;
    private $date;
    private $available_place;
    private $price

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
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
        return $this->availableplace;
    }

    public function setAvailableplace($available_place): void
    {
        $this->availableplace = $available_place;
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

    public function setPrice($): void
    {
        $this->price = $price;
    }
}