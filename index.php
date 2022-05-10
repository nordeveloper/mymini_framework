<?php

require __DIR__."/core/bootstarp.php";

use App\Controller\CarController;

$controller = new CarController();

$controller->index();