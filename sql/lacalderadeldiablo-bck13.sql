-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-12-2014 a las 16:54:41
-- Versión del servidor: 5.1.36-community-log
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `lcdd_clientes`
--

INSERT INTO `lcdd_clientes` (`idcliente`, `nombre`, `nrocliente`, `email`, `nrodocumento`, `telefono`) VALUES
(12, 'Milanovich Gaston', 'Mi0001', '', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lcdd_cuentas`
--

CREATE TABLE IF NOT EXISTS `lcdd_cuentas` (
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `refcliente` int(11) NOT NULL,
  `saldo` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idcuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `lcdd_cuentas`
--

INSERT INTO `lcdd_cuentas` (`idcuenta`, `refcliente`, `saldo`) VALUES
(9, 12, '100');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `lcdd_fiestas`
--

INSERT INTO `lcdd_fiestas` (`idfiesta`, `nombre`, `horadesde`, `horahasta`, `dia`, `concatering`) VALUES
(7, 'Viviana', '12:00:00', '17:00:00', '2014-12-20', b'0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

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
(10, '../fiestas/', 'icotorta', 'Fiestas', 8, NULL, 'Empleado, Administrador'),
(11, '../administrativo/', 'icoadministrativo', 'Administrativo', 9, NULL, 'Administrador');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `lcdd_movimientos`
--

INSERT INTO `lcdd_movimientos` (`idmovimiento`, `reftipoventa`, `refventa`, `monto`, `fechacreacion`, `usuacrea`, `refid`, `observacion`) VALUES
(29, 1, 37, '0', '2014-12-12 14:11:58', 'Saupurein Marcos', 10, 'Venta de las heladeras'),
(28, 9, 36, '0', '2014-12-11 20:21:00', 'Saupurein Marcos', 12, 'Carga de saldo del cliente'),
(27, 9, 35, '-20', '2014-12-11 20:20:24', 'Saupurein Marcos', 12, 'Carga de saldo del cliente'),
(25, 9, 33, '100', '2014-12-11 20:13:20', 'Saupurein Marcos', 12, 'Carga de saldo del cliente'),
(26, 5, 34, '300', '2014-12-11 20:13:42', 'Saupurein Marcos', 28, 'Alquiler de Cancha 1 Fecha:2014-12-11'),
(24, 9, 32, '320', '2014-12-11 20:08:38', 'Saupurein Marcos', 12, 'Carga de nuevo cliente'),
(19, 1, 27, '0', '2014-12-11 19:20:05', 'Saupurein Marcos', 7, 'Venta de las heladeras'),
(30, 3, 38, '330', '2014-12-12 14:30:15', 'Saupurein Marcos', 7, 'Alquiler de Fiesta');

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
  PRIMARY KEY (`idturno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `lcdd_turnos`
--

INSERT INTO `lcdd_turnos` (`idturno`, `refcancha`, `fechautilizacion`, `horautilizacion`, `refcliente`, `fechacreacion`, `usuacrea`, `activo`, `cliente`) VALUES
(28, 1, '2014-12-11', '21:00:00', 12, '2014-12-11 20:13:42', 'Saupurein ', b'1', 'Milanovich');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `lcdd_ventas`
--

INSERT INTO `lcdd_ventas` (`idventa`, `refproducto`, `reftipoventa`, `importe`, `fechacreacion`, `cancelado`, `usuacrea`, `fechamodificacion`, `usuamodi`, `concepto`, `observaciones`, `cantidad`) VALUES
(27, 7, 1, '75.00', '2014-12-11 19:20:05', b'0', 'Saupurein Marcos', NULL, '', 'Cerveza Quilmes 1 litro', 'Venta de Productos', 3),
(32, NULL, 9, '0.00', '2014-12-11 20:08:38', b'1', 'Saupurein Marcos', NULL, '', 'Idcliente:12', 'Carga de nuevo cliente', 1),
(33, NULL, 9, '0.00', '2014-12-11 20:13:20', b'1', 'Saupurein Marcos', NULL, '', 'Idcliente:12', 'Carga de saldo del cliente', 1),
(34, NULL, 5, '300.00', '2014-12-11 20:13:42', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler de canchas de noche despues de las 18:00', 'Alquiler de Cancha 1 Fecha:2014-12-11', 1),
(35, NULL, 9, '0.00', '2014-12-11 20:20:24', b'1', 'Saupurein Marcos', NULL, '', 'Idcliente:12', 'Carga de saldo del cliente', 1),
(36, NULL, 9, '0.00', '2014-12-11 20:21:00', b'1', 'Saupurein Marcos', NULL, '', 'Idcliente:12', 'Carga de saldo del cliente', 1),
(37, 10, 1, '16.50', '2014-12-12 14:11:58', b'0', 'Saupurein Marcos', NULL, '', 'Cigarrillos ', 'Venta de Productos', 1),
(38, NULL, 3, '330.00', '2014-12-12 14:30:15', b'0', 'Saupurein Marcos', NULL, '', 'Alquiler para cumplea?os', 'Alquiler de Fiesta', 1);

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
