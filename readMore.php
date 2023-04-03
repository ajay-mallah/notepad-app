<?php

require_once ("./vendor/autoload.php");

use App\Classes\NoteHandler;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteHandler = new NoteHandler($_POST);
    $noteHandler->addNote();
    echo "success";
    header("location:readMore.php?post_id=". $_POST['post_id'] );
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $noteHandler = new NoteHandler($_GET);
    $note = $noteHandler->getNote();
}

include("./src/Pages/readMore.php");

session_write_close();