<?php
include('../connection.php');
$id = null;
if (isset($_GET['id'])) {
    global $id;
    $id = (int) $_GET['id'];
    $query = "SELECT * FROM `services` WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $dept_name = $row["dept-name"];
        $service_type = $row["service-type"];
        $service_cost = $row["service-cost"];
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
    .my-box p,
    .my-box input[type="text"],
    select {
        display: block;
        width: 100%;
        max-width: 100%;
        margin-bottom: 7px;
    }

    input[type="submit"] {
        width: 150px;
        margin-top: 20px;
        font-size: 20px;
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
                <div class="my-box" style="height: 270px">
                    <h4>Edit Service</h4>
                    <hr>
                    <span id="message"></span>
                    <form id="my-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                        <div class="container">
                            <div class="first">
                                <label for="dept-name">Select department:</label>
                                <select name="dept-name" style="padding: 3px" required>
                                    <?php
                                    include('../connection.php');
                                    $query = "SELECT `dept-name` FROM `department`";
                                    $sql = $conn->prepare($query);
                                    $sql->execute();
                                    $depts = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($depts as $row) {
                                        $deptName = htmlspecialchars($row['dept-name']);
                                        $selected = isset($dept_name) && $dept_name == $deptName ? 'selected' : '';
                                        echo "<option value='$deptName' $selected>$deptName</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="second">
                                <label for="service-type">Service type:</label>
                                <input type="text" name="service-type" id="service-type" value="<?php echo isset($service_type) ? htmlspecialchars($service_type) : '' ?>" placeholder="service type">
                            </div>
                            <div class="third"><label for="service-cost">Service cost:</label>
                                <input type="text" name="service-cost" id="service-cost" placeholder="Cost of service" value="<?php echo isset($service_cost) ? htmlspecialchars($service_cost) : '' ?>">
                                <input type="submit" value="Update Service" class="a-button"></input>
                            </div>
                            <label id="output"></label>
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
</body>
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
    $dept_name = test_input($_POST["dept-name"]);
    $service_type = test_input($_POST["service-type"]);
    $service_cost = test_input($_POST["service-cost"]);
    $id = $_POST["id"];
    $errors = array();
    echo $id;

    // Check if the input already exists or not

    $check_service = $conn->prepare("SELECT COUNT(*) FROM `services` WHERE `service-type`= ? AND `id` != ?");
    $check_service->bindParam(1, $uid_id, PDO::PARAM_STR);
    $check_service->bindParam(2, $id, PDO::PARAM_INT);
    $check_service->execute();
    $count_service = $check_service->fetchColumn();
    if ($count_service > 0) {
        $errors['service-type'] = "Service type already exists";
    }
    if (!empty($errors)) {
        echo "<script>";
        foreach ($errors as $field => $error) {
            echo "console.log('Error for $field: $error');";
            echo "document.getElementById('$field-error').innerHTML = '$error';";
        }
        echo "</script>";
    }
    // update if no error found

    try {
        if ($count_service <= 0) {
            $sql = "UPDATE `services` SET ";
            $values = array();
            if (!empty($dept_name)) {
                $sql .= "`dept-name` = ?,";
                $values[] = $dept_name;
            }
            if (!empty($service_type)) {
                $sql .= "`service-type` = ?,";
                $values[] = $service_type;
            }
            if (!empty($service_cost)) {
                $sql .= "`service-cost` = ?,";
                $values[] = $service_cost;
            }

            $sql = rtrim($sql, ', ');

            $sql .= " WHERE `id` = ?";
            $values[] = $id;
            $sql = $conn->prepare($sql);

            foreach ($values as $key => $value) {
                $sql->bindValue($key + 1, $value);
            }
            if ($sql->execute()) {
                echo "<script>document.getElementById('message').innerHTML = 'Service updated Successfully';</script>";
            } else {
                echo "<script>document.getElementById('message').innerHTML = 'Failed to update, try again!';</script>";
                echo "<script>document.getElementById('message').style.color = 'red';</script>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

</html>