<style>
   #one {
      position: fixed;
      height: 95vh;
      background-color: #333;
      border-top: 7px solid white;
      float: left;
      padding-top: 50px;
      width: 235px;
      border-right: 2px solid #51D4E9;
      overflow-y: auto;
   }

   #one h3 {
      color: #51D4E9;
      padding-left: 15px;

   }

   #one a {
      display: inline-block;
      top: 100px;
      text-decoration: none;
      list-style-type: none;
      padding: 12px;
      width: 100%;
      color: #51D4E9;
      border-bottom: 1px solid #535050;
      border-bottom-left-radius: 10%;

   }

   #home:hover {
      color: white !important;
   }

   #one a:hover,
   .box a:hover {
      background-color: #535050;
      border-bottom-left-radius: 5%;
      border-top-left-radius: 10%;
   }

   #one a:active {
      background-color: #535050;
   }

   #dashboard {
      padding-top: 5vh;
   }

   .collapse li {
      list-style-type: none !important;
   }

   ul {
      padding-left: 25px;
      font-size: 14px;
   }

   .fa-angle-right {
      float: right;
      margin-right: 20px;
      transition: 0.2s;
   }

   .rotate {
      transform: rotate(90deg);
   }

   @media screen and (max-width: 853px) {
      #one {
         width: 50px;
      }

      .fa-angle-right,
      span {
         display: none;
      }

      #one:hover .fa-angle-right,
      #one:hover span {
         display: inline-block;
      }

      #one h3 {
         color: #51D4E9;
         padding-left: 0px;

      }


      #one:hover {
         position: fixed;
         min-height: 95vh;
         background-color: #333;
         border-top: 7px solid white;
         padding-top: 50px;
         width: 235px;
         border-right: 2px solid #51D4E9;
         z-index: 1;
         overflow: hidden;
      }

   }
</style>

<div id="one">
   <a href="adminpage.php">
      <h3><i class="fa-solid fa-gauge"></i> <span>Dashborad</span></h3>
   </a>
   <a class="link" href='#attend' data-toggle="collapse"><i
         class="fa-solid fa-clipboard-user"></i><span>Attendence</span>
      <i class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="attend" data-parent="#one">
      <ul>
         <a href="attend-status.php"><span>Attendence Status</span></a>
         <a href="attend-history.php"><span>Atttendence History</span></a>
      </ul>
   </div>
   <a class="link" href='#dept' data-toggle="collapse"><i class="fa-solid fa-building-user"></i><span>Departments</span>
      <i class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="dept" data-parent="#one">
      <ul>
         <a href="add-dept.php"><span>Add Department</span></a>
         <a href="manage-dept.php"><span>Manage Department</span></a>
      </ul>
   </div>
   <a class="link" href='#emp' data-toggle="collapse"><i class="fa-solid fa-user-group"></i><span>Employees</span> <i
         class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="emp" data-parent="#one">
      <ul>
         <a href="add-emp.php"><span>Add Employee</span></a>
         <a href="manage-emp.php"><span>Manage Employees</span></a>
      </ul>
   </div>
   <a class="link" href='#leave' data-toggle="collapse"><i class="fa-solid fa-building-circle-check"></i>
      <span>Services</span> <i class="fa-solid fa-angle-right"></i>
   </a>
   <div class="collapse" id="leave" data-parent="#one">
      <ul>
         <a href="add-service.php"><span>Add service</span></a>
         <a href="manage-service.php"><span>Manage services</span></a>

      </ul>
   </div>
   <a class="link" href='#service' data-toggle="collapse"><i class="fa-solid fa-person-walking-arrow-right"></i>
      <span>Leave
         Type </span><i class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="service" data-parent="#one">
      <ul>
         <a href="add-leave.php"><span>Add Leave</span></a>
         <a href="manage-leave.php"><span>Manage Leave</span></a>
      </ul>
   </div>
   <a class="link" href='#request' data-toggle="collapse"> <i class="fa-solid fa-comment-dots"></i> <span>Leave
         Requests</span><i class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="request" data-parent="#one">
      <ul>
         <a href="leave-request.php"><span>Leave request</span></a>
         <a href="leave-history.php"><span>Leave history</span></a>
      </ul>
   </div>
   <!--  ------------>
   <a class="link" href='#Salaryx' data-toggle="collapse"> <i class="fa-solid fa-money-bill-transfer"></i>
      <span>Salary</span><i class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="Salaryx" data-parent="#one">
      <ul>
         <a href="add-salary.php"><span>Salary update</span></a>
         <a href="salary-history.php"><span>Salary history</span></a>
      </ul>
   </div>
   <a class="link" href='#report' data-toggle="collapse"> <i class="fa-solid fa-circle-info"></i> <span>Report</span><i
         class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="report" data-parent="#one">
      <ul>
         <a href="service-report.php"><span>Daialy collection report</span></a>
         <a href="service-history.php"><span>Service History</span></a>
      </ul>
   </div>
   <a class="link" href='change-password.php'> <i class="fa-solid fa-lock"></i> <span>Change Password</span></a>
   <a class="link" href='#extra' data-toggle="collapse"> <i class="fa-solid fa-gear"></i> <span>Extra</span><i
         class="fa-solid fa-angle-right"></i></a>
   <div class="collapse" id="extra" data-parent="#one">
      <ul>
         <a href="manage-holiday.php"><span>Manage Holidays</span></a>
         <a href="setting.php"><span>Debuging</span></a>

      </ul>
   </div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      var links = document.querySelectorAll('.link');

      links.forEach(function (link) {
         link.addEventListener('click', function () {
            var icon = this.querySelector('.fa-angle-right');

            // Check if the icon already has the 'rotate' class
            var isRotated = icon.classList.contains('rotate');

            // Reset rotation for all icons
            document.querySelectorAll('.fa-angle-right').forEach(function (icon) {
               icon.classList.remove('rotate');
            });

            // Toggle rotation if the icon was not rotated, remove it otherwise
            if (!isRotated) {
               icon.classList.add('rotate');
            }
         });
      });
   });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      var sidebar = document.getElementById('one');

      sidebar.addEventListener('click', function () {
         sidebar.classList.toggle('open');
      });
   });

</script>
