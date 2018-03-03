-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2018 at 01:16 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`) VALUES
(1, 'Womenswear>Gowns');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `colorId` int(11) NOT NULL,
  `colorName` varchar(45) DEFAULT NULL,
  `colorType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`colorId`, `colorName`, `colorType`) VALUES
(1, 'nil', 'sta');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `fileType` varchar(15) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `createBy` int(11) DEFAULT NULL,
  `fkproductId` int(11) NOT NULL,
  `fkofferId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `offerId` int(11) NOT NULL,
  `disPrice` varchar(45) DEFAULT NULL,
  `disStartPrice` varchar(45) DEFAULT NULL,
  `disEndPrice` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `product-id-type` varchar(11) NOT NULL,
  `state` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `fkproductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`offerId`, `disPrice`, `disStartPrice`, `disEndPrice`, `status`, `product-id-type`, `state`, `price`, `quantity`, `fkproductId`) VALUES
(1, '300', '2018-02-18', '2018-02-22', 'active', 'sku-123', 'test', 400, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `productDecription` mediumtext,
  `style` varchar(45) DEFAULT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `size` varchar(5) DEFAULT NULL,
  `swatch` mediumtext,
  `mainImage` mediumtext,
  `outfit` mediumtext,
  `image2` mediumtext,
  `LastExportedBy` int(11) DEFAULT NULL,
  `LastExportedDate` varchar(45) DEFAULT NULL,
  `fkcategoryId` int(11) NOT NULL,
  `fkscolorId` int(11) NOT NULL,
  `fkdcolorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `status`, `productDecription`, `style`, `sku`, `brand`, `size`, `swatch`, `mainImage`, `outfit`, `image2`, `LastExportedBy`, `LastExportedDate`, `fkcategoryId`, `fkscolorId`, `fkdcolorId`) VALUES
(2, 'Bordeaux low-back satin gown', 'active', '<ul><li>Rosetta Getty Bordeaux wool blend satin gown</li><li>Draped low back with tied sash, partially lined</li><li><ul><li>Concealed zip fastening at back</li><li>43% wool, 34% acetate, 23% viscose; lining: 100% silk</li><li>Length shoulder to hem: 61 inches/ 154cm</li><li>Midweight</li><li>Slim fit</li></ul>', 'ABCD-123', 'ABCD-123-RDS', 'Rosetta Getty', 'S', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_5.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_1.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_2.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_4.jpg\r\n', 1, '2018-02-01', 1, 1, 1),
(3, 'Bordeaux low-back satin gown', 'Inactive', '<ul><li>Rosetta Getty Bordeaux wool blend satin gown</li><li>Draped low back with tied sash, partially lined</li><li><ul><li>Concealed zip fastening at back</li><li>43% wool, 34% acetate, 23% viscose; lining: 100% silk</li><li>Length shoulder to hem: 61 inches/ 154cm</li><li>Midweight</li><li>Slim fit</li></ul>', 'ABCD-123', 'ABCD-123-RDS', 'Rosetta Getty', 'L', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_5.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_1.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_2.jpg\r\n', 'http://media.harveynichols.com/catalog/product/cache/1/gallery/390x546/9df78eab33525d08d6e5fb8d27136e95/6/4/647566_bordeaux_4.jpg\r\n', 1, '2018-02-01', 1, 1, 1);

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
  `fkuserTypeId` varchar(5) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `phone`, `address`, `email`, `password`, `status`, `fkuserTypeId`, `remember_token`) VALUES
(1, 'admin', NULL, NULL, 'admin@tcl.com', '$2y$10$iZulWAQ1e/CVhqnnajUZS.GeoNAk2cb6UioJ0f9d1mTchtItfcYaW', 'active', 'admin', 'mCaBfmA3MkiSA0MLjXdM5gnOMWctwOu75h2mfEZSOhpAODVyvbREbPN1zQEq');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeId` varchar(5) NOT NULL,
  `userTypeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeId`, `userTypeName`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyId`),
  ADD KEY `fk_history_product1_idx` (`fkproductId`),
  ADD KEY `fk_history_offer1_idx` (`fkofferId`);

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
  ADD KEY `fk_product_category1_idx` (`fkcategoryId`),
  ADD KEY `fk_product_color1_idx` (`fkscolorId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_user_table1_idx` (`fkuserTypeId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `colorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `offerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_offer1` FOREIGN KEY (`fkofferId`) REFERENCES `offer` (`offerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_history_product1` FOREIGN KEY (`fkproductId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `fk_offer_product1` FOREIGN KEY (`fkproductId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`fkcategoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_color1` FOREIGN KEY (`fkscolorId`) REFERENCES `color` (`colorId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_table1` FOREIGN KEY (`fkuserTypeId`) REFERENCES `usertype` (`userTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
