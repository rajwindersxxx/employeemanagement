<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Employee Record Management</title>
</head>

<body>
    <h1 id="heading" class="text-center text-info">Employee Record Management</h1>
    <div class="container-fluid">
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="adminlogin.php" method="post">
                                <h3 class="text-center text-info"> <i class="fa fa-user fa-solid"></i> Sign In | Admin
                                </h3>
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
                                    <label for="remember-me" class="text-info"><span>Remember me</span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
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
</body>
<?php
//connection included

session_start();
function test_input($data)
{
    $data = trim($data); //
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtolower(test_input($_POST["username"]));
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM adminlogin");
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        if (($user["username"] == $username) && password_verify($password, $user['password'])) {
            $_SESSION["loggedin"] = true;
            header("location: adminpage.php");
        } else {
            echo "<script>document.getElementById('message-error').innerHTML = 'Wrong Password/Usernanme, Plese try again!';</script>";
            die();
        }
    }
}
?>

</html>