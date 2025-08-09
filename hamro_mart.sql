-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hamro_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ct_id` int(11) NOT NULL,
  `ct_amount` int(11) NOT NULL,
  `ct_note` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ct_id`, `ct_amount`, `ct_note`, `s_id`, `f_id`, `c_id`) VALUES
(1, 1, '', 0, 0, 0),
(18, 1, '', 0, 0, 0),
(29, 3, '', 0, 0, 0),
(84, 1, '', 3, 10, 1),
(90, 2, '', 2, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_username` varchar(45) NOT NULL,
  `c_pwd` varchar(45) NOT NULL,
  `c_firstname` varchar(45) NOT NULL,
  `c_lastname` varchar(45) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_gender` varchar(1) NOT NULL COMMENT 'M for Male, F for Female',
  `c_type` varchar(3) NOT NULL COMMENT 'Type of customer in this Shop (CUS for Customer, ADM for admin)',
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_username`, `c_pwd`, `c_firstname`, `c_lastname`, `c_email`, `c_gender`, `c_type`, `c_id`) VALUES
('admin', 'admin', 'admin', '', 'admin01@gmail.com', 'M', 'ADM', 4),
('Sacar', 'sacar@1234', 'Sacar', 'Chaulagain', 'SacarChaulagain@gmail.com', 'M', 'CUS', 10);

-- --------------------------------------------------------

--
-- Table structure for table `category (here category =f_id)`
--

CREATE TABLE `category` (
  `f_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `f_desc` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, 
  `f_price` decimal(12,2) NOT NULL,
  `f_qty` int(3) NOT NULL,
  `f_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`:
--

INSERT INTO `category` (`f_id`, `s_id`, `f_name`, `f_price`, `f_pic`, `f_desc`, `f_qty`) VALUES
(7, 2, 'Gigaware Bajeal Hjk901', 500.00, 'Products/Keyboard2.jpg', 'Gigaware Bajeal Hjk901 Mechanical Keyboard Blue Switch Hot Swappable Gaming Keyboard',100 ),
(8, 2, 'Redragon Ratri', 510.00, 'Products/Keyboard3.jpg', 'Redragon Ratri K595 Rgb Mechanical Gaming Keyboard',150 ),
(9, 2, 'MILANG K6', 560.00, 'Products/Keyboard4.jpg', 'MILANG K6 Professional Polychromatic RGB Rainbow Backlit Gaming Waterproof Mech Feel Keyboard',100),
(10, 2, 'Bajeal K35', 580.00, 'Products/Keyboard5.jpg', 'Bajeal K35 Professional Polychromatic RGB Backlit Design Gaming Keyboard',110 ),
(11, 2, 'USB Keyboard', 500.00, 'Products/Keyboard6.jpg', 'Smart Nepali English USB Keyboard',101),
(12, 3, 'Bingji Revolution', 200.00, 'Products/Mouse2.jpg', 'Bingji Revolution MT25 Light Sync Gaming Mouse with Customizable RGB Lighting',105),
(13, 3, 'G101 RGB', 210.00, 'Products/Mouse3.jpg', 'G101 RGB Gaming Mouse',102),
(14, 3, 'Aitnt Biagji Gaming Mouse', 260.00, 'Products/Mouse4.jpg', 'Aitnt Biagji Gaming Mouse With RGB LED',10),
(15, 3, 'Dual Rechargeable Bluetooth Mouse', 280.00, 'Products/Mouse5.jpg', 'Dual Rechargeable Bluetooth and 2.4G Wireless Mouse 2 in 1 Mouse',50),
(16, 3, 'M185 Wireless Mouse', 200.00, 'Products/Mouse6.jpg', 'M185 Wireless Mouse 2.4 GHz with USB Mini Receiver 1000 DPI',108),
(17, 4, 'Hitech LED Monitor', 10000.00, 'Products/Desktop2.jpg', 'Hitech LED Monitor 19" Inch Quality and Design',10),
(18, 4, 'Dell Optiplex', 15000.00, 'Products/Desktop3.jpg', 'Dell Optiplex 3040 I5 6th Generation Computer Set',108),
(19, 4, 'MI Xiaomi', 12000.00, 'Products/Desktop1.jpg', 'MI Xiaomi Monitor',110),
(20, 4, 'Hitech 22', 8000.00, 'Products/Desktop5.jpg', 'Hitech 22" Led Monitor With VGA & HDMI Supported | HiTech 22 Inch FHD Monitor',108),
(21, 4, 'Samsung Monitor', 10000.00, 'Products/Desktop6.jpg', 'Samsung Monitor FHD IPS Panel Monitor 75Hz Display 24 inch - OTE',115),
(22, 5, 'X-AGE ConvE', 1000.00, 'Products/Headset2.jpg', 'X-AGE ConvE Play Wired Gaming Headset - XGWH1 | Equipped With 40mm Dynamic Driver',208),
(23, 5, 'L33T Gaming Headphone', 800.00, 'Products/Headset3.jpg', 'L33T Gaming Headphone with LED Light Extended Adjustable Microphone',80),
(24, 5, 'FANTECH Portal HQ55', 500.00, 'Products/Headset4.jpg', 'FANTECH Portal HQ55 Gaming Headset',8),
(25, 5, 'Fantech HQ53', 1050.00, 'Products/Headset5.jpg', 'Fantech HQ53 Lightweight Gaming Headset | Lightweight Design With Red Accent Lighting',102),
(26, 5, 'DIGICOM PC-19', 1000.00, 'Products/Headset6.jpg', 'DIGICOM PC-19 USB Wired Headset With Mic',155),
(27, 6, 'Biostar Racing', 10000.00, 'Products/MotherBoard2.jpg', 'Biostar Racing B460GTA Motherboard For 10th gen Intel Core Processor',125),
(28, 6, 'motherboard Intel LGA1155', 12000.00, 'Products/MotherBoard3.jpg', 'Enter branded H61 motherboard Intel LGA1155 Core I7 I5 I3 Series CPU',115),
(29, 6, 'Gigabyte B450M', 15000.00, 'Products/MotherBoard4.jpg', 'Gigabyte B450M DS3H Motherboard (AMD Ryzen AM4/Micro ATX/M.2/HMDI/DVI/USB 3.1/DDR4)',125),
(30, 6, 'Esonic H61', 18000.00, 'Products/MotherBoard5.jpg', 'Esonic H61 Motherboard with M.2 NVMe SSD Slot, Intel',180),
(31, 6, 'ESONIC H110', 10000.00, 'Products/MotherBoard6.jpg', 'ESONIC H110 Motherboard with M.2 NVMe Slot , Supports 6th, 7th, 8th & 9th Gen Processor',105),
(32, 7, 'Gaming Lite Desktop', 20000.00, 'Products/Cpu2.jpg', 'Gaming Lite Desktop CPU Ryzen 5 5600G 16GB RAM 500GB SSD(CPU Only)',11),
(33, 7, 'CPU Assembled intel Core i5', 25000.00, 'Products/Cpu3.jpg', 'Desktop Computer CPU Assembled intel Core i5 3rd gen/ 8GB RAM/ 256GB SSD(CPU Only)',150),
(34, 7, 'thermaltake computer', 23000.00, 'Products/Cpu4.jpg', 'thermaltake computer Gaming case with a 120mm fan, the Versa N24',182),
(35, 7, 'MSI MPG Velox', 35000.00, 'Products/Cpu5.jpg', 'MSI MPG Velox 100R Gaming PC Case (ATX MB Support | 4 ARGB FAN | Support 360mm CPU Radiator | USB-C | Vertical GPU)',108),
(36, 7, 'Nzxt H1 Mini-Itx', 28000.00, 'Products/Cpu6.jpg', 'Nzxt H1 Mini-Itx Case With 450W Power Supply & 140Mm Rgb Cpu',82),
(37, 8, 'Brother DCP-1612W', 20000.00, 'Products/Printer2.jpg', 'Brother DCP-1612W Mono Laser Multi-Function All-In -One Small Office / Home Printer',90),
(38, 8, 'Brother DCP-B7640DW', 22000.00, 'Products/Printer3.jpg', 'Brother DCP-B7640DW 3-in-1 Laser Printer - Mono',112),
(39, 8, 'Canon Pixma E410', 21000.00, 'Products/Printer4.jpg', 'Canon Pixma E410 3 In 1 Multi-Function Inkjet Printer',109),
(40, 8, 'HP LaserJet 107a', 18000.00, 'Products/Printer5.jpg', 'HP LaserJet 107a Single Function Affordable Mono Printer - Upto 20 PPM - White',101),
(41, 8, 'Canon Pixma G3730', 25000.00, 'Products/Printer6.jpg', 'Canon Pixma G3730 3 in 1 Wireless Multi-Function Ink Tank Colour Printer',102),
(42, 8, 'Kisonli U-2500 Bluetooth', 5000.00, 'Products/Speaker1.jpg', 'Kisonli U-2500 Bluetooth Usb 2.1 Portable Speaker With Fm Black',103),
(43, 8, 'Speaker Desktop', 5000.00, 'Products/Speaker2.jpg', 'USB Computer Laptop Speaker Desktop Notebook l Speaker Portable Speaker 2.0',104),
(44, 8, 'FANTECH GS202', 5000.00, 'Products/Speaker3.jpg', 'FANTECH GS202 SONAR Mini RGB Lighting Speaker',105),
(45, 8, 'Redragon GS510', 5000.00, 'Products/Speaker4.jpg', 'Redragon GS510 Waltz Gaming Speaker 2.0 Channel PC Computer Stereo Speaker with 4 Colorful LED Backlight Modes',106),
(46, 8, '2 Pcs USB Computer Speakers', 5000.00, 'Products/Speaker5.jpg', '2 Pcs USB Computer Speakers Portable Speaker Stereo 3.5mm with Ear Jack for Desktop PC Laptop',107),
(47, 8, 'CPU Cooler ARGB', 1000.00, 'Products/CpuColler1.jpg', 'CPU Cooler ARGB 120mm 4 Pin Radiator PWM Temperature Control',109),
(48, 8, 'TFA0412CN Cooling Fan', 1500.00, 'Products/CpuColler2.jpg', 'TFA0412CN Cooling Fan for 4028 DC12V 0.81A 8200RPM 4-Wire PWM Temperature Control 4CM Switch Fan',110),
(49, 8, 'Industrial Cooling Fan', 2000.00, 'Products/CpuColler3.jpg', 'AFC1212DE 12038 DC12V 1.6A 4000RPM Industrial Cooling Fan 151.85CFM PWM Temperature Controlled Fan Precision390',20),
(50, 8, 'CPU Cooler ARGB 120mm', 2500.00, 'Products/CpuColler4.jpg', 'CPU Cooler ARGB 120mm 4 Pin Radiator Quiet PWM PC Cooling System Temperature Control 5V Computer Case Cooling Fan',29),
(51, 8, 'Cpu Cooler Fan', 1200.00, 'Products/CpuColler5.jpg', 'Motherboard Controlled Fan Rgb Pwm Cpu Cooler Fan for Lga 2011/1200/1150 with Temperature Control Quiet Efficient Pc Radiator Cooler',108),
(52, 8, 'Aluminum Alloy Laptop Stand', 900.00, 'Products/Laptop_stand1.jpg', 'Aluminum Alloy Metal Adjustable Laptop Stand for 9 to 17 Inches',90),
(53, 8, 'Aluminum Alloy Laptop Stand', 850.00, 'Products/Laptop_stand2.jpg', 'Aluminum Alloy Metal Adjustable Laptop Stand for 10 to 17 Inches Macbook/Laptops/Tab',5),
(54, 8, 'Aluminum Portable Laptop Stand', 599.00, 'Products/Laptop_stand3.jpg', 'Aluminum Portable Invisible Laptop Stand | Mini Aluminum Cooling Pad, Lightweight Laptop Desk Stand for MacBook, Lenovo, Dell, HP & Other Laptops (Cool Silver)',108);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_id` int(11) NOT NULL,
  `orh_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `ord_amount` int(11) NOT NULL,
  `ord_buyprice` decimal(12,2) NOT NULL,
  `ord_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`ord_id`, `orh_id`, `f_id`, `ord_amount`, `ord_buyprice`, `ord_note`) VALUES
(102, 72, 22, 1, 1000.00, ''),
(125, 88, 7, 3, 500.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `orh_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `orh_ordertime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orh_orderstatus` varchar(45) NOT NULL,
  `orh_finishedtime` datetime DEFAULT NULL,
  `t_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`orh_id`, `c_id`, `s_id`, `p_id`, `orh_ordertime`, `orh_orderstatus`, `orh_finishedtime`, `t_id`) VALUES
(72, 2, 3, 45, '2024-06-23 13:54:40', 'CNCL', '0000-00-00 00:00:00', ''),
(88, 8, 2, 64, '2024-06-28 05:42:16', 'PREP', '0000-00-00 00:00:00', '123566789123');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`p_id`, `c_id`, `p_amount`) VALUES
(45, 2, 1000.00),
(64, 8, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `s_username` varchar(45) NOT NULL,
  `s_pwd` varchar(45) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_location` varchar(100) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_phoneno` varchar(45) NOT NULL,
  `s_desc` varchar(200) NOT NULL,
  `s_pic` text DEFAULT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`s_username`, `s_pwd`, `s_name`, `s_location`, `s_email`, `s_phoneno`, `s_desc`, `s_pic`, `s_id`) VALUES
('shop1', 'Shop1@123', 'Keybords', 'Point-1', 'shop01@email.com', '7569395349', 'Varities of keyboards are available here.', 'Products/Keyboard1.jpg', 2),
('shop2', '12344321', 'Mouse', 'Point-2', 'shop02@email.com', '7569395349', 'Varities of Mouse are available here.', 'Products/Mouse1.jpg', 3),
('shop3', '12121212', 'Desktop', 'Point-3', 'shop3@gmail.com', '7569395349', 'Varities of Desktops are available here.', 'Products/Desktop4.jpg', 4),
('shop4', '13131313', 'Headset', 'Point-4', 'shop4@gmail.com', '7569395349', 'Enjoy the beats.', 'Products/Headset1.jpg', 5),
('shop5', '13131313', 'MotherBoard', 'Point-5', 'shop5@gmail.com', '7569395349','Varities of Motherboard is available here.', 'Products/MotherBoard1.jpg', 6),
('shop6', '13131313', 'Cpu', 'Point-6', 'shop6@gmail.com', '7569395349', 'Varities of CPU is available here.','Products/Cpu1.jpg', 7),
('shop7', '56565656', 'Others', 'Point-7', 'shop7@gmail.com', '7569395349', 'Varities of products like printer, Speaker etc is available here.', 'Products/Printer1.jpg', 8);

--
-- Indexes for dumped tables
--



--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_username` (`c_username`),
  ADD UNIQUE KEY `c_email` (`c_email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `orh_id` (`orh_id`) USING BTREE,
  ADD KEY `f_id` (`f_id`) USING BTREE;

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`orh_id`),
  ADD KEY `c_id` (`c_id`) USING BTREE,
  ADD KEY `s_id` (`s_id`) USING BTREE,
  ADD KEY `p_id` (`p_id`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `orh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
