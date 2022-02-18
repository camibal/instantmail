-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2022 a las 03:02:49
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ins`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_calificacion` int(11) NOT NULL COMMENT 'Id de la calificacion',
  `estado_calificacion` int(1) NOT NULL DEFAULT 0 COMMENT 'Si esta calificado o no',
  `fecha_calificacion` date DEFAULT NULL COMMENT 'Fecha de la calificacion',
  `fkID_envio` int(11) NOT NULL COMMENT 'Foranea del envio',
  `fkID_mensajero` int(11) NOT NULL COMMENT 'Foranea del mensajero',
  `fkID_cliente` int(11) NOT NULL COMMENT 'Foranea del cliente',
  `valor_calificacion` int(1) NOT NULL DEFAULT 0 COMMENT 'Valor de la calificacion',
  `observaciones_calificacion` longtext NOT NULL COMMENT 'Observaciones de la calificacion',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla para calificacion';

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`id_calificacion`, `estado_calificacion`, `fecha_calificacion`, `fkID_envio`, `fkID_mensajero`, `fkID_cliente`, `valor_calificacion`, `observaciones_calificacion`, `estado`) VALUES
(1, 1, '2022-01-05', 4, 2, 1, 4, '', 1),
(6, 0, NULL, 0, 2, 1, 0, '', 1),
(7, 1, '2022-01-05', 4, 2, 1, 4, '', 1),
(8, 1, '2022-01-06', 2, 2, 1, 5, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre`, `estado`) VALUES
(1, 'Bogotá D.C.', 1),
(2, 'Soacha', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL COMMENT 'Id del cliente',
  `nombres_cliente` varchar(50) NOT NULL COMMENT 'Nombres del cliente',
  `apellidos_cliente` varchar(50) NOT NULL COMMENT 'Apellidos del cliente',
  `ciudad_cliente` varchar(100) NOT NULL,
  `fkID_tipo_documento` int(1) NOT NULL COMMENT 'Foranea del tipo de documento',
  `documento_cliente` varchar(50) NOT NULL COMMENT 'Documento del cliente',
  `email_cliente` varchar(100) NOT NULL COMMENT 'Email del cliente',
  `celular_cliente` varchar(50) NOT NULL COMMENT 'Celular del cliente',
  `direccion_cliente` varchar(100) NOT NULL COMMENT 'Direccion del cliente',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de clientes';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres_cliente`, `apellidos_cliente`, `ciudad_cliente`, `fkID_tipo_documento`, `documento_cliente`, `email_cliente`, `celular_cliente`, `direccion_cliente`, `estado`) VALUES
