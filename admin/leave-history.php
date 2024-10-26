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
                <div class="my-box" style="height: 84vh;">
                    <h4>Leave History</h4>
                    <hr>
                    <span id="message"></span>
                    <div class="continer">
                        <form id="form" method="post" style="height: 70vh;overflow: auto;">
                            <table class="table table-bordered text-center" id="myTable">
                                <tr class="bg-dark text-white">
                                    <th onclick="sortNumber(0)">Serail No</th>
                                    <th onclick="sortTable(1)">Employee id</th>
                                    <th onclick="sortTable(2)">Leave type</th>
                                    <th onclick="sortTable(3)">Apply date</th>
                                    <th onclick="sortTable(4)">Apply from</th>
                                    <th onclick="sortTable(5)">Apply To</th>
                                    <th onclick="sortNumber(6)">days</th>
                                    <th onclick="sortTable(7)">Reason</th>
                                    <th onclick="sortTable(8)">Status</th>
                                </tr>
                                <?php
                                include('../connection.php');
                                $stmt = $conn->prepare("SELECT `id`, `emp-id`, `leave-type`, `apply-date`, `from-date`, `to-date`, `days`, `reason`, `action` 
                                       FROM `leave-applied` ORDER BY id DESC");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $number = 1;
                                $status = 'pending';
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $number . "</td>";
                                    echo "<td>" . $row["emp-id"] . "</td>";
                                    echo "<td>" . $row["leave-type"] . "</td>";
                                    echo "<td>" . $row["apply-date"] . "</td>";
                                    echo "<td>" . $row["from-date"] . "</td>";
                                    echo "<td>" . $row["to-date"] . "</td>";
                                    echo "<td>" . $row["days"] . " days" . "</td>";
                                    echo "<td>" . $row["reason"] . "</td>";
                                    echo "<td id='status'>" . $row["action"] . "</td>";
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

                if (cell.innerText.trim() == "Approved") {
                    cell.style.backgroundColor = 'rgba(0,255,0,0.3)';
                } else if (cell.innerText.trim() == "Rejected") {
                    cell.style.backgroundColor = 'rgba(255,0,0, 0.3)';
                } else if (cell.innerText.trim() == "Pending") {
                    cell.style.backgroundColor = 'rgba(255,255,0,0.3)';
                }
            });
        });
    </script>

</html>