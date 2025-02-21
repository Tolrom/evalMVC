<?php
require "./controller/playerController.php";
require "view/header.php";
require "view/footer.php";
require "view/viewPlayer.php";
require "model/playerModel.php";
require "utils/utils.php";
include 'config.php';

loadEnv(__DIR__.'/.env');

$header = new ViewHeader();
$footer = new ViewFooter();
$model = new PlayerModel();
$player = new ViewPlayer();
$playerController = new PlayerController($header, $footer , $model, $player );

$playerController->render();
