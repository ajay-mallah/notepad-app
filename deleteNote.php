<?php

require_once ("./vendor/autoload.php");

use App\Classes\NoteHandler;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteHandler = new NoteHandler($_POST);
    $noteHandler->delete();
    $result = ["status" => "success", "message" => "delete successfully"];
    print_r(json_encode($result));
}

include("./src/Pages/deleteNote.php");

session_write_close();