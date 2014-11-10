-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2014 a las 06:52:56
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lacalderadeldiablo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_canchas`
--

CREATE TABLE IF NOT EXISTS `lcdd_canchas` (
  `idcancha` int(11) NOT NULL AUTO_INCREMENT,
  `cancha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcancha`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lcdd_canchas`
--

INSERT INTO `lcdd_canchas` (`idcancha`, `cancha`) VALUES
(1, 'Cancha 1'),
(2, 'Cancha 2'),
(3, 'Cancha 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_clientes`
--

CREATE TABLE IF NOT EXISTS `lcdd_clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nrocliente` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nrodocumento` int(11) DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `lcdd_clientes`
--

INSERT INTO `lcdd_clientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`) VALUES
(1, 'marcos', 'ma0001', NULL, NULL, NULL),
(2, 'enzo franchescoli', 'en0002', 'elenzo@hotmail.com', NULL, ''),
(3, 'nora', 'no0003', NULL, NULL, NULL),
(7, 'cabrera juan', 'ca0007', '', 16448995, '15849846'),
(9, 'Pedro', 'Pe0008', 'pedro@msn.com', 12300300, '156234878'),
(10, 'pantro', 'pa0010', 'asjdhask', 12315, '645498'),
(11, 'Gaston Milanovich', 'Ga0011', 'milanga@yahoo.com.ar', 32568456, '152364578');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_productos`
--

CREATE TABLE IF NOT EXISTS `lcdd_productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unit` decimal(18,2) NOT NULL,
  `precio_venta` decimal(18,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` smallint(6) NOT NULL,
  `reftipoproducto` int(11) NOT NULL,
  `refproveedor` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `codigobarra` int(11) DEFAULT NULL,
  `caracteristicas` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lcdd_productos`
--

INSERT INTO `lcdd_productos` (`idproducto`, `nombre`, `precio_unit`, `precio_venta`, `stock`, `stock_min`, `reftipoproducto`, `refproveedor`, `codigo`, `codigobarra`, `caracteristicas`) VALUES
(2, 'Palermo', '6.00', '16.00', 30, 8, 1, 2, 'cer0001', NULL, '1 litro'),
(3, 'Gaseosa 7up', '12.50', '25.00', 0, 0, 0, 0, '', 0, ''),
(4, 'Gaseosa 7up', '12.00', '25.00', 0, 0, 0, 0, '', 0, ''),
(5, 'Gaseosa 7up', '12.90', '25.00', 62, 10, 3, 4, 'GAS0004', 0, '2.25 ltrs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_proveedores`
--

CREATE TABLE IF NOT EXISTS `lcdd_proveedores` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuit` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `lcdd_proveedores`
--

INSERT INTO `lcdd_proveedores` (`idproveedor`, `proveedor`, `direccion`, `telefono`, `cuit`, `nombre`, `email`) VALUES
(1, 'Favio', NULL, '4602536', NULL, 'German', NULL),
(2, 'Coca-Cola', NULL, '4895623', '20152634851', 'Lucas', NULL),
(3, 'Heineken', '70 e/23 y 24 N°1428', '4600169', '', 'Marcos', ''),
(4, 'Lucas', '', '', '', '', 'lucas@hotmail.com'),
(7, 'pepe', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_tipoproducto`
--

CREATE TABLE IF NOT EXISTS `lcdd_tipoproducto` (
  `idtipoproducto` int(11) NOT NULL AUTO_INCREMENT,
  `tipoproducto` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idtipoproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lcdd_tipoproducto`
--

INSERT INTO `lcdd_tipoproducto` (`idtipoproducto`, `tipoproducto`, `activo`) VALUES
(1, 'Cervezas', b'1'),
(2, 'Aguas', b'1'),
(3, 'Gaseosas', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_turnos`
--

CREATE TABLE IF NOT EXISTS `lcdd_turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `refcancha` smallint(6) NOT NULL,
  `fechautilizacion` date NOT NULL,
  `horautilizacion` time NOT NULL,
  `refcliente` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuacrea` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lcdd_turnos`
--

INSERT INTO `lcdd_turnos` (`idturno`, `refcancha`, `fechautilizacion`, `horautilizacion`, `refcliente`, `fechacreacion`, `usuacrea`) VALUES
(1, 2, '2014-11-09', '17:00:00', 10, '2014-11-09 20:43:51', 'Saupurein '),
(2, 2, '2014-11-09', '12:00:00', 3, '2014-11-09 20:44:59', 'Saupurein '),
(4, 1, '2014-11-10', '14:00:00', 9, '2014-11-10 06:09:40', 'Saupurein '),
(5, 1, '2014-11-10', '23:00:00', 2, '2014-11-10 06:24:08', 'Saupurein '),
(6, 2, '2014-11-10', '14:00:00', 7, '2014-11-10 06:32:47', 'Saupurein ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `se_usuarios`
--

CREATE TABLE IF NOT EXISTS `se_usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `refroll` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombrecompleto` varchar(70) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `se_usuarios`
--

INSERT INTO `se_usuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
