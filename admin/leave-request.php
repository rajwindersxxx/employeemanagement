<?php
include('../connection.php');
$approved = false;
$reject = false;
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'approved') {
        // if approved butten is pressed
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Prepare and execute deletion query
            $query = "UPDATE `leave-applied` SET `action`='Approved' WHERE `id` = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);


            if ($stmt->execute()) {
                // Redirect back to the page after deletion
                $approved = true;
            } else {
                // Handle error
                echo "<script>document.getElementById('message').style.color = 'red';</script>";
                echo "<script>document.getElementById('message').innerHTML = 'error , please try again.';</script>";
            }
        } else {
            // Handle case where no ID is provided
            echo "<script>document.getElementById('message').style.color = 'red';</script>";
            "<script>document.getElementById('message').innerHTML = 'no leave request id provided';</script>";
        }
    } elseif ($action === 'reject') {
        //if reject button is pressed
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Prepare and execute deletion query
            $query = "UPDATE `leave-applied` SET `action`='Rejected' WHERE `id` = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);


            if ($stmt->execute()) {
                // Redirect back to the page after deletion
                $reject = true;
            } else {
                // Handle error
                echo "<script>document.getElementById('message').style.color = 'red';</script>";

                echo "<script>document.getElementById('message').innerHTML = 'Leave rejected successfully.';</script>";
            }
        } else {
            // Handle case where no ID is provided
            "<script>document.getElementById('message').innerHTML = 'no Leave id provided';</script>";
        }
    }
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
    <title>Admin Dashboard</title>
</head>
<style>

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
                    <h4>New Leave Request</h4>
                    <hr>
                    <span id="nessage"></span>
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
                                       FROM `leave-applied` WHERE `action` ='pending' ORDER BY id DESC");
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
                                    echo "<td>
                  <a href='leave-request.php?action=reject&id=" . $row['id'] . "' id='reject' class='button' onclick='return confirm(\"Are you sure you want to Reject this Leave request?\")'>Reject</a>
                  <a href='leave-request.php?action=approved&id=" . $row['id'] . "' id= 'approve'class='button' onclick='return confirm(\"Are you sure you want to Approve this leave request?\")'>Approve</a></td>";
                                    echo "</tr>";
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/sorting.js"></script>

    <?php if ($approved) : ?>
        <script>
            document.getElementById('message').innerHTML = 'Leave approved successfully.';
            header('Location: '.$_SERVER['PHP_SELF']);
            exit();
        </script>
    <?php endif; ?>
    <?php if ($reject) : ?>
        <script>
            document.getElementById('message').innerHTML = 'Leave rejected successfully.';
            header('Location: '.$_SERVER['PHP_SELF']);
            exit();
        </script>
    <?php endif; ?>

</body>

</html>