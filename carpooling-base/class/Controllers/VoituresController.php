<?php

namespace App\Controllers;

use App\Voiture;

class VoitureController
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
            // Create the user :
            $voituresService = new VoituresService();
            $isOk = $voituresService ->setVoiture(
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
    public function getVoiture(): string
    {
        $html = '';

        // Get all voitures :
        $VoituresService = new VoituresService();
        $voitures = $VoituresService -> getVoitures();

        // Get html :
        foreach ($voitures as $voitures) {
            $html .=
                '#' . $voitures->getId() . ' ' .
                $voitures->getModel() . ' ' .
                $voitures->getCouleur() . ' ' .
                $voitures->getVitesseMax() . '<br />';
        }

        return $html;
    }

    /**
     * Update the voiture.
     */
    public function updateVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['model']) &&
            isset($_POST['couleur']) &&
            isset($_POST['vitesseMax'])) {
            // Update the voiture :
            $VoitureService = new VoitureService();
            $isOk = $VoitureService->setVoiture(
                $_POST['id'],
                $_POST['model'],
                $_POST['couleur'],
                $_POST['vitesseMax']
            );
            if ($isOk) {
                $html = 'Voiture mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete an Voiture.
     */
    public function deleteVoiture(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $VoitureService = new VoitureService();
            $isOk = $VoitureService->deleteVoiture($_POST['id']);
            if ($isOk) {
                $html = 'Voiture supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la Voiture.';
            }
        }

        return $html;
    }
}