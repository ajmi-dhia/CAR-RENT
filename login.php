
<?php

session_start();

include("includes/db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if($user){

        if(password_verify($password, $user['password'])){

            $_SESSION['user'] = $user;

            if($user['role'] == "client"){
                header("Location: client/dashboard.php");
            }

            elseif($user['role'] == "agence"){
                header("Location: agence/dashboard.php");
            }

            elseif($user['role'] == "admin"){
                header("Location: admin/dashboard.php");
            }
        }
    }
}

?>

<?php include("includes/header.php"); ?>

<div class="container">

<form method="POST">

    <h2>Connexion</h2>

    <input type="email" name="email" placeholder="Email">

    <input type="password" name="password" placeholder="Mot de passe">

    <button type="submit" name="login">
        Connexion
    </button>

</form>

</div>

<?php include("includes/footer.php"); ?>