<?php

use App\Controllers\CovoituragesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CovoituragesController();
echo $controller->deleteCovoiturage();
?>

<p>Supression d'une annonce de covoiturage</p>
<form method="post" action="covoiturages_delete.php" name ="covoiturageDeleteForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce de covoiturage">
</form>