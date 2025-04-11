<?php

session_start();

require('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re-password'];

    if ($password !== $re_password) {
        $_SESSION['error_message'] = "Mật khẩu không khớp!";
        header("Location: sign_in.php");
        exit;
    }

    $sql_username = "SELECT * FROM users WHERE U_LOG_NAME = ?";
    $stmt = $conn->prepare($sql_username);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Tên đăng nhập đã tồn tại!";
        header("Location: sign_in.php");
        exit;
    }

    $sql_email = "SELECT * FROM users WHERE U_EMAIL = ?";
    $stmt = $conn->prepare($sql_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Email đã tồn tại!";
        header("Location: sign_in.php");
        exit;
    }

    $sql_phone = "SELECT * FROM users WHERE U_TEL = ?";
    $stmt = $conn->prepare($sql_phone);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Số điện thoại đã tồn tại!";
        header("Location: sign_in.php");
        exit;
    }

    $sql_insert = "INSERT INTO users (U_LOG_NAME, U_NAME, U_TEL, U_EMAIL, U_PASS, AUTH_ID) 
                VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sssssi", $username, $fullname, $phone, $email, $password, $auth_id);
    $auth_id = 2; // Quyền mặc định
    $stmt->execute();

    header("Location: login_form.php");
    exit;
}
?>
