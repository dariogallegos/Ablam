-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2018 a las 17:11:23
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ablam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idContacto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `email` varchar(100) CHARACTER SET utf32 NOT NULL,
  `numero` int(9) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla con los datos de los usuarios';

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idContacto`, `nombre`, `direccion`, `email`, `numero`, `imagen`) VALUES
(2, 'javi ricaldi', 'Calle Berrocal 56 3 A Madrid', 'javi@ucm.es', 648949809, 'img/people_5.png'),
(3, 'noemi quishpe', 'Calle el toboso 102 bajo a', 'noemiquishpe12@gmail.com', 669617798, 'img/people_6.png'),
(5, 'Andrea del Vado', 'avenida de europa 13', 'avado@ucm.es', 673028359, 'img/people_2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nacimiento` date NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `email` varchar(100) CHARACTER SET utf32 NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla con los datos de los usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `usuario`, `pass`, `nacimiento`, `avatar`, `email`, `sexo`, `fecha_reg`) VALUES
(1, 'dario gallegos', 'dario', 'dario', '1996-10-30', '', 'dariogal@ucm.es', 'hombre', '2018-04-17 00:00:00'),
(2, 'andrea del vado', 'andrea', 'andrea', '1996-10-31', '', 'avado@ucm.com', 'mujer', '2018-04-17 00:00:00'),
(4, 'diego Gallegos', 'diego', 'diego', '0000-00-00', '', 'diegogallegos@gmail.com', 'hombre', '2018-04-17 00:58:27'),
(5, 'david Santiago', 'david', 'david', '0000-00-00', '', 'davidsant@gmail.com', '', '2018-04-17 01:00:40'),
(7, 'arantxa Brock', 'arantxa', 'arantxa', '0000-00-00', '', 'arantxabrock@gmail.com', '', '2018-04-23 10:46:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios-contactos`
--

CREATE TABLE `usuarios-contactos` (
  `idContacto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla con los datos de los usuarios';

--
-- Volcado de datos para la tabla `usuarios-contactos`
--

INSERT INTO `usuarios-contactos` (`idContacto`, `idUsuario`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuarios-contactos`
--
ALTER TABLE `usuarios-contactos`
  ADD PRIMARY KEY (`idContacto`,`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
