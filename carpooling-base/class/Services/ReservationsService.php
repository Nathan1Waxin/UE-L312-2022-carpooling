<?php

namespace App\Services;

use App\Entities\Reservation;

class ReservationsService
{
    /**
     * créer ou mettre à jour une reservation
     */
    public function setReservation(?int $id, String $name_client, String $tele_client, string $mail_client): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($name_client,$tele_client,$mail_client);
        } else {
            $isOk = $dataBaseService->updateReservation($id,$name_client,$tele_client,$mail_client);
        }

        return $isOk;
    }

    /**
     * retourner toutes les reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setNameClient($reservationDTO['name_client']);
                $reservation->setTeleClient($reservationDTO['tele_client']);
                $reservation->setMailClient($reservationDTO['mail_client']);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    /**
     * supprimer une reservation
     */
    public function deleteReservation(int $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}
