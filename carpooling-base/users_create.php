<?php

use App\Controllers\UsersController;
use App\Services\VoituresService; //ajout de cette ligne

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->createUser();

//ajout de ce paragraphe:
$voituresService = new VoituresService();
$voitures = $voituresService->getVoitures();
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
    <input type="submit" value="Créer un utilisateur">
</form>