<?php
include("../includes/role_guard.php");
requireRole("client");

include("../includes/db.php");
include("../includes/reservation_helper.php");

$client_id = $_SESSION['user']['id'];
$car_id = $_GET['car_id'] ?? null;

if(!$car_id){
    die("❌ No car selected");
}

// get car info
$carQuery = mysqli_query($conn, "SELECT * FROM cars WHERE id = $car_id");
$car = mysqli_fetch_assoc($carQuery);

if(!$car){
    die("❌ Car not found");
}

include("../includes/header.php");

if(isset($_POST['reserve'])){

    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    // CHECK availability (REAL LOGIC)
    if(!isCarAvailable($conn, $car_id, $date_debut, $date_fin)){
        echo "<div class='alert alert-danger'>❌ Car not available for selected dates</div>";
    }
    else {

        $sql = "INSERT INTO reservations
                (client_id, car_id, date_debut, date_fin, statut)
                VALUES
                ('$client_id', '$car_id', '$date_debut', '$date_fin', 'en_attente')";

        mysqli_query($conn, $sql);

        mysqli_query($conn, $sql);

/* =========================
   UPDATE CAR STATUS
========================= */
mysqli_query($conn, "
    UPDATE cars 
    SET disponible = 0 
    WHERE id = $car_id
");

        echo "<div class='alert alert-success'>✅ Reservation sent successfully</div>";
    }
}
?>

<div class="container">

    <h2>Reserve Car</h2>

    <!-- CAR PREVIEW -->
    <div class="card">

        <img src="<?= $car['image'] ?>" alt="car image">

        <h3><?= $car['marque'] . " " . $car['modele'] ?></h3>

        <p>💰 <?= $car['prix_jour'] ?> / day</p>

    </div>

    <br>

    <!-- RESERVATION FORM -->
    <form method="POST">

        <h3>Choose dates</h3>

        <input type="date" name="date_debut" required>

        <input type="date" name="date_fin" required>

        <button type="submit" name="reserve" class="btn btn-primary">
            Confirm Reservation
        </button>

    </form>

</div>

<?php include("../includes/footer.php"); ?>