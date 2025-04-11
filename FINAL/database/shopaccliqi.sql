-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 16, 2024 lúc 12:44 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopaccliqi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_game`
--

CREATE TABLE `account_game` (
  `ACC_ID` int(11) NOT NULL,
  `ACC_LOG_GAME` varchar(50) NOT NULL,
  `ACC_PASSWORD` varchar(50) NOT NULL,
  `ACC_PRICE` decimal(10,2) NOT NULL,
  `ACC_RANK` varchar(20) NOT NULL,
  `ACC_SKIN_COUNT` int(11) NOT NULL,
  `ACC_CHAMP_COUNT` int(11) NOT NULL,
  `ACC_STATUS` tinyint(1) DEFAULT 1,
  `CAT_ID` int(11) DEFAULT NULL,
  `acc_img` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_game`
--

INSERT INTO `account_game` (`ACC_ID`, `ACC_LOG_GAME`, `ACC_PASSWORD`, `ACC_PRICE`, `ACC_RANK`, `ACC_SKIN_COUNT`, `ACC_CHAMP_COUNT`, `ACC_STATUS`, `CAT_ID`, `acc_img`) VALUES
(1, 'account1', '000000', 199.99, 'Kim Cương', 104, 104, 0, 1, 'acc1main.jpg'),
(2, 'account2', '111111', 299.99, 'Cao Thủ', 233, 119, 0, 2, 'acc2main.jpg'),
(3, 'account3', '222222', 399.99, 'Cao Thủ', 145, 102, 0, 1, 'acc3main.jpg'),
(4, 'account4', '444444', 399.99, 'Cao Thủ', 70, 49, 1, 1, 'acc4main.jpg'),
(5, 'account5', '000000', 499.99, 'Cao Thủ', 266, 119, 0, 1, 'acc5main.jpg'),
(6, 'account6', '111111', 599.99, 'Cao Thủ', 216, 105, 1, 2, 'acc6main.jpg'),
(7, 'account7', '222222', 899.99, 'Kim Cương', 284, 119, 1, 1, 'acc7main.jpg'),
(8, 'account8', '222222', 799.99, 'Kim Cương', 342, 119, 1, 1, 'acc8main.jpg'),
(9, 'account9', '123421', 800.99, 'Tinh Anh', 317, 119, 1, 1, 'acc9main.jpg'),
(10, 'account10', '678575', 888.99, 'Tinh Anh', 323, 119, 1, 1, 'acc10main.jpg'),
(11, 'account11', '123689', 2222.99, 'Cao Thủ', 385, 119, 1, 1, 'acc11main.jpg'),
(12, 'account12', '239843', 1111.99, 'Tinh Anh', 289, 119, 1, 1, 'acc12main.jpg'),
(13, 'account13', '093092', 888.99, 'Tinh Anh', 280, 119, 1, 1, 'acc13main.jpg'),
(14, 'account14', '242111', 999.99, 'Đại Cao Thủ', 301, 119, 1, 1, 'acc14main.jpg'),
(15, 'account15', '657777', 444.99, 'Đại Cao Thủ', 160, 81, 1, 1, 'acc15main.jpg'),
(16, 'account16', '123321', 555.99, 'Đại Cao Thủ', 248, 118, 1, 1, 'acc16main.jpg'),
(17, 'account17', '123421', 222.99, 'Đại Cao Thủ', 301, 119, 1, 1, 'acc17main.jpg'),
(18, 'account18', '123321', 333.99, 'Đại Cao Thủ', 300, 119, 1, 1, 'acc18main.jpg'),
(19, 'account19', '964341', 111.99, 'Kim Cương', 68, 43, 1, 1, 'acc19main.jpg'),
(20, 'account20', '374234', 333.99, 'Tinh Anh', 188, 97, 1, 1, 'acc20main.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_img`
--

CREATE TABLE `account_img` (
  `IMG_ID` int(11) NOT NULL,
  `ACC_ID` int(11) DEFAULT NULL,
  `IMG_LINK` varchar(30) NOT NULL,
  `IMG_NUMBER` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_img`
--

INSERT INTO `account_img` (`IMG_ID`, `ACC_ID`, `IMG_LINK`, `IMG_NUMBER`) VALUES
(2, 1, 'acc1_1.jpg', '2'),
(3, 1, 'acc1_2.jpg', '3'),
(4, 1, 'acc1_3.jpg', '4'),
(5, 1, 'acc1_4.jpg', '5'),
(6, 1, 'acc1_5.jpg', '6'),
(8, 2, 'acc2_1.jpg', '2'),
(9, 2, 'acc2_2.jpg', '3'),
(10, 2, 'acc2_3.jpg', '4'),
(11, 2, 'acc2_4.jpg', '5'),
(12, 2, 'acc2_5.jpg', '6'),
(14, 3, 'acc3_1.jpg', '2'),
(15, 3, 'acc3_2.jpg', '3'),
(16, 3, 'acc3_3.jpg', '4'),
(17, 3, 'acc3_4.jpg', '5'),
(18, 3, 'acc3_5.jpg', '6'),
(20, 4, 'acc4_1.jpg', '2'),
(21, 4, 'acc4_2.jpg', '3'),
(22, 4, 'acc4_3.jpg', '4'),
(23, 4, 'acc4_4.jpg', '5'),
(24, 4, 'acc4_5.jpg', '6'),
(26, 5, 'acc5_1.jpg', '2'),
(27, 5, 'acc5_2.jpg', '3'),
(28, 5, 'acc5_3.jpg', '4'),
(29, 5, 'acc5_4.jpg', '5'),
(30, 5, 'acc5_5.jpg', '6'),
(32, 6, 'acc6_1.jpg', '2'),
(33, 6, 'acc6_2.jpg', '3'),
(34, 6, 'acc6_3.jpg', '4'),
(35, 6, 'acc6_4.jpg', '5'),
(36, 6, 'acc6_5.jpg', '6'),
(38, 7, 'acc7_1.jpg', '2'),
(39, 7, 'acc7_2.jpg', '3'),
(40, 7, 'acc7_3.jpg', '4'),
(41, 7, 'acc7_4.jpg', '5'),
(42, 7, 'acc7_5.jpg', '6'),
(44, 8, 'acc8_1.jpg', '2'),
(45, 8, 'acc8_2.jpg', '3'),
(46, 8, 'acc8_3.jpg', '4'),
(47, 8, 'acc8_4.jpg', '5'),
(48, 8, 'acc8_5.jpg', '6'),
(50, 9, 'acc9_1.jpg', '2'),
(51, 9, 'acc9_2.jpg', '3'),
(52, 9, 'acc9_3.jpg', '4'),
(53, 9, 'acc9_4.jpg', '5'),
(54, 9, 'acc9_5.jpg', '6'),
(56, 10, 'acc10_1.jpg', '2'),
(57, 10, 'acc10_2.jpg', '3'),
(58, 10, 'acc10_3.jpg', '4'),
(59, 10, 'acc10_4.jpg', '5'),
(60, 10, 'acc10_5.jpg', '6'),
(62, 11, 'acc11_1.jpg', '2'),
(63, 11, 'acc11_2.jpg', '3'),
(64, 11, 'acc11_3.jpg', '4'),
(65, 11, 'acc11_4.jpg', '5'),
(66, 11, 'acc11_5.jpg', '6'),
(68, 12, 'acc12_1.jpg', '2'),
(69, 12, 'acc12_2.jpg', '3'),
(70, 12, 'acc12_3.jpg', '4'),
(71, 12, 'acc12_4.jpg', '5'),
(72, 12, 'acc12_5.jpg', '6'),
(74, 13, 'acc13_1.jpg', '2'),
(75, 13, 'acc13_2.jpg', '3'),
(76, 13, 'acc13_3.jpg', '4'),
(77, 13, 'acc13_4.jpg', '5'),
(78, 13, 'acc13_5.jpg', '6'),
(80, 14, 'acc14_1.jpg', '2'),
(81, 14, 'acc14_2.jpg', '3'),
(82, 14, 'acc14_3.jpg', '4'),
(83, 14, 'acc14_4.jpg', '5'),
(84, 14, 'acc14_5.jpg', '6'),
(86, 15, 'acc15_1.jpg', '2'),
(87, 15, 'acc15_2.jpg', '3'),
(88, 15, 'acc15_3.jpg', '4'),
(89, 15, 'acc15_4.jpg', '5'),
(90, 15, 'acc15_5.jpg', '6'),
(92, 16, 'acc16_1.jpg', '2'),
(93, 16, 'acc16_2.jpg', '3'),
(94, 16, 'acc16_3.jpg', '4'),
(95, 16, 'acc16_4.jpg', '5'),
(96, 16, 'acc16_5.jpg', '6'),
(98, 17, 'acc17_1.jpg', '2'),
(99, 17, 'acc17_2.jpg', '3'),
(100, 17, 'acc17_3.jpg', '4'),
(101, 17, 'acc17_4.jpg', '5'),
(102, 17, 'acc17_5.jpg', '6'),
(104, 18, 'acc18_1.jpg', '2'),
(105, 18, 'acc18_2.jpg', '3'),
(106, 18, 'acc18_3.jpg', '4'),
(107, 18, 'acc18_4.jpg', '5'),
(108, 18, 'acc18_5.jpg', '6'),
(110, 19, 'acc19_1.jpg', '2'),
(111, 19, 'acc19_2.jpg', '3'),
(112, 19, 'acc19_3.jpg', '4'),
(113, 19, 'acc19_4.jpg', '5'),
(114, 19, 'acc19_5.jpg', '6'),
(116, 20, 'acc20_1.jpg', '2'),
(117, 20, 'acc20_2.jpg', '3'),
(118, 20, 'acc20_3.jpg', '4'),
(119, 20, 'acc20_4.jpg', '5'),
(120, 20, 'acc20_5.jpg', '6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authority`
--

CREATE TABLE `authority` (
  `AUTH_ID` int(11) NOT NULL,
  `AUTH_NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `authority`
--

INSERT INTO `authority` (`AUTH_ID`, `AUTH_NAME`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buy`
--

CREATE TABLE `buy` (
  `BUY_ID` int(11) NOT NULL,
  `ACC_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `BUY_DATE` datetime NOT NULL,
  `BUY_STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `buy`
--

INSERT INTO `buy` (`BUY_ID`, `ACC_ID`, `U_ID`, `BUY_DATE`, `BUY_STATUS`) VALUES
(1, 2, 4, '2024-12-16 11:55:23', 1),
(3, 3, 4, '2024-12-16 11:56:38', 1),
(4, 5, 4, '2024-12-16 12:35:23', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_acc`
--

CREATE TABLE `categories_acc` (
  `CAT_ID` int(11) NOT NULL,
  `CAT_NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_acc`
--

INSERT INTO `categories_acc` (`CAT_ID`, `CAT_NAME`) VALUES
(1, 'Trắng Thông Tin'),
(2, 'Thông Tin Xấu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `FB_ID` int(11) NOT NULL,
  `FB_TITLE` varchar(50) NOT NULL,
  `FB_CONTENT` varchar(5000) NOT NULL,
  `U_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`FB_ID`, `FB_TITLE`, `FB_CONTENT`, `U_ID`) VALUES
(27, 'OK', 'Dịch Vụ Này OK', 1),
(28, 'OK1', 'Dịch Vụ Này OK', 2),
(29, 'OK2', 'Dịch Vụ Này OK', 1),
(30, 'OK3', 'Dịch Vụ Này OK', 1),
(31, 'OK4', 'Dịch Vụ Này OK', 1),
(32, 'OK5', 'Dịch Vụ Này OK', 1),
(33, 'OK6', 'Dịch Vụ Này OK', 1),
(34, 'OK7', 'Dịch Vụ Này OK', 2),
(35, 'OK8', 'Dịch Vụ Này OK', 2),
(36, 'OK9', 'Dịch Vụ Này OK', 2),
(37, 'OK10', 'Dịch Vụ Này OK', 2),
(38, 'OK11', 'Dịch Vụ Này OK', 2),
(39, 'OK12', 'Dịch Vụ Này OK Dịch Vụ Này OK Dịch Vụ Này OK Dịch Vụ Này OK Dịch Vụ Này OK Dịch Vụ Này OK', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `PAY_ID` int(11) NOT NULL,
  `PAY_TYPE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`PAY_ID`, `PAY_TYPE`) VALUES
(1, 'QR THANH TOÁN'),
(2, 'ATM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `U_ID` int(11) NOT NULL,
  `U_LOG_NAME` varchar(30) NOT NULL,
  `U_NAME` varchar(50) NOT NULL,
  `U_TEL` varchar(15) NOT NULL,
  `U_EMAIL` varchar(50) NOT NULL,
  `U_PASS` varchar(100) NOT NULL,
  `AUTH_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`U_ID`, `U_LOG_NAME`, `U_NAME`, `U_TEL`, `U_EMAIL`, `U_PASS`, `AUTH_ID`) VALUES
(1, 'user123', 'Nguyen Van A', '0123456789', 'user1@gmail.com', '123', 1),
(2, 'user124', 'Nguyen Kim Khanh', '0123456788', 'user2@gmail.com', '123', 1),
(3, 'admin', 'Admin User', '9876543210', 'admin@gmail.com', 'admin', 1),
(4, 'veronica', 'Veronica', '0123456', 'veronica@gmail.com', 'admin', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_game`
--
ALTER TABLE `account_game`
  ADD PRIMARY KEY (`ACC_ID`),
  ADD KEY `CAT_ID` (`CAT_ID`);

--
-- Chỉ mục cho bảng `account_img`
--
ALTER TABLE `account_img`
  ADD PRIMARY KEY (`IMG_ID`),
  ADD KEY `ACC_ID` (`ACC_ID`);

--
-- Chỉ mục cho bảng `authority`
--
ALTER TABLE `authority`
  ADD PRIMARY KEY (`AUTH_ID`);

--
-- Chỉ mục cho bảng `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`BUY_ID`),
  ADD KEY `ACC_ID` (`ACC_ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Chỉ mục cho bảng `categories_acc`
--
ALTER TABLE `categories_acc`
  ADD PRIMARY KEY (`CAT_ID`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FB_ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`PAY_ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`U_ID`),
  ADD KEY `AUTH_ID` (`AUTH_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account_game`
--
ALTER TABLE `account_game`
  MODIFY `ACC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `account_img`
--
ALTER TABLE `account_img`
  MODIFY `IMG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT cho bảng `authority`
--
ALTER TABLE `authority`
  MODIFY `AUTH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `buy`
--
ALTER TABLE `buy`
  MODIFY `BUY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories_acc`
--
ALTER TABLE `categories_acc`
  MODIFY `CAT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FB_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account_game`
--
ALTER TABLE `account_game`
  ADD CONSTRAINT `account_game_ibfk_1` FOREIGN KEY (`CAT_ID`) REFERENCES `categories_acc` (`CAT_ID`);

--
-- Các ràng buộc cho bảng `account_img`
--
ALTER TABLE `account_img`
  ADD CONSTRAINT `account_img_ibfk_1` FOREIGN KEY (`ACC_ID`) REFERENCES `account_game` (`ACC_ID`);

--
-- Các ràng buộc cho bảng `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`ACC_ID`) REFERENCES `account_game` (`ACC_ID`),
  ADD CONSTRAINT `buy_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `users` (`U_ID`);

--
-- Các ràng buộc cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users` (`U_ID`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`AUTH_ID`) REFERENCES `authority` (`AUTH_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
