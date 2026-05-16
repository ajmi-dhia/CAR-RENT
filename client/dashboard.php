<?php
include("../includes/role_guard.php");

requireRole("client");
?>
<?php

include("../includes/auth.php");

?>

<?php include("../includes/header.php"); ?>

<div class="container">

    <h1>Dashboard Client</h1>

    <a href="reserve.php">
        Réserver une voiture
    </a>

</div>

<?php include("../includes/footer.php"); ?>