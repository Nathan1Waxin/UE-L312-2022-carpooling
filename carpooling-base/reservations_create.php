<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();
?>

<p>Création d'une réservation</p>
<form method="post" action="reservations_create.php" name ="reservationCreateForm">
    <label for="name_client">nom :</label>
    <input type="text" name="name_client">
    <br />
    <label for="tele_client">numéro de téléphone :</label>
    <input type="text" name="tele_client">
    <br />
    <label for="mail_client">adresse éléctronique :</label>
    <input type="text" name="mail_client">
    <br />
    <input type="submit" value="Créer une reservation">
</form>