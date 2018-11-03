-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2018 at 12:53 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pempleos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `idUsuario`) VALUES
(2, 'programador', 1),
(3, 'designer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_empleo` int(11) NOT NULL,
  `compañia` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `posicion` varchar(100) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `aplicar` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_empleo`, `compañia`, `tipo`, `logo`, `url`, `posicion`, `ubicacion`, `id_categoria`, `descripcion`, `aplicar`, `email`, `idUsuario`, `fecha`) VALUES
(1, 'aura motors', 'part-time', NULL, NULL, 'programador', 'herrera', 2, 'trabajo respetado', 'envie su cv', 'blabla@gmail.com', 1, '2018-10-15 16:34:02'),
(2, 'cmaster', 'full-time', NULL, NULL, 'designer', 'los alcarrizos', 3, 'diseños y demas', 'envia su cv', 'balaba@gmail.com', 1, '2018-10-15 16:36:57'),
(3, 'itla', 'part-time', NULL, NULL, 'programador', 'las americas', 2, 'programador', 'envie su cv', 'blabla@gmail.com', 1, '2018-10-15 16:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `postuleo`
--

CREATE TABLE `postuleo` (
  `idpostul` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idempleo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `NombreCompleto` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `NombreCompleto`, `email`, `tipo`, `contraseña`) VALUES
(1, 'Admin', 'dobki36@gmail,com', 1, '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_ce` (`idUsuario`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_empleo`),
  ADD KEY `fk_eu` (`idUsuario`),
  ADD KEY `fk_ec` (`id_categoria`);
ALTER TABLE `employee` ADD FULLTEXT KEY `posicion` (`posicion`,`ubicacion`,`compañia`,`tipo`);

--
-- Indexes for table `postuleo`
--
ALTER TABLE `postuleo`
  ADD PRIMARY KEY (`idpostul`),
  ADD KEY `fk_eu1` (`idempleo`),
  ADD KEY `fk_ue` (`idUsuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_empleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postuleo`
--
ALTER TABLE `postuleo`
  MODIFY `idpostul` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_ce` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_ec` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_eu` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Constraints for table `postuleo`
--
ALTER TABLE `postuleo`
  ADD CONSTRAINT `fk_eu1` FOREIGN KEY (`idempleo`) REFERENCES `employee` (`id_empleo`),
  ADD CONSTRAINT `fk_ue` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
