<?php

require_once ("./vendor/autoload.php");

use App\Classes\DBConnector;
use App\Classes\NoteHandler;
use App\Classes\Register;
session_start();
if (isset($_SESSION['user'])) {
    $noteHandler = new NoteHandler([]);
    $notes = $noteHandler->getNotes();
}
else {
    header("location:./login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $register = new Register($_POST);
}

include("./src/Pages/home.php");

session_write_close();