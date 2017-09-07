-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2017 年 9 月 04 日 20:16
-- サーバのバージョン： 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kogatter`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `all_posts`
--

CREATE TABLE `all_posts` (
  `kogari_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kogari_time` varchar(255) DEFAULT NULL,
  `contents` text,
  `count_dontmind` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `all_posts`
--

INSERT INTO `all_posts` (`kogari_id`, `user_id`, `kogari_time`, `contents`, `count_dontmind`) VALUES
(1, 24, '2017-09-01 21:22:04', '誠だよ！', 0),
(2, 26, '2017-09-01 22:12:19', 'ユッキーだよ！', 0),
(3, 24, '2017-09-02 15:40:42', 'だんだんだか弾', 0),
(4, 25, '2017-09-02 16:46:15', '竜也だぞ！', 0),
(7, 25, '2017-09-02 17:02:08', 'ボクサーでした！', 0),
(8, 28, '2017-09-03 15:46:30', 'ドクターだぞ！', 0),
(9, 28, '2017-09-03 15:46:52', '今日もギャグがキレてるぜ！', 0),
(10, 29, '2017-09-04 11:05:14', 'ダーツ！', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `dontmind_map`
--

CREATE TABLE `dontmind_map` (
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dontmind_date` varchar(255) DEFAULT NULL,
  `dontmind_update` varchar(255) DEFAULT NULL,
  `dontmind_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `dontmind_map`
--

INSERT INTO `dontmind_map` (`post_id`, `user_id`, `dontmind_date`, `dontmind_update`, `dontmind_flag`) VALUES
(1, 28, NULL, NULL, 0),
(3, 28, NULL, NULL, 0),
(2, 28, NULL, NULL, 0),
(8, 24, NULL, NULL, 0),
(1, 25, NULL, NULL, 0),
(8, 25, NULL, NULL, 0),
(9, 28, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `dontmind_message`
--

CREATE TABLE `dontmind_message` (
  `dm_id` int(11) UNSIGNED NOT NULL,
  `message` text,
  `sm_category` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `dontmind_message`
--

INSERT INTO `dontmind_message` (`dm_id`, `message`, `sm_category`) VALUES
(1, 'そんな凡ミスするくらいなら、辞めたほうがいいよ', 'type_m'),
(2, 'そのくらいのミス誰でもありますよ', 'type_s'),
(3, '毎回ちゃんとチャックしてたら、そんなミス起こらんよな。', 'type_m'),
(4, '切り替えて行きましょう！', 'type_s');

-- --------------------------------------------------------

--
-- テーブルの構造 `follow_map`
--

CREATE TABLE `follow_map` (
  `follow_id` int(11) NOT NULL,
  `following` int(20) DEFAULT NULL,
  `followed` int(20) DEFAULT NULL,
  `follow_time` varchar(255) DEFAULT NULL,
  `follow_update_time` varchar(255) DEFAULT NULL,
  `follow_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `follow_map`
--

INSERT INTO `follow_map` (`follow_id`, `following`, `followed`, `follow_time`, `follow_update_time`, `follow_flag`) VALUES
(10, 24, 25, NULL, NULL, 0),
(11, 25, 24, NULL, NULL, 0),
(12, 25, 26, NULL, NULL, 0),
(14, 28, 24, NULL, NULL, 0),
(15, 28, 26, NULL, NULL, 0),
(16, 28, 25, NULL, NULL, 0),
(17, 24, 28, NULL, NULL, 0),
(18, 29, 24, NULL, NULL, 0),
(19, 29, 28, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `account_name` varchar(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `judgement_sm` varchar(11) DEFAULT NULL,
  `user_icon` varchar(255) DEFAULT NULL,
  `cover_pic` varchar(255) NOT NULL,
  `time_reg` varchar(255) DEFAULT NULL,
  `time_update` varchar(255) DEFAULT NULL,
  `introduction` text,
  `user_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`user_id`, `account_name`, `email`, `password`, `judgement_sm`, `user_icon`, `cover_pic`, `time_reg`, `time_update`, `introduction`, `user_flag`) VALUES
(24, 'makoto', 'makoto@makoto', 'makoto', 'type_m', NULL, '', '2017-09-01 21:15:15', NULL, NULL, 1),
(25, 'tatsuya', 'tatsuya@tatsuya', 'tatsuya', 'type_s', NULL, '', '2017-09-01 21:53:18', NULL, NULL, 1),
(26, 'yukky', 'yukky@yukky', 'yukky', 'type_s', NULL, '', '2017-09-01 21:53:46', NULL, NULL, 1),
(27, 'saji', 'saji@saji', 'saji', 'type_m', NULL, '', '2017-09-03 15:42:44', NULL, NULL, 1),
(28, 'sajima', 'sajima@sajima', 'sajima', 'type_s', NULL, '', '2017-09-03 15:46:11', NULL, NULL, 1),
(29, 'sakuya', 'sakuya@sakuya', 'sakuya', 'type_s', NULL, '', '2017-09-04 11:04:57', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_posts`
--
ALTER TABLE `all_posts`
  ADD PRIMARY KEY (`kogari_id`);

--
-- Indexes for table `dontmind_message`
--
ALTER TABLE `dontmind_message`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indexes for table `follow_map`
--
ALTER TABLE `follow_map`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`account_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_posts`
--
ALTER TABLE `all_posts`
  MODIFY `kogari_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `dontmind_message`
--
ALTER TABLE `dontmind_message`
  MODIFY `dm_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `follow_map`
--
ALTER TABLE `follow_map`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
