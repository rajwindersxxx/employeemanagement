<?php
include('../connection.php');
include('config.php');
$emp_id = $_SESSION['emp_id'];
$first_name = $_SESSION['first_name'];
$department = $_SESSION['department'];
$mobile_no = $_SESSION['mobile_no'];
$state = $_SESSION['state'];
$dob = $_SESSION['dob'];
$profile_img = $_SESSION['profile_img'];
$password = $_SESSION['password'];
$uid_id = $_SESSION['uid_id'];
$last_name = $_SESSION['last_name'];
$mail = $_SESSION['mail'];
$country = $_SESSION['country'];
$city = $_SESSION['city'];
$doj = $_SESSION['doj'];
$address = $_SESSION['address'];
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

    textarea {
        height: 90px;
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

    .file {
        margin-top: 5px;
    }

    .unchange {
        background-color: rgb(245, 245, 245);
        border-color: rgb(250, 250, 250);
    }
    #uid-id-error,
    #emp-id-error,
    #email-error,
    #mobile-no-error {
        display: none;
    }
</style>

<body>
    <?php
    include_once 'nav-bar.php';
    ?>
    <div id="dashboard">
        <div class="wrapper">
            <?php
            include_once 'side-bar.php';
            ?>
            <!-- main application column -->
            <div id="two">
                <div class="my-box" style="height: 800px">
                    <h4>Profile information</h4>
                    <p>Change only required feild. </p>
                    <hr>
                    <span id="message"></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id']) : ''; ?>">
                        <?php echo "<script>console.log('ID: " . $_SESSION['id'] . "');</script>"; ?>

                        <div class="container">
                            <div class="left">
                                <label for="emp-id">Emp ID</label>
                                <input type="text" name="emp-id" readonly class="unchange" value="<?php echo isset($emp_id) ? htmlspecialchars($emp_id) : '' ?>">
                                <span id="emp-id-error"></span>
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : '' ?>">
                                <label for="department">Department</label>
                                <input name="department" readonly class="unchange" value="<?php echo isset($department) ? htmlspecialchars($department) : '' ?>">
                                <label for="mobile-no">Mobile No.</label>
                                <input type="text" name="mobile-no" value="<?php echo isset($mobile_no) ? htmlspecialchars($mobile_no) : '' ?>">
                                <span id="mobile-no-error"></span>
                                <label for="state">State</label>
                                <input type="text" name="state" value="<?php echo isset($state) ? htmlspecialchars($state) : '' ?>">
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo isset($dob) ? htmlspecialchars($dob) : '' ?>">
                                <label for="address">Address</label>
                                <textarea name="address"><?php echo isset($address) ? htmlspecialchars($address) : '' ?></textarea>


                            </div>
                            <div class="right">
                                <label for="uid-id">UID No.</label>
                                <input type="text" name="uid-id" readonly class="unchange" value="<?php echo isset($uid_id) ? htmlspecialchars($uid_id) : '' ?>">
                                <span id="uid-id-error"></span>
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last-name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : '' ?>">
                                <label for="e-mail">E-mail</label>
                                <input type="text" name="e-mail" value="<?php echo isset($mail) ? htmlspecialchars($mail) : '' ?>" readonly>
                                <span id="email-error"></span>
                                <label for="country">Country</label>
                                <input type="text" name="country" value="<?php echo isset($country) ? htmlspecialchars($country) : '' ?>">
                                <label for="city">City</label>
                                <input type="text" name="city" value="<?php echo isset($city) ? htmlspecialchars($city) : '' ?>">
                                <label for="doj">Date of joining</label>
                                <input type="date" name="doj" readonly class="unchange" value="<?php echo isset($doj) ? htmlspecialchars($doj) : '' ?>">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="update if needed" class="unchange" value="<?php echo isset($password) ? htmlspecialchars($password) : '' ?>">
                                <span id="password-error"></span>
                                <label for="profile-pic" class="file">Photo</label>
                                <input type="file" name="profile-pic" value="<?php echo isset($_POST['profile-pic']) ? htmlspecialchars($_POST['profile-pic']) : '' ?>">

                                <input style="width: 150;" type="submit" value="Update Profile" class="a-button" onclick='<?php echo "return confirm(\"Are you sure you want to Update this information?\")" ?>'>
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
    <script src="js/script.js"></script>

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
        $first_name = test_input($_POST["first-name"]);
        $mobile_no = test_input($_POST["mobile-no"]);
        $state = test_input($_POST["state"]);
        $dob = test_input($_POST["dob"]);
        $profile_img = test_input($_POST["profile-pic"]);
        $uid_id = test_input($_POST["uid-id"]);
        $last_name = test_input($_POST["last-name"]);
        $mail = test_input($_POST["e-mail"]);
        $country = test_input($_POST["country"]);
        $city = test_input($_POST["city"]);
        $address = test_input($_POST["address"]);
        $id = $_POST["id"];
        $errors = array();


        // update if no error found

        try {
            $emp = "UPDATE `employee-info` SET ";
            if (!empty($first_name)) {
                $emp .= "`first-name` = ?,";
                $values[] = $first_name;
            }
            if (!empty($last_name)) {
                $emp .= "`last-name`= ?,";
                $values[] = $last_name;
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
                echo '<script>window.location.href = "my-info.php";</script>';
                echo "<script>document.getElementById('message').innerHTML = 'Profile updated successfully.';</script>";
                // header('location: my-info.php?stattus=success');
            }
            if ($emp->rowCount() > 0) {
                $_SESSION['first_name'] = $first_name;
                $_SESSION['mobile_no'] = $mobile_no;
                $_SESSION['state'] = $state;
                $_SESSION['dob'] = $dob;
                $_SESSION['profile_img'] = $profile_img;
                $_SESSION['uid_id'] = $uid_id;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['mail'] = $mail;
                $_SESSION['country'] = $country;
                $_SESSION['city'] = $city;
                $_SESSION['address'] = $address;
                exit();
            } else {
                echo "<script>document.getElementById('message').innerHTML = 'Failed to update, try again!';</script>";
                echo "<script>document.getElementById('message').style.color = 'red'</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>