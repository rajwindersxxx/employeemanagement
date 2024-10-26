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
    <title>User Dashboard</title>
</head>
<style>
   tr {
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
                <div class="my-box" style="height: 87vh;">
                    <h4>Today Attandence status</h4>
                    <hr>
                    <span id="message"></span>
                    <div class="continer">
                        <form id="form" method="post" style="height: 77vh;overflow: auto;">
                            <table class="table table-bordered text-center" id="myTable">
                                <tr class="bg-dark text-white">
                                    <th onclick="sortNumber(0)">Serial No</th>
                                    <th onclick="sortTable(1)">Employee Id</th>
                                    <th onclick="sortNumber(2)">Name</th>
                                    <th onclick="sortNumber(3)">Department</th>
                                    <th onclick="sortNumber(4)">Mobile number</th>
                                    <th onclick="sortNumber(5)">Mark-time</th>
                                    <th onclick="sortNumber(6)">Status</th>
                                    <?php
                                    include('../connection.php');

                                    $stmt = $conn->prepare("SELECT `emp-id`, `first-name`, `last-name`, `department` , `mobile-no`, `attend-status`, `mark-time`, MONTHNAME(`last-update`) as `month` FROM `employee-info`
                                                            ORDER BY id DESC");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $number = 1;
                                    $status = 'pending';
                                    foreach ($result as $row) {
                                        if ($row['attend-status'] == 'Holiday') {
                                            $status = 'Holiday';
                                            break; // Exit the loop if a non-holiday status is found
                                        }
                                    }
                                    foreach ($result as $row) {
                                        echo "<tr onclick='redirectToDetails(\"attend-details.php?emp-id=" . $row['emp-id'] . "&month=" . $row['month'] . "\")'>";
                                        echo "<td>" . $number . "</td>";
                                        echo "<td>" . $row["emp-id"] . "</td>";
                                        echo "<td>" . $row["first-name"] . " " . $row["last-name"] . "</td>";
                                        echo "<td>" . $row["department"] . "</td>";
                                        echo "<td>" . $row["mobile-no"] . "</td>";
                                        echo "<td>" . $row["mark-time"] . "</td>";
                                        echo "<td>" . $row["attend-status"] . "</td>";
                                        echo "</tr>";
                                        $number++;
                                    }

                                    // JavaScript function to redirect to the details page
                                    echo "<script>";
                                    echo "function redirectToDetails(url) {";
                                    echo "  window.location.href = url;";
                                    echo "}";
                                    echo "</script>";
                                    ?>
                            </table>
                            <?php
                            if ($status == 'Holiday') {
                                $stmt =  $conn->prepare("SELECT `reason` FROM `holidays` WHERE `date` = CURDATE()");
                                $stmt->execute();
                                $result = $stmt->fetch();
                                $reason = $result['reason'];
                                echo "<p class='reason' style='text-align: center; border: 1px solid black;'> \"Today is Holiday for <strong>$reason</strong>\"</p>";
                            }
                            ?>
                        </form>
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
                if (cell.innerText.trim() == "Marked") {
                    cell.style.backgroundColor = 'rgba(0, 255, 0, 0.3)'; // green
                } else if (cell.innerText.trim() == "Pending") {
                    cell.style.backgroundColor = 'rgba(255, 255, 0, 0.3)'; // Light yellow for Pending
                } else if (cell.innerText.trim() == "On Leave") {
                    cell.style.backgroundColor = 'rgba(0, 255, 0, 0.3)'; // Light khaki for On Leave
                } else if (cell.innerText.trim() == "Holiday") {
                    cell.style.backgroundColor = 'rgba(0, 255, 255, 0.3)'; // Light blue for Holiday
                }
            });
        });
    </script>

</html>