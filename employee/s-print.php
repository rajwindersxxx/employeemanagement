<?php
include('../connection.php');
include('config.php');
// Store the data in a session variable for later use
$_SESSION['customer_name'];
$_SESSION['customer_number'];
$_SESSION['selected_dept_name'];
$_SESSION['service_type'];
$_SESSION['quantity'];
$_SESSION['amount'];
$_SESSION['date-time'];
$_SESSION['application-no'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Printing invoince</title>
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

    .my-box {
        border: 1px solid green;

    }

    .a-button {
        width: 250px;
        font-size: 20px;
        border-radius: 7%;
    }

    .container {
        display: flex;
        width: 100%;
    }

    .container-2 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .first,
    .second,
    .third,
    .four {
        flex: 1;
        height: 100px;
        padding: 20px;
    }

    #confirmation .container div {
        border: 1px solid lightgray;
    }

    hr {
        border: none;
        border-top: 2px solid green;
        height: 2px;
        margin: 20px 0;
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
                <div id="confirmation" class="my-box" style="height: 500px; display: block">
                    <h3 style="text-align: center">Service is applyed successfully</h3>
                    <hr>
                    <form action="add-confirm.php" method="POST">
                        <div class="container">
                            <div class="first">
                                <h5> Operator Name:</h5>
                                <p><span id="operatior-name">
                                        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5> Date:</h5>
                                <p><span id="entry-date">
                                        <?php echo $_SESSION['date-time'] ?>
                                    </span></p>
                            </div>
                            <div class="third">
                                <h5> Applicaion No.</h5>
                                <p><span id="confirm-name">
                                        <?php echo $_SESSION['application-no'] ?>
                                    </span></p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <h5> Applicant Name:</h5>
                                <p><span id="confirm-name">
                                        <?php echo $_SESSION['customer_name'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Mobile Number:</h5>
                                <p><span id="confirm-number">
                                        <?php echo $_SESSION['customer_number'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Service Asked for:</h5>
                                <p><span id="confirm-type">
                                        <?php echo $_SESSION['service_type'] ?>
                                    </span></p>
                            </div>
                            <div class="second">
                                <h5>Department:</h5>
                                <p><span id="confirm-dept">
                                        <?php echo $_SESSION['selected_dept_name'] ?>
                                    </span></p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="first">
                                <h5>Total Amount:</h5>
                                <p style="color: red"><span id="confirm-amount">
                                        <?php echo $_SESSION['amount'] . " ₹ " ?>
                                    </span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="container-2">
                            <input type="button" class="a-button" value="Print invoice pdf" onclick="return redirectToPage()">
                        </div>
                    </form>
                    <span id="message"></span>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function redirectToPage() {
            {
                window.open("print.php", "_blank", "width=800,height=1131");
                window.location.href = "add-service.php";
                return false;
            }
        }
    </script>
</body>

</html>