<?php

namespace App\Controllers;

use App\Services\CovoituragesService;

class CovoituragesController  
{
    /**
     * Return the html for the create action.
     */
    public function createCovoiturage(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['pointstart']) &&
            isset($_POST['pointend']) &&
            isset($_POST['datee']) &&
            isset($_POST['available_place']) &&
            isset($_POST['price']) &&
            isset($_POST['voitures']) &&
            isset($_POST['reservations'])) {
            // Creation de l'annonce de covoiturage :
            $covoituragesService = new covoituragesService();
            $covoiturageId = $covoituragesService->setCovoiturage( 
                null,
                $_POST['pointstart'],
                $_POST['pointend'],
                $_POST['datee'],
                $_POST['available_place'],
                $_POST['price']
            );

            // Create the covoiturages cars relations : ajout de cette partie
            $isOk = true;
            if (!empty($_POST['voitures'])) {
                foreach ($_POST['voitures'] as $voitureId) {
                    $isOk = $covoituragesService->setCovoiturageVoiture($covoiturageId, $voitureId);
                }
            }
            // Create the user reservation relations : ajout de cette partie
            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $covoituragesService->setCovoiturageReservation($covoiturageId, $reservationId);
                }
            }
            
            if ($isOk) {
                $html = 'Annonce de covoiturage créé avec succès.';
            } else {
                $html = 'Erreur lors de la création.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCovoiturages(): string
    {
        $html = '';

        // Get all annonces de covoiturages :
        $covoituragesService = new CovoituragesService();
        $covoiturages = $covoituragesService->getCovoiturages();

        // Get html :
        foreach ($covoiturages as $covoiturage) {
            $voituresHtml = '';
            if (!empty($covoiturage->getVoitures())) {
                foreach ($covoiturage->getVoitures() as $voiture) {
                    $voituresHtml .= $voiture->getModel() . ' ' . $voiture->getCouleur() . ' ' . $voiture->getVitesseMax() . ' ';
                }
            }
            $reservationsHtml = '';
            if (!empty($covoiturage->getReservations())) {
                foreach ($covoiturage->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getNameClient() . ' ' . $reservation->getTeleClient() . ' ' . $reservation->getMailClient() . ' ';
                }
            }

            $html .=
                '#' . $covoiturage->getId() . ' ' .
                $covoiturage->getPointstart() . ' ' .
                $covoiturage->getPointend() . ' ' .
                $covoiturage->getAvailableplace() . ' ' .
                $covoiturage->getPrice() . ' ' .
                $covoiturage->getDate()->format('d-m-Y')  . ' ' .
                $voituresHtml . ' ' .
                $reservationsHtml . '<br />';
        }

        return $html;
    }
    

    /**
     * mettre à jour l'annonce de covoiturage
     */
    public function updateCovoiturage(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['pointstart']) &&
            isset($_POST['pointend']) &&
            isset($_POST['datee']) &&
            isset($_POST['available_place']) &&
            isset($_POST['price'])) {
            // mettre à jour l'annonce de covoiturage
            $covoituragesService = new CovoituragesService();
            $isOk = $covoituragesService->setCovoiturage(
                $_POST['id'],
                $_POST['pointstart'],
                $_POST['pointend'],
                $_POST['datee'],
                $_POST['available_place'],
                $_POST['price']
            );
            if ($isOk) {
                $html = 'annonce de covoiturage mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour.';
            }
        }

        return $html;
    }

    /**
     * supprimer une annonce de covoiturage
     */
    public function deleteCovoiturage(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // supprimer l'annonce de covoiturage


            $covoituragesService = new CovoituragesService();
            $isOk = $covoituragesService->deleteCovoiturage($_POST['id']);
            if ($isOk) {
                $html = 'annonce supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression';
            }
        }

        return $html;
    }
}
