<?php
  session_start();
?>



<html>
    <head>
        <meta charset ="utf-8">
        <link rel = "stylesheet" href ="index.css">
       
    </head>

    <body>
    <nav>
            <ul>

              <li><a href="login.php">Connexion</a></li>
              <li><a href="reservation.php">Réservation</a></li>
              <li><a href="déco.php">Déconnexion</a></li>
              <?php if ($_SESSION["isAdmin"]== 1 ): ?>
                <li><a href ="client.php">Clients</a></li>
              <?php endif; ?>

            </ul>
          </nav>

        <h1>Projet CVVEN</h1>

    <table>
      <tr>
        <th id= "image1">Images</th>
        <th id= "image2">Images</th>
        <th id= "image2">Images</th>
      </tr>
      <tr>
        <td id= "lien1">Lien</td>
        <td id= "lien2">Lien</td>
        <td id= "lien3">Lien</td>
      </tr>
    </table>

       

    </body>
</html>

