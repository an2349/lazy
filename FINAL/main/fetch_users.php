<?php
include 'connection.php';

// Truy vấn dữ liệu người dùng với AUTH_ID = 2
$sql = "SELECT U_ID, U_LOG_NAME, U_NAME, U_TEL, U_EMAIL, U_PASS, AUTH_NAME
        FROM USERS 
        JOIN AUTHORITY ON USERS.AUTH_ID = AUTHORITY.AUTH_ID
        WHERE USERS.AUTH_ID = 2"; // Thêm điều kiện WHERE
$result = $conn->query($sql);

// CSS nội tuyến để làm đẹp bảng
echo "<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .action-cell button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }
    .action-cell button:hover {
        background-color: #0056b3;
    }
</style>";

// Tạo tiêu đề bảng
echo "<table>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Tên đăng nhập</th>";
echo "<th>Tên người dùng</th>";
echo "<th>Số điện thoại</th>";
echo "<th>Email</th>";
echo "<th>Quyền</th>";
echo "<th>Hành Vi</th>";
echo "</tr>";

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['U_ID']}</td>";
        echo "<td>" . htmlspecialchars($row['U_LOG_NAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['U_NAME']) . "</td>";
        echo "<td>{$row['U_TEL']}</td>";
        echo "<td>" . htmlspecialchars($row['U_EMAIL']) . "</td>";
        echo "<td>" . htmlspecialchars($row['AUTH_NAME']) . "</td>";
        echo "<td class='action-cell'>";
        echo "<a href='edit_users.php?id={$row['U_ID']}'><button>Sửa</button></a> ";
        echo "<form style='display:inline;' method='POST' action='delete_users.php'>
                <input type='hidden' name='id' value='{$row['U_ID']}'>
                <button type='submit' onclick=\"return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')\">Xóa</button>
              </form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Không có dữ liệu</td></tr>";
}
echo "</table>";

$conn->close();
?>
