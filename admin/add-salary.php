<?php
include('../connection.php');
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
    .my-box p,
    .my-box input[type="text"],
    select {
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

    body {
        height: 100vh;
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
                <div class="my-box" style="height: 450px">
                    <h4>Add Salary</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="add-salary.php" method="POST">
                        <div class="container">
                            <div class="first">
                                <label for="dept-name">Select department:</label>
                                <!-- Dropdown for selecting department -->
                                <select name="dept-name" id="dept-name" style="padding: 3px" required>
                                    <option value="">Select a department</option>
                                    <?php
                                    // PHP code to fetch departments from the database
                                    include('../connection.php');
                                    $query = "SELECT `dept-name` FROM `department`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $depts = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($depts as $row) {
                                        // Populate the dropdown options with department names
                                        echo "<option value='" . htmlspecialchars($row['dept-name']) . "'";
                                        if (isset($_POST['dept-name']) && $_POST['dept-name'] == $row['dept-name']) {
                                            echo " selected"; // Select the department if it was previously selected
                                        }
                                        echo ">" . htmlspecialchars($row['dept-name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="second">
                                <label for="service-type">Select Employee id:</label>
                                <!-- Dropdown for selecting service type -->
                                <select name="service-type" id="service-type" style="padding: 3px" required>
                                    <option value="">Select a Employee</option>
                                    <?php
                                    // Preload all service types for each department
                                    $query = "SELECT `department`, `emp-id` FROM `employee-info`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $services = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($services as $row) {
                                        // Populate the dropdown options with service types, and mark each option with the department it belongs to
                                        echo "<option class='service-option' data-dept-name='" . htmlspecialchars($row['department']) . "' value='" . htmlspecialchars($row['emp-id']) . "'>" . htmlspecialchars($row['emp-id']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <label for="salary">Add Salary:</label>
                                <input type="text" name="salary" id="salary" placeholder="Add Salary" required>
                            </div>
                            <div class="first">
                                <label for="allowance"> Add Allowance:</label>
                                <input type="text" name="allowance" id="allowance" placeholder="Add Allowance">
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <label for="amount">Total Amount</label>
                                <input style="color: red; font-weight: 20px" type="text" name="amount" id="amount" placeholder="Total amount" readonly>
                            </div>
                            <div class="second">
                                <input class="button" type="submit" name="submit" value="Update Salary" onclick="return confirm('update Salary Confirmation!');">
                            </div>
                        </div>
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
        echo "<script>document.getElementById('message').innerHTML = ' .$id.  Salary Updated Successfully';</script>!";
    } else {
        echo "<script>document.getElementById('message').style.color = 'red';</script>";
        echo "<script>document.getElementById('message').innerHTML = 'Failed to add , try agian!';</script>.";
    }
}
?>



</html>