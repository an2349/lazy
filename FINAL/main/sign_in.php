<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign_in.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sign In</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Đăng Ký</h1>
        </header>

        <!-- Chuyển đổi giữa Đăng nhập và Đăng ký -->
        <div class="switch-register">
            <i class="fas fa-exchange-alt"></i>
            <span><a href="login_form.php">Đăng nhập</a></span>
        </div>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php
        if (isset($_SESSION['error_message'])) {
            echo "<p style='color: red;'>{$_SESSION['error_message']}</p>";
            // Xóa thông báo lỗi sau khi đã hiển thị
            unset($_SESSION['error_message']);
        }
        ?>

        <form class="login-form" action="sign_in_test.php" method="POST">
            <div class="input-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="re-password">Nhập lại mật khẩu</label>
                <input type="password" id="re-password" name="re-password" required>
            </div>

            <div class="button-group">
                <a href="home.php" type="button" class="cancel-btn">Hủy</a>
                <button type="submit" class="login-btn">Đăng ký</button>
            </div>
        
        </form>
    </div>
</body>
</html>