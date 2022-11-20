<?php

namespace App\Controllers;

use App\Services\UsersService;

class ConvoituragesController
{
    /**
     * Return the html for the create action.
     */
    public function createConvoiturage(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['nomentreprise']) &&
            isset($_POST['adresse']) &&
            isset($_POST['datefondation'])) {
            // Create the user :
            $CovoituragesService = new CovoituragesService();
            $isOk = $CovoituragesService->setCovoiturage(
                null,
                $_POST['nomentreprise'],
                $_POST['adresse'],
                $_POST['datefondation'],
            );
            if ($isOk) {
                $html = 'Entreprise créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'entreprise.';
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

        // Get all Covoiturages :
        $CovoituragesService = new CovoituragesService();
        $Covoiturages = $CovoituragesService->getCovoiturages();

        // Get html :
        foreach ($Covoiturages as $Covoiturage) {
            $html .=
                '#' . $Covoiturage->getId() . ' ' .
                $Covoiturage->getNomentreprise() . ' ' .
                $Covoiturage->getAdresse() . ' ' .
                $Covoiturage ->getDatefondation()->format('d-m-Y') . '<br />';
        }

        return $html;
    }

    /**
     * Update the Covoiturages.
     */
    public function updateCovoiturage(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['nomentreprise']) &&
            isset($_POST['adresse']) &&
            isset($_POST['datefondation'])) {
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
