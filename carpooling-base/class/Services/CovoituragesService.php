<?php

namespace App\Services;

use App\Entities\Covoiturage;
use DateTime;

class CovoituragesService
{
    /**
     * créer ou mettre à jour une annonce de covoiturage
     */
    public function setCovoiturage(?int $id, String $pointstart, String $pointend, String $datee, int $available_place, int $price): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateeDateTime = new DateTime($datee);
        if (empty($id)) {
            $isOk = $dataBaseService->createCovoiturage($pointstart,$pointend,$dateeDateTime,$available_place,$price);
        } else {
            $isOk = $dataBaseService->updateCovoiturage($id,$pointstart,$pointend,$dateeDateTime,$available_place,$price);
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
        if (!empty($covoituragesDTO)) {
            foreach ($covoituragesDTO as $covoiturageDTO) {
                $covoiturage = new Covoiturage();
                $covoiturage->setId($covoiturageDTO['id']);
                $covoiturage->setPointstart($covoiturageDTO['pointstart']);
                $covoiturage->setPointend($covoiturageDTO['pointend']);


                // $covoiturage->setDate($covoiturageDTO['datee']);    => non
                $date = new DateTime($covoiturageDTO['datee']); // oui  on test



                $covoiturage->setAvailableplace($covoiturageDTO['available_place']);
                $covoiturage->setPrice($covoiturageDTO['price']);
                if ($date !== false) {
                    $covoiturage->setDate($date);
                }
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
