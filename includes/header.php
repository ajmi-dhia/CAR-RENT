<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'] ?? null;
$role = $user['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Car Rental</title>
    <link rel="stylesheet" href="/car-rental/css/style.css">
</head>
<body>

<nav>
    <h2>Car Rental</h2>

    <ul>

        <!-- ALWAYS visible -->
        

        <?php if(!$user): ?>

            <!-- NOT logged in -->
            <li><a href="/car-rental/login.php">Connexion</a></li>
            <li><a href="/car-rental/register.php">Inscription</a></li>

        <?php else: ?>

            <!-- CLIENT -->
            <?php if($role == "client"): ?>

                <li><a href="/car-rental/client/cars.php">Liste voitures</a></li>

                <li class="dropdown">

                    <a href="#">Profile ▼</a>

                    <ul class="dropdown-menu">
                        <li><a href="/car-rental/client/dashboard.php">Dashboard</a></li>
                        <li><a href="/car-rental/logout.php">Logout</a></li>
                    </ul>

                </li>

            <?php endif; ?>

            <!-- AGENCE -->
            <?php if($role == "agence"): ?>

               
                <li><a href="/car-rental/agence/dashboard.php">Dashboard</a></li>
                
               
                <li><a href="/car-rental/agence/add_car.php">Ajouter voiture</a></li>

                <li><a href="/car-rental/logout.php">Logout</a></li>

            <?php endif; ?>

            <!-- ADMIN -->
            <?php if($role == "admin"): ?>

                <li><a href="/car-rental/admin/dashboard.php">Admin</a></li>
                <li><a href="/car-rental/logout.php">Logout</a></li>

            <?php endif; ?>

        <?php endif; ?>

    </ul>
</nav>