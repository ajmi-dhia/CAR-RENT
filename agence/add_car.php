<?php
include("../includes/role_guard.php");

requireRole("agence");
?>
<?php

include("../includes/auth.php");
include("../includes/db.php");

if(isset($_POST['add'])){

    $agence_id = $_SESSION['user']['id'];

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO cars(agence_id,marque,modele,prix_jour)
            VALUES('$agence_id','$marque','$modele','$prix')";

    mysqli_query($conn, $sql);

    echo "Voiture ajoutée";
}

?>

<?php include("../includes/header.php"); ?>

<div class="container">

<form method="POST">

    <h2>Ajouter voiture</h2>

    <input type="text" name="marque" placeholder="Marque">

    <input type="text" name="modele" placeholder="Modèle">

    <input type="number" name="prix" placeholder="Prix/jour">

    <button type="submit" name="add">
        Ajouter
    </button>

</form>

</div>

<?php include("../includes/footer.php"); ?>