<?php
include 'connection.php';

// Nhận ID từ URL
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

if (empty($id)) {
    die("ID không hợp lệ.");
}

// Xử lý cập nhật thông tin người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $log_name = $conn->real_escape_string($_POST['U_LOG_NAME']);
    $name = $conn->real_escape_string($_POST['U_NAME']);
    $tel = $conn->real_escape_string($_POST['U_TEL']);
    $email = $conn->real_escape_string($_POST['U_EMAIL']);
    $auth_id = intval($_POST['AUTH_ID']);

    // Xử lý mật khẩu (chỉ cập nhật nếu có nhập mới)
    if (!empty($_POST['U_PASS'])) {
        $password = password_hash($_POST['U_PASS'], PASSWORD_BCRYPT);
        $password_sql = ", U_PASS = '$password'";
    } else {
        $password_sql = "";
    }

    // Cập nhật thông tin người dùng
    $sql = "UPDATE USERS 
            SET U_LOG_NAME = '$log_name', 
                U_NAME = '$name', 
                U_TEL = '$tel', 
                U_EMAIL = '$email', 
                AUTH_ID = $auth_id
                $password_sql
            WHERE U_ID = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: Test_QL.php"); // Chuyển hướng về danh sách người dùng
        exit();
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}

// Truy xuất thông tin người dùng
$sql = "SELECT * FROM USERS WHERE U_ID = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("Không tìm thấy người dùng.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input, form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            color: #007bff;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sửa người dùng</h1>
        <form action="edit_users.php?id=<?= htmlspecialchars($user['U_ID']) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['U_ID']) ?>">
            
            <label>Tên đăng nhập:</label>
            <input type="text" name="U_LOG_NAME" value="<?= htmlspecialchars($user['U_LOG_NAME']) ?>" required>
            
            <label>Mật khẩu (để trống nếu không muốn thay đổi):</label>
            <input type="password" name="U_PASS">
            
            <label>Tên người dùng:</label>
            <input type="text" name="U_NAME" value="<?= htmlspecialchars($user['U_NAME']) ?>" required>
            
            <label>Số điện thoại:</label>
            <input type="text" name="U_TEL" value="<?= htmlspecialchars($user['U_TEL']) ?>" required>
            
            <label>Email:</label>
            <input type="email" name="U_EMAIL" value="<?= htmlspecialchars($user['U_EMAIL']) ?>" required>
            
            <label>Mã phân quyền:</label>
            <input type="text" name="AUTH_ID" value="<?= htmlspecialchars($user['AUTH_ID']) ?>" required>
            
            <button type="submit" name="update">Lưu</button>
        </form>
        <div class="back-link">
            <a href="Test_QL.php">Quay lại danh sách người dùng</a>
        </div>
    </div>
</body>
</html>
