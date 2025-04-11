<?php
session_start();
// Xóa tất cả các giá trị trong session
session_unset(); 

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang login
header("Location: home.php");
exit;
?>
