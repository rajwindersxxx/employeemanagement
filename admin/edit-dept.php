<?php
include('../connection.php');
$id = null;
if (isset($_GET['id'])) {
    global $id;
    $id = (int) $_GET['id'];
    $query = "SELECT `dept-name` FROM `department` WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $row['dept-name'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicys="no-referrer" />
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

    input[type="submit"] {
        margin-top: 8px;
        width: 80px;
        margin-left: 0px;
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
                    <h4>Edit department</h4>
                    <hr>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                        <span id="message"></span>
                        <label for="dept-name">Department Name:</label>
                        <input type="text" name="dept-name" id="dept-name" placeholder="Enter a department" value="<?php echo isset($row['dept-name']) ? htmlspecialchars($row['dept-name']) : '' ?>" required>
                        <input type="submit" value="update" class="a-button">
                        <label id="output"></label>
                        <?php ?>
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
$id = test_input($_POST["id"]);

// Check if $id is set and is a valid integer
if (!is_null($id)) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dept_name = test_input($_POST["dept-name"]);
        // Update the department name
        $update_dept = $conn->prepare("UPDATE `department` SET `dept-name` = ? WHERE `id` = ?");
        $update_dept->bindParam(1, $dept_name, PDO::PARAM_STR);
        $update_dept->bindParam(2, $id, PDO::PARAM_INT);

        if ($update_dept->execute()) {
            echo "<script>document.getElementById('message').innerHTML = 'Department updated successfully.';</script>";
        } else {
            // Check for errors
            $errorInfo = $update_dept->errorInfo();
            echo "<script>document.getElementById('message').style.color = 'red';</script>";
            echo "<script>document.getElementById('message').innerHTML = 'Error updating department: " . $errorInfo[2] . "';</script>";
        }
    }
} else {
    echo "<script>document.getElementById('message').style.color = 'red';</script>";
    echo "<script>document.getElementById('message').innerHTML = 'Invalid department ID';</script>";
}

?>

</html>