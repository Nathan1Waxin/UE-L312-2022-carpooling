<?php

use App\Controllers\CovoituragesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CovoituragesController();
echo $controller->getCovoiturages();

