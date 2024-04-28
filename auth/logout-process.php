<?php

include ("../config/database.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth");
}

session_destroy();
header("Location: ../dashboard");
