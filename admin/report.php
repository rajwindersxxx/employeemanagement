<?php include("../connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
</head>
<style>
    .container label {
        width: 100%;
        margin-bottom: 0;
    }

    .container input {
        width: 100%;
        margin-bottom: 14px;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .left,
    .right {
        flex: 1;
        height: 60vh;
        padding: 20px;
    }

    input[type="submit"] {
        width: 80px;
        margin-top: 10px;
    }
</style>

<body>
    <?php
    include 'nav-bar.php';
    ?>
    <div id="dashboard">
        <div class="wrapper">
            <?php
            include 'side-bar.php';
            ?>
            <!-- main application column -->
            <div id="two">
                <div class="my-box" style="height: 30vh">
                    <h4>Search by date</h4>
                    <hr>
                    <form id="my-box" action="" method="POST">

                        <div class="container">
                            <div class="left">
                                <label for="from-date">From</label>
                                <input type="date" name="from-date" id="from-date" placeholder="Enter a date">
                                <input type="submit"></input>
                                <label id="output"></label>
                            </div>
                            <div class="right">
                                <label for="to-date">To.</label>
                                <input type="date" name="to-date" id="to-date" placeholder="Enter a date">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>