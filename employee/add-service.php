<?php
include('../connection.php');
include('config.php');
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
    select {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    input[type="submit"] {
        width: 150px;
        margin-top: 20px;
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
        width: 33%;
    }

    #confirmation .container div {
        border: 1px solid lightgray;
    }

    .confirm-button button {
        display: inline-block;
        width: 150px;
        margin: 15px 10px;
        font-size: 20px;
    }

    @media screen and (max-width: 873px) {
        .container {
            display: block;
        }

        .first,
        .second,
        .third,
        .four {
            width: 100%;
        }

        .my-box {
            height: 700px !important;
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
                <div class="my-box" style="height: 360px">
                    <h4>Add Service</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="add-confirm.php" method="POST" onsubmit="return showConfirmation()">
                        <input type="hidden" name="emp-id" value="<?php echo isset($_SESSION['emp_id']) ? htmlspecialchars($_SESSION['emp_id']) : ''; ?>">
                        <div class="container">
                            <div class="first">
                                <label for="customer-name">Customer name:</label>
                                <input type="text" name="customer-name" id="customer-name" placeholder="Name of Customer">
                            </div>
                            <div class="first">
                                <label for="customer-number">Customer number:</label>
                                <input type="text" name="customer-number" id="customer-number" placeholder="Phone number">
                            </div>
                        </div>
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
                                <label for="service-type">Service type:</label>
                                <!-- Dropdown for selecting service type -->
                                <select name="service-type" id="service-type" style="padding: 3px" required>
                                    <option value="">Select a service type</option>
                                    <?php
                                    // Preload all service types for each department
                                    $query = "SELECT `dept-name`, `service-type` FROM `services`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $services = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($services as $row) {
                                        // Populate the dropdown options with service types, and mark each option with the department it belongs to
                                        echo "<option class='service-option' data-dept-name='" . htmlspecialchars($row['dept-name']) . "' value='" . htmlspecialchars($row['service-type']) . "'>" . htmlspecialchars($row['service-type']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="third"><label for="service-number">No. of services:</label>
                                <input type="text" name="service-number" id="service-number" placeholder="Total number of services">
                                <input type="submit" name="submit" value="Add Service" class="a-button">
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

</body>




</html>