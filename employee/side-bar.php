<style>
    #one {
        position: fixed;
        min-height: 95vh;
        background-color: #333;
        border-top: 7px solid white;
        float: left;
        padding-top: 50px;
        width: 235px;
        border-right: 2px solid #51D4E9;

    }

    #one h3 {
        color: #51D4E9;
        padding-left: 15px;

    }

    #one a {
        display: block;
        top: 100px;
        text-decoration: none;
        list-style-type: none;
        padding: 12px;
        width: 100%;
        color: #51D4E9;
        border-bottom: 1px solid #535050;
        border-bottom-left-radius: 10%;

    }

    #one:hover {
        color: white !important;
    }

    #one a:hover {
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

    @media screen and (max-width: 800px) {
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
    <a href="employeepage.php">
        <h3><i class="fa-solid fa-gauge"></i> <span>Dashborad</span></h3>
    </a>
    <a class="link" href='my-info.php'><i class="fa-solid fa-user"></i> <span>My Profile</span></a>
    <a class="link" href='#attend' data-toggle="collapse"><i class="fa-solid fa-clipboard-user"></i> <span>Attendence</span><i class="fa-solid fa-angle-right"></i>
    </a>
    <div class="collapse" id="attend" data-parent="#one">
        <ul>
            <a href="attend.php"><span>Attandence Status</span></a>
            <a href="attend-history.php"><span>Attendence History</span></a>
        </ul>
    </div>
    <a class="link" href='#service' data-toggle="collapse"><i class="fa-solid fa-building-circle-check"></i> <span>Services</span><i class="fa-solid fa-angle-right"></i>
    </a>
    <div class="collapse" id="service" data-parent="#one">
        <ul>
            <a href="add-service.php"><span>Add service</span></a>
            <a href="view-services.php"><span>Available services</span></a>
        </ul>
    </div>

    <a class="link" href='#emp' data-toggle="collapse"><i class="fa-solid fa-person-walking-arrow-right"></i> <span>Leave </span> <i class="fa-solid fa-angle-right"></i></a>
    <div class="collapse" id="emp" data-parent="#one">
        <ul>
            <a href="apply-leave.php"><span>Leave apply</span></a>
            <a href="leave-history.php"><span>Leave history</span></a>
        </ul>
    </div>
    <a class="link" href='#report' data-toggle="collapse"> <i class="fa-solid fa-circle-info"></i> <span>Report</span><i class="fa-solid fa-angle-right"></i></a>
    <div class="collapse" id="report" data-parent="#one">
        <ul>
            <a href="service-histroy.php"><span>Daialy collection report</span></a>
            <a href="all-service-history.php"><span>Service History</span></a>

        </ul>
    </div>
    <a class="link" href='salary-history.php'><i class="fa-solid fa-money-bill-transfer"></i> <span>Salary History</span></a>

    <a class="link" href='change-password.php'><i class="fa-solid fa-lock"></i> <span>Change Password</span></a>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var links = document.querySelectorAll('.link');

        links.forEach(function(link) {
            link.addEventListener('click', function() {
                var icon = this.querySelector('.fa-angle-right');

                // Check if the icon already has the 'rotate' class
                var isRotated = icon.classList.contains('rotate');

                // Reset rotation for all icons
                document.querySelectorAll('.fa-angle-right').forEach(function(icon) {
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