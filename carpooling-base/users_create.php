<?php

use App\Controllers\UsersController;
use App\Services\VoituresService; //ajout de cette ligne
use App\Services\ReservationsService;
use App\Services\CovoituragesService;
require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();

//ajout de ce paragraphe:
$voituresService = new VoituresService();
$voitures = $voituresService->getVoitures();
$reservationsService = new ReservationsService();
$reservations = $reservationsService->getReservations();
$covoituragesService = new CovoituragesService();
$covoiturages = $covoituragesService->getCovoiturages();
//___________________

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
    <label for="voitures">Voiture(s) :</label>
    <?php foreach ($voitures as $voiture): ?>
        <?php $voitureName = $voiture->getModel() . ' ' . $voiture->getCouleur() . ' ' . $voiture->getVitesseMax(); ?>
        <input type="checkbox" name="voitures[]" value="<?php echo $voiture->getId(); ?>"><?php echo $voitureName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <label for="covoiturages">Contrat(s) :</label>
    <?php foreach ($covoiturages as $covoiturage): ?>
        <?php $covoiturageName = $covoiturage->getPointstart() . ' ' . $covoiturage->getPointend() . ' ' . $covoiturage->getAvailableplace() . ' ' . $covoiturage->getDate() . ' ' . $covoiturage->getPrice(); ?>
        <input type="checkbox" name="covoiturages[]" value="<?php echo $covoiturage->getId(); ?>"><?php echo $covoiturageName; ?>
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
    <input type="submit" value="Créer un utilisateur">
</form>