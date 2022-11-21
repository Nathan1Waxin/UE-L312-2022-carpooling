<?php

use App\Controllers\CovoituragesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CovoituragesController();
echo $controller->createCovoiturage();
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
    <input type="submit" value="Créer une annonce de covoiturage">
</form>