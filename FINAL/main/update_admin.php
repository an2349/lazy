<?php
session_start();
include 'connection.php';

// Kiểm tra session
if (!isset($_SESSION['user']['U_ID'])) {
    header("Location: login.php");
    exit();
}

// Lấy dữ liệu từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $U_ID = $_POST['U_ID'];
    $U_LOG_NAME = $_POST['U_LOG_NAME'];
    $U_NAME = $_POST['U_NAME'];
    $U_TEL = $_POST['U_TEL'];
    $U_EMAIL = $_POST['U_EMAIL'];
    $U_PASS = $_POST['U_PASS'];

    // Kiểm tra nếu mật khẩu đã thay đổi
    if (empty($U_PASS)) {
        // Nếu không thay đổi mật khẩu, không cập nhật trường mật khẩu
        $sql = "UPDATE USERS SET 
                    U_LOG_NAME = ?, 
                    U_NAME = ?, 
                    U_TEL = ?, 
                    U_EMAIL = ? 
                WHERE U_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $U_LOG_NAME, $U_NAME, $U_TEL, $U_EMAIL, $U_ID);
    } else {
        // Nếu có thay đổi mật khẩu, mã hóa mật khẩu mới
        $hashed_password = password_hash($U_PASS, PASSWORD_DEFAULT); // Mã hóa mật khẩu
        $sql = "UPDATE USERS SET 
                    U_LOG_NAME = ?, 
                    U_NAME = ?, 
                    U_TEL = ?, 
                    U_EMAIL = ?, 
                    U_PASS = ? 
                WHERE U_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $U_LOG_NAME, $U_NAME, $U_TEL, $U_EMAIL, $hashed_password, $U_ID);
    }

    if ($stmt->execute()) {
        echo "Cập nhật thành công!";
        header("Location: success_page.php"); // Chuyển hướng đến trang thành công
        exit();
    } else {
        echo "Lỗi cập nhật: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
