<?php

if (!isset($_SESSION['email'])) {
    header('location: salir.php');
}