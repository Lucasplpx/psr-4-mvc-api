-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Jan-2019 às 14:24
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `date_posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `photos`
--

INSERT INTO `photos` (`id`, `id_user`, `url`, `date_posted`) VALUES
(1, 1, '213', '2019-01-25 00:00:00'),
(2, 2, 'dfasdf', '2019-01-25 00:00:00'),
(3, 2, 'rewwerkk', '2019-01-25 00:00:00'),
(4, 3, 'qwereddww', '2019-01-25 00:00:00'),
(5, 1, '4d4dss56', '2019-01-25 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `photos_comments`
--

CREATE TABLE `photos_comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  `date_comment` datetime NOT NULL,
  `txt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `photos_comments`
--

INSERT INTO `photos_comments` (`id`, `id_user`, `id_photo`, `date_comment`, `txt`) VALUES
(1, 1, 4, '2019-01-25 00:00:00', 'asdfasdfsd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `photos_likes`
--

CREATE TABLE `photos_likes` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `photos_likes`
--

INSERT INTO `photos_likes` (`id`, `id_user`, `id_photo`) VALUES
(1, 2, 5),
(2, 3, 4),
(3, 1, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `avatar`) VALUES
(1, 'Lucas', 'lucas@gmail.com', '$2y$10$04ya/PTMcS0av81PIN.sc.1Rk.4TMpOJl/cB1sLeE5Xaz6KzsUkVa', ''),
(2, 'Cara 1', 'cara1@gmail.com', '', ''),
(3, 'Teste', 'teste@gmail.com', '$2y$10$rTeWL79JiNb0CtUPuTea9OyTquvVbQv6KTUReKbt4oUC56kHNkJl2', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_following`
--

CREATE TABLE `users_following` (
  `id` int(11) NOT NULL,
  `id_user_active` int(11) NOT NULL,
  `id_user_passive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_following`
--

INSERT INTO `users_following` (`id`, `id_user_active`, `id_user_passive`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_comments`
--
ALTER TABLE `photos_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_likes`
--
ALTER TABLE `photos_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_following`
--
ALTER TABLE `users_following`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos_comments`
--
ALTER TABLE `photos_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos_likes`
--
ALTER TABLE `photos_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_following`
--
ALTER TABLE `users_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
