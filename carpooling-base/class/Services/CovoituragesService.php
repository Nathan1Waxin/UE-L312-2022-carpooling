<?php

namespace App\Services;

use App\Entities\Covoiturage;
use App\Entities\Voiture;

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
            $isOk = $dataBaseService->createCovoiturage($id, $pointstart, $pointend, $date, $available_place, $price);
        } else {
            $isOk = $dataBaseService->updateCovoiturage($id, $pointstart, $pointend, $date, $available_place, $price);
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

            /* Get exemple of this covoiturage :
            $exemples = $this->getCovoiturageExemples($covoiturageDTO['id']);
            $covoiturage->setExemples($exemples);*/

            // Get voiture of this covoiturage :
            $voitures = $this->getCovoiturageVoitures($covoiturageDTO['id']);
            $covoiturage->setVoitures($voitures);
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

    /*
    public function getCovoiturageExemples(string $covoiturageId): array
    {
        $covoituragesExemples = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and exemples :
        $covoituragesExemplesDTO = $dataBaseService->getCovoiturageExemples($covoiturageId);
        if (!empty($covoituragesExemplesDTO)) {
            foreach ($covoituragesExemplesDTO as $covoituragesExemplesDTO) {
                $exemple = new Exemple();
                $exemple->setId($covoituragesExemplesDTO['id']);
                $exemple->setModel($covoituragesExemplesDTO['class1']);
                $exemple->setColor($covoituragesExemplesDTO['class2']);
                $exemple->setVitesseMax($covoituragesExemplesDTO['class3']);
                $covoituragesExemples[] = $exemple;
            }
        }

        return $covoituragesExemples;
    }
    */

    public function getCovoiturageVoitures(string $covoiturageId): array
    {
        $covoituragesVoitures = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $covoituragesVoituresDTO = $dataBaseService->getCovoiturageVoitures($covoiturageId);
        if (!empty($covoituragesVoituresDTO)) {
            foreach ($covoituragesVoituresDTO as $covoituragesVoitureDTO) {
                $voiture = new Voiture();
                $voiture->setId($covoituragesVoitureDTO['id']);
                $voiture->setModel($covoituragesVoitureDTO['model']);
                $voiture->setColor($covoituragesVoitureDTO['coleur']);
                $voiture->setVitesseMax($covoituragesVoitureDTO['vitessemax']);
                $covoituragesVoitures[] = $voiture;
            }
        }

        return $covoituragesVoitures;
    }
}
