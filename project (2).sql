-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 09:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `adminPassword` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminPassword`, `status`, `createdDate`) VALUES
(3, 'virenbhanushali12', '@Viren123', 0, '2021-02-28 10:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(255) DEFAULT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(10, 'color', 'product', 'color', 'select', 'varchar(255)', 1, 'practice'),
(11, 'size', 'product', 'size', 'select', 'text', 3, 'practice');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(6, 'Yellow', 10, 3),
(7, 'Green', 10, 2),
(8, 'Blue', 10, 1),
(9, '17', 11, 7),
(10, '15', 11, 2),
(11, '12', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `pathId` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(3, 'About ', 'About Us', '<nav class=\"navbar navbar-expand-lg navbar-light bg-light\"><a class=\"navbar-brand\" href=\"#\">Navbar</a> <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"> </button>\r\n<div id=\"navbarSupportedContent\" class=\"collapse navbar-collapse\">\r\n<ul class=\"navbar-nav mr-auto\">\r\n<li class=\"nav-item active\"><a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a></li>\r\n<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Link</a></li>\r\n<li class=\"nav-item dropdown\"><a id=\"navbarDropdown\" class=\"nav-link dropdown-toggle\" role=\"button\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> Dropdown </a>\r\n<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\"><a class=\"dropdown-item\" href=\"#\">Action</a> <a class=\"dropdown-item\" href=\"#\">Another action</a>\r\n<div class=\"dropdown-divider\">&nbsp;</div>\r\n<a class=\"dropdown-item\" href=\"#\">Something else here</a></div>\r\n</li>\r\n<li class=\"nav-item\"><a class=\"nav-link disabled\" href=\"#\">Disabled</a></li>\r\n</ul>\r\n<form class=\"form-inline my-2 my-lg-0\"><input class=\"form-control mr-sm-2\" type=\"search\" placeholder=\"Search\" aria-label=\"Search\" /></form></div>\r\n</nav>', 0, '2021-03-09 06:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `group_id`, `firstName`, `lastName`, `email`, `password`, `contactNo`, `status`, `createdDate`, `updatedDate`) VALUES
(16, 1, 'pradeep', 'yadav', 'pk@gmail.com', '@123', '8757978757', 1, '2021-03-03 18:54:43', NULL),
(18, 4, 'mahesh', 'ok', 'm@gmail.com', '745yud', '89757987797', 0, '2021-03-04 10:10:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customerId` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `addressType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customerId`, `address`, `city`, `state`, `zipcode`, `country`, `addressType`) VALUES
(25, 16, 'jamnadas', 'Surat', 'Punjab', 856977, 'Australia', 'Billing'),
(26, 16, 'shreedeep hostel', 'Delhi', 'Maharashtra', 9000000, 'Australia', 'Shipping'),
(27, 18, 'mahavir char rasta', 'Vapi', 'Gujarat', 396191, 'India', 'Billing'),
(28, 18, 'Zanda Chowk', 'Delhi', 'Maharashtra', 396191, 'India', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `group_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`group_id`, `name`, `status`, `createdDate`) VALUES
(1, 'wholesale', 1, '2021-03-10 09:18:47'),
(4, 'Retail', 1, '2021-03-04 10:10:00'),
(5, 'okay group', 0, '2021-03-10 11:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(5, 'dilip', '7645gfg', 90000, 'amazing product service', 0, '2021-02-18 04:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `SKU` varchar(20) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `productPrice` double NOT NULL,
  `productDiscount` double NOT NULL,
  `productQty` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `SKU`, `productName`, `productPrice`, `productDiscount`, `productQty`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `size`) VALUES
(18, 'y385hhs', 'Window Cover', 120, 20, 3, 'nice one full size', 0, '2021-02-13 13:34:31', '2021-03-17 10:52:48', 'Blue', ''),
(19, '8dg7fgh', 'Car Done', 165000, 15600, 1, 'aapki product service sahi nahi thi so mene 10 Rs Less Karke diya hai', 0, '2021-02-13 13:35:08', '2021-03-18 12:09:30', 'Green', '12'),
(20, '9dghshs', 'Keyboard', 1200, 120, 2, 'bluetooth ', 1, '2021-02-13 13:35:51', NULL, '', ''),
(21, '647hhsv', 'Mouse', 1200, 200, 3, 'bluetooth mouse with COD', 0, '2021-02-13 14:30:18', NULL, '', ''),
(24, '873457', 'laptop', 45000, 450, 2, 'HP 10th gen', 0, '2021-02-18 05:08:05', '2021-02-22 08:49:51', '', ''),
(68, '6857yfg', 'example product', 1200, 12, 3, 'chalo ye bhi thik hai', 1, '2021-02-23 09:13:45', NULL, '', ''),
(87, 'ok', 'done', 12000, 1200, 2, 'amazing product', 0, '2021-03-01 10:11:59', NULL, '', ''),
(88, '4738937yhe', 'pk', 123738927, 2357, 2, 'ok', 0, '2021-03-05 00:09:21', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `productgallery`
--

CREATE TABLE `productgallery` (
  `productId` int(11) NOT NULL,
  `productGalleryId` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `imagelabel` varchar(100) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productgallery`
--

INSERT INTO `productgallery` (`productId`, `productGalleryId`, `imageName`, `imagelabel`, `small`, `thumb`, `base`, `gallery`) VALUES
(18, 45, 'pexels-anni-roenkae-2156881.jpg', 'roz', 1, 1, 1, 1),
(19, 46, 'pexels-aleksandar-pasaric-3310691.jpg', 'chalo thik haii', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `groupPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `groupId`, `productId`, `groupPrice`) VALUES
(1, 1, 18, '200.00'),
(3, 4, 18, '100.00'),
(4, 5, 18, '19000.00'),
(5, 1, 19, '16000.00'),
(6, 4, 19, '0.00'),
(7, 5, 19, '0.00'),
(8, 1, 88, '120000.00'),
(9, 4, 88, '25000.00'),
(10, 5, 88, '0.00'),
(11, 1, 24, '16000.00'),
(12, 4, 24, '0.00'),
(13, 5, 24, '0.00'),
(14, 1, 20, '1000.00'),
(15, 4, 20, '800.00'),
(16, 5, 20, '200.00'),
(17, 1, 87, '1200.00'),
(18, 4, 87, '1000.00'),
(19, 5, 87, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(4, 'viral', '7854ggg', 9000, 'amazing product i got ', 0, '2021-02-18 05:22:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productgallery`
--
ALTER TABLE `productgallery`
  ADD PRIMARY KEY (`productGalleryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `productgallery`
--
ALTER TABLE `productgallery`
  MODIFY `productGalleryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `customer_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productgallery`
--
ALTER TABLE `productgallery`
  ADD CONSTRAINT `productgallery_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_group_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
