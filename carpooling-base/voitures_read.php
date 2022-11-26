<?php

use App\Controllers\VoituresController;

require __DIR__ . '/vendor/autoload.php';

$controller = new VoituresController();
echo $controller->getVoitures();
