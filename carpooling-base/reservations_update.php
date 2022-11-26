<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->updateReservation();
?>

<p>Mise à jour d'une reservation</p>
<form method="post" action="reservations_update.php" name ="reservationUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="name_client">nom :</label>
    <input type="text" name="name_client">
    <br />
    <label for="tele_client">numéro de téléphone :</label>
    <input type="text" name="tele_client">
    <br />
    <label for="mail_client">adresse éléctronique :</label>
    <input type="text" name="mail_client">
    <br />
    <input type="submit" value="Modifier la reservation">
</form>