<?php

namespace App\Controllers;

use App\Services\UsersService;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])) {
            // Create the user :
            $usersService = new UsersService();
            $isOk = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );

            // Create the user cars relations :
            $isOk = true;
            if (!empty($_POST['voitures'])) {
                foreach ($_POST['voitures'] as $voitureId) {
                    $isOk = $usersService->setUserVoiture($userId, $voitureId);
                }
            }

            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $usersService->setUserReservation($userId, $reservationId);
                }
            }

            if (!empty($_POST['covoiturages'])) {
                foreach ($_POST['covoiturages'] as $covoiturageId) {
                    $isOk = $usersService->setUserCovoiturage($userId, $covoiturageId);
                }
            }

            if ($userId && $isOk) {
                $html = 'Utilisateur créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }


        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getUsers(): string
    {
        $html = '';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $voituresHtml = '';
            if (!empty($user->getVoitures())) {
                foreach ($user->getVoitures() as $voiture) {
                    $voituresHtml .= $voiture->getVitesseMax() . ' ' . $voiture->getModel() . ' ' . $voiture->getColeur() . ' ';
                }
            }

            $reservationsHtml = '';
            if (!empty($user->getReservations())) {
                foreach ($user->getReservations() as $reservation) {
                    $reservationsHtml .= $reservation->getName_client() . ' ' . $reservation->getTele_client() . ' ' . $reservation->getMail_client() . ' ';
                }
            }

            $covoituragesHtml = '';
            if (!empty($user->getCovoiturages())) {
                foreach ($user->getCovoiturages() as $covoiturage) {
                    $covoituragesHtml .= $covoiturages->getPointstart() . ' ' . $covoiturages->getPointend() . ' ' . $covoiturages->getDate() . ' ' . $covoiturages->getAvailable_place() . ' ' . $covoiturages->getPrice() . ' ';
                }
            }

            $html .=
                '#' . $user->getId() . ' ' .
                $user->getFirstname() . ' ' .
                $user->getLastname() . ' ' .
                $user->getEmail() . ' ' .
                $user->getBirthday()->format('d-m-Y') . '<br />';
        }

        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday'])) {
            // Update the user :
            $usersService = new UsersService();
            $isOk = $usersService->setUser(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );
            if ($isOk) {
                $html = 'Utilisateur mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $usersService = new UsersService();
            $isOk = $usersService->deleteUser($_POST['id']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}
