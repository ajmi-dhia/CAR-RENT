<?php
include("init.php");

function requireRole($role_required) {

    if (!isset($_SESSION['user'])) {
        header("Location: /car-rental/login.php");
        exit();
    }

    $user_role = $_SESSION['user']['role'];

    if ($user_role !== $role_required) {
        header("Location: /car-rental/index.php");
        exit();
    }
}
?>