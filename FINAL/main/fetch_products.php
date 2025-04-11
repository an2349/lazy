<?php
// Kết nối cơ sở dữ liệu
include 'connection.php';

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT ACC_ID, ACC_LOG_GAME, ACC_PASSWORD, ACC_PRICE, ACC_RANK, 
               ACC_SKIN_COUNT, ACC_CHAMP_COUNT, CAT_ID, ACC_STATUS 
        FROM ACCOUNT_GAME";
$result = $conn->query($sql);

// Đếm số lượng cột (không tính cột Hành Vi)
$numColumns = 9; // Tổng số cột trừ cột "Hành Vi"
$remainingWidth = 80 - 15; // Phần còn lại sau khi trừ cột Hành Vi
$columnWidth = round($remainingWidth / $numColumns, 2);

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
    .add-button {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 10px 40px; /* Tăng chiều rộng của nút */
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    position: absolute;
    bottom: 20px;
    right: 20px; /* Đặt nút ở góc dưới bên phải */
    white-space: nowrap; /* Giữ chữ trên cùng một dòng */
    text-align: center;
}

.add-button:hover {
    background-color: #218838;
}

    .button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }
</style>";

// Tạo tiêu đề bảng
echo "<table>";
echo "<tr>";
echo "<th style='width:{$columnWidth}%;'>ID</th>";
echo "<th style='width:{$columnWidth}%;'>Tên đăng nhập</th>";
echo "<th style='width:{$columnWidth}%;'>Mật khẩu</th>";
echo "<th style='width:{$columnWidth}%;'>Giá</th>";
echo "<th style='width:{$columnWidth}%;'>Rank</th>";
echo "<th style='width:{$columnWidth}%;'>Số skin</th>";
echo "<th style='width:{$columnWidth}%;'>Số tướng</th>";
echo "<th style='width:{$columnWidth}%;'>Loại tài khoản</th>";
echo "<th style='width:{$columnWidth}%;'>Trạng thái</th>";
echo "<th style='width:15%;'>Hành Vi</th>";
echo "</tr>";

// Hiển thị dữ liệu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['ACC_ID']}</td>";
        echo "<td>" . htmlspecialchars($row['ACC_LOG_GAME']) . "</td>";
        echo "<td>********</td>"; // Không hiển thị mật khẩu thật
        echo "<td>{$row['ACC_PRICE']}</td>";
        echo "<td>" . htmlspecialchars($row['ACC_RANK']) . "</td>";
        echo "<td>{$row['ACC_SKIN_COUNT']}</td>";
        echo "<td>{$row['ACC_CHAMP_COUNT']}</td>";
        echo "<td>{$row['CAT_ID']}</td>";
        echo "<td>" . ($row['ACC_STATUS'] ? "Active" : "Inactive") . "</td>";
        echo "<td class='action-cell'>";
        echo "<a href='edit_account.php?id={$row['ACC_ID']}'><button>Sửa</button></a> ";
        echo "<form style='display:inline;' method='POST' action='delete_account.php'>
        <input type='hidden' name='id' value='{$row['ACC_ID']}'>
        <button type='submit' onclick=\"return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')\">Xóa</button>
      </form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
}
echo "</table>";

// Thêm nút Thêm sản phẩm ở góc dưới bên phải
echo "<div class='button-container'>
        <a href='add_account.php' class='add-button'>Thêm sản phẩm</a>
      </div>";
$conn->close();
?>
