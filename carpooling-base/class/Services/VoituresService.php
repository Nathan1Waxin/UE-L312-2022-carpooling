<?php

namespace App\Services;

use App\Entities\Voiture;

class VoituresService
{
    /**
     * créer ou mettre à jour une voiture.
     */
    public function setVoiture(?int $id, string $model, string $couleur, int $vitesseMax): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createVoiture($model, $couleur, $vitesseMax);
        } else {
            $isOk = $dataBaseService->updateVoiture($id, $model, $couleur, $vitesseMax);
        }

        return $isOk;
    }

    /**
     * retourner toutes les voitures.
     */
    public function getVoitures(): array
    {
        $voitures = [];

        $dataBaseService = new DataBaseService();
        $voituresDTO = $dataBaseService->getVoitures();
        if (!empty($voituresDTO)) {
            foreach ($voituresDTO as $voitureDTO) {
                $voiture = new Voiture();
                $voiture->setId($voitureDTO['id']);
                $voiture->setModel($voitureDTO['model']);
                $voiture->setCouleur($voitureDTO['couleur']);
                $voiture->setVitesseMax($voitureDTO['vitesseMax']);
                $voitures[] = $voiture;
            }
        }

        return $voitures;
    }

    /**
     * supprimer une voiture
     */
    public function deleteVoiture(int $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteVoiture($id);

        return $isOk;
    }
}
