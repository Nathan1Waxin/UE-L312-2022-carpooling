<?php

use App\Controllers\VoituresController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoituresController();
echo $controller->deleteVoiture();
?>

<p>Supression d'une voiture</p>
<form method="post" action="voitures_delete.php" name ="voitureDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une voiture">
</form>