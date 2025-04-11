<?php
    require('connection.php');
    session_start();

    if(isset($_GET['p_id'])) {
        $p_id = $_GET['p_id'];
        $sql_ProductInfo = "SELECT * FROM account_game JOIN account_img ON account_game.ACC_ID = account_img.ACC_ID WHERE account_game.ACC_ID = ?";
        $stmt = $conn->prepare($sql_ProductInfo);
        $stmt->bind_param("i", $p_id); // "i" là kiểu dữ liệu số nguyên (integer)
        $stmt->execute();
        $result_ProductInfo = $stmt->get_result();
    }
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP ACC LIQI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="./css/grid_system_12_column.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/product_info.css">

</head>
<body> 

<div id="header" class="grid wide">


    <div class="row nav-bar">
    <!-- NAV MENU WEB -->
    <div class="col p-6 t-6 m-0">
        <div class="row no-gutters nav-bar_menu">
            <div class="col p-2 t-2 m-0">
                <a href="home.php" class="nav-bar_menu_item b_left_radius_6px">HOME</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="home.php" class="nav-bar_menu_item">SLIDER</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="home.php#content" class="nav-bar_menu_item">PRODUCT</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="home.php#feedback" class="nav-bar_menu_item">FEEDB</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="home.php#footer" class="nav-bar_menu_item">FOOTER</a>
            </div>
        </div>
    </div>

    <!-- NAV MENU USER -->
    <div class="col p-6 t-6">
        <div class="row no-gutters nav-bar_menu">
            <?php if (empty($_SESSION['user'])): ?>
                <!-- Hiển thị nút Đăng Nhập và Đăng Ký nếu chưa đăng nhập -->
                <div class="col p-2 p-o-6 t-o-6 t-2 m-0">
                    <a href="login_form.php" class="nav-bar_menu_item">Đăng Nhập</a>
                </div>
                <div class="col p-2 t-2 m-0">
                    <a href="sign_in.php" class="nav-bar_menu_item">Đăng Ký</a>
                </div>
            <?php else: ?>
                <!--Hiển thị đăng xuất -->
                <div class="col p-2 p-o-6 t-o-6 t-2 m-0">
                    <a href="log_out.php" class="nav-bar_menu_item">Đăng Xuất</a>
                </div>
                <!-- Hiển thị avatar nếu đã đăng nhập -->
                <div class="col p-2 t-2 m-0">
            <?php if (!empty($_SESSION['user'])): ?>
            <!-- Kiểm tra AUTH_ID hoặc is_admin -->
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
            <a href="Test_QL.php" class="nav-bar_menu_item nav-bar_menu_item--nonhover">
                <img src="../image/avatar test.png" alt="AVATAR USER" class="avatar">
            </a>
            <?php else: ?>
                <a href="Info_Users.php" class="nav-bar_menu_item nav-bar_menu_item--nonhover">
                    <img src="../image/avatar test.png" alt="AVATAR USER" class="avatar">
                </a>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="account">
    <div class="account_container grid wide">
        <div class="row">
            <div class="col p-6">
                <!--  -->
                <div class="img_container">
                    <?php
                        if($result_ProductInfo->num_rows > 0) {
                            $r = $result_ProductInfo->fetch_assoc();
                    ?>
                        <div class="mySlides_account">
                            <div class="numbertext">1 / 6</div>
                            <img src="../image/image_acc/<?php echo $r['acc_img'] ?>">
                        </div>

                        <div class="mySlides_account">
                            <div class="numbertext">2 / 6</div>
                            <img src="../image/image_acc/<?php echo $r['IMG_LINK'] ?>">
                        </div>
                    <?php
                        }
                    ?>

                    <?php
                        if($result_ProductInfo->num_rows > 0) {
                            while($row = $result_ProductInfo->fetch_assoc()){
                    ?>
                        <div class="mySlides_account">
                            <div class="numbertext"><?php echo $row['IMG_NUMBER'] ?> / 6</div>
                            <img src="../image/image_acc/<?php echo $row['IMG_LINK'] ?>">
                        </div>
                    <?php            
                            }
                        }
                    ?>
                    
                        
                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>

                

                    <div class="thumbnails_row">
                        <?php
                            $stmt->execute();
                            $result_ProductInfo = $stmt->get_result();
                            if($result_ProductInfo->num_rows > 0) {
                        ?>
                            <div class="thumbnail_col">
                                <img class="thumbnail_img cursor" src="../image/image_acc/<?php echo $r['acc_img'] ?>" onclick="currentSlide(1)">
                            </div>
                        <?php
                            }
                        ?>

                        <?php
                            if($result_ProductInfo->num_rows > 0) {
                                while($row = $result_ProductInfo->fetch_assoc()){
                        ?>
                            <div class="thumbnail_col">
                                <img class="thumbnail_img cursor" src="../image/image_acc/<?php echo $row['IMG_LINK'] ?>" onclick="currentSlide(<?php echo $row['IMG_NUMBER'] ?>)">
                            </div>
                        <?php            
                                }
                            }
                        ?>
                        

                    </div>
                </div>
                <!--  -->
            </div>


            <div class="col p-6">
                <!--  -->
                <div class="account_info">
                    <?php
                        $stmt->execute();
                        $result_ProductInfo = $stmt->get_result();
                        if($result_ProductInfo->num_rows > 0) {
                            $r = $result_ProductInfo->fetch_assoc();
                    ?>
                    <h1 class="account_name">ID Tài Khoản: #00<?php echo $r['ACC_ID'] ?></h1>
                    <h1 class="account_heroes">Số Lượng Tướng: <?php echo $r['ACC_CHAMP_COUNT'] ?></h1>
                    <h1 class="account_skin">Số Lượng Trang Phục: <?php echo $r['ACC_SKIN_COUNT'] ?></h1>
                    <h1 class="account_rank">Bậc Rank: <?php echo $r['ACC_RANK'] ?></h1>
                    <h1 class="account_price">Giá: <?php echo $r['ACC_PRICE'] ?></h1>
                    <?php
                        }
                    ?>
                    <div class="payment">
                        <a href="payment.php?id=<?php echo $p_id ?>" class="payment_btn">Thanh Toán QR</a>
                        <a href="payment.php?id=<?php echo $p_id ?>" class="payment_btn">Thanh Toán ATM</a>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
