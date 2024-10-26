<?php
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<style>

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
</head>

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
                <div class="my-box" style="height: 87vh;">
                    <h4>Extra Settings</h4>
                    <hr>
                    <span id="message"></span>
                    <div class="continer">
                        <form id="reset" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmSubmit()" style='display: block'>
                            <div style="margin: 20px;">
                                <div style="display: inline-block"> <input type="submit" name="reset-day" value="Next day Event" class="button" style="width: 200px" /></div>
                                <div style="display: inline-block">This is the Event when Next day Starts</div>
                            </div>
                            <div style="margin: 20px;">
                                <div style="display: inline-block">
                                    <input type="submit" name="reset-month" value="Next month Event" class="button" style="width: 200px" />
                                </div>
                                <div style="display: inline-block">This is the Event when Next Month </div>
                            </div>
                            <div style="margin: 20px;">
                                <div style="display: inline-block"> <input type="submit" name="reset-enteries" value="Reset all enteries" class="button" style="width: 200px" /></div>
                                <div style="display: inline-block">It will reset All entities except dept, service, emp</div>
                            </div>
                            <div style="margin: 20px;">
                                <div style="display: inline-block"> <input type="submit" name="reset-everything" value="Reset Everything" class="button" style="width: 200px" /></div>
                                <div style="display: inline-block">It will reset the whole database. except Holidays </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
        function confirmSubmit() {
            return confirm("Are you sure you want to submit?");
        }
    </script>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset-month'])) {
    // copy values to another table for history
    $copy_history = $conn->prepare("INSERT INTO `attend-details` ( `emp-id`, `days-present`, `days-approved`, `days-absent`, `holidays`) 
                                                            SELECT `emp-id`, `days-present`, `days-approved`, `days-absent`, `holidays` FROM `employee-info`");
    $copy_history->execute();
    // reset the exesting table values 
    $reset_details = $conn->prepare("UPDATE `employee-info` SET `days-present`= 0, `days-approved` = 0, `days-absent`= 0 , `holidays` = 0 ");
    $reset_details->execute();
    echo '<script>
            document.getElementById("message").innerHTML = "Attendence copyed to attend details , all attendence reset";
        </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attend-history'])) {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $reset_history = $conn->prepare("DELETE FROM `attend-history`");
        $reset_history->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo '<script>
            document.getElementById("message").innerHTML = "attend history clear";
        </script>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset-enteries'])) {
    $reset_history = $conn->prepare("DELETE FROM `attend-history`;
                                    DELETE FROM `attend-details`;
                                    DELETE FROM `leave-applied`;
                                    DELETE FROM `services-applied`;
                                    DELETE FROM `salary`;
                                    UPDATE `employee-info` SET `days-present`= 0, `days-approved` = 0, `days-absent`= 0 , `holidays` = 0, `attend-status` = 'Pending';
                                    ");
    if ($reset_history->execute()) {
        echo '<script>
        document.getElementById("message").innerHTML = "All enteries clear";
    </script>';
    } else {
        echo '<script>
        document.getElementById("message").innerHTML = "somethng went wrong";
    </script>';
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset-everything'])) {
    $reset_history = $conn->prepare("DELETE FROM `attend-details`;
                                     DELETE FROM `attend-history`;
                                     DELETE FROM `department`;
                                     DELETE FROM `employee-info`;
                                     DELETE FROM `leave-applied`;
                                     DELETE FROM `salary`;
                                     DELETE FROM `services`;
                                     DELETE FROM `services-applied`;
                                     DELETE FROM `leave-info`;
                                     ");
    $reset_history->execute();
    echo '<script>
            document.getElementById("message").innerHTML = "Everything is clear";
        </script>';
}
if ($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['reset-day'])) {
    // This statement select all the rows for the table employee
    $stmt = $conn->prepare("SELECT `emp-id` FROM `employee-info`;");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $date = date('Y-m-d');
    $previous_date = date('Y-m-d', strtotime('-1 day'));

    // check if today is holiday or not 
    $stmt = $conn->prepare("SELECT * FROM `holidays` WHERE `date` = CURDATE()");
    $stmt->execute();
    $result = $stmt->fetch();
    $status = 'Pending';
    if ($stmt->rowCount() >  0) {
        echo "Today is Holiday <br>";
        $status = 'Holiday';
        $stmt = $conn->prepare("UPDATE `employee-info` SET  `attend-status` =  :status , `holidays` = `holidays` + 1 ");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        echo "attend status set to Holiday , Holiday value updated <br>";
        foreach ($rows as $row) {
            $emp_id = $row['emp-id'];
            echo "Row inserted into the table for ($emp_id) , as today is holiday <br>";
            $stmt = $conn->prepare("INSERT INTO `attend-history` (`emp-id`, `status`, `current-date`) VALUES (:emp_id, :status, :date)");
            $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
        }
    } else {
        echo "Today is not holiday";
        // check if the employee is on leave 
        $current_status = "";
        foreach ($rows as $row) {
            $emp_id = $row['emp-id'];
            //check current status 
            $stmt = $conn->prepare("SELECT  `attend-status` FROM `employee-info` WHERE `emp-id` = :emp_id");
            $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            $current_status = $result['attend-status'];
            // check leave status of the employee 
            $stmt = $conn->prepare("SELECT `emp-id` , `action` FROM `leave-applied` WHERE CURDATE() 
                                        BETWEEN `from-date` AND `to-date` AND  `emp-id` = :emp_id ORDER BY id DESC LIMIT 1");
            $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($stmt->rowCount() > 0) {
                if ($result['action'] == 'Approved' && $current_status !== "Marked") {
                    // execute when leave is approved 
                    $status = 'On Leave';
                    echo $emp_id . " is " . $status;
                    $stmt = $conn->prepare("UPDATE `employee-info` set  `days-approved` = `days-approved` + 1 , `attend-status` = :status WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $stmt->execute();
                    echo $emp_id . " is days-Approved updated as Leave approved <br> ";
                    $stmt = $conn->prepare("INSERT INTO `attend-history` (`emp-id`, `status`, `current-date`) VALUES (:emp_id, :status, :date)");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $date = date('Y-m-d');
                    $stmt->bindParam(':date', $date);
                    $stmt->execute();
                    echo $emp_id . " is attend-history is Updated , as Leave approved <br>";
                } else if ($result['action'] == 'Rejected') {
                    //execute when leave is rejected 
                    $status = 'Absent';
                    echo $emp_id . " is " . $status . " As leave is rejected";
                    // update days-absent value
                    $stmt = $conn->prepare("INSERT INTO `attend-history` (`emp-id`, `status`, `current-date`) VALUES (:emp_id, :status, :date);");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $date = date('Y-m-d');
                    $stmt->bindParam(':date', $date);
                    $stmt->execute();
                    echo $emp_id . " is attend-history Updated as Leave is Rejected <br>";
                    $stmt = $conn->prepare("UPDATE `employee-info` SET `days-absent` = `days-absent` + 1 , `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                    echo $emp_id . " is days-Absent updated  as Leave is Rejected <br>";
                }
            } else {
                if ($current_status == 'Pending') {
                    $status = 'Absent';
                    echo $emp_id . " is days-Absent updated  as attend-status is Pending <br>";
                    $stmt = $conn->prepare("INSERT INTO `attend-history` (`emp-id`, `status`, `current-date`) VALUES (:emp_id, :status, :date)");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $date = date('Y-m-d');
                    $stmt->bindParam(':date', $date);
                    $stmt->execute();
                    echo $emp_id . " is attend-history Updated as attend-status is Pending <br>";
                    // update days-absent value
                    echo $emp_id . " is " . $status . " as attend-status is Pending <br>";
                    $stmt = $conn->prepare("UPDATE `employee-info` SET `days-absent` = `days-absent` + 1 , `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                } else if ($current_status == 'Holiday') {
                    $status = 'Holiday';
                    // update days-absent value
                    echo $emp_id . " is " . $status . " as attend-status is Pending <br>";
                    $stmt = $conn->prepare("UPDATE `employee-info` SET `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                } else if ($current_status == 'Marked') {
                    $status = 'Present';
                    echo $emp_id . "attend history already updated while marked<br>";
                    // update days-absent value
                    echo $emp_id . " is " . $status . " as attend-status is Pending <br>";
                    $stmt = $conn->prepare("UPDATE `employee-info` SET `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                } else if ($current_status == 'On Leave') {
                    $status = 'On Leave';
                    echo $emp_id . "attend history already updated while marked<br>";
                    // update days-absent value
                    echo $emp_id . " is " . $status . " as attend-status is Pending <br>";
                    $stmt = $conn->prepare("UPDATE `employee-info` SET `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
            if ($result['action'] == 'Approved' && $current_status == "Marked") {
                echo $emp_id . " Special Case attend history already updated while marked and also on Leave<br>";
                // update days-absent value
                echo $emp_id . " is " . $status . " as attend-status is Pending <br>";
                $stmt = $conn->prepare("UPDATE `employee-info` SET `attend-status` = 'Pending' WHERE `emp-id` = :emp_id");
                $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }
    $stmt = $conn->prepare("UPDATE `employee-info` set  `last-update` = :date");
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    echo '<script>
            document.getElementById("message").innerHTML = "Everything is clear";
        </script>';
}
?>