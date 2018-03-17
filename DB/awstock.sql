-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 11:57 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

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
(2, 'Men->Pant', 'gasjdgkasygduashdkuasdkua'),
(3, 'hj', 'hjh'),
(4, 'tyty', 'tytytyt');

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
(4, 'Silver', NULL, 'standard'),
(5, 'White', NULL, 'standard');

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
-- Table structure for table `historicuploadedfiles`
--

CREATE TABLE `historicuploadedfiles` (
  `historicUploadedFilesId` int(11) NOT NULL,
  `historicUploadedFilesName` varchar(255) DEFAULT NULL,
  `historicUploadedFilesType` varchar(50) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) DEFAULT NULL,
  `exportedBy` int(11) DEFAULT NULL,
  `exportedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historicuploadedfiles`
--

INSERT INTO `historicuploadedfiles` (`historicUploadedFilesId`, `historicUploadedFilesName`, `historicUploadedFilesType`, `createDate`, `createdBy`, `exportedBy`, `exportedDate`) VALUES
(4, 'ProductList-1520574856.csv', 'ProductList', NULL, 2, NULL, NULL),
(5, 'ProductList-1520575229.csv', 'ProductList', '2018-03-09 06:00:29', 2, NULL, NULL),
(6, 'ProductList-1520575264.csv', 'ProductList', '2018-03-09 06:01:04', 2, NULL, NULL),
(7, 'ProductList-1520575276.csv', 'ProductList', '2018-03-09 06:01:16', 2, NULL, NULL),
(8, 'ProductList-1520577854.csv', 'ProductList', '2018-03-09 06:44:14', 2, NULL, NULL),
(9, 'ProductList-1520577872.csv', 'ProductList', '2018-03-09 06:44:32', 2, NULL, NULL),
(10, 'FullOfferList-1520582908.csv', 'OfferList', '2018-03-09 08:08:28', 2, NULL, NULL),
(11, 'FullOfferList-1520585072.csv', 'OfferList', '2018-03-09 08:44:32', 2, NULL, NULL),
(12, 'ProductList-1520589001.csv', 'ProductList', '2018-03-09 09:50:01', 2, NULL, NULL);

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
(1, 2, '10.50', '2018-03-01', '2018-03-23', '11', 'dfd5454', 'Downloaded', 2, '2018-03-09 08:44:32'),
(3, 2, '2.00', 'sdsd', 'dssds', '11', 'sdsd', 'Downloaded', 2, '2018-03-09 08:08:28'),
(4, 2, '65.55', 'dssd', 'sdsd', '11', 'sdsd', 'Downloaded', 2, '2018-03-09 08:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `fkcategoryId` int(11) NOT NULL,
  `style` varchar(45) DEFAULT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `ean` varchar(45) DEFAULT NULL,
  `productName` varchar(45) DEFAULT NULL,
  `productDesc` mediumtext,
  `brand` varchar(25) DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `colorDesc` mediumtext,
  `size` varchar(45) DEFAULT NULL,
  `sizeDescription` varchar(45) DEFAULT NULL,
  `swatchImage` mediumtext,
  `mainImage` mediumtext,
  `outfit` mediumtext,
  `image2` mediumtext,
  `image3` mediumtext,
  `image4` mediumtext,
  `runtosize` varchar(45) DEFAULT NULL,
  `care` varchar(45) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `costPrice` decimal(11,2) DEFAULT NULL,
  `wholePrice` decimal(11,2) DEFAULT NULL,
  `stockQty` int(11) DEFAULT NULL,
  `minQtyAlert` int(11) DEFAULT NULL,
  `LastExportedBy` int(11) DEFAULT NULL,
  `LastExportedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `status`, `fkcategoryId`, `style`, `sku`, `ean`, `productName`, `productDesc`, `brand`, `color`, `colorDesc`, `size`, `sizeDescription`, `swatchImage`, `mainImage`, `outfit`, `image2`, `image3`, `image4`, `runtosize`, `care`, `price`, `costPrice`, `wholePrice`, `stockQty`, `minQtyAlert`, `LastExportedBy`, `LastExportedDate`) VALUES
(2, 'Downloaded', 1, 'asdasd', 'dasdaewe', 'weqw', 'Test Product 1', 'asdaszxcd\r\najsdiuahs', 'asdasd', '5', 'ddfsfgdyrtyryfghfgh', 'L', NULL, '2swatch.jpg', NULL, '2outfit.jpg', NULL, NULL, NULL, 'This style runs small to size', 'Dry Clean Only', '40.00', NULL, NULL, 5, 2, 2, '2018-03-09 03:50:01'),
(4, 'Downloaded', 2, 'adasda', 'dfdf', 'sdsa', 'pant denim', 'asdasdas', 'levis', 'White', 'new', 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dry Clean Only', '565.00', NULL, NULL, 6565, 6565, 2, '2018-03-09 00:00:29'),
(5, 'Active', 1, 'asdasd', 'dsadasd', 'dfdf', '454sadsds', 'dfdfdf', 'asdasd', '5', 'dsadasd', 'XL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'This style runs small to size', 'Dry Clean Only', '54354.00', NULL, NULL, 5454, 652, 2, '2018-03-03 07:43:14'),
(6, 'Inactive', 1, 'Test', 'Test', 'Test 6', 'Test', 'Test 6', 'Test', '6', 'Test 6', 'XL', NULL, '7swatch.png', '7main.jpg', '7outfit.png', '7image2.jpg', '7image3.jpg', '7image4.jpg', 'This style runs true to size', 'Dry Clean Only', '654.00', NULL, NULL, 468, 946, 2, '2018-03-03 08:52:13'),
(7, 'Active', 1, 'sadad', '76', 'dasda', 'sdsd', 'AASASA', 'sdsd', 'Pink', 'test color', 'Mensw', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'This style runs true to size', 'Hand Wash or Dry Clean Only', '44.00', NULL, NULL, 98, 9, 2, '2018-03-07 05:23:18'),
(8, 'Downloaded', 2, '74584', '541', '5146', '1321321', '56414187', '1252', 'Purple', '13516', 'S', NULL, '8swatch.png', '8main.jpg', '8outfit.jpg', '8image2.jpg', '8image3.jpg', '8image4.jpg', 'This style runs small to size', 'Hand Wash or Dry Clean Only', '12.00', NULL, NULL, 54, 51, 2, '2018-03-09 00:01:16'),
(9, 'Downloaded', 2, 'test', 'test2', 'test brand by', 'test brand by farzad', 'test brand by farzad', 'test brand by farzad', '5', 'test brand by farzad', 'Mensw', NULL, '9swatch.jpg', '9main.jpg', '9outfit.jpg', '9image2.jpg', '9image3.jpg', '9image4.jpg', 'This style runs small to size', 'Dry Clean Only', '654.00', NULL, NULL, 65, 4, 2, '2018-03-09 00:01:16'),
(10, 'Downloaded', 1, 'asdad', 'adasd', '544', 'asdasd', 'dfd', 'asa', 'Silver', 'asdasd', 'Mensw', NULL, '10swatch.jpg', '10main.jpg', '10outfit.jpg', '10image2.jpg', '10image3.jpg', '10image4.jpg', 'This style runs small to size', 'Dry Clean Only', '895.00', NULL, NULL, 9, 4, 2, '2018-03-09 00:44:32'),
(11, 'New', 2, 'updateproduct', 'updateproduct', NULL, 'update product', 'update product', 'update product', '5', 'update product', NULL, 'test', NULL, 'http://localhost/awstocks/public/productImage/11main.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '21.65', NULL, NULL, 20, 10, NULL, '2018-03-17 07:28:47');

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
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `seasonId` int(11) NOT NULL,
  `seasonName` varchar(45) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `season`
--

INSERT INTO `season` (`seasonId`, `seasonName`, `startDate`, `endDate`, `status`, `created_at`) VALUES
(1, 'Summer', '2018-03-17', '2018-03-31', 1, '2018-03-17 10:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeId` int(11) NOT NULL,
  `sizeName` varchar(45) DEFAULT NULL,
  `sizeDescription` varchar(45) DEFAULT NULL,
  `sizeType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeId`, `sizeName`, `sizeDescription`, `sizeType`) VALUES
