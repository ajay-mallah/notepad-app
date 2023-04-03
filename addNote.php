<?php

require_once ("./vendor/autoload.php");

use App\Classes\NoteHandler;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteHandler = new NoteHandler($_POST);
    $noteHandler->addNote();
    echo "success";
}

include("./src/Pages/addNote.php");

session_write_close();