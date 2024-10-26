<?php
include('../connection.php');
include('config.php');
// count no of applyed services
$x = $_SESSION['emp_id'];
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `services-applied` WHERE `emp-id` = '$x' and DATE(`applyed-date`) = CURDATE() ");
$sql->execute();
$total_services_app = $sql->fetch(PDO::FETCH_ASSOC);
// today collection
$sql = $conn->prepare("SELECT * FROM `services-applied` WHERE `emp-id` = '$x' and DATE(`applyed-date`) = CURDATE()");
$sql->execute();
$collection = $sql->fetchAll(PDO::FETCH_ASSOC);
$today_collection = 0;
foreach ($collection as $row) {
  $today_collection += $row["total-cost"];
}
// total services avalable
$sql = $conn->prepare("SELECT COUNT(*) AS `total` FROM `services`");
$sql->execute();
$total_services = $sql->fetch(PDO::FETCH_ASSOC);
// leave status
$sql = $conn->prepare("SELECT `action` FROM `leave-applied` WHERE `emp-id` = :emp_id ORDER BY `id` DESC LIMIT 1");
$sql->bindParam(':emp_id', $x);
$sql->execute();
$leave_applyed = $sql->fetch(PDO::FETCH_ASSOC);

if ($leave_applyed) {
    $leave_applyed['action'];
} 
$query = "SELECT `attend-status` FROM `employee-info` WHERE `id` = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_SESSION['id']);
$stmt->execute();
$attend = $stmt->fetch(PDO::FETCH_ASSOC);
$attend_status = $attend['attend-status'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>User Dashboard</title>
</head>
<style>
  .conatiner {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    ;
    width: 100%;
    height: 31vh;
  }

  .box {
    width: 90%;
    height: 90px;
    margin: 10px;
    background-color: #333;
    border: 1px solid #51D4E9;
    border-radius: 5%;
  }

  .box h6 {
    width: 100%;
    text-align: center;
    padding: 5px;
    border-bottom: #51D4E9 solid 1px;
    font-weight: bold;
    font-size: 17px;
    color: #51D4E9;

  }

  .conatiner p {
    text-align: center;
    font-size: 22px;
    color: #c4ecf3;

  }

  .box:hover {
    background-color: #535050;
    border-bottom-left-radius: 5%;
    border-top-left-radius: 10%;
    text-decoration: none;
    color: white;
  }

  .container a:active {
    background-color: #535050;

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
        <div style="height: 10px"></div>
        <h4>Dashboard</h4>
        <hr>
        <div class=" my-box my-box1" style="height: 73vh">
          <div class="conatiner">
            <a class="box" href="service-histroy.php">
              <h6>Service Applyed</h6>
              <p id="total-emp">
                <?php echo $total_services_app['total'] ?>
              </p>
            </a>
            <a class="box" href="service-histroy.php">
              <h6>Today collection</h6>
              <p id="toatal-dept">
                <?php echo " ₹ " . $today_collection ?>
              </p>
            </a>
            <a class="box" href="view-services.php">
              <h6>Services avalable</h6>
              <p id="total-service">
                <?php echo $total_services['total'] ?>
              </p>
            </a>
            <a class="box" href="leave-history.php">
              <h6>Last applyed leave</h6>
              <p id="total-service"> <?php echo !empty($leave_applyed) ? $leave_applyed['action'] : 'None'; ?> </p>
              </p>
            </a>
            <a class="box" href="attend.php">
              <h6>Attendence Status</h6>
              <p id="total-service">  <?php echo !empty($attend_status) ? $attend_status : 'None'; ?> </p>
              </p>
            </a>
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