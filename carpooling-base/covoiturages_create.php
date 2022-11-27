<?php

use App\Controllers\CovoituragesController;
use App\Services\VoituresService; //ajout de cette ligne
use App\Services\ReservationsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CovoituragesController();
echo $controller->createCovoiturage();

//ajout de ce paragraphe:
$voituresService = new VoituresService();
$voitures = $voituresService->getVoitures();
$reservationsService = new ReservationsService();
$reservations = $reservationService->getReservations();
?>

<p>Création d'une annonce de covoiturage</p>
<form method="post" action="covoiturages_create.php" name ="covoiturageCreateForm">
    <label for="pointstart">point de départ :</label>
    <input type="text" name="pointstart">
    <br />
    <label for="pointend">point d'arrivée :</label>
    <input type="text" name="pointend">
    <br />
    <label for="datee">date :</label>
    <input type="text" name="datee">
    <br />
    <label for="available_place">nombre de place :</label>
    <input type="text" name="available_place">
    <br />
    <label for="price">prix :</label>
    <input type="text" name="price">
    <br />
    <label for="voitures">Voiture(s) :</label>
    <?php foreach ($voitures as $voiture): ?>
        <?php $voitureName = $voiture->getModel() . ' ' . $voiture->getCouleur() . ' ' . $voiture->getVitesseMax(); ?>
        <input type="checkbox" name="voitures[]" value="<?php echo $voiture->getId(); ?>"><?php echo $voitureName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="reservations">Reservation(s) :</label>
    <?php foreach ($reservations as $reservation): ?>
        <?php $reservationName = $reservation->getNameClient() . ' ' . $reservation->getTeleClient() . ' ' . $reservation->getMailClient(); ?>
        <input type="checkbox" name="reservations[]" value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce de covoiturage">
</form>