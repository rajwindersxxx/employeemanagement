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

    input,
    textarea {
        color: black;
        font-size: 20px;
        text-transform: capitalize;

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
                    <h4>Employee Information</h4>
                    <hr>
                    <span id="message"></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="container">
                            <div class="left">
                                <label for="emp-id">Emp ID</label>
                                <input type="text" name="emp-id" value="<?php echo isset($emp_id) ? htmlspecialchars($emp_id) : '' ?>" readonly>
                                <span id="emp-id-error"></span>
                                <label for="first-name">First Name</label>
                                <input type="text" name="first-name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : '' ?>" readonly>
                                <label for="department">Department</label>
                                <input name="department" value="<?php echo isset($department) ? htmlspecialchars($department) : '' ?>" readonly>
                                <label for="mobile-no">Mobile No.</label>
                                <input type="text" name="mobile-no" value="<?php echo isset($mobile_no) ? htmlspecialchars($mobile_no) : '' ?>" readonly>
                                <span id="mobile-no-error"></span>
                                <label for="state">State</label>
                                <input type="text" name="state" value="<?php echo isset($state) ? htmlspecialchars($state) : '' ?>" readonly>
                                <label for="dob">Date of Birth</label>
                                <input type="date" name="dob" value="<?php echo isset($dob) ? htmlspecialchars($dob) : '' ?>" readonly>
                                <label for="address">Address</label>
                                <textarea name="address" readonly><?php echo isset($address) ? htmlspecialchars($address) : '' ?></textarea>
                            </div>
                            <div class="right">
                                <label for="uid-id">UID No.</label>
                                <input type="text" name="uid-id" value="<?php echo isset($uid_id) ? htmlspecialchars($uid_id) : '' ?>" readonly>
                                <span id="uid-id-error"></span>
                                <label for="last-name">Last Name</label>
                                <input type="text" name="last-name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : '' ?>" readonly>
                                <label for="e-mail">E-mail</label>
                                <input type="text" name="e-mail" value="<?php echo isset($mail) ? htmlspecialchars($mail) : '' ?>" readonly>
                                <span id="email-error"></span>
                                <label for="country">Country</label>
                                <input type="text" name="country" value="<?php echo isset($country) ? htmlspecialchars($country) : '' ?>" readonly>
                                <label for="city">City</label>
                                <input type="text" name="city" value="<?php echo isset($city) ? htmlspecialchars($city) : '' ?>" readonly>
                                <label for="doj">Date of joining</label>
                                <input type="date" name="doj" value="<?php echo isset($doj) ? htmlspecialchars($doj) : '' ?>" readonly>

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


</body>

</html>