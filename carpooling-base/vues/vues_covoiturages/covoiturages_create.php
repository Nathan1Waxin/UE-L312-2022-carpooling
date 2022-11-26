<?php

use App\Controllers\CovoituragesController;
use App\Services\ReservationsService;
use App\Services\VoituresService;

require __DIR__ . '/vendor/autoload.php';

$controller = new CovoituragesController();
echo $controller->createCovoiturage();

$reservations = new ReservationsService();
echo $reservations->createReservations();

$voitures = new VoituresService();
echo $voitures->createVoitures();
?>

<p>Création d'une annonce de covoiturage</p>
<form method="post" action="covoiturages_create.php" name ="covoiturageCreateForm">
    <label for="pointstart">point de départ :</label>
    <input type="text" name="pointstart">
    <br />
    <label for="pointend">point d'arrivée :</label>
    <input type="text" name="pointend">
    <br />
    <label for="date">date :</label>
    <input type="text" name="date">
    <br />
    <label for="available_place">nombre de place :</label>
    <input type="text" name="available_place">
    <br />
    <label for="price">prix :</label>
    <input type="text" name="price">
    <br />
    <label for="voiture">Voiture :</label>
    <?php foreach ($voitures as $voiture): ?>
        <?php $voitureName = $voiture->getModel() . ' ' . $voiture->getCouleur() . ' ' . $voiture->getViteesseMax(); ?>
        <input type="checkbox" name="voiture[]" value="<?php echo $voiture->getId(); ?>"><?php echo $voitureName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="reservation">reservation(s) :</label>
    <?php foreach ($reservations as $reservation): ?>
        <?php $reservationName = $reservations->getName_client() . ' ' . $reservations->getTele_client() . ' ' . $reservations->getMail_client(); ?>
        <input type="checkbox" name="reservations[]" value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce de covoiturage">
</form>