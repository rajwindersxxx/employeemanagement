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

//calculate the total days approved
$leaves = $conn->prepare("SELECT `days` FROM `leave-applied` WHERE `action` = 'Approved' and `emp-id` = :id");
$leaves->bindParam(':id', $_SESSION['emp_id']);
$leaves->execute();
$days_approved = $leaves->fetchAll(PDO::FETCH_ASSOC);
$total_days_approved = 0;
foreach ($days_approved as $row) {
    $total_days_approved += $row['days'];
}

try {
    $attend_marked = $conn->prepare("UPDATE `employee-info` SET `days-approved` = :total_days_approved WHERE `id` = :id");
    $attend_marked->bindParam(':total_days_approved', $total_days_approved);
    $attend_marked->bindParam(':id', $_SESSION['id']);
    $attend_marked->execute();
} catch (PDOException $e) {
    echo "Error updating days approved: " . $e->getMessage();
}

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");
// fetch the current status of attendence
$query = "SELECT `attend-status`,`mark-time`, `days-present`, `days-absent`, `days-approved`, `holidays` FROM `employee-info` WHERE `id` = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_SESSION['id']);
$stmt->execute();
$attend = $stmt->fetchall(PDO::FETCH_ASSOC);
foreach ($attend as $row) {
    $attend_status = $row['attend-status'];
    $days_present = $row['days-present'];
    $days_absent = $row['days-absent'];
    $leave_approved = $row['days-approved'];
    $public_holidays = $row['holidays'];
    $mark_time = $row['mark-time'];
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
    <title>Attendence</title>
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
        width: 200px;
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
<?php

?>

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
                <div id="confirmation" class="my-box" style="height: 90vh; display: block">
                    <h3 style="text-align: center">Please Mark your Attendence</h3>
                    <hr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="container">
                            <div class="first">
                                <h5> Employee Name:</h5>
                                <p><span id="operatior-name">
                                        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
                                    </span></p>
                            </div>
                            <div class="third">
                                <h5> Employee Id: </h5>
                                <p><span id="employee-id">
                                        <?php echo $_SESSION['emp_id'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5> Today Date and Time:</h5>
                                <p><span id="entry-date">
                                        <?php echo $date ?>
                                    </span></p>
                            </div>

                        </div>
                        <div class="container">
                            <div class="first">
                                <h5> Total days Present:</h5>
                                <p><span id="days-present">
                                        <?php echo $days_present . " days" ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5> Total days absent:</h5>
                                <p><span id="days-absent">
                                        <?php echo $days_absent . " days" ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Total Leave approved:</h5>
                                <p><span id="leave-approved">
                                        <?php echo $leave_approved . " days" ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Total Public holidays: </h5>
                                <p><span id="public-holidays">
                                        <?php echo $public_holidays . " days" ?>
                                    </span></p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <h5>Attendence status:</h5>
                                <p><span id="status" <?php
                                                        if ($attend_status == 'Marked') {
                                                            echo "style='color: green;'";
                                                        } else {
                                                            echo "style='color: red;'";
                                                        }
                                                        ?>>
                                        <?php echo $attend_status ?>
                                    </span></p>
                            </div>
                            <div class="first">
                                <h5>Mark time:</h5>
                                <p style="color: blue"><span id="mark-time">
                                        <?php echo $mark_time ?>
                                    </span></p>
                            </div>
                            <div class="second confirm-button">
                                <input type="hidden" value="Marked" name="attend-status">
                                <input id="submitBtn" type="submit" name="marked" value="Mark Attendance" class="a-button" onclick="window.reload()" 
                                <?php
                                                                                                                                                    if ($attend_status == 'Marked') {
                                                                                                                                                        echo "style='display: none;'";
                                                                                                                                                    } else {
                                                                                                                                                        echo "style='display: block;'";
                                                                                                                                                    }
                                                                                                                                                    ?>>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <span id="message"></span>
                    <?php
                    if ($attend_status == 'Holiday') {
                        $stmt =  $conn->prepare("SELECT `reason` FROM `holidays` WHERE `date` = CURDATE()");
                        $stmt->execute();
                        $result = $stmt->fetch();
                        $reason = $result['reason'];
                        echo "<p class='reason' style='text-align: center; border: 1px solid black;'> \"Today is Holiday for <strong>$reason</strong>\"</p>";
                    }
                    ?>
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
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
<?php
// not useable ---------------------------------------------------------------------
include_once("../connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['marked'])) {
    $emp_id = $_SESSION['emp_id'];
    // Insert the service type if it doesn't exist
    $attend_marked = $conn->prepare("UPDATE `employee-info` SET `attend-status` = 'Marked' , `days-present` = `days-present` + 1 ,`mark-time` = :date  where `id` = :id");
    $attend_marked->bindParam(':date', $date, PDO::PARAM_STR);
    $attend_marked->bindParam(':id', $_SESSION['id']);
    if ($attend_marked->execute()) {
        $insertStmt = $conn->prepare("INSERT INTO `attend-history` (`emp-id`, `status`, `current-date`, `time`) VALUES (:emp_id, 'Present', :date, :date);");
        $insertStmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
        $insertStmt->bindParam(':date', $date);
        $insertStmt->execute();

        echo "<script>
                    window.location.href = 'employeepage.php';
             </script>";
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'Something went worng, try again!';</script>";
    }
}

?>



</html>