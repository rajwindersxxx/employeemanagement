<?php
include('../connection.php');
include('config.php');
$emp_id = $_SESSION['emp_id'];
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
                    <h4>This Month Attendance History</h4>
                    <hr>
                    <span id="message"></span>
                    <div class="continer">
                        <form id="form" method="post" style="height: 70vh;overflow: auto;">
                            <table class="table table-bordered text-center" id="myTable">
                                <tr class="bg-dark text-white">
                                    <th onclick="sortNumber(0)">Serial No</th>
                                    <th onclick="sortTable(1)">Employee Id</th>
                                    <th onclick="sortTable(1)">Date</th>
                                    <th onclick="sortTable(2)">Mark time</th>
                                    <th onclick="sortNumber(5)">Status</th>
                                    <?php
                                    include('../connection.php');
                                    $stmt = $conn->prepare("SELECT * 
                                       FROM `attend-history` WHERE `emp-id` ='$emp_id' AND MONTH(`current-date`) = MONTH(CURDATE()) ORDER BY id DESC");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $number = 1;
                                    $status = 'pending';
                                    foreach ($result as $row) {
                                        echo "<tr>";
                                        echo "<td>" . $number . "</td>";
                                        echo "<td>" . $row["emp-id"] . "</td>";
                                        echo "<td>" . $row["current-date"] . "</td>";
                                        echo "<td>" . $row["time"] . "</td>";
                                        echo "<td>" . $row["status"] . "</td>";
                                        $number++;
                                    }
                                    ?>
                            </table>
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
    <script src="include/sorting.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cells = document.querySelectorAll('td');

            cells.forEach(function(cell) {

                if (cell.innerText.trim() == "Present") {
                    cell.style.backgroundColor = 'rgba(0,255,0,0.3)';
                } else if (cell.innerText.trim() == "Absent") {
                    cell.style.backgroundColor = 'rgba(255,0,0, 0.3)';
                } else if (cell.innerText.trim() == "Pending") {
                    cell.style.backgroundColor = 'rgba(255,255,0,0.3)';
                }
            });
        });
    </script>

</html>