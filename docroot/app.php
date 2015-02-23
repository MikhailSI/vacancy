<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../Base/autoload.php';
\Base\App::i()->configure(new \Base\Config())->start();