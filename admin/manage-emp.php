<?php
include('../connection.php');
$deleteSuccess = false;
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Prepare and execute deletion query
  $query = "DELETE FROM `employee-info` WHERE `id` = :id ORDER BY id DESC";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $id);


  if ($stmt->execute()) {
    // Redirect back to the page after deletion
    $deleteSuccess = true;

  } else {
    // Handle error
    echo "<script>document.getElementById('message').innerHTML = 'Error deleting Employee.';</script>";
  }
} else {
  // Handle case where no ID is provided
  "<script>document.getElementById('message').innerHTML = 'no Employee id provided';</script>";
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
          <h4>Manage Employees</h4>
          <hr>
          <span id="message"></span>
          <div class="continer" style="height: 70vh;overflow: auto;">
            <table class="table table-bordered text-center" id="myTable">
              <tr class="bg-dark text-white">
                <th onclick="sortNumber(0)">Serail No</th>
                <th onclick="sortTable(1)">Employee Id</th>
                <th onclick="sortTable(2)">Department</th>
                <th onclick="sortTable(3)">E-mail</th>
                <th onclick="sortNumber(4)">Mobie No.</th>
                <th onclick="sortTable(5)">Action</th>
              </tr>
              <?php
              include('../connection.php');
              $query = "SELECT * FROM  `employee-info`";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $number = 1;
              foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $number . "</td>";
                echo "<td>" . $row["emp-id"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["e-mail"] . "</td>";
                echo "<td>" . $row["mobile-no"] . "</td>";
                echo "<td>
                  <a href='view-info.php?id=" . $row['id'] . "' id='view' class='button'>View</a>
                  <a href='edit-emp.php?id=" . $row['id'] . "' id='edit' class='button'>Edit</a>
                  <a href='salary-info.php?id=" . $row['id'] . "' id='salary' class='button'>Salary</a>
                  <a href='manage-emp.php?id=" . $row['id'] . "' class='button' onclick='return confirm(\"Are you sure you want to delete this department?\")'>Delete</a></td>";
                echo "</tr>";
                $number++;
              }
              ?>
            </table>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('table.sortable').addEventListener('click', function(event) {
        if (event.target.tagName.toLowerCase() === 'th' && event.target.dataset.columnIndex) {
            sortTable(parseInt(event.target.dataset.columnIndex));
        }
    });
});

  </script>
  <?php if ($deleteSuccess): ?>
    <script>
      document.getElementById('message').style.color = 'red';
      document.getElementById('message').innerHTML = 'Employee deleted successfully.';
      header('Location: '.$_SERVER['PHP_SELF']);
      exit();
    </script>
  <?php endif; ?>
</body>
</html>