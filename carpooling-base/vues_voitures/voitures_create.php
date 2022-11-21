<?php

use App\Controllers\VoituresController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoituresController();
echo $controller->createVoiture();
?>

<p>Création d'une voiture</p>
<form method="post" action="voitures_create.php" name ="voitureCreateForm">
    <label for="model">Model :</label>
    <input type="text" name="model">
    <br />
    <label for="couleur">Couleur :</label>
    <input type="text" name="couleur">
    <br />
    <label for="vitesseMax">Vitesse Max :</label>
    <input type="text" name="vitesseMax">
    <br />
    <input type="submit" value="Créer une voiture">
</form>