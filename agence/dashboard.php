<?php
include("../includes/role_guard.php");
requireRole("agence");

include("../includes/db.php");

$agence_id = $_SESSION['user']['id'];

include("../includes/header.php");
?>

<div class="container">

    <h1>Dashboard Agence</h1>

    <!-- STATS -->
    <div class="dashboard">

        <?php
        $totalCars = mysqli_fetch_assoc(mysqli_query($conn,"
            SELECT COUNT(*) as total FROM cars WHERE agence_id = $agence_id
        "))['total'];

        $availableCars = mysqli_fetch_assoc(mysqli_query($conn,"
            SELECT COUNT(*) as total FROM cars WHERE agence_id = $agence_id AND disponible = 1
        "))['total'];

        $totalReservationsQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM reservations r
    INNER JOIN cars c 
        ON r.car_id = c.id
    WHERE c.agence_id = '$agence_id'
");

$totalReservations = mysqli_fetch_assoc($totalReservationsQuery)['total'];
        ?>

        <div class="dashboard-card">
            <h2><?= $totalCars ?></h2>
            <p>Total Cars</p>
        </div>

        <div class="dashboard-card">
            <h2><?= $availableCars ?></h2>
            <p>Available Cars</p>
        </div>

        <div class="dashboard-card">
            <h2><?= $totalReservations ?></h2>
            <p>Reservations</p>
        </div>

    </div>

    <hr style="margin:40px 0;">

    <h2>My Cars</h2>

    <div class="cars-grid">

        <?php
        $cars = mysqli_query($conn, "
            SELECT * FROM cars 
            WHERE agence_id = $agence_id
        ");

        while($car = mysqli_fetch_assoc($cars)):
        ?>

        <div class="card">

            <!-- IMAGE -->
             <img src="<?= $car['image'] ?>" alt="car image">

            <!-- INFO -->
            <h3>
                <?= $car['marque'] . " " . $car['modele'] ?>
            </h3>

            <p>💰 <?= $car['prix_jour'] ?> / day</p>

            <!-- AVAILABILITY -->
            <?php if($car['disponible'] == 1): ?>
                <span class="badge badge-success">Available</span>
            <?php else: ?>
                <span class="badge badge-danger">Not Available</span>
            <?php endif; ?>

            <br><br>

            <!-- ACTIONS -->
            <a class="btn btn-primary"
               href="add_car.php?id=<?= $car['id'] ?>">
                Edit
            </a>

            <a class="btn btn-danger"
               onclick="return confirm('Delete this car?')"
               href="delete_car.php?id=<?= $car['id'] ?>">
                Delete
            </a>

        </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>