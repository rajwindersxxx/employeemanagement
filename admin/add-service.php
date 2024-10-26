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
    .my-box p,
    I .my-box input[type="text"],
    select {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    input[type="submit"] {
        width: 150px;
        margin-top: 20px;
        font-size: 20px;
        float: right;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .first,
    .second,
    .third {
        flex: 1;
        height: 70vh;
        padding: 20px;
        width: 33%;
    }

    input {
        width: 100%;
    }

    @media screen and (max-width: 868px) {
        .container {
            display: block;
        }

        .first,
        .second,
        .third {
            height: 10vh;
            width: 100%;
        }

        .my-box {
            height: 450px !important;
        }
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
                <div class="my-box" style="height: 250px">
                    <h4>Add Service</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="container">
                            <div class="first">
                                <label for="dept-name">Select department:</label>
                                <select name="dept-name" style="padding: 3px" required>
                                    <?php
                                    include('../connection.php');
                                    $query = "SELECT `dept-name` FROM `department`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $depts = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($depts as $row) {
                                        echo "<option value='" . htmlspecialchars($row['dept-name']) . "'";
                                        if (isset($_POST['department']) && $_POST['department'] == $row['dept-name']) {
                                            echo " selected";
                                        }
                                        echo ">" . htmlspecialchars($row['dept-name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="second">
                                <label for="service-type">Service type:</label>
                                <input type="text" name="service-type" id="service-type" placeholder="service type">
                            </div>
                            <div class="third"><label for="service-cost">Service cost:</label>
                                <input type="text" name="service-cost" id="service-cost" placeholder="Cost of service">
                                <input type="submit" value="Add Service" class="a-button"></input>
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dept_name = ucfirst(test_input($_POST["dept-name"]));
    $service_type = ucfirst(test_input($_POST["service-type"]));
    $service_cost = test_input($_POST["service-cost"]);

    // Check if the input already exists or not 
    $check_service = $conn->prepare("SELECT COUNT(*) FROM `services` WHERE `service-type`= ?");
    $check_service->bindParam(1, $service_type, PDO::PARAM_STR);
    $check_service->execute();
    $count = $check_service->fetchColumn();

    if ($count > 0) {
        echo "<script>document.getElementById('message').style.color = 'red';</script>";
        echo "<script>document.getElementById('message').innerHTML = 'Service already exists.';</script>";
    } else {
        // Insert the service type if it doesn't exist
        $insert_service = $conn->prepare("INSERT INTO `services`(`dept-name`, `service-type`, `service-cost`) VALUES (?,?,?)");
        $insert_service->bindParam(1, $dept_name, PDO::PARAM_STR);
        $insert_service->bindParam(2, $service_type, PDO::PARAM_STR);
        $insert_service->bindParam(3, $service_cost, PDO::PARAM_INT);
        if ($insert_service->execute()) {
            echo "<script>document.getElementById('message').innerHTML = 'Service added successfully.';</script>";
        } else {
            echo "<script>document.getElementById('message').style.color = 'red';</script>";
            echo "<script>document.getElementById('message').innerHTML = 'Error adding department.';</script>";
        }
    }
}
?>

</html>