(1, 'PEPITO', 'PEREZ', 'Bogotá D.C.', 1, '123', 'camibal1995@gmail.com', '300', 'CALLE 100', 1),
(2, 'PRUEBA', '', '', 0, '', 'CORREO4@GMAIL.COM', '4222', '', 2),
(3, 'pablos', 'marin', '', 1, '123', 'correo1@gmail.com', '321', 'calle 100', 2),
(4, 'JUAN CAMILO', 'GOMEZ ', '', 1, '10100555', 'CORREO3@GMAIL.COM.CO', '3002406185', 'CALLE 100 CON 15 36', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id_envio` int(11) NOT NULL COMMENT 'Id del envio',
  `numero_envio` varchar(50) NOT NULL COMMENT 'Numero del envio',
  `fecha_envio` date NOT NULL COMMENT 'Fecha del envio',
  `destinatario_envio` varchar(100) NOT NULL COMMENT 'Destinatario del envio',
  `celular_envio` varchar(50) NOT NULL COMMENT 'Celular del envio',
  `direccion_envio` varchar(100) NOT NULL COMMENT 'Direccion del envio',
  `email_envio` varchar(100) NOT NULL COMMENT 'Email del envio',
  `valor_envio` double NOT NULL COMMENT 'Valor del envio',
  `fkID_estado_envio` int(1) NOT NULL COMMENT 'Foranea del estado del envio',
  `fkID_cliente` int(11) NOT NULL COMMENT 'Foranea del cliente',
  `fkID_mensajero` int(11) NOT NULL COMMENT 'Foranea del mensajero',
  `observaciones_envio` longtext NOT NULL COMMENT 'Observaciones del envio',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de envio';

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id_envio`, `numero_envio`, `fecha_envio`, `destinatario_envio`, `celular_envio`, `direccion_envio`, `email_envio`, `valor_envio`, `fkID_estado_envio`, `fkID_cliente`, `fkID_mensajero`, `observaciones_envio`, `estado`) VALUES
(1, '222', '2022-01-04', 'juan perez', '321321', 'calle 100 con 15', 'correo@gmail.com.co', 200, 2, 1, 2, 'ok', 2),
(2, '333', '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 3, 1, 2, '', 1),
(3, '444', '2022-01-04', 'juans', '321321', 'calle 100 con 15', 'correo@gmail.com.co', 30000, 2, 1, 2, 'ok ok', 2),
(4, '6667', '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 4, 1, 2, '', 1),
(5, '444', '2022-01-05', 'JUAN', '321', 'CALLE 100', '', 9000, 4, 1, 2, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_envio`
--

CREATE TABLE `estado_envio` (
  `id_estado_envio` int(11) NOT NULL COMMENT 'Id del estado del envio',
  `nombre_estado_envio` varchar(50) NOT NULL COMMENT 'Nombre del estado del envio',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de estados del envio';

--
-- Volcado de datos para la tabla `estado_envio`
--

INSERT INTO `estado_envio` (`id_estado_envio`, `nombre_estado_envio`, `estado`) VALUES
(1, 'En bodega', 1),
(2, 'En camino', 1),
(3, 'Entregado', 1),
(4, 'Devuelto', 1),
(5, 'Anulado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_envio`
--

CREATE TABLE `historial_envio` (
  `id_historial_envio` int(11) NOT NULL COMMENT 'Id del historial_envio',
  `fkID_envio` int(11) NOT NULL COMMENT 'Foranea del envio',
  `fecha_historial` date NOT NULL COMMENT 'Fecha del historial_envio',
  `destinatario_historial` varchar(100) NOT NULL COMMENT 'Destinatario del historial_envio',
  `celular_historial` varchar(50) NOT NULL COMMENT 'Celular del historial_envio',
  `direccion_historial` varchar(100) NOT NULL COMMENT 'Direccion del historial_envio',
  `email_historial` varchar(100) NOT NULL COMMENT 'Email del historial_envio',
  `valor_historial` double NOT NULL COMMENT 'Valor del historial_envio',
  `fkID_estado_envio` int(1) NOT NULL COMMENT 'Foranea del estado del historial_envio',
  `fkID_cliente` int(11) NOT NULL COMMENT 'Foranea del cliente',
  `fkID_mensajero` int(11) NOT NULL COMMENT 'Foranea del mensajero',
  `observaciones_historial` longtext NOT NULL COMMENT 'Observaciones del historial_envio',
  `evidencia_historial` varchar(100) NOT NULL COMMENT 'Ruta de la evidencia del envio',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de historial_envio';

--
-- Volcado de datos para la tabla `historial_envio`
--

INSERT INTO `historial_envio` (`id_historial_envio`, `fkID_envio`, `fecha_historial`, `destinatario_historial`, `celular_historial`, `direccion_historial`, `email_historial`, `valor_historial`, `fkID_estado_envio`, `fkID_cliente`, `fkID_mensajero`, `observaciones_historial`, `evidencia_historial`, `estado`) VALUES
(1, 222, '2022-01-04', 'juan perez', '321321', 'calle 100 con 15', 'correo@gmail.com.co', 200, 2, 1, 2, 'ok', '', 1),
(2, 1, '2022-01-04', 'juan perez', '321321', 'calle 100 con 15', 'correo@gmail.com.co', 200, 2, 1, 2, 'ok', '', 1),
(3, 2, '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 1, 1, 0, '', '', 1),
(4, 2, '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 2, 1, 2, '', '', 1),
(5, 3, '2022-01-04', 'juan', '321', 'calle 100', 'correo@gmail.com', 2000, 1, 1, 0, 'ok', '', 1),
(6, 3, '2022-01-04', 'juans', '321321', 'calle 100 con 15', 'correo@gmail.com.co', 30000, 2, 1, 2, 'ok ok', '', 1),
(7, 2, '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 3, 1, 2, '', '', 1),
(8, 2, '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 3, 1, 2, '', '929c5c3714325b8782b40532c55f077a26f6d0b6.jpeg', 1),
(9, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 1, 1, 0, '', '', 1),
(10, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 1, 1, 2, '', '', 1),
(11, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 2, 1, 2, '', '', 1),
(12, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 3, 1, 2, '', '', 1),
(13, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 4, 1, 2, '', '', 1),
(14, 4, '2022-01-04', 'PILAR', '32131131231', 'CALLE 100 CON 14', '', 29000, 3, 1, 2, '', '', 1),
(15, 2, '2022-01-04', 'JULIANA', '3213211871', 'CALLE 5TA', '', 20000, 3, 1, 2, '', '', 1),
(16, 5, '2022-01-05', 'JUAN', '321', 'CALLE 100', '', 9000, 1, 1, 2, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajero`
--

CREATE TABLE `mensajero` (
  `id_mensajero` int(11) NOT NULL COMMENT 'Id del mensajero',
  `nombres_mensajero` varchar(50) NOT NULL COMMENT 'Nombres del mensajero',
  `apellidos_mensajero` varchar(50) NOT NULL COMMENT 'Apellidos del mensajero',
  `fkID_tipo_documento` int(1) NOT NULL COMMENT 'Foranea del tipo de documento',
  `documento_mensajero` varchar(50) NOT NULL COMMENT 'Documento del mensajero',
  `celular_mensajero` varchar(50) NOT NULL COMMENT 'Celular del mensajero',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de mensajeros';

--
-- Volcado de datos para la tabla `mensajero`
--

INSERT INTO `mensajero` (`id_mensajero`, `nombres_mensajero`, `apellidos_mensajero`, `fkID_tipo_documento`, `documento_mensajero`, `celular_mensajero`, `estado`) VALUES
(1, 'nombres', 'apellidos', 4, '123456', '321123', 2),
(2, 'pablo', 'ortiz', 1, '123', '3213211871', 1),
(3, 'mensajeros', 'perezs', 4, '123456', '321321', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL COMMENT 'Id del modulo',
  `nombre_modulo` varchar(50) NOT NULL COMMENT 'Nombre del modulo',
  `nombre_icono` varchar(50) NOT NULL COMMENT 'Nombre del icono del menu',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del modulo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla para los modulos';

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre_modulo`, `nombre_icono`, `estado`) VALUES
(1, 'Clientes', 'fas fa-user-friends', 1),
(2, 'Mensajeros', 'fas fa-motorcycle', 1),
(3, 'Envios', 'fas fa-box-open', 1),
(4, 'Informes', 'fas fa-chart-bar', 1),
(5, 'Listados', 'fas fa-list-ul', 1),
(6, 'Usuarios', 'far fa-user-circle', 1),
(7, 'Mis envios', 'fas fa-box-open', 1),
(8, 'Calificaciones', 'fas fa-star', 1),
(9, 'Pedidos', 'fas fa-box-open', 1),
(10, 'Guias', 'fas fa-file-contract', 1),
(11, 'Caja', 'fas fa-coins', 1),
(12, 'Base', 'fas fa-coins', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `id_movimiento` int(11) NOT NULL COMMENT 'Id del movimiento',
  `fecha_movimiento` date NOT NULL COMMENT 'Fecha del movimiento',
  `fkID_tipo_movimiento` int(1) NOT NULL COMMENT 'Tipo del movimiento',
  `valor_movimiento` double NOT NULL COMMENT 'Valor del movimiento',
  `observaciones_movimiento` longtext NOT NULL COMMENT 'Observaciones del movimiento',
  `fkID_usuario` int(11) NOT NULL COMMENT 'Foranea del usuario',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de movimientos';

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`id_movimiento`, `fecha_movimiento`, `fkID_tipo_movimiento`, `valor_movimiento`, `observaciones_movimiento`, `fkID_usuario`, `estado`) VALUES
(1, '2022-01-07', 2, 10000, 'Lapices rojos', 1, 1),
(2, '2022-01-07', 2, 9000, 'undefined', 0, 2),
(3, '2022-01-07', 1, 80000, 'envio no 153', 0, 1),
(4, '2022-01-07', 2, 9000, 'tajalapices', 0, 1),
(5, '2022-01-11', 2, 10000, 'BOLSAS', 0, 1),
(6, '2022-01-11', 1, 1000, 'DONACION', 0, 1),
(7, '2022-01-11', 3, 90000, 'ok', 0, 2),
(8, '2022-01-11', 3, 9000, '', 0, 1),
(9, '2022-01-11', 3, 9000, '', 0, 1),
(10, '2022-01-11', 3, 9000, '', 0, 1),
(11, '2022-01-11', 4, 900, '', 0, 2),
(12, '2022-01-11', 3, 9000, '', 0, 1),
(13, '2022-01-11', 4, 9000, '', 0, 1),
(14, '2022-01-11', 3, -7000, '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL COMMENT 'Id del permiso',
  `fkID_rol` int(1) NOT NULL COMMENT 'Foranea del rol',
  `fkID_modulo` int(11) NOT NULL COMMENT 'Foreanea del modulo',
  `consultar` int(1) NOT NULL COMMENT 'Si se puede ver o no',
  `crear` int(1) NOT NULL COMMENT 'Permisos para crear',
  `editar` int(1) NOT NULL COMMENT 'Permisos para editar',
  `eliminar` int(1) NOT NULL COMMENT 'Permisos para eliminar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `fkID_rol`, `fkID_modulo`, `consultar`, `crear`, `editar`, `eliminar`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 5, 1, 1, 1, 1),
(6, 1, 6, 1, 1, 1, 1),
(8, 4, 9, 1, 1, 1, 1),
(9, 5, 7, 1, 1, 1, 1),
(10, 5, 8, 1, 1, 1, 1),
(11, 2, 1, 1, 1, 1, 1),
(12, 2, 2, 1, 1, 1, 1),
(13, 2, 3, 1, 1, 1, 1),
(14, 2, 4, 1, 1, 1, 1),
(15, 2, 5, 1, 1, 1, 1),
(16, 2, 6, 1, 1, 1, 1),
(17, 3, 1, 1, 1, 1, 1),
(18, 3, 2, 1, 1, 1, 1),
(19, 3, 3, 1, 1, 1, 1),
(20, 3, 4, 1, 1, 1, 1),
(21, 3, 5, 1, 1, 1, 1),
(22, 1, 7, 1, 1, 1, 1),
(23, 1, 8, 1, 1, 1, 1),
(24, 1, 9, 1, 1, 1, 1),
(25, 5, 10, 1, 1, 1, 1),
(26, 2, 11, 1, 1, 1, 1),
(27, 3, 11, 1, 1, 1, 1),
(28, 2, 12, 1, 1, 1, 1),
(29, 1, 12, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(1) NOT NULL COMMENT 'Id del rol',
  `nombre_rol` varchar(50) NOT NULL COMMENT 'Nombre del rol',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de los roles';

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `estado`) VALUES
(1, 'Soporte', 1),
(2, 'Superadministrador', 1),
(3, 'Administrador', 1),
(4, 'Mensajero', 1),
(5, 'Cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(1) NOT NULL COMMENT 'Id del tipo de documento',
  `nombre_tipo_documento` varchar(50) NOT NULL COMMENT 'Nombre del tipo de documento',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de tipo de documento';

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `nombre_tipo_documento`, `estado`) VALUES
(1, 'Cedula de ciudadanía', 1),
(2, 'NIT', 1),
(3, 'Tarjeta de identidad', 1),
(4, 'Cedula de extranjeria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_tipo_movimiento` int(1) NOT NULL COMMENT 'Id del tipo de movimiento',
  `nombre_tipo_movimiento` varchar(50) NOT NULL COMMENT 'Nombre del tipo de movimiento',
  `orden_tipo_movimiento` int(1) NOT NULL COMMENT 'Orden del tipo de movimiento',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tablas de los tipos de movimiento';

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_tipo_movimiento`, `nombre_tipo_movimiento`, `orden_tipo_movimiento`, `estado`) VALUES
(1, 'Ingreso', 2, 1),
(2, 'Egreso', 3, 1),
(3, 'Ajuste', 4, 1),
(4, 'Base', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(2000) NOT NULL,
  `fkID_usuario` int(250) NOT NULL,
  `estado` int(1) NOT NULL,
  `fecha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `fkID_usuario`, `estado`, `fecha`) VALUES
(1, 'FbxA1ASmSGoLMlfr0UsUuqhLOzpCUjhQg7Y/DGljPZs=', 3, 0, '18-02-2022');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL COMMENT 'Id del usuario',
  `nombres_usuario` varchar(100) NOT NULL COMMENT 'Nombre del usuario',
  `apellidos_usuario` varchar(100) NOT NULL COMMENT 'Apellidos del usuario',
  `email_usuario` varchar(100) NOT NULL COMMENT 'es el email del usuario',
  `fkID_rol` int(1) NOT NULL COMMENT 'Foranea del rol',
  `fkID_tipo_documento` int(1) NOT NULL COMMENT 'Foranea del tipo de documento',
  `documento_usuario` int(11) NOT NULL COMMENT 'Documento del usuario',
  `nickname_usuario` varchar(100) NOT NULL COMMENT 'Nickname del usuario',
  `pass_usuario` varchar(100) NOT NULL COMMENT 'Password del usuario',
  `fkID_cliente` int(11) NOT NULL COMMENT 'Foranea del cliente',
  `fkID_mensajero` int(11) NOT NULL COMMENT 'Foranea del mensajero',
  `foto_usuario` varchar(100) NOT NULL COMMENT 'Ruta de la foto \r\n del usuario',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado en sistema del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabla de usuarios';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `email_usuario`, `fkID_rol`, `fkID_tipo_documento`, `documento_usuario`, `nickname_usuario`, `pass_usuario`, `fkID_cliente`, `fkID_mensajero`, `foto_usuario`, `estado`) VALUES
(1, 'alejo', 'marin', '', 1, 1, 123, 'soporte', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, '', 2),
(2, 'soporte', '', '', 1, 1, 1010191, 'soporte', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, '6a8b00922539ed92a7ff0b922e92ecc4ff1c49b8.png', 1),
(3, 'CLIENTEs', 'marins', 'camibal1995@gmail.com', 3, 4, 123123, 'clientes', '8cb2237d0679ca88db6464eac60da96345513964', 1, 0, 'ecdae97bc67fb8235d856978a9c2caf2039865ad.png', 1),
(4, 'super', 'admin', '', 2, 1, 123, 'superadministrador', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, '6f21b2676f00de84056daa492850468d60958189.png', 1),
(5, 'Cliente', '', '', 5, 1, 321, 'cliente', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 0, 'f25b8104b7327a2e461d6543b13b073c6f266b76.png', 1),
(6, 'mensajero', '', '', 4, 1, 321, 'mensajero', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 2, 'c1b91d2221bd81c4072e9e3a9413b7e77f66abc9.jpeg', 1),
(7, 'administrador', '', '', 3, 1, 444, 'administrador', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 4, 0, '03e4650b9b189120e714a54a87960b65d179f9b2.png', 1),
(8, 'jennifer', 'torres', '', 3, 1, 123, 'mosquito', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, 0, '4f931fefd890584ae6bc829956b6bd6a0e6240ee.jpg', 2),
(9, 'a', '', '', 3, 1, 0, 'ss', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 3, 0, '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_calificacion`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `estado_envio`
--
ALTER TABLE `estado_envio`
  ADD PRIMARY KEY (`id_estado_envio`);

--
-- Indices de la tabla `historial_envio`
--
ALTER TABLE `historial_envio`
  ADD PRIMARY KEY (`id_historial_envio`);

--
-- Indices de la tabla `mensajero`
--
ALTER TABLE `mensajero`
  ADD PRIMARY KEY (`id_mensajero`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_tipo_movimiento`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la calificacion', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del cliente', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del envio', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_envio`
--
ALTER TABLE `estado_envio`
  MODIFY `id_estado_envio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del estado del envio', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial_envio`
--
ALTER TABLE `historial_envio`
  MODIFY `id_historial_envio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del historial_envio', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mensajero`
--
ALTER TABLE `mensajero`
  MODIFY `id_mensajero` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del mensajero', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del modulo', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del movimiento', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del permiso', AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Id del rol', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de documento', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id_tipo_movimiento` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de movimiento', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del usuario', AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
