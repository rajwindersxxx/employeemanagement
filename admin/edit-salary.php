<?php
include('../connection.php');
$id = null;
if (isset($_GET['id'])) {
    global $id;
    $id = (int) $_GET['id'];
    $query = "SELECT * FROM `employee-info` WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $emp_id = $row['emp-id'];
        $first_name = $row['first-name'];
        $department = $row['department'];
        $mobile_no = $row['mobile-no'];
        $state = $row['state'];
        $dob = $row['dob'];
        $profile_img = $row['profile-img'];
        $password = $row['password'];
        $uid_id = $row['uid-id'];
        $last_name = $row['last-name'];
        $mail = $row['e-mail'];
        $country = $row['country'];
        $city = $row['city'];
        $doj = $row['doj'];
        $address = $row['address'];
    }
    $stmt = $conn->prepare("SELECT * 
    FROM `salary` WHERE `emp-id` ='$emp_id' ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $last_salary = $row['salary'];
        $last_allowence = $row['allowance'];
        $total_salary = $row['total'];
        $salary_date = $row['date-only'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .tfoot {
        margin-top: 40px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
</head>
<style>
    .my-box p,
    .my-box input[type="text"],
    input {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    input[type="submit"] {
        width: 150px;
        margin-top: 40px;
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

    @media screen and (max-width: 587px) {
        .container {
            display: block;
        }

        .first,
        .second,
        .third,
        .four {
            height: 80px;
        }

        .my-box {
            height: 600px !important;
        }

        input[type="submit"] {
            margin-top: 15px;
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
                <div class="my-box" style="height: 530px">
                    <h4>Update Salary</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="edit-salary.php" method="POST">

                        <div class="container">
                            <div class="first">
                                <label for="dept-name">Department:</label>
                                <!-- Dropdown for ing department -->
                                <input name="dept-name" id="dept-name" value="<?php echo isset($department) ? htmlspecialchars($department) : ''; ?>" readonly>
                            </div>
                            <div class="second">
                                <label for="service-type"> Employee id:</label>
                                <!-- Dropdown for selecting service type -->
                                <input name="service-type" id="service-type" value="<?php echo isset($emp_id) ? htmlspecialchars($emp_id) : ''; ?>" readonly>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <label for="salary">Add Salary:</label>
                                <input type="text" name="salary" id="salary" placeholder="Add Salary" value="<?php echo isset($last_salary) ? htmlspecialchars($last_salary) : ''; ?>" required>
                            </div>
                            <div class="first">
                                <label for="allowance"> Add Allowance:</label>
                                <input type="text" name="allowance" id="allowance" placeholder="Add Allowance" value="<?php echo isset($last_allowence) ? htmlspecialchars($last_allowence) : ''; ?>">
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <label for="amount">Total Amount</label>
                                <input style="color: red; font-weight: 20px" type="text" name="amount" id="amount" placeholder="Total amount" readonly>
                            </div>
                            <div class="second">
                                <input class="a-button" type="submit" name="submit" value="Update Salary" onclick="return confirm('update Salary Confirmation!');">
                            </div>
                        </div>
                    </form>
                    <?php
                    $query = "SELECT `timestamp`, `days-present`, `days-absent`, `days-approved`, `holidays`, MONTHNAME(`timestamp`) as `month-name`
            FROM `attend-details`
            WHERE `emp-id` = :id
            AND `timestamp` BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01') AND LAST_DAY(NOW() - INTERVAL 1 MONTH)
            ORDER BY `timestamp` DESC
            LIMIT 1";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':id', $emp_id, PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($result) {
                        $days_present = $result['days-present'];
                        $days_absent = $result['days-absent'];
                        $days_approved = $result['days-approved'];
                        $public_holidays = $result['holidays'];
                        $mark_time = $result['timestamp'];
                        $month_name = $result['month-name'];
                        // Process data as needed
                    }

                    ?>

                    <table class="tfoot">
                        <tr>
                            <td>Total days Present:</td>
                            <td>
                                <?php echo !empty($days_present) ? $days_present : ''; ?>
                            </td>
                            <td>Today days Absent</td>
                            <td>
                                <?php echo !empty($days_absent) ? $days_absent : ''; ?>
                            </td>
                            <td>Total Leaves</td>
                            <td>
                                <?php echo !empty($days_approved) ? $days_approved : ''; ?>
                            </td>
                            <td>Total Holidays</td>
                            <td>
                                <?php echo !empty($public_holidays) ? $public_holidays : ''; ?>
                            </td>
                        </tr>
                    </table>
                    <p>Last month Attendece Details Of <?php echo $first_name . " " . $last_name ?> </p>
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
    <script>
        const salaryInput = document.getElementById("salary");
        const allowanceInput = document.getElementById("allowance");
        const totalInput = document.getElementById("amount");

        function calculateTotal() {
            const salary = parseFloat(salaryInput.value) || 0; // Parse input value as a float, default to 0 if NaN
            const allowance = parseFloat(allowanceInput.value) || 0;
            const total = salary + allowance;

            totalInput.value = total; // Update the value of the read-only input
        }

        salaryInput.addEventListener('input', calculateTotal);
        allowanceInput.addEventListener('input', calculateTotal);

        calculateTotal(); // Calculate and display total initially
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var serviceOptions = document.querySelectorAll('.service-option');
            serviceOptions.forEach(function(option) {
                option.style.display = 'none';
            });
        });
        // JavaScript to handle department change
        document.getElementById('dept-name').addEventListener('change', function() {
            var selectedDept = this.value;
            var serviceOptions = document.querySelectorAll('.service-option');
            // Iterate over all service options
            serviceOptions.forEach(function(option) {
                // Show options that belong to the selected department and hide others
                if (option.getAttribute('data-dept-name') === selectedDept || option.getAttribute('data-dept-name') === 'all') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
            // Reset the service type dropdown to its initial state
            document.getElementById('service-type').selectedIndex = 0;
            // Show the second div containing the service selection
            document.querySelector('.second').style.display = 'block';
        });
        // JavaScript to handle form submission
        document.getElementById('myForm').addEventListener('submit', function(event) {
            var deptName = document.getElementById('dept-name').value;
            var serviceType = document.getElementById('service-type').value;
            if (deptName === "" || serviceType === "") {
                // Prevent form submission if no department or service is selected
                event.preventDefault();
                alert("Please select a department and service type.");
            }
        });
    </script>
    <script>
        // prevent resubmit dialoge in form
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cells = document.querySelectorAll('td');

            cells.forEach(function(cell) {

                if (cell.innerText.trim() == "Paid") {
                    cell.style.backgroundColor = 'rgba(0,255,0,0.3)';
                } else if (cell.innerText.trim() == "Pending") {
                    cell.style.backgroundColor = 'rgba(255,255,0,0.3)';
                }
            });
        });
    </script>

</body>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $dept_name = test_input($_POST['dept-name']);
    $id = test_input($_POST['service-type']);
    $salary = test_input($_POST['salary']);
    $allowance = test_input($_POST['allowance']);
    $amount = test_input($_POST['amount']);
    $remark = 'Paid';
    $sql = $conn->prepare("INSERT INTO `salary`(`emp-id`, `department`, `salary`, `allowance`, `total`, `action`) 
                       VALUES (?,?,?,?,?,?)");
    $sql->bindParam(1, $id, PDO::PARAM_STR);
    $sql->bindParam(2, $dept_name, pdo::PARAM_STR);
    $sql->bindParam(3, $salary, pdo::PARAM_INT);
    $sql->bindParam(4, $allowance, pdo::PARAM_INT);
    $sql->bindParam(5, $amount, pdo::PARAM_INT);
    $sql->bindParam(6, $remark, pdo::PARAM_STR);
    if ($sql->execute()) {
        echo "<script>window.location.href = 'manage-emp.php'</script>";
    } else {
        echo "<script>document.getElementById('message').style.color = 'red';</script>";
        echo "<script>document.getElementById('message').innerHTML = 'Failed to add , try agian!';</script>.";
    }
}
?>



</html>