<?php
include('../connection.php');
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to the login page
    header("Location: ../index.php");
    exit;
}
?>
<style>
    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        position: fixed;
        width: 100%;
        border-bottom: 2px solid #51D4E9;
        z-index: 2;
    }

    nav ul li {
        float: right;
    }

    nav .link1,
    nav label {
        display: block;
        color: #51D4E9;
        text-align: right;
        padding: 14px 16px;
        text-decoration: none;
        margin-top: 10px;
    }

    .link2:hover {
        text-decoration: none;
    }

    nav ul li h2 {
        color: #51D4E9;
        padding: 7px;
        margin-left: 25px;
    }

    h2 span {
        font-size: 14px;
    }

    label {
        text-transform: capitalize;
    }

    .fa-angle-right {
        float: right;
        margin-right: 20px;
    }

    .rotate {
        transform: rotate(90deg);
    }

    @media screen and (max-width: 800px) {
        h2 {
            font-size: 15px;
            margin-top: 15px;
        }
    }

    @media screen and (max-width: 520px) {
        h2 {
            font-size: 15px;
            margin-top: 15px;
        }

        nav ul li label span {
            display: none;
        }
    }
</style>

<nav>
    <ul>
        <li><a href="logout.php" class="link1"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        <li><label><span>Welcome Back: </span>
                <?php echo $_SESSION['emp_id']; ?>
            </label></li>
        <li style="float: left">
        <li style="float: left"><a href="employeepage.php" class="link2">
                <h2>Employee & Services <span>Record Management</span></h2>
            </a></li>
        </li>
    </ul>
</nav>