-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2015 a las 06:30:32
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
-- Estructura de tabla para la tabla `lcdd_administrativo`
--

CREATE TABLE IF NOT EXISTS `lcdd_administrativo` (
  `idadministrativo` int(11) NOT NULL AUTO_INCREMENT,
  `importecanchas` decimal(18,2) DEFAULT NULL,
  `importebar` decimal(18,2) DEFAULT NULL,
  `importesueldos` decimal(18,2) DEFAULT NULL,
  `importegastosvarios` decimal(18,2) DEFAULT NULL,
  `importemercaderia` decimal(18,2) DEFAULT NULL,
  `importegas` decimal(18,2) DEFAULT NULL,
  `importeluz` decimal(18,2) DEFAULT NULL,
  `importetelefono` decimal(18,2) DEFAULT NULL,
  `importeagua` decimal(18,2) DEFAULT NULL,
  `importeinmobiliario` decimal(18,2) DEFAULT NULL,
  `importeimpuestos` decimal(18,2) DEFAULT NULL,
  `importeautonomos` decimal(18,2) DEFAULT NULL,
  `importeingresosbrutos` decimal(18,2) DEFAULT NULL,
  `importeaportes` decimal(18,2) DEFAULT NULL,
  `importesmunicipal` decimal(18,2) DEFAULT NULL,
  `importefiestas` decimal(18,2) DEFAULT NULL,
  `anio` smallint(6) DEFAULT NULL,
  `mes` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idadministrativo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `lcdd_administrativo`
--

INSERT INTO `lcdd_administrativo` (`idadministrativo`, `importecanchas`, `importebar`, `importesueldos`, `importegastosvarios`, `importemercaderia`, `importegas`, `importeluz`, `importetelefono`, `importeagua`, `importeinmobiliario`, `importeimpuestos`, `importeautonomos`, `importeingresosbrutos`, `importeaportes`, `importesmunicipal`, `importefiestas`, `anio`, `mes`) VALUES
(1, '300.00', '91.50', '1.00', '0.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '330.00', 2014, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `lcdd_clientes`
--

INSERT INTO `lcdd_clientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`) VALUES
(12, 'Milanovich Gaston', 'Mi0001', '', NULL, ''),
(13, 'daniel duranti', 'da0013', '', NULL, ''),
(14, 'gaston', 'ga0014', '', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_cuentas`
--

CREATE TABLE IF NOT EXISTS `lcdd_cuentas` (
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `refcliente` int(11) NOT NULL,
  `saldo` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idcuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `lcdd_cuentas`
--

INSERT INTO `lcdd_cuentas` (`idcuenta`, `refcliente`, `saldo`) VALUES
(11, 14, '760'),
(10, 13, '0'),
(9, 12, '-1240');

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
  `saldo` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idfiesta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `lcdd_menu`
--

INSERT INTO `lcdd_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 1, NULL, 'Empleado, Administrador, SuperAdmin'),
(2, '../turnos/', 'icoturnos', 'Turnos', 2, NULL, 'Empleado, Administrador, SuperAdmin'),
(3, '../ventas/', 'icoventas', 'Ventas', 3, NULL, 'Empleado, Administrador, SuperAdmin'),
(4, '../clientes/', 'icousuarios', 'Clientes', 4, NULL, 'Empleado, Administrador, SuperAdmin'),
(5, '../productos/', 'icoproductos', 'Productos', 5, NULL, 'Empleado, Administrador, SuperAdmin'),
(6, '../proveedores/', 'icocontratos', 'Proveedores', 6, NULL, 'Empleado, Administrador, SuperAdmin'),
(7, '../reportes/', 'icoreportes', 'Reportes', 11, NULL, 'Empleado, Administrador, SuperAdmin'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Empleado, Administrador, SuperAdmin'),
(9, '../configuraciones/', 'icoconfiguracion', 'Configuraciones', 7, NULL, 'SuperAdmin'),
(10, '../fiestas/', 'icotorta', 'Fiestas', 8, NULL, 'Empleado, Administrador, SuperAdmin'),
(11, '../administrativo/', 'icoadministrativo', 'Administrativo', 9, NULL, 'SuperAdmin'),
(12, '../usuarios/', 'icopersonal', 'Usuarios', 10, NULL, 'SuperAdmin'),
(13, '../exportar/', 'icoexportar', 'Exportar', 12, NULL, 'Empleado, Administrador, SuperAdmin'),
(14, '../importar/', 'icoimportar', 'Importar', 13, NULL, 'Empleado, Administrador, SuperAdmin');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=57 ;

--
-- Volcado de datos para la tabla `lcdd_movimientos`
--

INSERT INTO `lcdd_movimientos` (`idmovimiento`, `reftipoventa`, `refventa`, `monto`, `fechacreacion`, `usuacrea`, `refid`, `observacion`) VALUES
(56, 3, 58, '0', '2015-01-16 21:58:07', 'Saupurein Marcos', 8, 'Alquiler de Fiesta cancelado'),
(55, 3, 58, '330', '2015-01-16 21:57:55', 'Saupurein Marcos', 8, 'Alquiler de Fiesta'),
(52, 2, 57, '260', '2015-01-16 21:32:21', 'Saupurein Marcos', 36, 'Alquiler de Cancha 2 Fecha:2015-01-16'),
(54, 2, 57, '-260', '2015-01-16 21:34:53', '', 36, 'Alquiler de Cancha 2 Cancelado');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `lcdd_productos`
--

INSERT INTO `lcdd_productos` (`idproducto`, `nombre`, `precio_unit`, `precio_venta`, `stock`, `stock_min`, `reftipoproducto`, `refproveedor`, `codigo`, `codigobarra`, `caracteristicas`, `egreso`) VALUES
(2, 'Palermo', '6.00', '16.00', 30, 8, 1, 2, 'cer0001', 8710103584506, '1 litro', b'0'),
(3, 'Gaseosa 7up', '12.50', '25.00', 0, 0, 0, 0, '', 0, '', b'0'),
(4, 'Gaseosa 7up', '12.00', '25.00', 0, 0, 0, 0, '', 0, '', b'0'),
(5, 'Gaseosa 7up', '12.90', '25.00', 62, 10, 3, 4, 'GAS0004', 7795373011366, '2.25 ltrs', b'0'),
(6, 'Cerveza Leffe', '16.00', '40.00', 20, 4, 1, 2, 'ce0003', 0, '', b'0'),
(7, 'Cerveza Quilmes', '8.00', '25.00', 59, 10, 1, 2, 'ge0004', 7790520981974, '1 litro', b'0'),
(8, 'Se rompio un vidrio', '400.00', '400.00', 1, 1, 4, 7, 'egreso', 0, '', b'1'),
(9, 'Pizzas', '10.00', '50.00', 50, 10, 6, 7, 'pizzas', 0, 'Pizzas de muzzarella comun', b'0'),
(10, 'Cigarrillos', '12.00', '16.50', 21, 5, 5, 2, 'asd0003', 0, '', b'0');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `lcdd_tipoventa`
--

INSERT INTO `lcdd_tipoventa` (`idtipoventa`, `tipoventa`, `precio`, `detalle`, `refvalores`) VALUES
(1, 'Venta Productos', '0', 'Venta de los productos de las heladeras', 1),
(2, 'Alquiler de canchas de día', '260', 'Alquiler de cancha de día antes de las 18:00 hs', 2),
(3, 'Alquiler para cumpleaños', '330', 'Alquiler para cumpleaños', 3),
(5, 'Alquiler de canchas de noche', '300', 'Alquiler de canchas de noche despues de las 18:00', 2),
(6, 'Alquiler para cumpleaños con catering', '450', 'Alquiler para cumpleaños con catering', 3),
(9, 'Carga de Saldo', '0', 'Carga de Saldo del Cliente', 4),
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
  `indefinido` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_valores`
--

CREATE TABLE IF NOT EXISTS `lcdd_valores` (
  `idvalor` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idvalor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `lcdd_valores`
--

INSERT INTO `lcdd_valores` (`idvalor`, `descripcion`) VALUES
(1, 'Productos'),
(2, 'Canchas'),
(3, 'Fiestas'),
(4, 'Clientes');

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
  `cantidad` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `lcdd_ventas`
--

INSERT INTO `lcdd_ventas` (`idventa`, `refproducto`, `reftipoventa`, `importe`, `fechacreacion`, `cancelado`, `usuacrea`, `fechamodificacion`, `usuamodi`, `concepto`, `observaciones`, `cantidad`) VALUES
(57, NULL, 2, '260.00', '2015-01-16 21:32:21', b'1', 'Saupurein Marcos', NULL, '', 'Alquiler de cancha de d?a antes de las 18:00 hs', 'Se cancelo el turno de la cancha: Cancha 2', 1),
(58, NULL, 3, '330.00', '2015-01-16 21:57:55', b'1', 'Saupurein Marcos', NULL, '', 'Alquiler para cumplea?os', 'Se cancelo la fiesta ', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `se_usuarios`
--

INSERT INTO `se_usuarios` (`idusuario`, `usuario`, `password`, `refroll`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 'SuperAdmin', 'msredhotero@msn.com', 'Saupurein Marcos'),
(2, 'carlos', 'carlos', 'Empleado', 'carlos@msn.com', 'Carlinio');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
