<?php include("../connection.php"); ?>

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
    .container label {
        width: 100%;
        margin-bottom: 0;
    }

    .container input,
    textarea,
    select {
        width: 100%;
        margin-bottom: 14px;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .left,
    .right {
        flex: 1;
        height: 70vh;
        padding: 20px;
    }

    input[type="submit"] {
        width: 150px;
        padding: 5px 10px;
        margin-top: 30px;
        margin-right: 0;
        font-size: 20px;
        float: right;
    }

    label[for="confirm-password"] {
        margin-top: 15px;
    }

    form span {
        margin-bottom: 0px;
        margin-top: -15px;
        display: block;
        background-color: lightgreen;
        color: red;
        font-size: 14px;
        z-index: -1;
    }

    #uid-id-error,
    #emp-id-error,
    #email-error,
    #mobile-no-error {
        display: none;
    }

    .dept {
        height: 30px;
    }

    @media screen and (max-width: 545px) {
        .container {
            display: block;
        }

        .my-box {
            height: 1300px !important;
        }

        #message {
            display: block;
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
                <div class="my-box" style="height: 800px">
                    <h4>Add New Employee</h4>
                    <hr>
                    <span id="message"></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="container">
                            <div class="left">
                                <label for="emp-id">Emp ID</label>
                                <input type="text" name="emp-id" tabindex="1" value="<?php echo isset($_POST['emp-id']) ? htmlspecialchars($_POST['emp-id']) : '' ?>" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="Employee ID must be  at least 8 characters, including at least one number and one letter" required>
                                <span id="emp-id-error"></span>
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name" tabindex="3" value="<?php echo isset($_POST['first-name']) ? htmlspecialchars($_POST['first-name']) : '' ?>" required>
                                <label for="department">Department</label>
                                <select name="department" tabindex="5" required class="dept">
                                    <?php
                                    include('../connection.php');
                                    $query = "SELECT `dept-name` FROM `department`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $depts = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($depts as $row) {
                                        echo "<option value='" . htmlspecialchars($row['dept-name']) . "'";
                                        if (isset($_POST['department']) && $_POST['department'] == $row['dept-name']) {
                                            echo " selected";
                                        }
                                        echo ">" . htmlspecialchars($row['dept-name']) . "</option>";
                                    }
                                    ?>
                                </select>

                                <label for="mobile-no">Mobile No.</label>
                                <input type="number" name="mobile-no" pattern="[0-9]{10}" title="Please atleast 10-digit number" tabindex="7" value="<?php echo isset($_POST['mobile-no']) ? htmlspecialchars($_POST['mobile-no']) : '' ?>" required>
                                <span id="mobile-no-error"></span>
                                <label for="state">State</label>
                                <input type="text" name="state" tabindex="9" value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : '' ?>" required>
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" tabindex="11" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '' ?>" required>
                                <label for="address">Address</label>
                                <textarea name="address" tabindex="13" required></textarea>
                                <label for="profile-pic">Photo</label>
                                <input type="file" name="profile-pic" tabindex="15" value="<?php echo isset($_POST['profile-pic']) ? htmlspecialchars($_POST['profile-pic']) : '' ?>">
                            </div>
                            <div class="right">
                                <label for="uid-id">UID No.</label>
                                <input type="number" name="uid-id" pattern="\d{12}" title="UID should be a 12-digit number" tabindex="2" value="<?php echo isset($_POST['uid-id']) ? htmlspecialchars($_POST['uid-id']) : '' ?>" required>
                                <span id="uid-id-error"></span>
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last-name" tabindex="4" value="<?php echo isset($_POST['last-name']) ? htmlspecialchars($_POST['last-name']) : '' ?>" required>
                                <label for="e-mail">E-mail</label>
                                <input type="text" name="e-mail" tabindex="6" value="<?php echo isset($_POST['e-mail']) ? htmlspecialchars($_POST['e-mail']) : '' ?>" required>
                                <span id="email-error"></span>
                                <label for="country">Country</label>
                                <input type="text" name="country" tabindex="8" value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '' ?>" required>
                                <label for="city">City</label>
                                <input type="text" name="city" tabindex="10" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>" required>
                                <label for="doj">Date of joining</label>
                                <input type="date" name="doj" tabindex="12" value="<?php echo isset($_POST['doj']) ? htmlspecialchars($_POST['doj']) : '' ?>">
                                <label for="password">Password</label>
                                <input type="password" name="password" tabindex="14" required>
                                <span id="password-error"></span>
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" name="confirm-password" tabindex="16" required>
                                <span id="password-error"></span>
                                <input type="submit" class="a-button" tabindex="17">
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

    <?php

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }




    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $emp_id = strtolower(test_input($_POST["emp-id"]));
        $first_name = ucfirst(test_input($_POST["first-name"]));
        $department = ucfirst(test_input($_POST["department"]));
        $mobile_no = test_input($_POST["mobile-no"]);
        $state = ucfirst(test_input($_POST["state"]));
        $dob = test_input($_POST["dob"]);
        $profile_img = test_input($_POST["profile-pic"]);
        $password = test_input($_POST["password"]);
        $uid_id = strtolower(test_input($_POST["uid-id"]));
        $last_name = ucfirst(test_input($_POST["last-name"]));
        $mail = strtolower(test_input($_POST["e-mail"]));
        $country = ucfirst(test_input($_POST["country"]));
        $city = ucfirst(test_input($_POST["city"]));
        $doj = test_input($_POST["doj"]);
        $address = ucfirst((test_input($_POST["address"])));
        $confirm_password = test_input($_POST["confirm-password"]);
        $errors = array();

        // Check if the input already exists or not

        $check_uid_id = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `uid-id`= ?");
        $check_uid_id->bindParam(1, $uid_id, PDO::PARAM_STR);
        $check_uid_id->execute();
        $count_uid_id = $check_uid_id->fetchColumn();
        if ($count_uid_id > 0) {
            $errors['uid-id'] = "UID NO. already exists";
            echo "<script>document.getElementById('uid-id-error').style.display = 'block';</script>";
        }

        $check_emp_id = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `emp-id`= ?");
        $check_emp_id->bindParam(1, $emp_id, PDO::PARAM_STR);
        $check_emp_id->execute();
        $count_emp_id = $check_emp_id->fetchColumn();
        if ($count_emp_id > 0) {
            $errors['emp-id'] = "Employee ID already exists";
            echo "<script>document.getElementById('emp-id-error').style.display = 'block';</script>";
        }

        $check_mail = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `e-mail`= ?");
        $check_mail->bindParam(1, $mail, PDO::PARAM_STR);
        $check_mail->execute();
        $count_mail = $check_mail->fetchColumn();

        if ($count_mail > 0) {
            echo "<script>console.log('emp alredy exits')</script>";
            $errors['email'] = "E-mail already exists";
            echo "<script>document.getElementById('email-error').style.display = 'block';</script>";
        }

        if (!empty($errors)) {
            echo "<script>";
            foreach ($errors as $field => $error) {
                echo "console.log('Error for $field: $error');";
                echo "document.getElementById('$field-error').innerHTML = '$error';";
            }
            echo "</script>";
        }
        if ($password !== $confirm_password) {
            echo "<script>document.getElementById('message').style.color = 'red';</script>";
            echo "<script>document.getElementById('password-error').innerHTML = 'Password does not match';</script>!";
        }
        // inseration if no error found

        if ($count_emp_id <= 0 && $count_uid_id <= 0 && $count_mail <= 0 && $password === $confirm_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $emp = $conn->prepare("INSERT INTO `employee-info`(`emp-id`, `uid-id`, `first-name`, `last-name`, `department`, `e-mail`, `mobile-no`, `country`, `state`, `city`, `dob`, `doj`, `profile-img`, `address`, `password`) 
                                               VALUES ('$emp_id','$uid_id','$first_name','$last_name','$department','$mail','$mobile_no','$country','$state','$city','$dob','$doj','$profile_img','$address','$hash')");

            if ($emp->execute()) {
                echo "<script>document.getElementById('message').innerHTML = 'Employee added Successfully';</script>!";
            } else {
                echo "<script>document.getElementById('message').style.color = 'red';</script>";
                echo "<script>document.getElementById('message').innerHTML = 'Failed to add , try agian!';</script>.";
            }
        }
    }
    ?>
</body>

</html>