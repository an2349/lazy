<?php
include 'connection.php';

// Nhận ID từ URL
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

if (empty($id)) {
    die("ID không hợp lệ.");
}

// Xử lý cập nhật thông tin tài khoản
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $log_game = $conn->real_escape_string($_POST['ACC_LOG_GAME']);
    $price = floatval($_POST['ACC_PRICE']);
    $rank = $conn->real_escape_string($_POST['ACC_RANK']);
    $skin_count = intval($_POST['ACC_SKIN_COUNT']);
    $champ_count = intval($_POST['ACC_CHAMP_COUNT']);
    $cat_id = intval($_POST['CAT_ID']);
    $status = intval($_POST['ACC_STATUS']);

    // Xử lý mật khẩu (chỉ cập nhật nếu có nhập mới)
    if (!empty($_POST['ACC_PASSWORD'])) {
        $password = password_hash($_POST['ACC_PASSWORD'], PASSWORD_BCRYPT);
        $password_sql = ", ACC_PASSWORD = '$password'";
    } else {
        $password_sql = "";
    }

    $sql = "UPDATE ACCOUNT_GAME 
            SET ACC_LOG_GAME = '$log_game', 
                ACC_PRICE = $price, 
                ACC_RANK = '$rank', 
                ACC_SKIN_COUNT = $skin_count, 
                ACC_CHAMP_COUNT = $champ_count, 
                CAT_ID = $cat_id, 
                ACC_STATUS = $status 
                $password_sql
            WHERE ACC_ID = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: Test_QL.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}

// Truy xuất thông tin tài khoản
$sql = "SELECT * FROM ACCOUNT_GAME WHERE ACC_ID = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $account = $result->fetch_assoc();
} else {
    die("Không tìm thấy tài khoản.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tài khoản</title>
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
        <h1>Sửa tài khoản</h1>
        <form action="edit_account.php?id=<?= htmlspecialchars($account['ACC_ID']) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($account['ACC_ID']) ?>">
            
            <label>Tên đăng nhập:</label>
            <input type="text" name="ACC_LOG_GAME" value="<?= htmlspecialchars($account['ACC_LOG_GAME']) ?>" required>
            
            <label>Mật khẩu (để trống nếu không muốn thay đổi):</label>
            <input type="password" name="ACC_PASSWORD">
            
            <label>Giá:</label>
            <input type="number" name="ACC_PRICE" value="<?= htmlspecialchars($account['ACC_PRICE']) ?>" required>
            
            <label>Rank:</label>
            <input type="text" name="ACC_RANK" value="<?= htmlspecialchars($account['ACC_RANK']) ?>" required>
            
            <label>Số skin:</label>
            <input type="number" name="ACC_SKIN_COUNT" value="<?= htmlspecialchars($account['ACC_SKIN_COUNT']) ?>" required>
            
            <label>Số tướng:</label>
            <input type="number" name="ACC_CHAMP_COUNT" value="<?= htmlspecialchars($account['ACC_CHAMP_COUNT']) ?>" required>
            
            <label>Loại tài khoản:</label>
            <input type="text" name="CAT_ID" value="<?= htmlspecialchars($account['CAT_ID']) ?>" required>
            
            <label>Trạng thái:</label>
            <select name="ACC_STATUS">
                <option value="1" <?= $account['ACC_STATUS'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$account['ACC_STATUS'] ? 'selected' : '' ?>>Inactive</option>
            </select>
            
            <button type="submit" name="update">Lưu</button>
        </form>
        <div class="back-link">
            <a href="Test_QL.php">Quay lại</a>
        </div>
    </div>
</body>
</html>
