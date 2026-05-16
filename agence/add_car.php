<?php
include("../includes/role_guard.php");
requireRole("agence");

include("../includes/db.php");

$agence_id = $_SESSION['user']['id'];

/* =========================
   CHECK EDIT MODE
========================= */
$edit_mode = false;
$car = null;

if(isset($_GET['id'])){
    $edit_mode = true;
    $car_id = $_GET['id'];

    $result = mysqli_query($conn, "
        SELECT * FROM cars 
        WHERE id = $car_id AND agence_id = $agence_id
    ");

    $car = mysqli_fetch_assoc($result);

    if(!$car){
        die("Car not found");
    }
}

/* =========================
   SAVE (ADD OR UPDATE)
========================= */
if(isset($_POST['save'])){

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];

    if($edit_mode){

        // UPDATE
        $sql = "
            UPDATE cars SET
            marque='$marque',
            modele='$modele',
            prix_jour='$prix',
            image='$image'
            WHERE id=$car_id AND agence_id=$agence_id
        ";

        mysqli_query($conn, $sql);

        header("Location: dashboard.php");
        exit();

    } else {

        // INSERT
        $sql = "
            INSERT INTO cars
            (agence_id, marque, modele, image, prix_jour)
            VALUES
            ('$agence_id', '$marque', '$modele', '$image', '$prix')
        ";

        mysqli_query($conn, $sql);

        header("Location: dashboard.php");
        exit();
    }
}

include("../includes/header.php");
?>

<div class="container">

<form method="POST">

    <h2>
        <?= $edit_mode ? "Modifier voiture" : "Ajouter voiture" ?>
    </h2>

    <!-- IMAGE -->
    <div class="upload-card">
        <h3>Images</h3>

        <img 
            id="previewImage"
            src="<?= $edit_mode ? $car['image'] : 'https://via.placeholder.com/400x220?text=Car' ?>"
            style="width:100%; max-height:220px; object-fit:cover; border-radius:10px; margin-bottom:15px;"
        >

        <input 
            type="url"
            id="imageInput"
            name="image"
            placeholder="Paste image URL here"
            value="<?= $edit_mode ? $car['image'] : '' ?>"
            style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;"
        >
    </div>

    <br>

    <!-- FIELDS -->
    <input type="text" name="marque" placeholder="Marque"
           value="<?= $edit_mode ? $car['marque'] : '' ?>" required>

    <br><br>

    <input type="text" name="modele" placeholder="Modèle"
           value="<?= $edit_mode ? $car['modele'] : '' ?>" required>

    <br><br>

    <input type="number" name="prix" placeholder="Prix/jour"
           value="<?= $edit_mode ? $car['prix_jour'] : '' ?>" required>

    <br><br>

    <!-- BUTTONS -->
    <button type="submit" name="save">
        <?= $edit_mode ? "Save changes" : "Ajouter" ?>
    </button>

    <a href="dashboard.php" class="btn btn-danger">
        Annuler
    </a>

</form>

</div>

<script>
const imageInput = document.getElementById("imageInput");
const previewImage = document.getElementById("previewImage");

imageInput.addEventListener("input", function () {
    previewImage.src = this.value;
});
</script>

<?php include("../includes/footer.php"); ?>