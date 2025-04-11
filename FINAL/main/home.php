<?php

    session_start();
    require("connection.php");

    
    if(isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];
        if($cat_id != 0) {
            $sqlProducts = "SELECT * FROM account_game JOIN categories_acc ON account_game.CAT_ID = categories_acc.CAT_ID WHERE ACC_STATUS = 1 and categories_acc.CAT_ID = ".$cat_id;
        } else {
            $sqlProducts = "SELECT * FROM account_game where ACC_STATUS = 1";
        }
    } else {
        $sqlProducts = "SELECT * FROM account_game where ACC_STATUS = 1";
    }

    //phan trang
    $numrows = 8; 
    $rs_products = $conn->query($sqlProducts);
    $numpages = ceil($rs_products->num_rows / $numrows);
    if (!isset($_REQUEST["page"])) {
        $page = 1;
    } else {
    $page = $_REQUEST["page"];
    }
    if ($page<1) $page = 1;
    if ($page > $numpages) $page = $numpages;
    $sqlProducts .=" limit ". ($page-1)*$numrows." , ". $numrows;
    $result_products = $conn->query($sqlProducts) or die($conn->error);
         
    
    

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

</head>
<body >
    
    
<div id="header" class="grid wide">
    <div class="row nav-bar">
    <!-- NAV MENU WEB -->
    <div class="col p-6 t-6 m-0">
        <div class="row no-gutters nav-bar_menu">
            <div class="col p-2 t-2 m-0">
                <a href="#" class="nav-bar_menu_item b_left_radius_6px">HOME</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="#" class="nav-bar_menu_item">SLIDER</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="#content" class="nav-bar_menu_item">PRODUCT</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="#feedback" class="nav-bar_menu_item">FEEDB</a>
            </div>
            <div class="col p-2 t-2 m-0">
                <a href="#footer" class="nav-bar_menu_item">FOOTER</a>
            </div>
        </div>
    </div>

    <!-- NAV MENU USER -->
    <div class="col p-6 t-6">
        <div class="row no-gutters nav-bar_menu">
            <?php
                if(isset($_SESSION['user'])) {
            ?>
                <div class="col p-2 p-o-6 t-o-6 t-2 m-0">
                    <a href="log_out.php" class="nav-bar_menu_item">Đăng Xuất</a>
                </div>

                <div class="col p-2 t-2 m-0 ">
                    <a href="Info_Users.php" class="nav-bar_menu_item nav-bar_menu_item--nonhover ">
                        <img src="../image/avatar test.png" alt="AVATAR USER" class="avatar">
                    </a>
                </div>
            <?php        
                } else {
            ?>
                <div class="col p-2 p-o-6 t-o-6 t-2 m-0">
                    <a href="login_form.php" class="nav-bar_menu_item">Đăng Nhập</a>
                </div>

                <div class="col p-2 t-2 m-0">
                    <a href="sign_in.php" class="nav-bar_menu_item">Đăng Ký</a>
                </div>
            <?php        
                }
            ?>

        </div>
    </div>
</div>