(1, 'S', NULL, 'Womenswear clothing / lingerie'),
(3, 'L', NULL, 'Womenswear shoes'),
(4, 'XL', NULL, 'Womenswear shoes'),
(5, 'Menswear belts', 'sdsds', 'Menswear belts'),
(6, 'Menswear belts', 'Menswear beltsMenswear belts', 'Menswear belts'),
(7, 'test 2', 'adasd', 'Menswear belts'),
(8, 'dssd', 'dsdsds', 'Womenswear gloves'),
(9, 'test 2', 'dfdf', 'Womenswear shoes'),
(10, 'test2', 'test2', 'Womenswear clothing / lingerie');

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
(2, 'rumi', NULL, NULL, 'admin@gmail.com', '$2y$10$6uyV1sPMpuqEQR4iFbdFp.HsIxfquF67nk3zdJlYma8U1Mw6ZZ9E6', NULL, NULL, 'ArDBXlif0JZWyrHM2vBnr024bOrIiMWrDslFP6JH9dvlh6dQuzB87RbMiMe3');

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
-- Indexes for table `historicuploadedfiles`
--
ALTER TABLE `historicuploadedfiles`
  ADD PRIMARY KEY (`historicUploadedFilesId`);

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
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`seasonId`);

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
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `colorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filetransfer`
--
ALTER TABLE `filetransfer`
  MODIFY `transferId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historicuploadedfiles`
--
ALTER TABLE `historicuploadedfiles`
  MODIFY `historicUploadedFilesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `runtosize`
--
ALTER TABLE `runtosize`
  MODIFY `runToSizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `seasonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `sizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
