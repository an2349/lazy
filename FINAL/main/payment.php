<?php
    include 'connection.php';
    session_start();
   // Kiểm tra nếu đã đăng nhập
    if (!isset($_SESSION['user'])) {
    header("Location: login_form.php");
    exit;
    }

    $user_id = $_SESSION['user']['U_ID'];

    //echo $user_id;

    $id = $_GET['id'];
    $sqlSetSTT = "UPDATE account_game SET ACC_STATUS = 0 WHERE ACC_ID = ?";
    $stmt = $conn->prepare($sqlSetSTT);
    $stmt->bind_param("i", $id);
    $stmt->execute();


    $datetime = (new DateTime())->format('Y-m-d H:i:s');
    $sqlBuy = "INSERT INTO buy(ACC_ID, U_ID, BUY_DATE, BUY_STATUS) VALUES (?, ?, ?, 1)";
    $stmt2 = $conn->prepare($sqlBuy);
    $stmt2->bind_param("iis", $id, $user_id, $datetime);
    $stmt2->execute();
    header("Location: home.php");
?>