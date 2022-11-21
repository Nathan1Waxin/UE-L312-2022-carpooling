<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['model']) &&
            isset($_POST['couleur']) &&
            isset($_POST['vitesseMax'])) {
            // Creation de la reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                null,
                $_POST['name_client'],
                $_POST['tele_client'],
                $_POST['mail_client']
            );
            if ($isOk) {
                $html = 'Réservation créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la reservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '';

        // Get all reservation :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
            $html .=
                '#' . $reservation->getId() . ' ' .
                $reservation->getNameClient() . ' ' .
                $reservation->getTeleClient() . ' ' .
                $reservation->getMailClient() . ' ' . '<br />';
        }

        return $html;
    }

    /**
     * mettre à jour la reservation
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['name_client']) &&
            isset($_POST['tele_client']) &&
            isset($_POST['mail_client'])) {
            // mettre à jour la reservation
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['name_client'],
                $_POST['tele_client'],
                $_POST['mail_client']
            );
            if ($isOk) {
                $html = 'reservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la reservation.';
            }
        }

        return $html;
    }

    /**
     * supprimer une voiture
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // supprimer la reservation
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'Reservation supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la reservation';
            }
        }

        return $html;
    }
}
