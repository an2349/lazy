<?php
session_start();
include 'connection.php';

// Kiểm tra session
if (!isset($_SESSION['user']['U_ID'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['user']['U_ID'];

// Truy vấn dữ liệu chỉ lấy người dùng có quyền admin và U_ID bằng với ID của session admin
$sql = "SELECT U_ID, U_LOG_NAME, U_NAME, U_TEL, U_EMAIL, AUTH_NAME
        FROM USERS
        JOIN AUTHORITY ON USERS.AUTH_ID = AUTHORITY.AUTH_ID
        WHERE AUTHORITY.AUTH_NAME = 'admin' AND USERS.U_ID = $admin_id";
$result = $conn->query($sql);

// Đếm số lượng cột (không tính cột Hành Vi)
$numColumns = 5; // Tổng số cột hiển thị dữ liệu
$remainingWidth = 80 - 15; // Phần còn lại sau khi trừ cột Hành Vi
$columnWidth = round($remainingWidth / $numColumns, 2);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .action-cell button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-cell button:hover {
            opacity: 0.9;
        }

        .action-cell .edit {
            background-color: #3498db;
        }

        .action-cell .delete {
            background-color: #e74c3c;
        }

        .no-data {
            text-align: center;
            color: #999;
            font-size: 16px;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="width:<?php echo $columnWidth; ?>%;">ID</th>
                <th style="width:<?php echo $columnWidth; ?>%;">Tên đăng nhập</th>
                <th style="width:<?php echo $columnWidth; ?>%;">Tên người dùng</th>
                <th style="width:<?php echo $columnWidth; ?>%;">Số điện thoại</th>
                <th style="width:<?php echo $columnWidth; ?>%;">Email</th>
                <th style="width:15%;">Hành Vi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['U_ID']; ?></td>
                        <td><?php echo htmlspecialchars($row['U_LOG_NAME']); ?></td>
                        <td><?php echo htmlspecialchars($row['U_NAME']); ?></td>
                        <td><?php echo $row['U_TEL']; ?></td>
                        <td><?php echo htmlspecialchars($row['U_EMAIL']); ?></td>
                        <td class="action-cell">
                            <a href="edit_users.php?id=<?php echo $row['U_ID']; ?>">
                                <button class="edit">Sửa</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?> 
