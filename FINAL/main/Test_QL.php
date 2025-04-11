<?php
session_start(); // Khởi tạo hoặc tiếp tục session


$admin = $_SESSION['user']; // Lấy thông tin admin từ session
?>

<!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang Quản Lý</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            .container {
                display: flex;
                height: 100vh;
            }

            /* Phần 1: Menu bên trái */
            .sidebar {
                width: 20%;
                background-color: #f4f4f4;
                padding: 20px;
                box-sizing: border-box;
            }

            .sidebar h3 {
                margin-top: 0;
            }

            .sidebar ul {
                list-style-type: none;
                padding: 0;
            }

            .sidebar ul li {
                margin: 15px 0;
            }

            .sidebar ul li a {
                text-decoration: none;
                color: black;
                cursor: pointer;
            }

            /* Phần 2: Bảng nội dung */
            .main-content {
                width: 80%;
                padding: 20px;
                box-sizing: border-box;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            .action-cell {
                text-align: center;
            }

            .dynamic-width {
                /* Sẽ được thêm bởi PHP */
            }
        </style>
        <script>
            // Hàm tải dữ liệu qua AJAX
            function loadData(endpoint) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', endpoint, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('data-table').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            }
        </script>
    </head>
    <body>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Quản lý</h3>
            <p><strong><?php echo htmlspecialchars($admin['U_NAME']); ?></strong></p>
            <p>Vai trò: Admin</p>
            <ul>
                <li><a href="#" onclick="loadData('fetch_users.php')">Quản lý người dùng</a></li>
                <li><a href="#" onclick="loadData('fetch_products.php')">Quản lý sản phẩm</a></li>
                <li><a href="#" onclick="loadData('edit_admin.php')">Sửa thông tin</a></li>
                <li><a href="log_out.php">Đăng xuất</a></li>
            </ul>
        </div>


        <!-- Main Content -->
        <div class="main-content">
            <table>
                <thead id="table-header">
                    <!-- Header sẽ được cập nhật từ PHP -->
                </thead>
                <tbody id="data-table">
                    <!-- Dữ liệu sẽ được cập nhật từ PHP -->
                </tbody>
            </table>
        </div>
    </div>

    </body>
    </html>
