<?php
include('../connection.php');
include('config.php');

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Process and store the form data
    $customer_name = test_input($_POST['customer-name']);
    $customer_number = test_input($_POST['customer-number']);
    $selected_dept_name = test_input($_POST['dept-name']);
    $service_type = test_input($_POST['service-type']);
    $quantity = test_input($_POST["service-number"]);

    // calulate service cost 
    $select_cost = $conn->prepare("SELECT `service-cost` FROM `services` WHERE `service-type` = ?;");
    $select_cost->bindParam(1, $service_type, PDO::PARAM_STR);
    $select_cost->execute();
    $service_cost_row = $select_cost->fetch(PDO::FETCH_ASSOC);
    if ($service_cost_row !== false) {
        $service_cost = $service_cost_row['service-cost'];
    } else {
        // Handle the case when no row is found, e.g., set a default value
        $service_cost = 0; // Set a default cost of 0
    }
    // Calculate the total amount
    $amount = intval($quantity) * intval($service_cost);
    // Store the data in a session variable for later use
    $_SESSION['customer_name'] = $customer_name;
    $_SESSION['customer_number'] = $customer_number;
    $_SESSION['selected_dept_name'] = $selected_dept_name;
    $_SESSION['service_type'] = $service_type;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['amount'] = $amount;
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d H:i:s");
    $_SESSION['date-time'] = (string) $date;
    // retreving the applicaiton id 

    $sql = "SHOW TABLE STATUS LIKE 'services-applied'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $table_status = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($table_status !== false && isset($table_status['Auto_increment'])) {
        $next_id = (int) $table_status['Auto_increment'];
    } else {
        $next_id = 0;
    }
    $_SESSION['application-no'] = str_pad($next_id, 8, '0', STR_PAD_LEFT);
} else {
    // If the user accesses this page directly without submitting the form, redirect back to the form page
    echo "<script>document.getElementById('message').innerHTML = 'error .';</script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>User Dashboard</title>
</head>
<style>
    .my-box p,
    .my-box input[type="text"],
    select {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    .a-button {
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
    .third,
    .four {
        flex: 1;
        height: 100px;
        padding: 20px;
    }

    #confirmation .container div {
        border: 1px solid lightgray;
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
                <div id="confirmation" class="my-box" style="height: 500px; display: block">
                    <h3 style="text-align: center">Please confirm Information</h3>
                    <hr>
                    <form action="add-confirm.php" method="POST">
                        <div class="container">
                            <div class="first">
                                <h5> Operator Name:</h5>
                                <p><span id="operatior-name">
                                        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5> Date:</h5>
                                <p><span id="entry-date">
                                        <?php echo $_SESSION['date-time'] ?>
                                    </span></p>
                            </div>
                            <div class="third">
                                <h5> Applicaion No.</h5>
                                <p><span id="confirm-name">
                                        <?php echo $_SESSION['application-no'] ?>
                                    </span></p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <h5> Applicant Name:</h5>
                                <p><span id="confirm-name">
                                        <?php echo $_SESSION['customer_name'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Mobile Number:</h5>
                                <p><span id="confirm-number">
                                        <?php echo $_SESSION['customer_number'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Service Asked for:</h5>
                                <p><span id="confirm-type">
                                        <?php echo $_SESSION['service_type'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Department:</h5>
                                <p><span id="confirm-dept">
                                        <?php echo $_SESSION['selected_dept_name'] ?>
                                    </span></p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <h5>Total Amount:</h5>
                                <p style="color: red"><span id="confirm-amount">
                                        <?php echo $_SESSION['amount'] . " ₹ " ?>
                                    </span></p>
                            </div>
                            <div class="second confirm-button">
                                <input type="submit" name="confirm" value="confirm" class="a-button" onclick="">
                                <input type="button" value="Cancel" onclick="window.history.back()" class="a-button">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <span id="message"></span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function redirectToPage() {
            {

            }
        }
    </script>
</body>
<?php
// not useable ---------------------------------------------------------------------
include_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    $customer_name = $_SESSION['customer_name'];
    $customer_number = $_SESSION['customer_number'];
    $dept_name = $_SESSION['selected_dept_name'];
    $service_type = $_SESSION['service_type'];
    $quantity = test_input($_SESSION['quantity']);
    $total_cost = test_input($_SESSION['amount']);
    $emp_id = $_SESSION['emp_id'];
    $timestamp = ($_SESSION['date-time']);
    // Insert the service type if it doesn't exist
    $insert_service = $conn->prepare("INSERT INTO `services-applied`(`customer-name`, `customer-number`, `dept-name`, `service-type`, `quantity`, `total-cost`,`emp-id`, `date-time`) VALUES (?,?,?,?,?,?,?,?)");
    $insert_service->bindParam(1, $customer_name, PDO::PARAM_STR);
    $insert_service->bindParam(2, $customer_number, PDO::PARAM_INT);
    $insert_service->bindParam(3, $dept_name, PDO::PARAM_STR);
    $insert_service->bindParam(4, $service_type, PDO::PARAM_STR);
    $insert_service->bindParam(5, $quantity, PDO::PARAM_INT);
    $insert_service->bindParam(6, $total_cost, PDO::PARAM_INT);
    $insert_service->bindParam(7, $emp_id, PDO::PARAM_STR);
    $insert_service->bindParam(8, $timestamp, PDO::PARAM_STR);
    if ($insert_service->execute()) {
        echo '<script>window.location.href = "s-print.php";</script>';
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'Error adding department.';</script>";
    }
}

?>



</html>