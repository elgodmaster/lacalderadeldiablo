-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-12-2014 a las 07:50:12
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lcdd_clientes`
--

INSERT INTO `lcdd_clientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`) VALUES
(1, 'marcos', 'ma0001', '', NULL, ''),
(2, 'enzo franchescoli', 'en0002', 'elenzo@hotmail.com', NULL, ''),
(3, 'nora', 'no0003', NULL, NULL, NULL),
(4, '', '0004', '', NULL, ''),
(5, '', '0005', '', NULL, ''),
(6, '', '0006', '', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_cuentas`
--

CREATE TABLE IF NOT EXISTS `lcdd_cuentas` (
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `refcliente` int(11) NOT NULL,
  `saldo` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idcuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lcdd_cuentas`
--

INSERT INTO `lcdd_cuentas` (`idcuenta`, `refcliente`, `saldo`) VALUES
(1, 1, '180'),
(2, 2, '0'),
(3, 3, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_fiestas`
--

CREATE TABLE IF NOT EXISTS `lcdd_fiestas` (
  `idfiesta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `horadesde` time NOT NULL,
  `horahasta` time NOT NULL,
  `dia` date NOT NULL,
  `concatering` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfiesta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `lcdd_fiestas`
--

INSERT INTO `lcdd_fiestas` (`idfiesta`, `nombre`, `horadesde`, `horahasta`, `dia`, `concatering`) VALUES
(4, 'cristian spazzarini', '08:00:00', '12:00:00', '2014-12-06', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_menu`
--

CREATE TABLE IF NOT EXISTS `lcdd_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `lcdd_menu`
--

INSERT INTO `lcdd_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Empleado, Administrador'),
(2, '../turnos/', 'icoturnos', 'Turnos', 2, NULL, 'Empleado, Administrador'),
(3, '../ventas/', 'icoventas', 'Ventas', 3, NULL, 'Empleado, Administrador'),
(4, '../clientes/', 'icousuarios', 'Clientes', 4, NULL, 'Empleado, Administrador'),
(5, '../productos/', 'icoproductos', 'Productos', 5, NULL, 'Empleado, Administrador'),
(6, '../proveedores/', 'icocontratos', 'Proveedores', 6, NULL, 'Empleado, Administrador'),
(7, '../reportes/', 'icoreportes', 'Reportes', 10, NULL, 'Empleado, Administrador'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador'),
(9, '../configuraciones/', 'icoconfiguracion', 'Configuraciones', 7, NULL, 'Administrador'),
(10, '../fiestas/', 'icotorta', 'Fiestas', 8, NULL, 'Empleado, Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_movimientos`
--

CREATE TABLE IF NOT EXISTS `lcdd_movimientos` (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `reftipoventa` int(11) NOT NULL,
  `refventa` int(11) NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuacrea` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refid` int(11) NOT NULL,
  `observacion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmovimiento`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `lcdd_movimientos`
--

INSERT INTO `lcdd_movimientos` (`idmovimiento`, `reftipoventa`, `refventa`, `monto`, `fechacreacion`, `usuacrea`, `refid`, `observacion`) VALUES
(4, 2, 7, '0', '2014-12-05 23:22:17', 'Saupurein Marcos', 15, 'Alquiler de '),
(5, 2, 7, '0', '2014-12-05 23:28:24', '', 15, 'Alquiler de '),
(6, 2, 8, '260', '2014-12-05 23:32:07', 'Saupurein Marcos', 16, 'Alquiler de Cancha 3'),
(11, 2, 11, '260', '2014-12-05 23:39:54', 'Saupurein Marcos', 17, 'Alquiler de Cancha 2'),
(12, 3, 14, '330', '2014-12-06 00:02:15', 'msredhotero@msn.com', 4, 'Alquiler de Fiesta'),
(13, 2, 15, '260', '2014-12-09 05:48:56', 'Saupurein Marcos', 18, 'Alquiler de Cancha 2'),
(14, 2, 16, '260', '2014-12-09 05:51:52', 'Saupurein Marcos', 19, 'Alquiler de Cancha 1'),
(15, 2, 17, '260', '2014-12-09 05:58:39', 'Saupurein Marcos', 20, 'Alquiler de Cancha 3'),
(16, 5, 18, '300', '2014-12-09 06:00:02', 'Saupurein Marcos', 21, 'Alquiler de Cancha 2'),
(17, 8, 19, '260', '2014-12-09 06:03:37', 'Saupurein Marcos', 25, 'Alquiler de Cancha 2');

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
  `codigobarra` bigint(15) DEFAULT NULL,
  `caracteristicas` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `egreso` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `lcdd_productos`
--

INSERT INTO `lcdd_productos` (`idproducto`, `nombre`, `precio_unit`, `precio_venta`, `stock`, `stock_min`, `reftipoproducto`, `refproveedor`, `codigo`, `codigobarra`, `caracteristicas`, `egreso`) VALUES
(2, 'Palermo', '6.00', '16.00', 30, 8, 1, 2, 'cer0001', 8710103584506, '1 litro', b'0'),
(3, 'Gaseosa 7up', '12.50', '25.00', 0, 0, 0, 0, '', 0, '', b'0'),
(4, 'Gaseosa 7up', '12.00', '25.00', 0, 0, 0, 0, '', 0, '', b'0'),
(5, 'Gaseosa 7up', '12.90', '25.00', 62, 10, 3, 4, 'GAS0004', 7795373011366, '2.25 ltrs', b'0'),
(6, 'Cerveza Leffe', '16.00', '40.00', 20, 4, 1, 2, 'ce0003', 0, '', b'0'),
(7, 'Cerveza Quilmes', '8.00', '25.00', 62, 10, 1, 2, 'ge0004', 7790520981974, '1 litro', b'0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `lcdd_tipoproducto`
--

INSERT INTO `lcdd_tipoproducto` (`idtipoproducto`, `tipoproducto`, `activo`) VALUES
(1, 'Cervezas', b'1'),
(2, 'Aguas', b'1'),
(3, 'Gaseosas', b'1'),
(4, 'Egresos', b'1'),
(5, 'Incontingencias', b'1'),
(6, 'Comidas', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_tipoventa`
--

CREATE TABLE IF NOT EXISTS `lcdd_tipoventa` (
  `idtipoventa` int(11) NOT NULL AUTO_INCREMENT,
  `tipoventa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `detalle` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `refvalores` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idtipoventa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `lcdd_tipoventa`
--

INSERT INTO `lcdd_tipoventa` (`idtipoventa`, `tipoventa`, `precio`, `detalle`, `refvalores`) VALUES
(1, 'Venta Productos', '0', 'Venta de los productos de las heladeras', 1),
(2, 'Alquiler de canchas de día', '260', 'Alquiler de cancha de día antes de las 18:00 hs', 2),
(3, 'Alquiler para cumpleaños', '330', 'Alquiler para cumpleaños', 3),
(5, 'Alquiler de canchas de noche', '300', 'Alquiler de canchas de noche despues de las 18:00', 2),
(6, 'Alquiler para cumpleaños con catering', '450', 'Alquiler para cumpleaños con catering', 3),
(7, 'Alquiler de canchas mes entero', '260', 'Alquiler de canchas mes entero', NULL),
(8, 'Alquiler de canchas mes entero', '260', 'Alquiler de canchas mes entero', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_turnos`
--

CREATE TABLE IF NOT EXISTS `lcdd_turnos` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `refcancha` smallint(6) NOT NULL,
  `fechautilizacion` date NOT NULL,
  `horautilizacion` time NOT NULL,
  `refcliente` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuacrea` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  `cliente` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `lcdd_turnos`
--

INSERT INTO `lcdd_turnos` (`idturno`, `refcancha`, `fechautilizacion`, `horautilizacion`, `refcliente`, `fechacreacion`, `usuacrea`, `activo`, `cliente`) VALUES
(16, 3, '2014-12-06', '12:00:00', 3, '2014-12-05 23:32:07', 'Saupurein ', b'1', 'nora'),
(17, 2, '2014-12-05', '15:00:00', 3, '2014-12-05 23:33:16', 'Saupurein ', b'1', 'nora'),
(18, 2, '2014-12-09', '13:00:00', 2, '2014-12-09 05:48:54', 'Saupurein ', b'1', 'enzo franchescoli'),
(19, 1, '2014-12-09', '16:00:00', 1, '2014-12-09 05:51:49', 'Saupurein ', b'1', 'marcos'),
(20, 3, '2014-12-09', '16:00:00', 1, '2014-12-09 05:58:36', 'Saupurein ', b'1', 'marcos'),
(21, 2, '2014-12-09', '22:00:00', 0, '2014-12-09 06:00:00', 'Saupurein ', b'1', 'Alejandro menotti'),
(22, 2, '2014-12-16', '20:00:00', 1, '2014-12-09 06:03:29', 'Saupurein ', b'1', 'marcos'),
(23, 2, '2014-12-23', '20:00:00', 1, '2014-12-09 06:03:31', 'Saupurein ', b'1', 'marcos'),
(24, 2, '2014-12-30', '20:00:00', 1, '2014-12-09 06:03:33', 'Saupurein ', b'1', 'marcos'),
(25, 2, '2014-12-09', '20:00:00', 1, '2014-12-09 06:03:35', 'Saupurein ', b'1', 'marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_valores`
--

CREATE TABLE IF NOT EXISTS `lcdd_valores` (
  `idvalor` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idvalor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `lcdd_valores`
--

INSERT INTO `lcdd_valores` (`idvalor`, `descripcion`) VALUES
(1, 'Productos'),
(2, 'Canchas'),
(3, 'Fiestas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_ventas`
--

CREATE TABLE IF NOT EXISTS `lcdd_ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `refproducto` int(11) DEFAULT NULL,
  `reftipoventa` int(11) NOT NULL,
  `importe` decimal(18,2) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancelado` bit(1) DEFAULT NULL,
  `usuacrea` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `usuamodi` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `concepto` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `lcdd_ventas`
--

INSERT INTO `lcdd_ventas` (`idventa`, `refproducto`, `reftipoventa`, `importe`, `fechacreacion`, `cancelado`, `usuacrea`, `fechamodificacion`, `usuamodi`, `concepto`, `observaciones`) VALUES
(7, NULL, 5, '300.00', '2014-12-05 23:21:45', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de canchas de noche despues de las 18:00', 'Alquiler de Cancha 1'),
(8, NULL, 2, '260.00', '2014-12-05 23:32:07', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Alquiler de Cancha 3'),
(11, NULL, 2, '260.00', '2014-12-05 23:39:54', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Alquiler de Cancha 2'),
(14, NULL, 3, '330.00', '2014-12-06 00:02:15', b'0', 'msredhotero@msn.com', NULL, '', 'Alquiler para cumplea?os', 'Alquiler de Fiesta'),
(15, NULL, 2, '260.00', '2014-12-09 05:48:56', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Alquiler de Cancha 2'),
(16, NULL, 2, '260.00', '2014-12-09 05:51:52', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Alquiler de Cancha 1'),
(17, NULL, 2, '260.00', '2014-12-09 05:58:38', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Alquiler de Cancha 3'),
(18, NULL, 5, '300.00', '2014-12-09 06:00:02', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de canchas de noche despues de las 18:00', 'Alquiler de Cancha 2'),
(19, NULL, 8, '260.00', '2014-12-09 06:03:37', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de canchas mes entero', 'Alquiler de Cancha 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `se_usuarios`
--

CREATE TABLE IF NOT EXISTS `se_usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `refroll` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombrecompleto` varchar(70) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `se_usuarios`
--

INSERT INTO `se_usuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 'Administrador', 'msredhotero@msn.com', 'Saupurein Marcos'),
(2, 'carlos', 'carlos', 'Empleado', 'carlos@msn.com', 'Carlinio');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
