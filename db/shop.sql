-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 01:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_cart`
--

CREATE TABLE `add_cart` (
  `addCartID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `add_cart`
--

INSERT INTO `add_cart` (`addCartID`, `itemID`, `userID`, `date`) VALUES
(7, 8, 1, '2019-11-02 13:31:14'),
(8, 9, 1, '2019-11-02 13:38:38'),
(9, 5, 2, '2019-11-13 11:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(55) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Category_Name`, `Description`) VALUES
(1, 'Fashion', ''),
(2, 'House & Kitchen', ''),
(4, 'Video Games2020', ''),
(5, 'Mobile Tools', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `User_ID` int(11) NOT NULL,
  `item_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favorite_ID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `fake_price` varchar(55) NOT NULL,
  `Price` varchar(55) NOT NULL,
  `discount` varchar(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pic` varchar(255) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `loves` int(11) NOT NULL,
  `stars` varchar(11) NOT NULL,
  `views` int(11) NOT NULL,
  `mount` int(11) NOT NULL,
  `saled` int(11) NOT NULL,
  `precent` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Item_Name`, `Description`, `fake_price`, `Price`, `discount`, `Date`, `Pic`, `Cat_ID`, `loves`, `stars`, `views`, `mount`, `saled`, `precent`) VALUES
(1, 'jacket jeans', 'jacket jeans for woman 2019 jacket jeans for woman 2019 jacket jeans for woman 2019 jacket jeans for woman 2019 jacket jeans for woman 2019 ', '200', '120', '75', '2019-10-27 19:07:37', '586_product_6.jpg', 1, 645, '234', 97, 56, 0, ''),
(2, 'gray blotha', 'gray blotha for women 2019 gray blotha for women 2019 gray blotha for women 2019 gray blotha for women 2019 gray blotha for women 2019 ', '638', '456', '55', '2019-10-27 19:16:10', '588_product_1.jpg', 1, 234, '876', 87, 45, 0, ''),
(3, 'white jacked', 'White Wool Jacket 2019  For Girls Available All Sizes', '200', '150', '34', '2019-10-27 23:07:50', '460_product_2.jpg', 1, 123, '234', 567, 43, 0, ''),
(4, 'black shirt', 'black shirt 2019 for asian girls', '457', '57', '25', '2019-10-27 23:09:10', '429_product_3.jpg', 2, 324, '432', 567, 5, 0, ''),
(5, 'Yalow ', 'Yellow pajamas for girls available in all sizes', '43', '23', '23', '2019-10-27 23:10:43', '804_product_4.jpg', 2, 324, '23', 234, 324, 0, ''),
(6, 'green blotha', 'green blotha 2019', '23', '34', '34', '2019-10-27 23:11:30', '756_product_5.jpg', 1, 432, '567', 567, 57, 0, ''),
(7, 'blue colthes', 'blue colthes 2019 blue colthes 2019 blue colthes 2019', '23', '35', '6', '2019-10-27 23:18:10', '849_product_9.jpg', 1, 456, '6', 345, 234, 0, ''),
(8, 'green clothes', 'green clothes for girls Available All Sizes', '234', '34', '23', '2019-10-27 23:19:10', '500_product_8.jpg', 1, 42, '57', 67, 56, 0, ''),
(9, 'new blotha 2019', 'new blotha 2019 For Girls Available All Sizes', '435', '325', '34', '2019-10-27 23:20:09', '240_product_7.jpg', 4, 346, '456', 456, 34, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `chat_Link` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `msg_type` varchar(50) NOT NULL,
  `Sender_ID` varchar(55) NOT NULL,
  `Receiver_ID` varchar(55) NOT NULL,
  `seen` varchar(3) NOT NULL DEFAULT '0',
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `chat_Link`, `message`, `msg_type`, `Sender_ID`, `Receiver_ID`, `seen`, `msg_time`) VALUES
(1, 'admin_2', 'Hi', 'text', '2', 'admin', '1', '2019-10-28 12:50:52'),
(2, 'admin_2', '<i class=\"fas fa-thumbs-up\"></i>', 'like', '2', 'admin', '1', '2019-11-12 23:40:43'),
(3, 'admin_2', '<i class=\"fas fa-thumbs-up\"></i>', 'like', '2', 'admin', '1', '2019-11-12 23:49:17'),
(4, 'admin_2', 'Hello', 'text', 'admin', '2', '0', '2019-11-13 00:28:25'),
(5, 'admin_2', 'sdddddddd', 'text', 'admin', '2', '0', '2019-11-13 00:51:24'),
(6, 'admin_2', 'asddddddd', 'text', 'admin', '2', '0', '2019-11-13 12:04:10'),
(7, 'admin_2', 'sdffffffff', 'text', 'admin', '2', '0', '2019-11-13 12:05:48'),
(8, 'admin_2', 'ddddd', 'text', 'admin', '2', '0', '2019-11-13 12:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` varchar(55) NOT NULL,
  `total_price` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(4) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `client_num_1` varchar(55) NOT NULL,
  `client_num_2` varchar(55) NOT NULL,
  `receiver_name` varchar(55) NOT NULL,
  `received_money` int(4) NOT NULL DEFAULT '0',
  `arrival_products` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `item_id`, `cat_id`, `price`, `total_price`, `date`, `quantity`, `city`, `address`, `client_num_1`, `client_num_2`, `receiver_name`, `received_money`, `arrival_products`) VALUES
(1, 1, 7, 1, '35', '140', '2019-10-27 23:37:02', 4, 'Alexandria', 'El warsh street 29th', '01210811347', '01210811347', 'Mahmoud Mohamed', 0, 0),
(2, 1, 1, 1, '120', '240', '2019-10-27 23:37:02', 2, 'Alexandria', 'El warsh street 29th', '01210811347', '01210811347', 'Mahmoud Mohamed', 0, 0),
(3, 1, 2, 1, '456', '912', '2019-10-27 23:37:02', 2, 'Alexandria', 'El warsh street 29th', '01210811347', '01210811347', 'Mahmoud Mohamed', 0, 0),
(4, 1, 5, 2, '23', '92', '2019-10-27 23:37:02', 4, 'Alexandria', 'El warsh street 29th', '01210811347', '01210811347', 'Mahmoud Mohamed', 0, 0),
(5, 1, 6, 1, '34', '136', '2019-10-27 23:37:02', 4, 'Alexandria', 'El warsh street 29th', '01210811347', '01210811347', 'Mahmoud Mohamed', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `gender` varchar(55) NOT NULL,
  `GroupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstName`, `lastName`, `Username`, `Email`, `Pass`, `gender`, `GroupID`) VALUES
(1, 'Ahmed', 'Ali', 'Ahmed Ali', 'ahmed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0', 2),
(2, 'Soha', 'Ahmed', 'Soha Ahmed', 'soha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_cart`
--
ALTER TABLE `add_cart`
  ADD PRIMARY KEY (`addCartID`),
  ADD KEY `itemID` (`itemID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `item_ID` (`item_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favorite_ID`),
  ADD KEY `itemID` (`itemID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `items_ibfk_1` (`Cat_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `Receiver_ID` (`Receiver_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `orders_ibfk_1` (`user_ID`),
  ADD KEY `orders_ibfk_2` (`item_id`),
  ADD KEY `orders_ibfk_3` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_cart`
--
ALTER TABLE `add_cart`
  MODIFY `addCartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favorite_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_cart`
--
ALTER TABLE `add_cart`
  ADD CONSTRAINT `add_cart_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `add_cart_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`item_ID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`Category_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`Category_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
