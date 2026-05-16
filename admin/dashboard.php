<?php
include("../includes/role_guard.php");

requireRole("admin");
?>
<?php

include("../includes/auth.php");
include("../includes/db.php");

?>

<?php include("../includes/header.php"); ?>

<div class="container">

<h1>Dashboard Admin</h1>

<?php

$clients = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM users WHERE role='client'")
);

$agences = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM users WHERE role='agence'")
);

$reservations = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM reservations")
);

?>

<div class="card">
    Clients : <?php echo $clients; ?>
</div>

<div class="card">
    Agences : <?php echo $agences; ?>
</div>

<div class="card">
    Réservations : <?php echo $reservations; ?>
</div>

</div>

<?php include("../includes/footer.php"); ?>