</div>

<div id="footer">
            <div class="sub_header">
                <p class="sub_header-text">THÔNG TIN THÊM VỀ CHÚNG TÔI</p>
            </div>
            <div class="row footer_container">
                <div class="col p-4">
                    <div class="wrap_element_ft">
                        <span class="element_ft_header">Về Shop Chúng Tôi</span>
                        <p class="element_ft_content">Shop Bán Acc Liên Quân Uy tín - Giá Rẻ - An toàn - Tự động. Ở đây có bán acc, thu acc, nạp game, trả góp, giao lưu lên đời, tìm acc theo yêu cầu...</p>
                    </div>
                </div>

                <div class="col p-4">
                    <div class="wrap_element_ft">
                        <span class="element_ft_header">Chúng tôi</span>
                        <p class="element_ft_content">Chỉ cần bạn mua acc, rẻ đắt không quan trọng:))
                            <br>
                            Lưu ý: Acc trắng thông tin và chỉ cài SDT sẽ không có bảo hành thông tin. Acc có CCCD sẽ được bảo hành tranh chấp cho khách hàng yên tâm chơi, nhưng không bảo kê mua bán qua tay. 
                            <br>
                            Acc reg sẽ chỉ bảo hành lần đăng nhập đầu tiên, nếu vừa mua vào bị ban(khóa) shop sẽ hoàn tiền hoặc đổi acc tương tự, sau đó không bảo hành thêm, tks!</p>
                    </div>
                </div>

                <div class="col p-4">
                    <div class="wrap_element_ft">
                        <span class="element_ft_header">Liên Hệ</span>
                        <p class="element_ft_content">
                            <span>
                                Hotline: 0797979397
                            </span>
                            <span>
                                Work time: 10:00 - 22:00
                            </span>
                            <span>
                                Address: Tân Phú, Hồ Chí Minh</p>
                            </span>
                    </div>
                </div>
                
                
                
                <div class="footer_ti">
                    <p>shopski.vn</p>
                    <p>SHOP ACC LIÊN QUÂN - GIÁ RẺ - ĐẸP - UY TÍN</p>
                </div>

            </div>


</div>
</body>
<script src="./js/slideAccountInfo.js"></script>
</html>