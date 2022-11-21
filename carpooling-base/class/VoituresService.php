<?php

namespace App;

class VoituresService
{
    /**
     * Return all the animals.
     */
    public function getAnimals(): array
    {
        $animals = [];

        // Get animals from database :
        $databaseService = new DataBaseService();
        $animalsDTO = $databaseService->getAnimals();

        // Get objects from array :
        foreach ($animalsDTO as $animalDTO) {
            $animal = new AnimalModel();
            if (!empty($animalDTO['sound'])) {
                $animal->setSound($animalDTO['sound']);
            }
            $animals[] = $animal;
        }

        return $animals;
    }
}
