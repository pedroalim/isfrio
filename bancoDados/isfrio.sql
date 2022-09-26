-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Set-2022 às 16:35
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `isfrio`
--
CREATE DATABASE IF NOT EXISTS `isfrio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `isfrio`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicionais`
--

CREATE TABLE `adicionais` (
  `id` int(11) NOT NULL,
  `nome` varchar(666) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adicionais`
--

INSERT INTO `adicionais` (`id`, `nome`, `preco`) VALUES
(1, 'M&M’s', '0.50'),
(2, 'Chocolates', '0.75'),
(3, 'Marshmallows', '0.40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `coberturas`
--

CREATE TABLE `coberturas` (
  `id` int(11) NOT NULL,
  `nome` varchar(666) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `coberturas`
--

INSERT INTO `coberturas` (`id`, `nome`, `preco`) VALUES
(1, 'Beterraba', '1.00'),
(2, 'Churros', '1.00'),
(3, 'Kiwi', '0.75');

-- --------------------------------------------------------

--
-- Estrutura da tabela `massas`
--

CREATE TABLE `massas` (
  `id` int(11) NOT NULL,
  `nome` varchar(666) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `massas`
--

INSERT INTO `massas` (`id`, `nome`, `preco`) VALUES
(1, 'Beterraba', '2.00'),
(2, 'Chocolate', '2.00'),
(3, 'Banana', '2.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `rua` varchar(20) NOT NULL,
  `numero` int(8) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `bairro`, `rua`, `numero`, `complemento`) VALUES
(27, 6, 'Jardim América', 'bozo', 123, ''),
(28, 6, 'Jardim América', 'rua abdala abujamra', 288, ''),
(29, 6, 'Jardim América', 'rua abdala abujamra', 288, ''),
(30, 6, 'Jardim América', 'rua abdala abujamra', 288, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_complementos`
--

CREATE TABLE `pedidos_complementos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_cobertura` varchar(11) NOT NULL,
  `id_massa` varchar(11) NOT NULL,
  `id_adiconal` varchar(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos_complementos`
--

INSERT INTO `pedidos_complementos` (`id`, `id_produto`, `id_cobertura`, `id_massa`, `id_adiconal`, `id_pedido`) VALUES
(27, 2, '2', '3', '2', 27),
(28, 2, '2', '1,2', '1,3', 28),
(29, 2, '2', '2,3', '1', 29),
(30, 1, '3', '1', '2', 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(666) NOT NULL,
  `img` varchar(666) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `img`) VALUES
(1, 'Sorvete de litro', 'https://res.cloudinary.com/isfrio/image/upload/v1663427419/sorveteLitro_kbkzzc.png'),
(2, 'Sorvete de casquinha', 'https://res.cloudinary.com/isfrio/image/upload/v1663427419/sorveteCasca_jnevml.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` mediumtext NOT NULL,
  `senha` mediumtext NOT NULL,
  `nome` longtext NOT NULL,
  `imagem` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `imagem`) VALUES
(6, 'bolsonaro@gmail.com', '202cb962ac59075b964b07152d234b70', 'Lucas', ''),
(7, 'zugor@gmail.com', '202cb962ac59075b964b07152d234b70', 'zugor', ''),
(8, 'bozo@gmail.com', '202cb962ac59075b964b07152d234b70', 'bozo', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `coberturas`
--
ALTER TABLE `coberturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `massas`
--
ALTER TABLE `massas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos_complementos`
--
ALTER TABLE `pedidos_complementos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicionais`
--
ALTER TABLE `adicionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `coberturas`
--
ALTER TABLE `coberturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `massas`
--
ALTER TABLE `massas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `pedidos_complementos`
--
ALTER TABLE `pedidos_complementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
