<!DOCTYPE html>
<html lang="en">
<?php

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Home page</title>
</head>
<style>
    * {
        font-family: "Open Sans", sans-serif;
    }

    body {
        color: green;
    }
</style> 

<body>
    <div id="main">
        <header class="header">
            <h1>Employee & Services Management System</h1>
            <hr>
        </header>
        <div class="container">
            <div class="row-1">
                <img src="images/team-work.jpg">
            </div>
            <div id="links" class="row-2">
                <div class="quote">
                    <q>Failure is an amazing data point that tells you which direction not to go.</q>
                </div>
                <a href="employee/employeelogin.php" class="button">Employee Login</a>
                <a href="admin/adminlogin.php" class="button">Admin Login</a>
            </div>
        </div>
        <div class="footer">
            <hr>
            <p>Msc It Final year Project developed using HTML, CSS, javascript, PHP, MySql.</p>
        </div>
    </div>
</body>

</html>