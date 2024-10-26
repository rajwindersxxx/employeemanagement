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
        position: relative;
    }

    .left td:nth-child(0),
    .left td:nth-child(2) {
        width: 30%;
    }

    table {
        width: 100%;
        overflow: auto;
    }

    .left {
        width: 100%;
        overflow: auto;
    }

    .a-button {
        position: absolute;
        width: 200px;
        height: 50px;
        margin: 10px;
        right: 5vh;
        bottom: 7vh;
    }

    p {
        text-align: center;
        margin-top: 7px;
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
                <div class="my-box" style="height: 83vh">
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
                        <a class="a-button" href="my-profile.php">
                            <p>Update Information</p>
                        </a>

                    </div>
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