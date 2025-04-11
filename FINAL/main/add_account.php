<?php
include 'connection.php';

// Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $log_game = $conn->real_escape_string($_POST['ACC_LOG_GAME']);
    $password = password_hash($_POST['ACC_PASSWORD'], PASSWORD_BCRYPT);
    $price = floatval($_POST['ACC_PRICE']);
    $rank = $conn->real_escape_string($_POST['ACC_RANK']);
    $skin_count = intval($_POST['ACC_SKIN_COUNT']);
    $champ_count = intval($_POST['ACC_CHAMP_COUNT']);
    $cat_id = intval($_POST['CAT_ID']);
    $status = intval($_POST['ACC_STATUS']);

    $sql = "INSERT INTO ACCOUNT_GAME (ACC_LOG_GAME, ACC_PASSWORD, ACC_PRICE, ACC_RANK, 
                                      ACC_SKIN_COUNT, ACC_CHAMP_COUNT, CAT_ID, ACC_STATUS) 
            VALUES ('$log_game', '$password', $price, '$rank', $skin_count, $champ_count, $cat_id, $status)";

    if ($conn->query($sql) === TRUE) {
        header("Location: Test_QL.php");
        exit();
    } else {
        echo "Lỗi khi thêm sản phẩm: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
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
        <h1>Thêm sản phẩm</h1>
        <form action="add_account.php" method="POST">
            <label>Tên đăng nhập:</label>
            <input type="text" name="ACC_LOG_GAME" required>
            
            <label>Mật khẩu:</label>
            <input type="password" name="ACC_PASSWORD" required>
            
            <label>Giá:</label>
            <input type="number" name="ACC_PRICE" required>
            
            <label>Rank:</label>
            <input type="text" name="ACC_RANK" required>
            
            <label>Số skin:</label>
            <input type="number" name="ACC_SKIN_COUNT" required>
            
            <label>Số tướng:</label>
            <input type="number" name="ACC_CHAMP_COUNT" required>
            
            <label>Loại tài khoản:</label>
            <input type="text" name="CAT_ID" required>
            
            <label>Trạng thái:</label>
            <select name="ACC_STATUS">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            
            <button type="submit" name="add">Thêm</button>
        </form>
        <div class="back-link">
            <a href="Test_QL.php">Quay lại</a>
        </div>
    </div>
</body>
</html>
