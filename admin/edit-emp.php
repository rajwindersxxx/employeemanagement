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
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        width: 40%;
        padding: 5px 10px;
        margin-top: 20px;
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

    p {
        margin: -12px;
        text-align: center;
        padding: 0;
    }
    #uid-id-error,
    #emp-id-error,
    #email-error,
    #mobile-no-error {
        display: none;
    }
    select{
        height: 28px; 
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
                    <h4>Edit Employee information</h4>
                    <p>Change only required feild. </p>
                    <hr>
                    <span id="message"></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id"
                            value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                        <div class="container">
                            <div class="left">
                                <label for="emp-id">Emp ID</label>
                                <input type="text" name="emp-id" class="readonly"
                                    value="<?php echo isset($emp_id) ? htmlspecialchars($emp_id) : '' ?>" readonly>
                                <span id="emp-id-error"></span>
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name"
                                    value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : '' ?>">
                                <label for="department">Department</label>
                                <select name="department"
                                    value="<?php echo isset($department) ? htmlspecialchars($department) : '' ?>">
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
                                <input type="number" name="mobile-no"
                                    value="<?php echo isset($mobile_no) ? htmlspecialchars($mobile_no) : '' ?>">
                                <span id="mobile-no-error"></span>
                                <label for="state">State</label>
                                <input type="text" name="state"
                                    value="<?php echo isset($state) ? htmlspecialchars($state) : '' ?>">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob"
                                    value="<?php echo isset($dob) ? htmlspecialchars($dob) : '' ?>">
                                <label for="address">Address</label>
                                <textarea
                                    name="address"><?php echo isset($address) ? htmlspecialchars($address) : '' ?></textarea>
                                <label for="profile-pic">Photo</label>
                                <input type="file" name="image"
                                    value="<?php echo isset($_POST['profile-pic']) ? htmlspecialchars($_POST['profile-pic']) : '' ?>">

                            </div>
                            <div class="right">
                                <label for="uid-id">UID No.</label>
                                <input type="number" name="uid-id" class="readonly"
                                    value="<?php echo isset($uid_id) ? htmlspecialchars($uid_id) : '' ?>" readonly>
                                <span id="uid-id-error"></span>
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last-name"
                                    value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : '' ?>">
                                <label for="e-mail">E-mail</label>
                                <input type="text" name="e-mail" class="readonly"
                                    value="<?php echo isset($mail) ? htmlspecialchars($mail) : '' ?>" readonly>
                                <span id="email-error"></span>
                                <label for="country">Country</label>
                                <input type="text" name="country"
                                    value="<?php echo isset($country) ? htmlspecialchars($country) : '' ?>">
                                <label for="city">City</label>
                                <input type="text" name="city"
                                    value="<?php echo isset($city) ? htmlspecialchars($city) : '' ?>">
                                <label for="doj">Date of joining</label>
                                <input type="date" name="doj"readonly
                                    value="<?php echo isset($doj) ? htmlspecialchars($doj) : '' ?>">
                                <label for="password">Password</label>
                                <input type="text" name="password" placeholder="update if needed"
                                    value="<?php echo isset($password) ? htmlspecialchars($password) : '' ?>">
                                <span id="password-error"></span>
                                <label for="confirm-password">Confirm Password</label>
                                <input type="text" name="confirm-password" placeholder="update if needed"
                                    value="<?php echo isset($password) ? htmlspecialchars($password) : '' ?>">
                                <span id="password-error"></span>
                                <input type="submit" value="Update" class="a-button"
                                    onclick='<?php echo "return confirm(\"Are you sure you want to Update this information?\")" ?>'>
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
    include_once("../connection.php");

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }




    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $emp_id = test_input($_POST["emp-id"]);
        $first_name = test_input($_POST["first-name"]);
        $department = test_input($_POST["department"]);
        $mobile_no = test_input($_POST["mobile-no"]);
        $state = test_input($_POST["state"]);
        $dob = test_input($_POST["dob"]);
        $password = test_input($_POST["password"]);
        $uid_id = test_input($_POST["uid-id"]);
        $last_name = test_input($_POST["last-name"]);
        $mail = test_input($_POST["e-mail"]);
        $country = test_input($_POST["country"]);
        $city = test_input($_POST["city"]);
        $doj = test_input($_POST["doj"]);
        $address = test_input($_POST["address"]);
        $confirm_password = test_input($_POST["confirm-password"]);
        $id = $_POST["id"];
        $errors = array();
        echo $id;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $profile_img = file_get_contents($_FILES['image']['name']);
        }
        // Check if the input already exists or not
    
        $check_uid_id = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `uid-id`= ? AND `id` != ?");
        $check_uid_id->bindParam(1, $uid_id, PDO::PARAM_STR);
        $check_uid_id->bindParam(2, $id, PDO::PARAM_INT);
        $check_uid_id->execute();
        $count_uid_id = $check_uid_id->fetchColumn();
        if ($count_uid_id > 0) {
            $errors['uid-id'] = "UID NO. already exists";

        }

        $check_emp_id = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `emp-id`= ? AND `id` != ?");
        $check_emp_id->bindParam(1, $emp_id, PDO::PARAM_STR);
        $check_emp_id->bindParam(2, $id, PDO::PARAM_INT);
        $check_emp_id->execute();
        $count_emp_id = $check_emp_id->fetchColumn();
        if ($count_emp_id > 0) {
            $errors['emp-id'] = "Employee ID already exists";

        }

        $check_mail = $conn->prepare("SELECT COUNT(*) FROM `employee-info` WHERE `e-mail`= ? AND `id` != ?");
        $check_mail->bindParam(1, $mail, PDO::PARAM_STR);
        $check_mail->bindParam(2, $id, PDO::PARAM_INT);
        $check_mail->execute();
        $count_mail = $check_mail->fetchColumn();
        if ($count_mail > 0) {
            $errors['email'] = "E-mail already exists";

        }

        if (!empty($errors)) {
            echo "<script>";
            foreach ($errors as $field => $error) {
                echo "console.log('Error for $field: $error');";
                echo "document.getElementById('$field-error').innerHTML = '$error';";
            }
            echo "</script>";
        }
        if ($password === $confirm_password && !empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT); 
            $emp_password = $conn->prepare("UPDATE `employee-info` SET `password`= ? WHERE `id`= ? ");
            $emp_password->bindParam(1, $hash, PDO::PARAM_STR);
            $emp_password->bindParam(2, $id, PDO::PARAM_INT);
            if ($emp_password->execute()) {
                echo "<script>document.getElementById('password-error').innerHTML = 'Password change successfully';</script>!";
            } else {
                echo "<script>document.getElementById('message').style.color = 'red';</script>";
                echo "<script>document.getElementById('password-error').innerHTML = 'Password change error, try again';</script>!";
            }
        }
        // update if no error found
    
        try {
            if ($count_emp_id <= 0 && $count_uid_id <= 0 && $count_mail <= 0) {
                $emp = "UPDATE `employee-info` SET ";
                $values = array();
                if (!empty($emp_id)) {
                    $emp .= "`emp-id` = ?,";
                    $values[] = $emp_id;
                }
                if (!empty($uid_id)) {
                    $emp .= "`uid-id` = ?,";
                    $values[] = $uid_id;
                }
                if (!empty($first_name)) {
                    $emp .= "`first-name` = ?,";
                    $values[] = $first_name;
                }
                if (!empty($last_name)) {
                    $emp .= "`last-name`= ?,";
                    $values[] = $last_name;
                }
                if (!empty($department)) {
                    $emp .= "`department` = ?,";
                    $values[] = $department;
                }
                if (!empty($mail)) {
                    $emp .= "`e-mail` = ?,";
                    $values[] = $mail;
                }
                if (!empty($mobile_no)) {
                    $emp .= "`mobile-no` = ?,";
                    $values[] = $mobile_no;
                }
                if (!empty($country)) {
                    $emp .= "`country` = ?,";
                    $values[] = $country;
                }
                if (!empty($state)) {
                    $emp .= "`state` = ?,";
                    $values[] = $state;
                }
                if (!empty($city)) {
                    $emp .= "`city`= ?,";
                    $values[] = $city;
                }
                if (!empty($dob)) {
                    $emp .= "`dob` = ?,";
                    $values[] = $dob;
                }
                if (!empty($doj)) {
                    $emp .= "`doj` = ?,";
                    $values[] = $doj;
                }
                if (!empty($profile_img)) {
                    $emp .= "`profile-img` = ?,";
                    $values[] = $profile_img;
                }
                if (!empty($address)) {
                    $emp .= "`address` = ?,";
                    $values[] = $address;
                }

                $emp = rtrim($emp, ', ');

                $emp .= " WHERE `id` = ?";
                $values[] = $id;
                $emp = $conn->prepare($emp);

                foreach ($values as $key => $value) {
                    $emp->bindValue($key + 1, $value);
                }
                if ($emp->execute()) {
                    echo "<script>document.getElementById('message').innerHTML = 'Employee updated Successfully';</script>";
                } else {
                    echo "<script>document.getElementById('message').style.color = 'red';</script>";
                    echo "<script>document.getElementById('message').innerHTML = 'Failed to update, try again!';</script>";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>