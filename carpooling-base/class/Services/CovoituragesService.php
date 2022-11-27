<?php

namespace App\Services;

use App\Entities\Covoiturage;
use App\Entities\Voiture;
use App\Entities\Reservation;
use DateTime;

class CovoituragesService
{
    /**
     * créer ou mettre à jour une annonce de covoiturage
     */
    public function setCovoiturage(?int $id, String $pointstart, String $pointend, String $datee, int $available_place, int $price): String
    {
        $reservationId = '';

        $dataBaseService = new DataBaseService();
        $dateeDateTime = new DateTime($datee);
        if (empty($id)) {
            $reservationId = $dataBaseService->createCovoiturage($pointstart,$pointend,$dateeDateTime,$available_place,$price);
        } else {
            $dataBaseService->updateCovoiturage($id,$pointstart,$pointend,$dateeDateTime,$available_place,$price);
            $reservationId = $id;
        }

        return $reservationId;
    }

    /**
     * retourner toutes les annonces de covoiturages
     */
    public function getCovoiturages(): array
    {
        $covoiturages = [];

        $dataBaseService = new DataBaseService();
        $covoituragesDTO = $dataBaseService->getCovoiturages();
        if (!empty($covoituragesDTO)) {
            foreach ($covoituragesDTO as $covoiturageDTO) {
                $covoiturage = new Covoiturage();
                $covoiturage->setId($covoiturageDTO['id']);
                $covoiturage->setPointstart($covoiturageDTO['pointstart']);
                $covoiturage->setPointend($covoiturageDTO['pointend']);
                // $covoiturage->setDate($covoiturageDTO['datee']);    => non
                $date = new DateTime($covoiturageDTO['datee']); // oui  on test
                $covoiturage->setAvailableplace($covoiturageDTO['available_place']);
                $covoiturage->setPrice($covoiturageDTO['price']);
                if ($date !== false) {
                    $covoiturage->setDate($date);
                }

                //ajout de ces paragraphes
                $voitures = $this->getCovoiturageVoitures($covoiturageDTO['id']);
                $covoiturage->setVoitures($voitures);
                $reservations = $this->getCovoiturageReservations($covoiturageDTO['id']);
                $covoiturage->setReservations($reservations);
                $covoiturages[] = $covoiturage;
            }
        }
        return $covoiturages;
    }

    /**
     * supprimer une annonce de covoiturage
     */
    public function deleteCovoiturage(int $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCovoiturage($id);

        return $isOk;
    }

     /**
     * Create relation bewteen an user and his car.
     */
    public function setCovoiturageVoiture(string $covoiturageId, string $voitureId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setCovoiturageVoiture($covoiturageId, $voitureId);

        return $isOk;
    }
    /**
     * Get cars of given user id.
     */
    public function getCovoiturageVoitures(string $covoiturageId): array
    {
        $covoiturageVoitures = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $covoituragesVoituresDTO = $dataBaseService->getCovoiturageVoitures($covoiturageId);
        if (!empty($covoituragesVoituresDTO)) {
            foreach ($covoituragesVoituresDTO as $covoiturageVoituresDTO) {
                $voiture = new Voiture();
                $voiture->setId($covoiturageVoituresDTO['id']);
                $voiture->setModel($covoiturageVoituresDTO['model']);
                $voiture->setCouleur($covoiturageVoituresDTO['couleur']);
                $voiture->setVitesseMax($covoiturageVoituresDTO['vitesseMax']);
                $covoiturageVoitures[] = $voiture;
            }
        }

        return $covoiturageVoitures;
    }

    /**
     * Create relation bewteen an user and his reservation.
     */
    public function setCovoiturageReservation(string $covoiturageId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setCovoiturageReservation($covoiturageId, $reservationId);

        return $isOk;
    }
    /**
     * Get cars of given user id.
     */
    public function getCovoiturageReservations(string $covoiturageId): array
    {
        $covoiturageReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $covoituragesReservationsDTO = $dataBaseService->getCovoiturageReservations($covoiturageId);
        if (!empty($covoituragesReservationsDTO)) {
            foreach ($covoituragesReservationsDTO as $covoiturageReservationsDTO) {
                $reservation = new Reservation();
                $reservation->setId($covoiturageReservationsDTO['id']);
                $reservation->setNameClient($covoiturageReservationsDTO['name_client']);
                $reservation->setTeleClient($covoiturageReservationsDTO['tele_client']);
                $reservation->setMailClient($covoiturageReservationsDTO['mail_client']);
                $covoiturageReservations[] = $reservation;
            }
        }

        return $covoiturageReservations;
    }

}
