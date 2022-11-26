<?php

namespace App\Controllers;

use App\Services\VoituresService;

class VoituresController
{
    /**
     * Return the html for the create action.
     */
    public function createVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['model']) &&
            isset($_POST['couleur']) &&
            isset($_POST['vitesseMax'])) {
            // Creation de la voiture :
            $voituresService = new VoituresService();
            $isOk = $voituresService->setVoiture(
                null,
                $_POST['model'],
                $_POST['couleur'],
                $_POST['vitesseMax']
            );
            if ($isOk) {
                $html = 'Voiture créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getVoitures(): string
    {
        $html = '';

        // Get all voitures :
        $voituresService = new VoituresService();
        $voitures = $voituresService->getVoitures();

        // Get html :
        foreach ($voitures as $voiture) {
            $html .=
                '#' . $voiture->getId() . ' ' .
                $voiture->getModel() . ' ' .
                $voiture->getCouleur() . ' ' .
                $voiture->getVitesseMax() . ' ' . '<br />';
        }

        return $html;
    }

    /**
     * mettre à jour la voiture
     */
    public function updateVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['model']) &&
            isset($_POST['couleur']) &&
            isset($_POST['vitesseMax'])) {
            // mettre à jour la voiture
            $voituresService = new VoituresService();
            $isOk = $voituresService->setVoiture(
                $_POST['id'],
                $_POST['model'],
                $_POST['couleur'],
                $_POST['vitesseMax']
            );
            if ($isOk) {
                $html = 'voiture mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * supprimer une voiture
     */
    public function deleteVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // supprimer la voiture
            $voituresService = new VoituresService();
            $isOk = $voituresService->deleteVoiture($_POST['id']);
            if ($isOk) {
                $html = 'Voiture supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture';
            }
        }

        return $html;
    }
}
