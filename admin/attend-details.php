<?php
include '../connection.php';
if (isset($_GET['emp-id']) && isset($_GET['month'])) {
    global $emp_id;
    $emp_id = (string) $_GET['emp-id'];
    $month = $_GET['month'];
    $month = strtolower($month);
    $currentMonth = strtolower(date('F'));
}
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
    <title>User Dashboard</title>
</head>
<style>
    hr {
        cursor: pointer;
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
                <div class="my-box" style="height: 84vh;">
                    <h4 style="text-transform: capitalize;">Attendance History of <?php echo $emp_id ?> , Month : <?php echo $month ?> </h4>
                    <hr>
                    <span id="message"></span>
                    <div class="continer">
                        <form id="form" method="post" style="height: 63vh;overflow: auto;">
                            <table class="table table-bordered text-center" id="myTable">
                                <tr class="bg-dark text-white">
                                    <th onclick="sortNumber(0)">Serial No</th>
                                    <th onclick="sortTable(1)">Employee Id</th>
                                    <th onclick="sortNumber(2)">Date</th>
                                    <th onclick="sortNumber(3)">Time</th>
                                    <th onclick="sortNumber(4)">status</th>
                                    <?php
                                    include '../connection.php';
                                    $month_number = date('m', strtotime($month));
                                    $year = date('Y'); // Current year

                                    // Calculate the start and end dates for the specified month
                                    $start_date = date('Y-m-01', strtotime("$year-$month_number-01"));
                                    $end_date = date('Y-m-t', strtotime("$year-$month_number-01"));
                                    $stmt = $conn->prepare("SELECT `emp-id`, `current-date`, `time`, `status`
                                        FROM `attend-history`
                                        WHERE `emp-id` = :emp_id
                                        AND `current-date` BETWEEN :start_date AND :end_date
                                        ORDER BY id DESC");

                                    $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_STR);
                                    $stmt->bindParam(':start_date', $start_date);
                                    $stmt->bindParam(':end_date', $end_date);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $number = 1;
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $number . "</td>";
                                        echo "<td>" . $row["emp-id"] . "</td>";
                                        echo "<td>" . $row["current-date"] . "</td>";
                                        echo "<td>" . $row["time"] . "</td>";
                                        echo "<td>" . $row["status"] . "</td>";
                                        echo "</tr>";
                                        $number++;
                                    }
                                    ?>
                            </table>
                        </form>
                        <?php
                        if ($month == $currentMonth) {
                            $query = "SELECT `days-present`, `days-absent`, `days-approved`, `holidays` FROM `employee-info` WHERE `emp-id` = :id";
                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(':id', $emp_id, PDO::PARAM_STR);
                        } else {
                            $query = "SELECT `days-present`, `days-absent`, `days-approved`, `holidays` FROM `attend-details` WHERE `emp-id` = :id
                        AND `timestamp` BETWEEN :start_date AND :end_date ORDER BY id DESC";
                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(':id', $emp_id, PDO::PARAM_STR);
                            $stmt->bindParam(':start_date', $start_date);
                            $stmt->bindParam(':end_date', $end_date);
                        }
                        $stmt->execute();
                        $attend = $stmt->fetchall(PDO::FETCH_ASSOC);
                        foreach ($attend as $row) {
                            $days_present = $row['days-present'];
                            $days_absent = $row['days-absent'];
                            $leave_approved = $row['days-approved'];
                            $public_holidays = $row['holidays'];
                        }
                        ?>
                        <table class="tfoot">
                            <tr>
                                <td>Total days Present:</td>
                                <td>
                                    <?php echo $days_present ?>
                                </td>
                                <td>Today days Absent</td>
                                <td>
                                    <?php echo $days_absent ?>
                                </td>
                                <td>Total Leaves</td>
                                <td>
                                    <?php echo $leave_approved ?>
                                </td>
                                <td>Total Holidays</td>
                                <td>
                                    <?php echo $public_holidays ?>
                                </td>
                            </tr>
                        </table>
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
    <script src="include/sorting.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cells = document.querySelectorAll('td');

            cells.forEach(function(cell) {
                var row = cell.parentElement;
                if (cell.innerText.trim() == "Present") {
                    cell.style.backgroundColor = 'rgba(0, 255, 0, 0.3)'; // green
                } else if (cell.innerText.trim() == "Absent") {
                    cell.style.backgroundColor = 'rgba(255, 0, 0, 0.3)'; // Light yellow for Pending
                } else if (cell.innerText.trim() == "On Leave") {
                    cell.style.backgroundColor = 'rgba(255, 255, 0, 0.3)'; // Light khaki for On Leave
                } else if (cell.innerText.trim() == "Holiday") {
                    cell.style.backgroundColor = 'rgba(0, 255, 255, 0.3)'; // Light blue for Holiday
                }
            });
        });
    </script>

</html>