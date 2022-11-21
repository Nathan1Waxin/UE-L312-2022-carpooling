<?php

namespace App\Services;

use App\Entities\Covoiturage;

class CovoituragesService
{
    /**
     * créer ou mettre à jour une annonce de covoiturage
     */
    public function setCovoiturage(?int $id, String $pointstart, $pointend, $date, int $available_place, int $price): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createCovoiturage($id,$pointstart,$pointend,$date,$available_place,$price);
        } else {
            $isOk = $dataBaseService->updateCovoiturage($id,$pointstart,$pointend,$date,$available_place,$price);
        }

        return $isOk;
    }

    /**
     * retourner toutes les annonces de covoiturages
     */
    public function getCovoiturages(): array
    {
        $covoiturages = [];

        $dataBaseService = new DataBaseService();
        $covoituragesDTO = $dataBaseService->getCovoiturages();
        if (!empty($voituresDTO)) {
            foreach ($covoituragesDTO as $covoiturageDTO) {
                $covoiturage = new Covoiturage();
                $covoiturage->setId($covoiturageDTO['id']);
                $covoiturage->setPointstart($covoiturageDTO['pointstart']);
                $covoiturage->setPointend($covoiturageDTO['pointend']);
                $covoiturage->setDate($covoiturageDTO['date']);
                $covoiturage->setAvailableplace($covoiturageDTO['available_place']);
                $covoiturage->setPrice($covoiturageDTO['price']);
                $covoiturages[] = $covoiturage;
            }
        }
        return $covoiturages;
    }

    /**
     * supprimer une annonce de covoiturage
     */
    public function deleteCovoiturage(int $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCovoiturage($id);

        return $isOk;
    }
}
