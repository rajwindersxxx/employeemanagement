<?php include("../connection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Welcome Employee</title>
</head>
<style>
    #message-error {
        color: red;
        font-weight: bold;

    }
</style>

<body>
    <h1 id="heading" class="text-center text-info" style="margin-top: 20vh">Employee Record Management</h1>
    <span id="message"></span>
    <div class="container-fluid">
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="employeelogin.php" method="post">
                                <h3 class="text-center text-info"> <i class="fa fa-user fa-solid"></i> Sign In |
                                    Employee ID</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <span id="message-error"></span>
                                <div class="form-group">
                                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                    <input style="width: 100px" type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                    <input style="width: 100px; margin-left: 12px;" type="button" name="button" class="btn btn-info btn-md" value="Home" onclick="window.location.href='../index.php';">
                                </div>
                                <div id="register-link" class="text-right">

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
    <script src="../bootstrap/dist/js/bootstrap.bundle.main.js"></script>
    <script src="js/script.js"></script>
</body>
<?php
include_once("../connection.php");
session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtolower(test_input($_POST["username"]));
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT `emp-id`, `password`, `id` FROM `employee-info`");
    $stmt->execute();
    $users = $stmt->fetchAll();
    $login_successful = false; // Initialize a flag to track successful login

    foreach ($users as $user) {
        if (($user["emp-id"] == $username) && password_verify($password, $user['password'])) {
            // If login is successful, set the flag to true and break out of the loop
            $login_successful = true;
            break;
        }
    }

    // After checking all users, if login was successful, redirect to employeepage.php
    if ($login_successful) {
        $_SESSION["loggedin"] = true;
        header("location: employeepage.php?id=" . $user["id"]);
        exit;
    } else {
        // If login fails for all users, display error message
        echo "<script>document.getElementById('message-error').innerHTML = 'Wrong Password/Usernanme, Plese try again!';</script>";

        die(); // Terminate script execution
    }
}

?>

</html>