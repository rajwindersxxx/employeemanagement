<?php
include("../connection.php");
// count No of employees
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `employee-info`");
$sql->execute();
$total_emp = $sql->fetch(PDO::FETCH_ASSOC);
// count No of employees Present
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `employee-info` WHERE  `attend-status` = 'Marked'");
$sql->execute();
$total_emp_present = $sql->fetch(PDO::FETCH_ASSOC);
// count No of department
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `department`");
$sql->execute();
$total_dept = $sql->fetch(PDO::FETCH_ASSOC);
// count no of services
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `services`");
$sql->execute();
$total_services = $sql->fetch(PDO::FETCH_ASSOC);
// count no of applyed services
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `services-applied` WHERE `applyed-date` = CURDATE()");
$sql->execute();
$total_services_app = $sql->fetch(PDO::FETCH_ASSOC);
// today collection
$sql = $conn->prepare("SELECT * FROM `services-applied` WHERE `applyed-date` = CURDATE()");
$sql->execute();
$collection = $sql->fetchAll(PDO::FETCH_ASSOC);
$today_collection = 0;
foreach ($collection as $row) {
    $today_collection += $row["total-cost"];
}
// Total collection
$sql = $conn->prepare("SELECT * FROM `services-applied`");
$sql->execute();
$collection = $sql->fetchAll(PDO::FETCH_ASSOC);
$total_collection = 0;
foreach ($collection as $row) {
    $total_collection += $row["total-cost"];
}
//-----------------------------------------------------------------------------------
// total leaves applyed
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `leave-applied`");
$sql->execute();
$leave_applyed = $sql->fetch(PDO::FETCH_ASSOC);

// total requests
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `leave-applied` WHERE `action`='pending'");
$sql->execute();
$leave_request = $sql->fetch(PDO::FETCH_ASSOC);
// approved leaves
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `leave-applied` WHERE `action`='approved'");
$sql->execute();
$leave_approved = $sql->fetch(PDO::FETCH_ASSOC);

// rejected leaves
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `leave-applied`WHERE `action`='rejected'");
$sql->execute();
$leave_rejected = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/all.css">

    <title>Admin Dashboard</title>
</head>
<style>
    .conatiner {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        width: 100%;
        height: 31vh;
    }

    .box {
        width: 90%;
        height: 90px;
        margin: 10px;
        background-color: #333;
        border: 1px solid #51D4E9;
        border-radius: 5%;
    }

    .box h6 {
        width: 100%;
        text-align: center;
        padding: 5px;
        border-bottom: #51D4E9 solid 1px;
        font-weight: bold;
        font-size: 17px;
        color: #51D4E9;

    }

    .conatiner p {
        text-align: center;
        font-size: 22px;
        color: #c4ecf3;

    }

    .box:hover {
        background-color: #535050;
        border-bottom-left-radius: 5%;
        border-top-left-radius: 10%;
        text-decoration: none;
        color: white;
    }

    .container a:active {
        background-color: #535050;

    }

    @media screen and (max-width: 1195px) {
        .my-box2 {
            height: 35vh !important;
        }
    }

    @media screen and (max-width: 977px) {
        .my-box1 {
            height: 50vh !important;
        }

        .my-box2 {
            height: 35vh !important;
        }
    }

    @media screen and (max-width: 560px) {
        .my-box1 {
            height: 70vh !important;
        }

        .my-box2 {
            height: 50vh !important;
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
                <div style="height: 10px"></div>
                <h4>Dashboard</h4>
                <hr>
                <div class="my-box my-box1" style="height: 38vh">
                    <div class="conatiner">
                        <a class="box" href="manage-emp.php">
                            <h6>Total employees</h6>
                            <p id="total-emp"><?php echo $total_emp['total'] ?>
                            </p>
                        </a>
                        <a class="box" href="attend-status.php">
                            <h6>Employees present</h6>
                            <p id="total-emp"><?php echo $total_emp_present['total'] ?>
                            </p>
                        </a>
                        <a class="box" href="manage-dept.php">
                            <h6>Total department</h6>
                            <p id="toatal-dept"><?php echo $total_dept['total'] ?></p>
                        </a>
                        <a class="box" href="manage-service.php">
                            <h6>Total services</h6>
                            <p id="total-service"><?php echo $total_services['total'] ?></p>
                        </a>
                        <a class="box" href="service-report.php">
                            <h6>Service Applied</h6>
                            <p id="total-service-app"><?php echo $total_services_app['total'] ?></p>
                        </a>
                        <a class="box" href="service-report.php">
                            <h6>Today collection</h6>
                            <p id="today-collection"><?php echo " ₹ " . $today_collection ?></p>
                        </a>
                        <a class="box" href="service-history.php">
                            <h6>Total collection</h6>
                            <p id="total-collection"><?php echo " ₹ " . $total_collection ?></p>
                        </a>
                    </div>
                </div>
                <hr>
                <h4>Leave Details</h4>
                <hr>
                <div class=" my-box my-box2" style="height: 20vh">
                    <div class="conatiner">
                        <a class="box" href="leave-history.php">
                            <h6>Total Leaves applyed</h6>
                            <p id="leave-applyed"><?php echo $leave_applyed['total'] ?></p>
                        </a>
                        <a class="box" href="leave-request.php">
                            <h6> New Leave Request</h6>
                            <p id="leave-request"><?php echo $leave_request['total'] ?></p>
                        </a>
                        <a class="box" href="leave-history.php">
                            <h6>Approved Leaves</h6>
                            <p id="leave-approved"><?php echo $leave_approved['total'] ?></p>
                        </a>
                        <a class="box" href="leave-history.php">
                            <h6>Rejected Leaves</h6>
                            <p id="leave-rejected"><?php echo $leave_rejected['total'] ?></p>
                        </a>
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