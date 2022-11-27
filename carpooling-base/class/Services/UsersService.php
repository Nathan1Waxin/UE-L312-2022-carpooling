<?php

namespace App\Services;

use App\Entities\User;
use App\Entities\Voiture;
use App\Entities\Covoiturage;
use App\Entities\Reservation;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): String //avant c'était bool
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
                //get User:
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setbirthday($date);
                }

                //ajout de ces paragraphes
                $voitures = $this->getUserVoitures($userDTO['id']);
                $user->setVoitures($voitures);
                $covoiturages = $this->getUserCovoiturages($userDTO['id']);
                $user->setCovoiturages($covoiturages);
                $reservations = $this->getUserReservations($userDTO['id']);
                $user->setReservations($reservations);

                $users[] = $user;
                //___________________________
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
     * Create relation bewteen an user and his car.
     */
    public function setUserVoiture(string $userId, string $voitureId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserVoiture($userId, $voitureId);

        return $isOk;
    }
    /**
     * Get cars of given user id.
     */
    public function getUserVoitures(string $userId): array
    {
        $userVoitures = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersVoituresDTO = $dataBaseService->getUserVoitures($userId);
        if (!empty($usersVoituresDTO)) {
            foreach ($usersVoituresDTO as $userVoitureDTO) {
                $voiture = new Voiture();
                $voiture->setId($userVoitureDTO['id']);
                $voiture->setModel($userVoitureDTO['model']);
                $voiture->setCouleur($userVoitureDTO['couleur']);
                $voiture->setVitesseMax($userVoitureDTO['vitesseMax']);
                $userVoitures[] = $voiture;
            }
        }

        return $userVoitures;
    }


    /**
     * Create relation bewteen an user and his Covoiturage.
     */
    public function setUserCovoiturage(string $userId, string $covoiturageId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCovoiturage($userId, $covoiturageId);

        return $isOk;
    }
    /**
     * Get cars of given user id.
     */
    public function getUserCovoiturages(string $userId): array
    {
        $userCovoiturages = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCovoituragesDTO = $dataBaseService->getUserCovoiturages($userId);
        if (!empty($usersCovoituragesDTO)) {
            foreach ($usersCovoituragesDTO as $userCovoiturageDTO) {
                $covoiturage = new Covoiturage();
                $covoiturage->setId($userCovoiturageDTO['id']);
                $covoiturage->setPointstart($userCovoiturageDTO['pointstart']);
                $covoiturage->setPointend($userCovoiturageDTO['pointend']);
                $covoiturage->setAvailableplace($userCovoiturageDTO['available_place']);
                $covoiturage->setDate($userCovoiturageDTO['datee']);
                $covoiturage->setPrice($userCovoiturageDTO['price']);
                $userCovoiturages[] = $covoiturage;
            }
        }

        return $userCovoiturages;
    }

    /**
     * Create relation bewteen an user and his reservation.
     */
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserReservation($userId, $reservationId);

        return $isOk;
    }
    /**
     * Get cars of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersReservationsDTO = $dataBaseService->getUserReservations($userId);
        if (!empty($usersReservationsDTO)) {
            foreach ($usersReservationsDTO as $usersReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($usersReservationDTO['id']);
                $reservation->setNameClient($usersReservationDTO['name_client']);
                $reservation->setTeleClient($usersReservationDTO['tele_client']);
                $reservation->setMailClient($usersReservationDTO['mail_client']);
                $userReservations[] = $reservation;
            }
        }

        return $userReservations;
    }
}
