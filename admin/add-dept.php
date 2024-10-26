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
    .my-box p,
    .my-box input[type="text"] {
        display: block;
        width: 400px;
        max-width: 100%;
        margin-bottom: 7px;
    }

    .a-button {
        margin-top: 12px;
        font-size: 16px;
        margin-left: 0;
        height: 42px;
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
                    <h4>Add Department</h4>
                    <hr>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <span id="message"></span>
                        <label for="dept-name">Department Name:</label>
                        <input type="text" name="dept-name" id="dept-name" placeholder="Enter a department" required>
                        <input type="submit" class="a-button"></input>
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
    $dept_name = ucfirst(test_input($_POST["dept-name"]));

    // Check if the input already exists or not 
    $check_dept = $conn->prepare("SELECT COUNT(*) FROM `department` WHERE `dept-name`= ?");
    $check_dept->bindParam(1, $dept_name, PDO::PARAM_STR);
    $check_dept->execute();
    $count = $check_dept->fetchColumn();

    if ($count > 0) {
        echo "<script>document.getElementById('message').style.color = 'red';</script>";
        echo "<script>document.getElementById('message').innerHTML = 'Department already exists.';</script>";
    } else {
        // Insert the department if it doesn't exist
        $insert_dept = $conn->prepare("INSERT INTO `department`(`dept-name`) VALUES (?)");
        $insert_dept->bindParam(1, $dept_name, PDO::PARAM_STR);
        if ($insert_dept->execute()) {
            echo "<script>document.getElementById('message').innerHTML = 'Department added successfully.';</script>";
        } else {
            echo "<script>document.getElementById('message').innerHTML = 'Error adding department.';</script>";
        }
    }
}
?>


</html>