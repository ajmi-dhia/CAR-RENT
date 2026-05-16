
<?php

include("includes/db.php");

if(isset($_POST['register'])){

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $permis = "";

    if($role == "client"){

        $filename = $_FILES['permis']['name'];
        $tmp = $_FILES['permis']['tmp_name'];

        move_uploaded_file($tmp, "uploads/permis/".$filename);

        $permis = $filename;
    }

    $sql = "INSERT INTO users(nom,email,password,role,permis_photo)
            VALUES('$nom','$email','$password','$role','$permis')";

    mysqli_query($conn, $sql);

    header("Location: login.php");
}

?>

<?php include("includes/header.php"); ?>

<div class="container">

<form method="POST" enctype="multipart/form-data">

    <h2>Inscription</h2>

    <input type="text" name="nom" placeholder="Nom" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Mot de passe" required>

    <select name="role" id="role">
        <option value="client">Client</option>
        <option value="agence">Agence</option>
    </select>

    <input type="file" name="permis">

    <button type="submit" name="register">
        S'inscrire
    </button>

</form>

</div>

<?php include("includes/footer.php"); ?>