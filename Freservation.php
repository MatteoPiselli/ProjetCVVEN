<?php

$valid = false;
$hote = 0;

$DateDebut = $DateFin ="";

include("connexion.php");

$action = "";
if (isset($_REQUEST["action"]) && trim($_REQUEST["action"]) != "") {  //trim enleve les blanc
    $action = trim($_REQUEST["action"]);
}
$id = "";
if (isset($_REQUEST["id"]) && trim($_REQUEST["id"]) != "") {
    $id = trim($_REQUEST["id"]);
}
$method = $_SERVER["REQUEST_METHOD"];
var_dump($method, $action, $id);

if ($method == "GET") {
    switch ($action) {
        case 'create':
            break;
        case 'update':
        case 'delete':
            if ($id != "") {
                $sql = "SELECT * FROM Reservation";
                try {
                    $stmt = $db->query($sql);

                    if ($stmt == false) {
                        die("Erreur");
                    }
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $DateDebut = $row["DateDebut"];
                    $DateFin = $row["DateFin"];
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            break;
        default: //read
            $action = "read";
            break;
    }
} else {
    //POST
    if (!empty($_POST["send"])) {
        $valid = true;
    }

    if ($valid) {
        $DateDebut = $_POST["DateDebut"];
        $DateFin = $_POST["DateFin"];

        if (isset($_POST["DateDebut"])) {
            $DateDebut = $_POST["DateDebut"];
        }
        if (isset($_POST["DateFin"])) {
            $DateFin = $_POST["DateFin"];
        }
        switch ($action) {
            case 'create':
                //INSERT
                $insert = "INSERT INTO Reservation( DateDebut, DateFin) 
                VALUES ( :DateDebut, :DateFin)";
                try {
                    $query = $db->prepare($insert);
                    $ret = $query->execute([
                        ':DateDebut' => $DateDebut,
                        ':DateFin' => $DateFin,
                    ]);
                } catch (Exception $th) {
                    echo $th;
                }
                break;
            case 'update':
                //UPDATE
                $update = "UPDATE Reservation SET DateDebut=:DateDebut, DateFin =:DateFin";
                try {
                    $query = $db->prepare($update);
                    $ret = $query->execute([
                        ':DateDebut' => $DateDebut,
                        ':DateFin' => $DateFin,
                    ]);
                } catch (PDOException $th) {
                    echo $th;
                }
                break;
            case 'delete':
                //DELETE
                $delete = "DELETE FROM Reservation";
                try{
                    $query = $db->prepare($delete);
                    $ret = $query->execute([
                        ':id' => $id,
                    ]);
                } catch (PDOException $th){
                    echo $th;
                }
                break;
            default: //read
                $action = "read";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>CVVEN - Reservation</title>
</head>
<header>
    <div class="nav">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="reservation.php"> Table Reservation</a></li>
        </ul>
    </div>
</header>

<body>
    <div class="container">
    <form method="POST" action="reservation.php">
        <input type="hidden" name="action" value="<?= $action ?>">
        <h1>Reservation</h1>
        <label for="DateDebut">Debut du sejour</label>
        <input type="date" name="DateDebut" id="DateDebut" placeholder="jj/mm/aaaa heure:minutes" size="20" value="<?= $DateDebut ?>">
        <br>
        <label for="DateFin">Fin du sejour</label>
        <input type="date" name="DateFin" id="DateFin" placeholder="jj/mm/aaaa heure:minutes" size="20" value="<?= $DateFin ?>">
        <br>
        
        <input type="submit" name="send" value="Envoyer">
    </form>
</div>
</body>

</html>