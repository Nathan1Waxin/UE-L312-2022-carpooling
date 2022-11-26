<?php

namespace App\Services;

use App\Entities\Voiture;
use App\Entities\Reservation;
use App\Entities\User;
use App\Entities\Covoiturage;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): bool
    {
        $userId = '';

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);
        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstname, $lastname, $email, $birthdayDateTime);
            $userId = $id;
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) {
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setbirthday($date);
                }

                // Get cars of this user :
                $voitures = $this->getUserVoitures($userDTO['id']);
                $user->setVoitures($voitures);

                // Get Reservation of this user :
                $reservations = $this->getUserReservations($userDTO['id']);
                $user->setReservations($reservations);

                // Get Covoiturage of this user :
                $covoiturages = $this->getUserCovoiturages($userDTO['id']);
                $user->setCovoiturages($covoiturages);


                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $usersReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and Reservation :
        $usersReservationsDTO = $dataBaseService->getUserReservations($userId);
        if (!empty($usersReservationsDTO)) {
            foreach ($usersReservationsDTO as $usersReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($usersReservationDTO['id']);
                $reservation->setName_client($usersReservationDTO['name_client']);
                $reservation->setTele_client($usersReservationDTO['tele_client']);
                $reservation->setMail_client($usersReservationDTO['mail_client']);
                $usersReservations[] = $reservation;
            }
        }

        return $usersReservations;
    }

    public function getUserVoitures(string $userId): array
    {
        $usersVoitures = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersVoituresDTO = $dataBaseService->getUserVoitures($userId);
        if (!empty($usersVoituresDTO)) {
            foreach ($usersVoituresDTO as $usersVoitureDTO) {
                $voiture = new Voiture();
                $voiture->setId($usersVoitureDTO['id']);
                $voiture->setModel($usersVoitureDTO['model']);
                $voiture->setColor($usersVoitureDTO['color']);
                $voiture->setVitesseMax($usersVoitureDTO['vitessemax']);
                $usersVoitures[] = $voiture;
            }
        }

        return $usersVoitures;
    }

    public function getUserCovoiturages(string $userId): array
    {
        $usersCovoiturages = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCovoituragesDTO = $dataBaseService->getUserCovoiturages($userId);
        if (!empty($usersCovoituragesDTO)) {
            foreach ($usersCovoituragesDTO as $usersCovoiturageDTO) {
                $covoiturage = new Reservation();
                $covoiturage->setId($usersCovoiturageDTO['id']);
                $covoiturage->setPointstart($usersCovoiturageDTO['pointstart']);
                $covoiturage->setPointend($usersCovoiturageDTO['pointend']);
                $covoiturage->setDate($usersCovoiturageDTO['Date']);
                $covoiturage->setAvailable_place($usersCovoiturageDTO['available_place']);
                $covoiturage->setPrice($usersCovoiturageDTO['price']);
                $usersCovoiturages[] = $covoiturage;
            }
        }

        return $usersCovoiturages;
    }
}
