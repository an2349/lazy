<?php
session_start(); // Khởi tạo session

require('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra tài khoản trong cơ sở dữ liệu
$sql = "SELECT * FROM USERS WHERE U_LOG_NAME = ? AND U_PASS = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Tài khoản tồn tại
    $user = $result->fetch_assoc();
    $_SESSION['user'] = [
        'U_ID' => $user['U_ID'], // Lưu ID
        'U_NAME' => $user['U_NAME'], // Lưu tên người dùng
    ];

    // Kiểm tra role để chuyển hướng
    if ($user['AUTH_ID'] == 1) { // AUTH_ID 1 là admin
        $_SESSION['is_admin'] = true; // Lưu trạng thái là admin
        echo "<script>
            alert('Đăng nhập thành công. Chào mừng Admin!');
            window.location.href = 'Test_QL.php'; // Chuyển hướng đến Test_QL.php
        </script>";
    } else if ($user['AUTH_ID'] == 2) { // AUTH_ID 2 là user
        $_SESSION['is_admin'] = false; // Lưu trạng thái là user
        echo "<script>
            alert('Đăng nhập thành công. Chào mừng người dùng!');
            window.location.href = 'home.php'; // Chuyển hướng đến Info_Users.html
        </script>";
    } else {
        echo "<script>
            alert('Tài khoản không có quyền hợp lệ.');
            window.location.href = 'login_form.php';
        </script>";
    }
} else {
    // Tài khoản hoặc mật khẩu sai
    echo "<script>
        alert('Tài khoản hoặc mật khẩu không đúng');
        window.location.href = 'login_form.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
