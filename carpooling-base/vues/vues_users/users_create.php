<?php

use App\Controllers\UsersController;
use App\Services\VoituresService;
use App\Services\ReservationsService;
use App\Services\CovoituragesService;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();
?>

<p>Création d'un utilisateur</p>
<form method="post" action="users_create.php" name ="userCreateForm">
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
    <input type="text" name="birthday">
    <br />
    <label for="voiture">Voiture(s) :</label>
    <?php foreach ($voitures as $voiture): ?>
        <?php $voitureName = $car->getBrand() . ' ' . $voiture->getModel() . ' ' . $voiture->getColor(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $voiture->getId(); ?>"><?php echo $voitureName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="reservation">Contrat(s) :</label>
    <?php foreach ($reservations as $reservation): ?>
        <?php $reservationName = $reservations->getName_client() . ' ' . $reservations->getTele_client() . ' ' . $reservations->getMail_client(); ?>
        <input type="checkbox" name="reservations[]" value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="covoiturage">Annonce(s) :</label>
    <?php foreach ($covoiturages as $covoiturage): ?>
        <?php $covoiturageName = $covoiturages->getPointstart() . ' ' . $covoiturages->getPointend() . ' ' . $covoiturages->getDate() . ' ' . $covoiturages->getAvailable_place() . ' ' . $covoiturages->getPrice(); ?>
        <input type="checkbox" name="reservations[]" value="<?php echo $reservation->getId(); ?>"><?php echo $reservationName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer un utilisateur">
</form>