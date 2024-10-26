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
    input[type="submit"] {
        width: 40%;
        padding: 5px 10px;
        margin-top: 20px;
        font-size: 20px;
        float: right;
    }

    .header {
        font-weight: bold;
    }

    .container {
        display: flex;
    }

    .left td:nth-child(0),
    .left td:nth-child(2) {
        width: 30%;
    }

    table {
        width: 100%;
    }

    .left {
        width: 100%;
        overflow: auto;

    }

    .button {
        position: relative;
        width: 200px;
        height: 50px;
        margin-top: 20px;
        float: right;
    }

    p {
        text-align: center;
        margin-top: 7px;
    }

    @media screen and (max-width: 772px) {}
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
            <div id="two" style="height: 87vh">
                <div class="my-box" style="height: 87vh">
                    <h4>Profile information</h4>
                    <hr>
                    <div class="conatiner">
                        <div class="left">
                            <table>
                                <tr>
                                    <td class="header">Emp id:</td>
                                    <td>
                                        <?php echo $emp_id ?>
                                    </td>
                                    <td class="header">UID id:</td>
                                    <td>
                                        <?php echo $uid_id ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">First Name:</td>
                                    <td>
                                        <?php echo $first_name ?>
                                    </td>
                                    <td class="header">Last Name:</td>
                                    <td>
                                        <?php echo $last_name ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">Departmentt</td>
                                    <td>
                                        <?php echo $department ?>
                                    </td>
                                    <td class="header">E-mail</td>
                                    <td>
                                        <?php echo $mail ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">Mobile No.</td>
                                    <td>
                                        <?php echo $mobile_no ?>
                                    </td>
                                    <td class="header">Country:</td>
                                    <td>
                                        <?php echo $country ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">State:</td>
                                    <td>
                                        <?php echo $state ?>
                                    </td>
                                    <td class="header">City</td>
                                    <td>
                                        <?php echo $city ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">Date of birth:</td>
                                    <td>
                                        <?php echo $dob ?>
                                    </td>
                                    <td class="header">Date of joining</td>
                                    <td>
                                        <?php echo $doj ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="header">Address:</td>
                                    <td colspan="2">
                                        <?php echo $address . ", " . $city . ", " . $state ?>
                                    </td>
                                    <td class="header"></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a class="button" href="<?php echo "edit-emp.php?id=$id" ?>">
                        <p>Update Information</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>