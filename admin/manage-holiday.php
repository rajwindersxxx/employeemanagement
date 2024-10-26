<?php
include('../connection.php');
$deleteSuccess = false;
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM `holidays` WHERE `id` = :id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    $deleteSuccess = true;
  } else {
    echo "<script>document.getElementById('message').innerHTML = 'Error deleting department.';</script>";
  }
} else {
  "<script>document.getElementById('message').innerHTML = 'no department id provided';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Admin Dashboard</title>
</head>
<style>
  .additon {
        display: inline-block;
    }

    .row {
        padding: 1px 20px 10px 20px;
        width: 300px;
    } 
    .a-button{
        float: right;
        width: 90px;
    }
    .input{
      margin-top: 3px;
    }
    form label{
        font-size: 20px;
        margin-left: 5px;
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
        <div class="my-box" style="height: 84vh;">
          <h4>Manage Holidays</h4>
          <hr>
          <span id="message"></span>
          <div class="continer">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="additon">
                                <label>Enter Date: </label>
                                <input type="date" name="holiday-date" class="input" placeholder="Enter Date">
                                <label>Enter Day: </label>
                                <input type="Text" name="holiday-day" class="input" placeholder="Day">
                                <label>Enter Reason: </label>
                                <input type="Text" name="holiday-reason" class="input" placeholder="Add New Holiday">
                                <input type="submit" class="a-button" value="Add" name="add-holiday">
                        </div>
                    </form>
            <form id="form" method="post" style="height: 63vh;overflow: auto;">
              <table class="table table-bordered text-center sortable" id="myTable">
                <thead>
                <tr class="bg-dark text-white">
                  <th onclick="sortNumber(0)">Serail No</th>
                  <th onclick="sortTable(1)">Date</th>
                  <th onclick="sortTable(1)">Day</th>
                  <th onclick="sortTable(1)">Reason</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT `date`, `day`, `reason`, `id` FROM `holidays`";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $number = 1;
                foreach ($result as $row) {
                  echo "<tr>";
                  echo "<td>" . $number . "</td>";
                  echo "<td>" . $row["date"] . "</td>";
                  echo "<td>" . $row["day"] . "</td>";
                  echo "<td>" . $row["reason"] . "</td>";
                  echo "<td>
                  <a href='manage-holiday.php?id=" . $row['id'] . "' class='button' onclick='return confirm(\"Are you sure you want to delete this Holiday?\")'>Delete</a></td>";
                  echo "</tr>";
                  $number++;
                }
                ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="include/sorting.js"></script>
  <?php if ($deleteSuccess): ?>
    <script>
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'Holiday deleted successfully.';
      header('Location: '.$_SERVER['PHP_SELF']);
      exit();
    </script>
  <?php endif; ?>
</body>

</html>
<?php
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $holiday_date = test_input($_POST["holiday-date"]);
  $holiday_day = test_input($_POST["holiday-day"]);
  $holiday_reason = test_input($_POST["holiday-reason"]);

  // Check if the input already exists or not 
  $check_dept = $conn->prepare("SELECT COUNT(*) FROM `holidays` WHERE `reason`= ?");
  $check_dept->bindParam(1, $holiday_reason, PDO::PARAM_STR);
  $check_dept->execute();
  $count = $check_dept->fetchColumn();

  if ($count > 0) {
    echo "<script>document.getElementById('message').style.color = 'red';</script>";
    echo "<script>document.getElementById('message').innerHTML = 'Holiday already exists.';</script>";

  } else {
    // Insert the department if it doesn't exist
    $insert_dept = $conn->prepare("INSERT INTO `holidays`(`date`, `day`, `reason`) VALUES (?,?,?)");
    $insert_dept->bindParam(1, $holiday_date, PDO::PARAM_STR);
    $insert_dept->bindParam(2, $holiday_day, PDO::PARAM_STR);
    $insert_dept->bindParam(3, $holiday_reason, PDO::PARAM_STR);
    if ($insert_dept->execute()) {
      echo "<script>window.herf.location = 'manage-holiday.php'</script>";
      echo '<script>
        setTimeout(function(){
            location.reload();
        }, 0); // 3000 milliseconds (3 seconds)
    </script>';
    } else {
      echo "<script>document.getElementById('message').innerHTML = 'Error adding department.';</script>";
    }
  }
}
?>

