<?php
include 'connection.php';

// Kiểm tra dữ liệu từ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);

    // Xóa tài khoản
    $sql = "UPDATE ACCOUNT_GAME SET ACC_STATUS = 0 WHERE ACC_ID = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Xóa tài khoản thành công.');
                window.location.href = 'Test_QL.php'; // Quay lại danh sách sản phẩm
              </script>";
    } else {
        echo "<script>
                alert('Lỗi khi xóa tài khoản: " . $conn->error . "');
                window.location.href = 'Test_QL.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Dữ liệu không hợp lệ.');
            window.location.href = 'Test_QL.php';
          </script>";
}

$conn->close();
?>
