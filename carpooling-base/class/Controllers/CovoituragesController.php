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
            isset($_POST['date']) &&
            isset($_POST['available_place']) &&
            isset($_POST['price'])) {
            // Creation de l'annonce de covoiturage :
            $covoituragesService = new covoituragesService();
            $isOk = $covoituragesService->setCovoiturage(
                null,
                $_POST['pointstart'],
                $_POST['pointend'],
                $_POST['date'],
                $_POST['available_place'],
                $_POST['price']
            );

            /* creation relation exemple
            if (!empty($_POST['exemples'])) {
                 foreach ($_POST['exemples'] as $exempleId) {
                     $isOk = $covoituragesService->setCovoiturageExemple($covoiturageId, $exempleId);
                 }
             }
            */
             // creation de la relation covoiturage et voiture :
             $isOk = true;
            if (!empty($_POST['voitures'])) {
                 foreach ($_POST['voitures'] as $voitureId) {
                     $isOk = $covoituragesService->setCovoiturageVoiture($covoiturageId, $voitureId);
                 }
             }

            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $usersService->setCovoiturageReservation($covoiturageId, $reservationId);
                }
            }


            if ($covoiturageId && $isOk) {
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

            /* exemple get html relation
            $exemplesHtml = '';
            if (!empty($covoiturage->getExemples())) {
                foreach ($covoiturage->getExemples() as $exemple) {
                    $ExemplesHtml .= $exemple->getClass1() . ' ' . $voiture->getClass2() . ' ' . $voiture->getClass3() . ' ';
                }
            }*/

            $voituresHtml = '';
            if (!empty($covoiturage->getVoitures())) {
                foreach ($covoiturage->getVoitures() as $voiture) {
                    $voituresHtml .= $voiture->getVitesseMax() . ' ' . $voiture->getModel() . ' ' . $voiture->getColeur() . ' ';
                }
            }

            $reservationsHtml = '';
            if (!empty($covoiturage->getReservations())) {
                foreach ($covoiturage->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getName_client() . ' ' . $reservation->getTele_client() . ' ' . $reservation->getMail_client() . ' ';
                }
            }

            $html .=
                '#' . $covoiturage->getId() . ' ' .
                $covoiturage->getPointstart() . ' ' .
                $covoiturage->getPointend() . ' ' .
                $covoiturage->getAvailableplace() . ' ' .
                $covoiturage->getDate() . ' ' .
                $covoiturage->getPrice() . ' ' . '<br />';
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
        if (isset($_POST['pointstart']) &&
            isset($_POST['pointend']) &&
            isset($_POST['date']) &&
            isset($_POST['available_place']) &&
            isset($_POST['price'])) {
            // mettre à jour l'annonce de covoiturage
            $covoituragesService = new CovoituragesService();
            $isOk = $covoituragesService->setCovoiturage(
                $_POST['id'],
                $_POST['pointstart'],
                $_POST['pointend'],
                $_POST['date'],
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
