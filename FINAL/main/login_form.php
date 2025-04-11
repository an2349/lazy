

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login_form.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Login Form</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Đăng Nhập</h1>
        </header>

        <!-- Chuyển đổi giữa Đăng nhập và Đăng ký -->
        <div class="switch-register">
            <i class="fas fa-exchange-alt"></i>
            <span><a href="sign_in.php">Đăng ký</a></span>
        </div>

        <form class="login-form" method="POST" action="login_test.php">
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
            </div>
        
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
        
            <div class="button-group">
                <a href="home.php" type="button" class="cancel-btn">Hủy</a>
                <button type="submit" class="login-btn">Đăng nhập</button>
            </div>
        
            <a href="../forgot_password/forogt_password.html" class="forgot-password-link">Quên mật khẩu?</a>
        
            <button type="button" class="facebook-btn">
                <i class="fab fa-facebook-f"></i>Facebook
            </button>
        </form>        
    </div>
</body>
</html>
