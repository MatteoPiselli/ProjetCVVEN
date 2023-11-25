<?php

include("connexion.php");

$sql = "SELECT * FROM Reservation";

try
{
    $stmt = $db->query($sql);

    if($stmt ==false){
        die("Erreur");
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();  
}
      if(isset( $_SESSION['sess_user_name'])){
          echo  $_SESSION['sess_user_name'];
      }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="tableClient.css">
        <title>CVVEN - Table Reservation</title>
    </head>
    <header>
		<div class="nav">
			<ul>
				<li><a href="index.php">Accueil</a></li>
                <li><a href="Freservation.php?action=create">Formulaire Reservation</a></li>
			</ul>
		</div>
    </header>
    <body>
        <table>
            <caption>Table Reservation</caption>
            <thead>
            <tr>
                <th>DateDebut</th>
                <th>DateFin</th> 
                <th>NbPersonne</th>
                <th>Pension</th>
                <th>Menage</th>
                <th>TypeLogement</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
                <tr>
                <td><a href="Freservation.php?action=create" title="formulaire de la table Reservation"><img src width="100px" height="auto"></a></td>
                <td><?=htmlspecialchars($row['DateDebut']);?></td>
                <td><?=htmlspecialchars($row['DateFin']);?></td>
                <td><?=htmlspecialchars($row['NbPersonne']);?></td>
                <td><?=htmlspecialchars($row['Pension']);?></td>
                <td><?=htmlspecialchars($row['Menage']);?></td>
                <td><?=htmlspecialchars($row['TypeLogement']);?></td>
                <td><a href="formclient.php?action=update&id=<?=$row['Id']?>"><img src="images/up.png" width="10%" height="auto"></a> 
                <td><a href="formclient.php?action=delete&id=<?=$row['Id']?>"><img src="images/delete.png" width="10%" height="auto"></a> 
            </div>             
            </tr>
            <?php endwhile; ?>
            </tbody>
            </table>
    </body>
</html>