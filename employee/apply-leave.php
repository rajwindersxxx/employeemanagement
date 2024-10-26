<?php
include('../connection.php');
include('config.php');
$emp_id = $_SESSION['emp_id'];
$id = $_SESSION['id'];
$first_name = $_SESSION['first_name'];

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
    select,
    label,
    .date input,
    textarea {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    .date div {
        display: inline-block;
        width: 49%;
    }

    .first {
        float: right;
    }

    .secont {
        float: left;
    }

    input[type="submit"] {
        width: 150px;
        margin-top: 20px;
        font-size: 20px;
        float: right;
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
                <div class="my-box" style="height: 460px">
                    <h4>Apply Service</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="emp-id" value="<?php echo isset($emp_id) ? htmlspecialchars($emp_id) : ''; ?>">
                        <div class="container">
                            <label for="leave-type">Leave type:</label>
                            <select name="leave-type" style="padding: 3px" required>
                                <?php
                                include('../connection.php');
                                $query = "SELECT `leave-type` FROM `leave-info`";
                                $sql = $conn->prepare($query);
                                $sql->execute();
                                $depts = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($depts as $row) {
                                    echo "<option value='" . htmlspecialchars($row['leave-type']) . "'";
                                    if (isset($_POST['leave-info']) && $_POST['leave-info'] == $row['leave-type']) {
                                        echo " selected";
                                    }
                                    echo ">" . htmlspecialchars($row['leave-type']) . "</option>";
                                }
                                ?>
                            </select>
                            <div class="date">
                                <div class="first">
                                    <label>From Date:</label>
                                    <input type="date" name="from-date" required>
                                </div>
                                <div class="second">
                                    <label>To Date:</label>
                                    <input type="date" name="to-date" required>
                                </div>
                            </div>
                            <div>
                                <label for="reason">Description:</label>
                                <textarea name="reason" style="height: 70px" required></textarea>
                            </div>
                            <input type="submit" value="Apply leave" class="a-button">
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
<?php
include_once("../connection.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_id = test_input($_POST['emp-id']);
    $from_date = test_input($_POST['from-date']);
    $to_date = test_input($_POST['to-date']);
    $reason = test_input($_POST['reason']);
    $leave_type = test_input($_POST['leave-type']);
    $status = 'Pending';
    // calculate days 
    $date1 = new DateTime($from_date);
    $date2 = new DateTime($to_date);
    $interval = $date1->diff($date2);
    $days = $interval->days + 1;
    // Insert the service type if it doesn't exist
    $insert_leave = $conn->prepare("INSERT INTO `leave-applied`(`emp-id`, `leave-type`, `from-date`,`to-date`,`days`,`reason`,`action`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert_leave->bindParam(1, $emp_id, PDO::PARAM_STR);
    $insert_leave->bindParam(2, $leave_type, PDO::PARAM_STR);
    $insert_leave->bindParam(3, $from_date, PDO::PARAM_STR);
    $insert_leave->bindParam(4, $to_date, PDO::PARAM_STR);
    $insert_leave->bindParam(5, $days, PDO::PARAM_INT);
    $insert_leave->bindParam(6, $reason, PDO::PARAM_STR);
    $insert_leave->bindParam(7, $status, PDO::PARAM_STR);
    if ($insert_leave->execute()) {
        echo "<script>document.getElementById('message').innerHTML = 'Leve applied successfully.';</script>";
    } else {
        echo "<script>document.getElementById('message').innerHTML = 'Error applying Leave.';</script>";
    }
}
?>

</html>