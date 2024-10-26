<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../connection.php');

$id = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM `employee-info` WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        // Assign values to variables
        $emp_id = $row['emp-id'];
        $first_name = $row['first-name'];
        $department = $row['department'];
        $mobile_no = $row['mobile-no'];
        $state = $row['state'];
        $dob = $row['dob'];
        $profile_img = $row['profile-img'];
        $password = $row['password'];
        $uid_id = $row['uid-id'];
        $last_name = $row['last-name'];
        $mail = $row['e-mail'];
        $country = $row['country'];
        $city = $row['city'];
        $doj = $row['doj'];
        $address = $row['address'];
        $attendence = $row['attend-status'];

        // Store values in session variables
        $_SESSION['id'] = $id;
        $_SESSION['emp_id'] = $emp_id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['department'] = $department;
        $_SESSION['mobile_no'] = $mobile_no;
        $_SESSION['state'] = $state;
        $_SESSION['dob'] = $dob;
        $_SESSION['profile_img'] = $profile_img;
        $_SESSION['password'] = $password;
        $_SESSION['uid_id'] = $uid_id;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['mail'] = $mail;
        $_SESSION['country'] = $country;
        $_SESSION['city'] = $city;
        $_SESSION['doj'] = $doj;
        $_SESSION['address'] = $address;
        $_SESSION['attend_status'] = $attendence;
    }
}
// Use session variable wherever you need it
