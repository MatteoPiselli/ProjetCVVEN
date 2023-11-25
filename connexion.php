<?php
try {
    $db = new PDO(
        'mysql:host=mysql-piselli-matteo.alwaysdata.net;dbname=piselli-matteo_cvven;charset=utf8',
        '243065_cvven',
        'Matteo94440',
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>