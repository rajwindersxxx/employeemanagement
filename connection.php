<?php
// Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

try {
    $servername = "";
    $dbname = "";
    $username = "";
    $password = "";

    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
<link rel="stylesheet" href="../includes/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../includes/fontawesome/css/all.css">
<script src="../includes/bootstrap/dist/js/bootstrap.bundle.main.js"></script>
<script src="../includes/fontawesome/js/all.js"></script>