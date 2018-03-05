-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2018 at 10:07 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `care`
--

CREATE TABLE `care` (
  `careId` int(11) NOT NULL,
  `careName` varchar(45) DEFAULT NULL,
  `careDescription` varchar(45) DEFAULT NULL,
  `careType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `care`
--

INSERT INTO `care` (`careId`, `careName`, `careDescription`, `careType`) VALUES
(1, 'Dry Clean Only', NULL, NULL),
(2, 'Hand Wash or Dry Clean Only', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(45) DEFAULT NULL,
  `categoryDesc` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryDesc`) VALUES
(1, 'Women->Gown', 'asdgausdga'),
(2, 'Men->Pant', 'gasjdgkasygduashdkuasdkua');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `colorId` int(11) NOT NULL,
  `colorName` varchar(45) DEFAULT NULL,
  `colorDescription` varchar(45) DEFAULT NULL,
  `colorType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`colorId`, `colorName`, `colorDescription`, `colorType`) VALUES
(1, 'Pink', NULL, 'standard'),
(2, 'Purple', NULL, 'standard'),
(3, 'Red', NULL, 'standard'),
(4, 'Silver', NULL, 'standard'),
(5, 'White', NULL, 'standard'),
(6, 'Yellow', NULL, 'standard');

-- --------------------------------------------------------

--
-- Table structure for table `filetransfer`
--

CREATE TABLE `filetransfer` (
  `transferId` int(11) NOT NULL,
  `fileName` varchar(45) DEFAULT NULL,
  `fileType` varchar(15) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `createBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offerId` int(11) NOT NULL,
  `fkproductId` int(11) NOT NULL,
  `disPrice` decimal(10,2) DEFAULT NULL,
  `disStartPrice` varchar(45) DEFAULT NULL,
  `disEndPrice` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `product-id-type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `lastExportedBy` int(11) NOT NULL,
  `lastExportedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offerId`, `fkproductId`, `disPrice`, `disStartPrice`, `disEndPrice`, `state`, `product-id-type`, `status`, `lastExportedBy`, `lastExportedDate`) VALUES
(1, 2, '10.50', '2018-03-01', '2018-03-23', '11', 'dfd5454', 'Active', 2, NULL),
(3, 2, '2.00', 'sdsd', 'dssds', '11', 'sdsd', 'Downloaded', 2, '2018-03-05 07:54:52'),
(4, 2, '65.55', 'dssd', 'sdsd', '11', 'sdsd', 'Downloaded', 2, '2018-03-05 07:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `fkcategoryId` int(11) NOT NULL,
  `style` varchar(20) DEFAULT NULL,
  `sku` varchar(25) DEFAULT NULL,
  `ean` varchar(20) DEFAULT NULL,
  `productName` varchar(75) DEFAULT NULL,
  `productDesc` mediumtext,
  `brand` varchar(45) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `colorDesc` mediumtext,
  `size` varchar(5) DEFAULT NULL,
  `swatchImage` mediumtext,
  `mainImage` mediumtext,
  `outfit` mediumtext,
  `image2` mediumtext,
  `image3` mediumtext,
  `image4` mediumtext,
  `runtosize` varchar(45) DEFAULT NULL,
  `care` varchar(45) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stockQty` int(11) DEFAULT NULL,
  `minQtyAlert` int(11) DEFAULT NULL,
  `LastExportedBy` int(11) DEFAULT NULL,
  `LastExportedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `status`, `fkcategoryId`, `style`, `sku`, `ean`, `productName`, `productDesc`, `brand`, `color`, `colorDesc`, `size`, `swatchImage`, `mainImage`, `outfit`, `image2`, `image3`, `image4`, `runtosize`, `care`, `price`, `stockQty`, `minQtyAlert`, `LastExportedBy`, `LastExportedDate`) VALUES
(2, 'Active', 1, 'asdasd', 'dasdaewe', 'weqw', 'Test Product 1', 'asdaszxcd\r\najsdiuahs', 'asdasd', '6', 'ddfsfgdyrtyryfghfgh', 'L', '', NULL, '2outfit.jpg', NULL, NULL, NULL, 'This style runs small to size', 'Dry Clean Only', 40, 5, 2, 1, NULL),
(4, 'Active', 2, 'adasda', 'dfdf', 'sdsa', 'pant denim', 'asdasdas', 'levis', 'White', 'new', 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dry Clean Only', 565, 6565, 6565, 2, '2018-03-03 07:39:17'),
(5, 'Active', 1, 'fdfdf', 'dsadasd', 'dfdf', '454', 'dfdfdf', 'asdasd', 'Purple', 'dsadasd', 'XL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dry Clean Only', 54354, 5454, 652, 2, '2018-03-03 07:43:14'),
(6, 'Inactive', 1, 'Test', 'Test', 'Test 6', 'Test', 'Test 6', 'Test', '6', 'Test 6', 'XL', '7swatch.png', '7main.jpg', '7outfit.png', '7image2.jpg', '7image3.jpg', '7image4.jpg', 'This style runs true to size', 'Dry Clean Only', 654, 468, 946, 2, '2018-03-03 08:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `runtosize`
--

CREATE TABLE `runtosize` (
  `runToSizeId` int(11) NOT NULL,
  `runToSizeName` varchar(45) DEFAULT NULL,
  `runToSizeDescription` varchar(45) DEFAULT NULL,
  `runToSizeType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `runtosize`
--

INSERT INTO `runtosize` (`runToSizeId`, `runToSizeName`, `runToSizeDescription`, `runToSizeType`) VALUES
(1, 'This style runs small to size', NULL, NULL),
(2, 'This style runs true to size', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeId` int(11) NOT NULL,
  `sizeName` varchar(45) DEFAULT NULL,
  `sizeDescription` varchar(45) DEFAULT NULL,
  `sizeType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeId`, `sizeName`, `sizeDescription`, `sizeType`) VALUES
(1, 'S', NULL, 'Womens cloth'),
(2, 'M', NULL, 'Womens cloth'),
(3, 'L', NULL, 'Womens cloth'),
(4, 'XL', NULL, 'Womens shoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `userType` varchar(5) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `phone`, `address`, `email`, `password`, `status`, `userType`, `remember_token`) VALUES
(2, 'rumi', NULL, NULL, 'admin@gmail.com', '$2y$10$6uyV1sPMpuqEQR4iFbdFp.HsIxfquF67nk3zdJlYma8U1Mw6ZZ9E6', NULL, NULL, 's7A9vpy1nyxwfl7aC4tQqAE0UQ73TvpY3kCFda4PVIFoVHZOqAL8v9TnXia5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `care`
--
ALTER TABLE `care`
  ADD PRIMARY KEY (`careId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`colorId`);

--
-- Indexes for table `filetransfer`
--
ALTER TABLE `filetransfer`
  ADD PRIMARY KEY (`transferId`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`offerId`),
  ADD KEY `fk_offer_product1_idx` (`fkproductId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `fk_product_category1_idx` (`fkcategoryId`);

--
-- Indexes for table `runtosize`
--
ALTER TABLE `runtosize`
  ADD PRIMARY KEY (`runToSizeId`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `care`
--
ALTER TABLE `care`
  MODIFY `careId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `colorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `filetransfer`
--
ALTER TABLE `filetransfer`
  MODIFY `transferId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `runtosize`
--
ALTER TABLE `runtosize`
  MODIFY `runToSizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `sizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `fk_offer_product1` FOREIGN KEY (`fkproductId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`fkcategoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
