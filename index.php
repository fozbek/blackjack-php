<?php

use App\Helpers\CliHelper;

require 'app/bootstrap.php';

$name = CliHelper::readLine('Your name');
$delay = CliHelper::readLine('Insert round countdown');

$game = new \App\GameRunner($name, $delay);

$game->start();
