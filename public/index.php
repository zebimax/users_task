<?php
error_reporting(E_ALL);
require '../AutoLoader.php';
require '../Globals/functions.php';
(new AutoLoader())->register();
App::getApp(require '../global_config.php')->start();