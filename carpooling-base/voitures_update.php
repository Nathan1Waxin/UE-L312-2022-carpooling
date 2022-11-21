<?php

use App\Controllers\VoituresController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoituresController();
echo $controller->updateVoiture();
?>

<p>Mise à jour d'une voiture</p>
<form method="post" action="voitures_update.php" name ="voitureUpdateForm">
    <label for="model">Model :</label>
    <input type="text" name="model">
    <br />
    <label for="couleur">Couleur :</label>
    <input type="text" name="couleur">
    <br />
    <label for="vitesseMax">Vitesse Max :</label>
    <input type="text" name="vitesseMax">
    <br />
    <input type="submit" value="Modifier la voiture">
</form>