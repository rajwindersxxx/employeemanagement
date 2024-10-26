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
    .my-box input[type="password"],
    select {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    input[type="submit"] {
        width: 170px;
        margin-top: 20px;
        margin-left: 0;
        margin-right: 0;
        font-size: 17px;
        float: right;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .first,
    .second,
    .third {
        flex: 1;
        height: 70vh;
        padding: 20px;
        width: 33px;
    }

    @media screen and (max-width: 671px) {
        .container {
            display: block;
        }

        .first,
        .second,
        .third {
            height: 10vh;
            width: 100%;
        }

        .my-box {
            height: 500px !important;
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
                <div class="my-box" style="height: 250px">
                    <h4>Change your password</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id']) : ''; ?>">
                        <div class="container">
                            <div class="first">
                                <label for="currnet-password">Current Password:</label>
                                <input type="password" name="current-password" id="current-password" placeholder="Your password" required>
                            </div>
                            <div class="second">
                                <label for="new-password">New password:</label>
                                <input type="password" name="new-password" id="new-password" placeholder="Create new Password" required>
                            </div>
                            <div class="third"><label for="confirm-password">confirm Password:</label>
                                <input type="password" name="confirm-password" id="confirm-password" placeholder="Retype your password" required>
                                <input type="submit" value="Change password" class="a-button"></input>
                            </div>
                            <label id="output"></label>
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
</body>
<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // input data
    $current_password = test_input($_POST["current-password"]); //plain text
    $new_password = test_input($_POST["new-password"]);
    $confirm_password = test_input($_POST["confirm-password"]);
    // retreve old passsword
    $sql = $conn->prepare("SELECT `password` FROM `adminlogin` WHERE `id` = 3");
    $sql->execute();
    $password = $sql->fetch(PDO::FETCH_ASSOC);
    $old_password_hash = $password['password'];
    if (password_verify($current_password, $old_password_hash)) {
        if ($new_password === $confirm_password && !empty($new_password)) {
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $emp_password = $conn->prepare("UPDATE `adminlogin` SET `password`= ? WHERE `id`= 3 ");
            $emp_password->bindParam(1, $new_password_hash, PDO::PARAM_STR);
            if ($emp_password->execute()) {
                echo "<script>document.getElementById('message').innerHTML = 'Password change successfully';</script>!";
            } else {
                echo "<script>document.getElementById('message').style.color = 'red';</script>";
                echo "<script>document.getElementById('message').innerHTML = 'Password change error, try again';</script>!";
            }
        }
    } else {
        echo "<script>document.getElementById('message').style.color = 'red';</script>";
        echo "<script>document.getElementById('message').innerHTML = 'Current password incorrenct';</script>!";
    }
}
?>

</html>