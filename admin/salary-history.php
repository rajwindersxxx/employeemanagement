<?php
include('../connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<style>
    .search {
        display: flex;
        width: 100%;
        margin: 10px 0;
    }

    .row {
        display: flex;
        align-items: center;
        padding: 1px 20px 10px 20px;
        width: 100%;
    }

    .row label {
        margin: 0 10px;
        width: 60px;
    }

    .row input {
        width: 70%;
    }

    .row label {
        margin-bottom: 0;
    }

    .button {
        width: 100px !important;

    }

    .tfoot {
        margin-top: 16px;
    }
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
                    <h4>Salary History</h4>
                    <hr>
                    <span id="message"></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width: 100%;">
                        <div class="search">
                            <div class="row">
                                <label><span>From:</span></label>
                                <input type="date" name="from-date" placeholder="Enter from date">
                            </div>
                            <div class="row">
                                <label><span>To:</span></label>
                                <input type="date" name="to-date" placeholder="Enter to date ">
                            </div>
                            <div class="row">
                                <input type="submit" class="button" value="Search" name="search-date">
                            </div>
                        </div>
                    </form>
                    <div class="continer">
                        <form id="form" method="post" style="height: 53vh;overflow: auto;">
                            <table class="table table-bordered text-center" id="myTable">
                                <tr class="bg-dark text-white">
                                    <th onclick="sortNumber(0)">Serial No</th>
                                    <th onclick="sortTable(1)">Employee Id</th>
                                    <th onclick="sortTable(2)">department</th>
                                    <th onclick="sortNumber(5)">Salary</th>
                                    <th onclick="sortNumber(5)">Allowence</th>
                                    <th onclick="sortNumber(6)">Total</th>
                                    <th onclick="sortTable(7)">Paid date</th>
                                    <th onclick="sortTable(8)">Status</th>
                                </tr>
                                <?php
                                include('../connection.php');
                                $from_date = '1900-01-01';
                                $to_date = '9999-12-31';
                                $number = 1;
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $from_date = $_POST['from-date'];
                                    $to_date = $_POST['to-date'];
                                }
                                $stmt = $conn->prepare("SELECT * 
                                       FROM `salary` WHERE `date-only` BETWEEN :from_date AND :to_date ORDER BY id DESC");
                                $stmt->bindParam(':from_date', $from_date);
                                $stmt->bindParam(':to_date', $to_date);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $number = 1;
                                $total_paid = 0;
                                $total_sal = 0;
                                $total_all = 0;
                                $status = 'pending';
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $number . "</td>";
                                    echo "<td>" . $row["emp-id"] . "</td>";
                                    echo "<td>" . $row["department"] . "</td>";
                                    echo "<td>" . $row["salary"] . " ₹ " . "</td>";
                                    echo "<td>" . $row["allowance"] . " ₹ " . "</td>";
                                    echo "<td>" . $row["total"] . " ₹ " . "</td>";
                                    echo "<td>" . $row["date"] . "</td>";
                                    echo "<td id='status'>" . $row["action"] . "</td>";
                                    $total_paid = $total_paid + $row["total"];
                                    $total_sal = $total_sal + $row["salary"];
                                    $total_all = $total_all + $row["allowance"];
                                    $number++;
                                }
                                ?>
                            </table>

                        </form>
                        <table class="tfoot">
                            <tr>
                                <td>TOTAL SALARY:</td>
                                <td>
                                    <?php echo  $total_sal . " ₹ " ?>
                                </td>
                                <td>TOTAL ALLOWENCE:</td>
                                <td>
                                    <?php echo $total_all . " ₹ " ?>

                                </td>
                                <td>TOTAL PAID:</td>
                                <td>
                                    <?php echo $total_paid . " ₹ " ?>
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

                if (cell.innerText.trim() == "paid") {
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