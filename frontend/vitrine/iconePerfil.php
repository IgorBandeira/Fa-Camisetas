<?php
session_start();
if (isset($_SESSION['id']) == false) {
    header("location: ../../index.php");
} else {
    header("location: ../perfil/perfil.php");
}
