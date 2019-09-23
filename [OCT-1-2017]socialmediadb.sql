-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2017 at 11:55 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmediadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(100) NOT NULL,
  `submittedby` varchar(512) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `submittedby`, `comment`, `comment_date`) VALUES
(3, 71, 'akagileonel', 'hahaha', '2017-10-01 06:37:19'),
(4, 70, 'akagileonel', 'test 1', '2017-10-01 06:37:35'),
(5, 71, 'akagileonel', 'qaqo nagana!', '2017-10-01 06:37:58'),
(6, 20, 'akagileonel', 'It shows up!', '2017-10-01 06:38:40'),
(7, 71, 'akagileonel', 'xD', '2017-10-01 06:41:19'),
(8, 71, 'akagileonel', 'iii', '2017-10-01 06:42:10'),
(9, 71, 'akagileonel', 'asas', '2017-10-01 06:42:15'),
(10, 20, 'akagileonel', 'ye xD', '2017-10-01 06:45:15'),
(11, 20, 'akagileonel', 'test id return?', '2017-10-01 06:57:03'),
(12, 31, 'akagileonel', 'umu', '2017-10-01 06:57:12'),
(13, 48, 'akagileonel', 'ye', '2017-10-01 06:57:25'),
(14, 20, 'akagileonel', 'xDDDD', '2017-10-01 07:17:59'),
(15, 55, 'akagileonel', 'paddings xD', '2017-10-01 07:26:22'),
(16, 70, 'ayana', 'test 2', '2017-10-01 07:26:34'),
(17, 0, '', '', '2017-10-01 07:33:03'),
(18, 45, 'akagileonel', 'not anymore \"level 100\" \'noob\'', '2017-10-01 07:51:15'),
(19, 20, 'akagileonel', 'ye', '2017-10-01 07:51:46'),
(20, 23, 'akagileonel', 'why', '2017-10-01 07:52:10'),
(21, 59, 'akagileonel', '727 LUL', '2017-10-01 07:53:20'),
(22, 56, 'akagileonel', 'weeb', '2017-10-01 08:04:52'),
(23, 59, 'akagileonel', 'ye', '2017-10-01 08:08:26'),
(24, 59, 'akagileonel', 'ye', '2017-10-01 08:08:42'),
(25, 59, 'akagileonel', '727 LUL', '2017-10-01 08:09:42'),
(26, 56, 'akagileonel', 'qq', '2017-10-01 08:10:32'),
(27, 41, 'akagileonel', 'ye ok', '2017-10-01 08:12:46'),
(28, 42, 'akagileonel', 'yep', '2017-10-01 08:13:24'),
(29, 48, 'akagileonel', 'ok', '2017-10-01 08:16:03'),
(30, 43, 'akagileonel', 'LMAO', '2017-10-01 08:17:27'),
(31, 59, 'akagileonel', 'ok', '2017-10-01 08:51:59'),
(32, 59, 'akagileonel', 'ok', '2017-10-01 08:52:13'),
(33, 71, 'akagileonel', 'AHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH', '2017-10-01 08:53:36'),
(35, 71, 'ayana', 'because why not', '2017-10-01 09:01:59'),
(36, 71, 'ayana', 'wtf am i doing really', '2017-10-01 09:02:04'),
(37, 71, 'ayana', 'end me xDDD', '2017-10-01 09:02:10'),
(38, 71, 'ayana', 'test', '2017-10-01 09:04:39'),
(39, 71, 'ayana', 'another test', '2017-10-01 09:05:12'),
(40, 71, 'ayana', 'why are you not working', '2017-10-01 09:05:54'),
(41, 71, 'ayana', 'nvm it works now', '2017-10-01 09:06:02'),
(42, 71, 'ayana', 'ahaha', '2017-10-01 09:08:25'),
(43, 71, '1212', 'ahaha', '2017-10-01 09:12:07'),
(44, 71, '1212', 'filling up comments', '2017-10-01 09:12:16'),
(45, 71, '1212', 'doe', '2017-10-01 09:12:20'),
(46, 71, '1212', 'doi', '2017-10-01 09:12:22'),
(47, 71, '1212', 'dqf', '2017-10-01 09:12:32'),
(48, 71, 'HardROck', '23rd comment lol', '2017-10-01 09:13:07'),
(49, 71, 'HardROck', '24 now', '2017-10-01 09:13:09'),
(50, 71, 'HardROck', '25', '2017-10-01 09:13:12'),
(51, 71, 'HardROck', '26', '2017-10-01 09:13:14'),
(52, 71, 'HardROck', '27', '2017-10-01 09:13:16'),
(53, 71, 'HardROck', '28', '2017-10-01 09:13:18'),
(54, 71, 'HardROck', '29', '2017-10-01 09:13:24'),
(55, 71, 'HardROck', 'ye', '2017-10-01 09:14:09'),
(56, 45, 'HardROck', 'rekt', '2017-10-01 09:15:30'),
(57, 71, 'akagileonel', 'aaaaa', '2017-10-01 09:29:54'),
(58, 71, 'akagileonel', '&lt;?php echo \"HI\"; ?&gt;', '2017-10-01 09:30:45'),
(60, 71, 'akagileonel', 'as', '2017-10-01 09:42:08'),
(61, 71, 'akagileonel', 'aaa', '2017-10-01 09:42:45'),
(62, 71, 'akagileonel', 'asas', '2017-10-01 09:43:04'),
(63, 71, 'akagileonel', 'reeeee', '2017-10-01 09:50:15'),
(64, 71, 'ayana', 'xD', '2017-10-01 09:50:45'),
(66, 54, 'ayana', 'test', '2017-10-01 09:55:03'),
(67, 53, 'ayana', 'same as comments? &lt;b&gt;test&lt;/b&gt;', '2017-10-01 09:55:27'),
(68, 53, 'ayana', 'yep', '2017-10-01 09:55:31'),
(69, 71, 'qaz', 'yo xD', '2017-10-01 10:11:58'),
(72, 71, 'qaz', 'xDDDDD', '2017-10-01 10:14:39'),
(73, 71, 'qaz', '!@#$%^&*()_+&lt;?php ?&gt;', '2017-10-01 10:15:51'),
(77, 59, 'qaz', 'fill', '2017-10-01 10:21:43'),
(79, 76, 'qaz', 'q', '2017-10-01 10:22:06'),
(82, 71, 'username', 'xD', '2017-10-01 11:23:28'),
(83, 48, 'username', 'wtf', '2017-10-01 11:25:00'),
(84, 55, 'username', 'paddings XDD', '2017-10-01 11:26:52'),
(85, 78, 'ayana', 'LMAO', '2017-10-01 11:28:46'),
(86, 78, 'akagileonel', 'xD', '2017-10-01 11:28:58'),
(87, 78, 'HardROck', 'ROFL', '2017-10-01 11:29:19'),
(88, 78, 'qaz', ':laughing:', '2017-10-01 11:29:42'),
(89, 78, 'username', 'thanks guys xDD', '2017-10-01 11:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL,
  `post` varchar(1024) NOT NULL,
  `submittedby` varchar(50) NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_date`, `post`, `submittedby`, `rating`) VALUES
(20, '2017-09-17 08:49:29', 'Testing post. To see if the username shows up lmao.', 'akagileonel', 0),
(21, '2017-09-17 08:49:37', 'it shows up xD', 'akagileonel', 0),
(22, '2017-09-17 08:52:00', 'whoa', 'akagileonel', 0),
(23, '2017-09-17 09:20:08', 'no display name lol', 'imiwa', 0),
(31, '2017-09-17 09:33:10', '**umu**', 'akagileonel', 0),
(34, '2017-09-17 09:34:12', 'a', 'akagileonel', 0),
(37, '2017-09-21 03:45:51', 'Hello', 'googleChrome', 0),
(38, '2017-09-21 04:34:43', 'ye boi', 'googleChrome', 0),
(39, '2017-09-21 04:34:50', 'nibba', 'googleChrome', 0),
(41, '2017-09-21 04:48:01', 'AYYY', 'oreo', 0),
(42, '2017-09-21 04:48:16', '@googleChrome u suck ', 'oreo', 0),
(43, '2017-09-21 04:48:47', 'AYYY', 'oreo', 0),
(44, '2017-09-21 04:48:57', 'no mentions here, sad', 'oreo', 0),
(45, '2017-09-21 04:49:19', 'this site breaks when you use colons and quotes', 'oreo', 0),
(46, '2017-09-21 04:49:25', 'will fix', 'oreo', 0),
(47, '2017-09-21 04:50:43', 'sure oreo sama, btw i just ate you', 'akagileonel', 0),
(48, '2017-09-24 06:52:52', 'ayayaya', 'username', 0),
(53, '2017-09-24 07:25:43', '&lt;b&gt;HTML tags doesnt work anymore, yay!&lt;/b&gt;', 'akagileonel', 0),
(54, '2017-09-24 08:31:35', 'test', 'akagileonel', 0),
(55, '2017-09-24 08:39:38', 'paddings xD', 'akagileonel', 0),
(56, '2017-09-24 09:00:59', 'desu', 'ayana', 0),
(59, '2017-09-24 10:29:12', 'Cookiezi is my lord and savior', 'ayana', 0),
(70, '2017-09-24 11:58:45', '....\r\n', '1212', 0),
(71, '2017-10-01 04:37:15', 'Test post with comments', 'akagileonel', 0),
(76, '2017-10-01 10:12:07', 'self post\r\n', 'qaz', 0),
(77, '1905-01-01 00:00:00', 'I time traveled.', 'akagileonel', 0),
(78, '2017-10-01 11:28:32', 'HAHA\r\n', 'username', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(144) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `join_date` datetime NOT NULL,
  `prof_bio` varchar(144) DEFAULT NULL,
  `prof_pic` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `display_name`, `join_date`, `prof_bio`, `prof_pic`) VALUES
(5, 'akagileonel', 'gilsonpalacol@gmail.com', 'c3d56b2768a60e9fddedd612109865be', '[DEV]Akagi', '2036-09-17 08:25:56', 'some fancy quotation xDDDDDDDDDDDDD', 'uploads/avatars/JPEG_20170824_121048.jpg'),
(6, 'imiwa', 'imiwa@email.com', '882d39ceff31aa867f902131a21ec60b', 'imwa xD', '2017-09-17 09:19:38', NULL, NULL),
(7, 'ayana', 'ayana@email.com', '9570d238a935f4bad98ed85dac7659e9', 'Alternate account', '2017-09-17 09:23:34', 'Test account xDDDDDDD', 'uploads/avatars/JPEG_20170901_174511.jpg'),
(8, 'HardROck', 'hr@breakHTML.com', '833344d5e1432da82ef02e1301477ce8', 'HR', '2017-09-17 09:25:01', 'I have no idea what to put here', 'uploads/avatars/selection-mod-hardrock@2x.png'),
(9, 'googleChrome', 'google@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Google Chrome', '2017-09-21 03:45:35', 'aa', NULL),
(10, 'oreo', 'someemail@email', '099b3b060154898840f0ebdfb46ec78f', 'Panda cookies', '2017-09-21 04:47:53', NULL, NULL),
(11, 'username', 'email@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Generic Account', '2017-09-24 06:52:39', 'this text is going to have a fancy font even though its not worthy of it', 'uploads/avatars/FB_IMG_14817871386941014.jpg'),
(12, 'qaz', 'q12@q', '202cb962ac59075b964b07152d234b70', 'Q A Z', '2017-09-24 06:56:34', 'eh', 'uploads/avatars/JPEG_20170915_025716.jpg'),
(13, '1212', '1212@gmail.com', 'a01610228fe998f515a72dd730294d87', '1212', '2017-09-24 07:00:39', NULL, 'uploads/avatars/hit0.png'),
(14, 'registered user', 'user@user', '7215ee9c7d9dc229d2921a40e899ec5f', 'Beta user, plz', '2017-09-24 13:12:58', NULL, NULL),
(15, 'testo', 'a@q.com', '202cb962ac59075b964b07152d234b70', 'TEST', '2017-10-01 09:24:53', NULL, NULL),
(16, 'dsfsdvcv', 'd@adadasd', '55c66eea2955ba89ba5fb4c9b9efb7fc', 'kgjgkjhv ksdjl afkl ', '2017-10-01 09:25:29', NULL, NULL),
(17, 'dsfsdvcv', 'd@adadasd', '55c66eea2955ba89ba5fb4c9b9efb7fc', 'kgjgkjhv ksdjl afkl ', '2017-10-01 09:26:08', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