</div>

        <div id="slider">
            <div class="slideshow_container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 4</div>
                    <img src="../image/slider/img1.jpg" alt="">
                    <div class="text">Uy Tín</div>
                </div>
        
                <div class="mySlides fade">
                    <div class="numbertext">2 / 4</div>
                    <img src="../image/slider/img2.jpg" alt="">
                    <div class="text">Giá Đẹp</div>
                </div>
        
                <div class="mySlides fade">
                    <div class="numbertext">3 / 4</div>
                    <img src="../image/slider/img3.jpg" alt="">
                    <div class="text">Tìm Skin Theo Yêu Cầu</div>
                </div>
        
                <div class="mySlides fade">
                    <div class="numbertext">4 / 4</div>
                    <img src="../image/slider/img4.jpg" alt="">
                    <div class="text">Bảo Hành Trọn Đời</div>
                </div>
        
                <!-- button next and previous -->
                 <a onclick="plusSlides(-1)" class="prev">&#10094;</a>
                 <a onclick="plusSlides(1)" class="next">&#10095;</a>
                          
                <div  class="dot_list" style="text-align:center;">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
        
        
            </div>
        </div>


        <div id="content">
            <div class="sub_header">
                <p class="sub_header-text">ACC LIÊN QUÂN</p>
            </div>

            <div class="product_container">
                <div class="categories">
                    <span>Danh Mục</span>
                    <ul class="list_categories">
                    <li><a href="?cat_id=0#content" class="list_cate_item">Tất Cả</a></li>
                    <?php
                        $sqlCategories = "SELECT * FROM categories_acc";
                        $rsCategories = $conn->query($sqlCategories) or die($conn->error);
                        if($rsCategories->num_rows > 0) {
                            while($row = $rsCategories->fetch_assoc()) {
                    ?>
                                <li><a href="?cat_id=<?php echo htmlspecialchars($row['CAT_ID']); ?>#content" name="cat_id" class="list_cate_item"><?php echo $row['CAT_NAME'] ?></a></li>
                    <?php
                                
                            }
                        }
                    ?>
                    </ul>
                </div>

                <div class="grid list_product">
                    <div class="row">

                        
                        <?php    
                            if($result_products->num_rows > 0) {
                                while($row = $result_products->fetch_assoc()) {
                                    

                                
                           
                        ?>

                        <div class="col p-3">
                            <a href="product_info.php?p_id=<?php echo $row['ACC_ID'] ?>" class="product">
                                <div class="wrap">
                                    <img src="../image/image_acc/<?php echo $row['acc_img']?>" alt="PRODUCT">
                                    <div class="product_body">
                                        <div class="info">
                                            <span class="name">ID: 00<?php echo $row['ACC_ID']?></span>
                                            <span class="price"><?php echo $row['ACC_PRICE']?>đ</span>
                                        </div>
                                        <div class="more_info">
                                            <span class="skin">Trang Phục: <?php echo $row['ACC_SKIN_COUNT']?></span>
                                            <span class="rank">Rank: <?php echo $row['ACC_RANK']?></span>
                                            <span class="heroes">Tướng: <?php echo $row['ACC_CHAMP_COUNT']?></span>
                                        </div>
                                        <p class="description">Murad 2.0, Violet Thần Long, Gildu Bãi Biển, Ngộ Không Siêu Việt</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <?php
                                    
                                }
                            }
                        ?>
                        
                        
                    </div>

                    <div class="row pagination">
                        <?php 
                            for($i = 1;$i<=$numpages;$i++){
                        ?>
                            <div class="col p-1">
                                <a href="?page=<?php echo $i ?>#content" class="page"><?php echo $i ?></a>
                            </div>   
                        <?php        
                            }
							
						?>
                        
                        
                    </div>
                </div>
            </div>






        </div>
        
        <div id="feedback">
            <div class="sub_header sub_header--swap">
                <p class="sub_header-text">ĐÁNH GIÁ</p>
            </div>

            <div class="grid feedback">
                <div class="row feedback_container">
                    <?php
                        $sqlFeedback = "SELECT * FROM feedback JOIN users ON feedback.U_ID = users.U_ID LIMIT 9";
                        $rsFeedback = $conn->query($sqlFeedback) or die($conn->error);
                        if($rsFeedback->num_rows > 0) {
                            while($row = $rsFeedback->fetch_assoc()){
                    ?>
                                <div class="col p-4">
                                    <div class="wrap_fb">
                                        <div class="wrap_img">
                                            <img src="../image/avt/avatar test.png" alt="" class="avt_fb">
                                            <div class="wrap_name">
                                                <span class="name_fb"><?php echo $row['U_NAME'] ?></span>
                                            </div>
                                        </div>
                                        <p class="content_fb"><?php echo $row['FB_TITLE']."  ".$row['FB_CONTENT'] ?></p>
                                        
                                    </div>
                                </div>
                    <?php            
                            }
                        } 
                    ?>

                    




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
    </div>


</body>
<script src="./js/sliderScript.js"></script>
</html>










