<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if(isset($_SESSION["username"])) {
    // Si oui, afficher un message de bienvenue
    echo "Bienvenue, " . $_SESSION["username"] . "!";
} else {
    // Sinon, vérifier si les informations de connexion ont été soumises
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        // Vérifier les informations de connexion
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Connecter à la base de données pour vérifier les informations de connexion
        include("connexion.php");
        
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()){
          die('Connect Error ('. mysqli_connect_errno() .') '
            . mysqli_connect_error());
        }
        else{
            $SELECT = "SELECT mail, password, isAdmin From register Where email = ? Limit 1";
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($username, $password);
            $stmt->store_result();
            $rnum = $stmt->num_rows;
            if ($rnum==1) {
                $_SESSION["username"] = $username;
                $_SESSION["isAdmin"] = $SELECT["isAdmin"];
                echo "Connecté en tant que " . $_SESSION["username"];
            } else {
                echo "Mauvais nom d'utilisateur ou mot de passe";
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        // Sinon, afficher un formulaire de connexion
        echo "
        <form action='session.php' method='post'>
        <label for='username'>Nom d'utilisateur :</label>
        <input type='text' id='username' name='username'>
        <br>
        <label for='password'>Mot de passe :</label>
        <input type='password' id='password' name='password'>
        <br><br>
        <input type='submit' value='Se connecter'>
        </form>
        ";
    }
}
?>
