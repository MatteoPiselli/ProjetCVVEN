<?php
include("connexion.php");
session_start();
$errorMessage = $user = $pass = "";
if(isset($_SESSION["username"])) {
    header("location:index.php");
}
// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = $_POST['email'];
    $pass = $_POST['password'];
    try {
        $query = "select * from Client where Email=:Email and Passwords =:Password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':Email', $user, PDO::PARAM_STR);
        $stmt->bindValue(':Password', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count == 1) {
            $_SESSION['sess_user_id'] = $row['Email'];
            $_SESSION['username'] = $row['Nom'];
            $_SESSION["isAdmin"]= $row['isAdmin'];
            header('location:index.php');
            exit;
        } else {
            $errorMessage = "Invalid username or password!";
        }
    } catch (PDOException $e) {
        die ("Error : " . $e->getMessage());
    }
}
?>

<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<div class="container">

<form action="login.php" method="post">
<h1>Connexion</h1>
 
 <label><b>Email</b></label>
 <input type="text" placeholder="Entrer l'adresse mail" id="email" name="email" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" id ="password" name="password" required>

 <input type="submit" id='submit' value='LOGIN' >
    <!-- si message d'erreur on l'affiche -->
    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessage ?>
        </div>
    <?php endif;?>

    <a href="formClient.php?action=create">Inscription</a>
</form>
    </div>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

   

    <!-- Inclusion du formulaire de connexion -->
    <?php include_once('login.php'); ?>
        

    
</body>
</html>