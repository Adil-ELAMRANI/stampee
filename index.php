<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'config.php';
//echo "Connexion réussie à la base de données !";
require_once 'vendor/autoload.php';
require_once __DIR__ . '/routes/web.php';




