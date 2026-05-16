<?php
include("../includes/role_guard.php");

requireRole("client");
?>

<?php

include("../includes/auth.php");
include("../includes/db.php");
include("../includes/reservation_helper.php");

?>

<?php include("../includes/header.php"); ?>

<div class="container">

    <h1>Available Cars</h1>

    <div class="cars-grid">

        <?php

        $sql = "SELECT * FROM cars";
        $result = mysqli_query($conn, $sql);

        while($car = mysqli_fetch_assoc($result)):

            // fake availability check (today as default preview)
            $today = date("Y-m-d");
           

        ?>

        <div class="card">

            <!-- CAR IMAGE -->
            <img src="<?= $car['image'] ?>" alt="car image">

            <!-- CAR INFO -->
            <h3>
                <?php echo $car['marque'] . " " . $car['modele']; ?>
            </h3>

            <p>
                💰 <?php echo $car['prix_jour']; ?> / day
            </p>

            <!-- AVAILABILITY -->
            <?php if($car['disponible'] == 1): ?>
                <span class="badge badge-success">Available</span>
            <?php else: ?>
                <span class="badge badge-danger">Not Available</span>
            <?php endif; ?>

            <br><br>

            <!-- RESERVE BUTTON -->
            <?php if($car['disponible'] == 1): ?>
                <a class="btn btn-primary"
   href="reserve.php?car_id=<?= $car['id'] ?>">
    Reserve
</a>
            <?php else: ?>
                <button class="btn" disabled>
                    Unavailable
                </button>
            <?php endif; ?>

        </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>