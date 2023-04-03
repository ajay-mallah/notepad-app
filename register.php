<?php

require_once ("./vendor/autoload.php");

use App\Classes\DBConnector;
use App\Classes\Register;

$db = new DBConnector();
// $db->connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = new Register($_POST);
    $register->registerUser();
}

include("./src/Pages/register.php");