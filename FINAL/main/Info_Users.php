<?php
session_start();

include 'connection.php';

// Kiểm tra nếu đã đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: login_form.php");
    exit;
}

$user_id = $_SESSION['user']['U_ID'];

// Xử lý cập nhật thông tin khi ấn lưu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['name'] ?? '';
    $new_tel = $_POST['tel'] ?? '';
    $new_email = $_POST['email'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Lấy thông tin hiện tại từ cơ sở dữ liệu
    $sql = "SELECT U_PASS FROM USERS WHERE U_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        echo "<script>alert('Người dùng không tồn tại.'); window.location.href='Info_Users.php';</script>";
        exit;
    }

    $update_fields = [];
    $update_params = [];
    $param_types = '';

    // Cập nhật tên
    if (!empty($new_name)) {
        $update_fields[] = "U_NAME = ?";
        $update_params[] = $new_name;
        $param_types .= 's';
    }

    // Cập nhật số điện thoại
    if (!empty($new_tel)) {
        $update_fields[] = "U_TEL = ?";
        $update_params[] = $new_tel;
        $param_types .= 's';
    }

    // Cập nhật email
    if (!empty($new_email)) {
        $update_fields[] = "U_EMAIL = ?";
        $update_params[] = $new_email;
        $param_types .= 's';
    }

    // Cập nhật mật khẩu nếu có nhập mật khẩu mới
    if (!empty($new_password)) {
        if ($new_password !== $confirm_password) {
            echo "<script>alert('Mật khẩu mới và xác nhận không khớp.'); window.location.href='Info_Users.php';</script>";
            exit;
        }

        if ($current_password !== $user['U_PASS']) {
            echo "<script>alert('Mật khẩu hiện tại không chính xác.'); window.location.href='Info_Users.php';</script>";
            exit;
        }

        $update_fields[] = "U_PASS = ?";
        $update_params[] = $new_password;
        $param_types .= 's';
    }

    // Thực hiện cập nhật nếu có thay đổi
    if (!empty($update_fields)) {
        $sql = "UPDATE USERS SET " . implode(", ", $update_fields) . " WHERE U_ID = ?";
        $update_params[] = $user_id;
        $param_types .= 'i';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($param_types, ...$update_params);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thông tin thành công.'); window.location.href='Info_Users.php';</script>";
        } else {
            echo "<script>alert('Cập nhật thông tin thất bại.'); window.location.href='Info_Users.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Không có thông tin nào được thay đổi.'); window.location.href='Info_Users.php';</script>";
    }
}

// Lấy thông tin hiện tại của người dùng
$sql = "SELECT U_NAME, U_TEL, U_EMAIL FROM USERS WHERE U_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Phần bên trái -->
        <div class="sidebar">
            <div class="avatar">
                <div class="circle"></div>
                <p>Ảnh</p>
            </div>
            <nav>
                <button class="menu-button">Lịch Sử</button>
                <button class="menu-button active">Sửa Thông Tin</button>
                <a href="log_out.php"><button class="menu-button">Đăng Xuất</button></a>
            </nav>
        </div>

        <!-- Phần nội dung chính -->
        <div class="main-content">
            <div class="header">
                <h1><?php echo htmlspecialchars($user['U_NAME']); ?></h1>
                <p>Mã khách hàng: <?php echo isset($_SESSION['user']['U_ID']) ? $_SESSION['user']['U_ID'] : "Chưa xác định"; ?></p>


                <p>SDT: <?php echo htmlspecialchars($user['U_TEL']); ?></p>
                <p>Email: <?php echo htmlspecialchars($user['U_EMAIL']); ?></p>
            </div>

            <div class="form-container">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($user['U_NAME']); ?>" placeholder="Nhập tên mới">
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="text" name="tel" value="<?php echo htmlspecialchars($user['U_TEL']); ?>" placeholder="Nhập số mới">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['U_EMAIL']); ?>" placeholder="Nhập email mới">
                    </div>
                    <div class="form-group">
                        <label>Mật Khẩu Hiện Tại</label>
                        <input type="password" name="current_password" placeholder="Mật khẩu hiện tại">
                    </div>
                    <div class="form-group">
                        <label>Mật Khẩu Mới</label>
                        <input type="password" name="new_password" placeholder="Mật khẩu mới">
                    </div>
                    <div class="form-group">
                        <label>Nhập Lại Mật Khẩu Mới</label>
                        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-button">Hủy</button>
                        <button type="submit" class="save-button" name="save">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Thêm đoạn script -->
    <script>
        // Hàm đồng bộ chiều cao giữa sidebar và main-content
        function syncHeights() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.form-container');
            const header_pos = document.querySelector(".header");

            // Lấy chiều cao của các phần
            const sidebarHeight = sidebar.offsetHeight;
            const mainContentHeight = mainContent.offsetHeight;
            const headerHeight = header_pos.offsetHeight;

            // In ra chiều cao của sidebar và main-content để kiểm tra
            console.log('Sidebar height:', sidebarHeight);
            console.log('Main Content height:', mainContentHeight);

            // Lấy chiều cao lớn hơn giữa hai phần
            const maxHeight = Math.max(sidebarHeight, mainContentHeight + headerHeight);

            // Gán chiều cao cho cả hai phần
            sidebar.style.height = (maxHeight + 60) + 'px';

            // In ra chiều cao sau khi đồng bộ
            console.log('Max height set:', maxHeight);
        }

        // Gọi hàm khi tải trang và khi thay đổi kích thước
        window.addEventListener('load', syncHeights);
        window.addEventListener('resize', syncHeights);
    </script>
</body>
</html>