-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-07-2016 a las 18:59:54
-- Versión del servidor: 10.0.26-MariaDB-1~trusty
-- Versión de PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `deluxer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_img_logo`
--

CREATE TABLE IF NOT EXISTS `app_img_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `app_img_logo`
--

INSERT INTO `app_img_logo` (`id`, `name`, `id_user`) VALUES
(17, '78616f542e32eabf5feb04b3c97e9b9e.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_login_attempts`
--

CREATE TABLE IF NOT EXISTS `app_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_modules`
--

CREATE TABLE IF NOT EXISTS `app_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `needlogin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `app_modules`
--

INSERT INTO `app_modules` (`id`, `name`, `url`, `icon`, `status`, `order`, `needlogin`) VALUES
(3, 'inicio', 'inicio', 'fa-home', 1, 1, 0),
(4, 'contacto', 'contacto', 'fa-home', 0, 4, 0),
(5, 'acerca de mi', 'acerca de mi', 'fa-home', 0, 5, 0),
(6, 'usuarios', 'usuarios', 'fa-users', 1, 6, 1),
(7, 'ajustes', 'ajustes', 'fa-cog', 1, 7, 1),
(8, 'articulos', 'articulos', 'fa-list-alt', 1, 8, 0),
(17, 'postear', 'postear', 'fa-chain-broken', 1, 14, 1),
(18, 'eventos', 'postear/eventos', 'fa-chain-broken', 0, 15, 1),
(19, 'perfil', 'perfil', 'fa-chain-broken', 1, 16, 1),
(22, 'redes sociales', 'ajustes/social', 'fa-coffee', 1, 19, 0),
(25, 'categorias', 'articulos/categorias', 'fa-list-alt', 1, 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_password`
--

CREATE TABLE IF NOT EXISTS `app_password` (
  `id_pass` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `fechaRegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_permissions`
--

CREATE TABLE IF NOT EXISTS `app_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `app_permissions`
--

INSERT INTO `app_permissions` (`id`, `role_id`, `data`) VALUES
(1, 2, 'a:8:{i:1;s:8:"usuarios";i:2;s:7:"ajustes";i:3;s:9:"articulos";i:4;s:7:"postear";i:0;s:20:"articulos/categorias";i:5;s:7:"postear";i:6;s:6:"perfil";i:7;s:14:"ajustes/social";}'),
(2, 3, 'a:4:{i:1;s:6:"inicio";i:2;s:9:"articulos";i:4;s:20:"articulos/categorias";i:3;s:6:"perfil";}'),
(3, 1, 'a:8:{i:1;s:8:"usuarios";i:0;s:6:"inicio";i:2;s:7:"ajustes";i:3;s:9:"articulos";i:4;s:10:"categorias";i:5;s:7:"postear";i:6;s:6:"perfil";i:7;s:14:"redes sociales";}'),
(4, 0, 'a:1:{i:4;s:7:"postear";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_roles`
--

CREATE TABLE IF NOT EXISTS `app_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `app_roles`
--

INSERT INTO `app_roles` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'Super'),
(2, 0, 'Administrador'),
(3, 0, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_sessions`
--

CREATE TABLE IF NOT EXISTS `app_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `app_sessions`
--

INSERT INTO `app_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('364bedf2b29f6440f785b57d91cbf3c4', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36', 1469404737, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '2',
  `role_id` int(11) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_pass` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_users_client`
--

CREATE TABLE IF NOT EXISTS `app_users_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `domain` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `newpass_time` datetime DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_pass` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `app_users_client`
--

INSERT INTO `app_users_client` (`id`, `id_user`, `role_id`, `username`, `password`, `domain`, `email`, `banned`, `ban_reason`, `newpass`, `newpass_key`, `newpass_time`, `last_ip`, `last_login`, `created`, `modified_pass`, `modified`, `activo`) VALUES
(1, 0, 2, 'gerardo', '$1$d9YOxbuq$ebPC/vQom6Aww/veUxP3f1', 'geradeluxer', 'gera@gera.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2016-07-24 18:23:16', '2016-07-20 23:07:39', '2016-07-20 23:07:39', '2016-07-24 23:23:16', 1),
(2, 0, 2, 'pedro', '$1$QYKYl6Hi$XZAm4MIYM9W.X6k4.IOio/', 'pedro', 'pedro@pedro.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 00:24:26', '2016-07-24 00:24:26', '2016-07-24 05:24:26', 1),
(3, 0, 2, 'rodio', '$1$Ed2jncIn$Cj4xNkaW6miTSQgZJIblw0', 'rocio', 'rocio@rocio.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 11:41:59', '2016-07-24 11:41:59', '2016-07-24 16:41:59', 1),
(4, 1, 3, 'saludos', '$1$0U8LqVIA$QYZ7Fgcnl1EGIk.tgqc761', 'geradeluxer', 'saludos@saludos.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 12:46:40', '2016-07-24 12:46:40', '2016-07-24 17:46:40', 1),
(5, 0, 2, 'gustavo', '$1$SSb1oxm5$ierlsukzH6xxinjRe98zC1', 'gustavo', 'gustavo@gustavo.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 12:53:12', '2016-07-24 12:53:12', '2016-07-24 17:53:12', 1),
(6, 0, 2, 'josefina', '$1$CZfRIyuG$C6eVNIwOv1cnW1bBg9rgC/', 'josefina', 'josefina@josefina.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 12:56:35', '2016-07-24 12:56:35', '2016-07-24 17:56:35', 1),
(7, 0, 2, 'alex', '$1$v9AaGMtI$XB/5nBZq.IEUG3cJ0MyjU.', 'alex', 'alex@alex.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2016-07-24 13:22:42', '2016-07-24 13:22:42', '2016-07-24 18:22:42', 1),
(8, 0, 2, 'pricila', '$1$YgTiTOJj$EjdvXYEU3S.ROsdYWyHUW1', 'GalletasPricila', 'pricila@pricila.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2016-07-24 13:31:23', '2016-07-24 13:30:57', '2016-07-24 13:30:57', '2016-07-24 18:31:23', 1),
(9, 0, 2, 'kika', '$1$5qqErnW3$uqpTeaFkOPr/FGAP/btIx.', 'kikapizas', 'kika@kika.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2016-07-24 13:59:44', '2016-07-24 13:59:34', '2016-07-24 13:59:34', '2016-07-24 18:59:44', 1),
(10, 0, 2, 'castillo', '$1$xOP0WAKC$Opzm8.tC8.BoiTFwRTc6i0', 'LonasCastill', 'castilo@castillo.com', 0, NULL, NULL, NULL, NULL, '127.0.0.1', '2016-07-24 14:02:34', '2016-07-24 14:02:13', '2016-07-24 14:02:13', '2016-07-24 19:02:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_autologin`
--

CREATE TABLE IF NOT EXISTS `app_user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_info`
--

CREATE TABLE IF NOT EXISTS `app_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `company` char(15) NOT NULL,
  `description` char(30) NOT NULL,
  `street` char(100) NOT NULL,
  `zip_code` char(100) NOT NULL,
  `colony` char(100) NOT NULL,
  `city` char(100) NOT NULL,
  `state` char(100) NOT NULL,
  `country` char(100) NOT NULL,
  `logo` char(100) NOT NULL,
  `registred_by` int(11) NOT NULL,
  `registred_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `app_user_info`
--

INSERT INTO `app_user_info` (`id`, `id_user`, `company`, `description`, `street`, `zip_code`, `colony`, `city`, `state`, `country`, `logo`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'Zapatos la past', 'Venta de zapatos la pastora', '', '', '', '', '', '', '78616f542e32eabf5feb04b3c97e9b9e.jpg', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 'Zapatos la past', 'Venta de zapatos la pastora', '', '', '', '', '', '', '78616f542e32eabf5feb04b3c97e9b9e.jpg', 1, '2016-07-20 11:07:39', 0, '0000-00-00 00:00:00'),
(3, 2, '', '', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 2, '', '', '', '', '', '', '', '', '', 2, '2016-07-24 12:24:27', 0, '0000-00-00 00:00:00'),
(5, 3, '', '', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 3, '', '', '', '', '', '', '', '', '', 3, '2016-07-24 11:42:00', 0, '0000-00-00 00:00:00'),
(7, 4, '', '', '', '', '', '', '', '', '', 4, '2016-07-24 12:46:40', 0, '0000-00-00 00:00:00'),
(8, 7, '', '', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 7, '', '', '', '', '', '', '', '', '', 7, '2016-07-24 01:22:42', 0, '0000-00-00 00:00:00'),
(10, 8, 'Galletas Pricil', 'Las mas ricas galletas', '', '', '', '', '', '', '', 8, '2016-07-24 01:30:57', 0, '0000-00-00 00:00:00'),
(11, 9, 'kika pizzas', 'El mejor sabor de pizzas', '', '', '', '', '', '', '', 9, '2016-07-24 01:59:35', 0, '0000-00-00 00:00:00'),
(12, 10, 'Lonas Castillo', 'Materiales Castillo', '', '', '', '', '', '', '', 10, '2016-07-24 02:02:13', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_profile`
--

CREATE TABLE IF NOT EXISTS `app_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `paterno` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `materno` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puesto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_profile_client`
--

CREATE TABLE IF NOT EXISTS `app_user_profile_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nombre` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `paterno` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `materno` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puesto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `app_user_profile_client`
--

INSERT INTO `app_user_profile_client` (`id`, `user_id`, `nombre`, `paterno`, `materno`, `puesto`, `telefono`, `imagen`) VALUES
(1, 1, '', '', '', '', '', '70aadad23eb8789a3fb5ad5fa16ec99b.jpg'),
(2, 2, '', '', '', '', '', NULL),
(3, 3, '', 'Rocio', 'Garcia Perez', 'Dueña', '0999999', NULL),
(4, 4, '', '', '', '', '', NULL),
(5, 5, '', '', '', '', '', NULL),
(6, 6, '', '', '', '', '', NULL),
(7, 7, '', '', '', '', '', NULL),
(8, 8, '', '', '', '', '', NULL),
(9, 9, '', '', '', '', '', NULL),
(10, 10, '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_profile_extra`
--

CREATE TABLE IF NOT EXISTS `app_user_profile_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `facebook` char(18) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` char(18) COLLATE utf8_unicode_ci NOT NULL,
  `google` char(18) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` char(18) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user_temp`
--

CREATE TABLE IF NOT EXISTS `app_user_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(34) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activation_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `registred_by` char(4) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` char(4) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `id_user`, `name`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'Mascotas', '1', '2016-07-21 10:20:44', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `registred_by` char(4) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` char(4) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments_response`
--

CREATE TABLE IF NOT EXISTS `comments_response` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `id_post` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `registred_by` int(11) DEFAULT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE IF NOT EXISTS `dependencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Dependencia` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`id`, `Dependencia`) VALUES
(1, 'itavu'),
(2, 'Tecnologico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `brandwather` varchar(100) NOT NULL,
  `id_imgpost` int(11) NOT NULL,
  `video` text NOT NULL,
  `urll` text NOT NULL,
  `create_by` varchar(4) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` varchar(4) NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_items`
--

CREATE TABLE IF NOT EXISTS `img_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_post`
--

CREATE TABLE IF NOT EXISTS `img_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `img_post`
--

INSERT INTO `img_post` (`id`, `name`, `id_post`) VALUES
(1, '34384cc524904cee5ac2e8f11574060a.jpg', 1),
(2, '45f9ccc128d3fe96307deb7937a0f8a7.jpg', 2),
(3, '83033b18434ef8acb4a254c76403eee6.jpg', 6),
(4, '7814cb902bf0922a8e838f0e4768cb14.jpg', 7),
(5, '10151c1379eb6988dcfbe7fc5ddd0687.jpg', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_profile`
--

CREATE TABLE IF NOT EXISTS `img_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `img_profile`
--

INSERT INTO `img_profile` (`id`, `id_user`, `name`) VALUES
(1, 1, '70aadad23eb8789a3fb5ad5fa16ec99b.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` char(11) NOT NULL,
  `oldprice` char(11) NOT NULL,
  `id_imgitem` int(11) NOT NULL,
  `video` text NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_by` varchar(4) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` varchar(4) NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypost`
--

CREATE TABLE IF NOT EXISTS `mypost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` char(11) NOT NULL,
  `oldprice` char(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_imgpost` int(11) NOT NULL,
  `video` text NOT NULL,
  `category` varchar(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `registred_by` int(11) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `mypost`
--

INSERT INTO `mypost` (`id`, `id_user`, `title`, `description`, `price`, `oldprice`, `stock`, `id_imgpost`, `video`, `category`, `type`, `registred_by`, `registred_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 'perriro', 'Cachorro SanBernardo', '2500', '', 0, 0, '', '1', 2, 1, '2016-07-23 13:33:34', 0, '0000-00-00 00:00:00'),
(2, 1, 'cachorro chihuahua', 'Lindo cachorro chihuahua de apenas 1 mes de nacio, muy barato', '1000', '', 0, 0, '', '1', 2, 1, '2016-07-23 13:57:43', 0, '0000-00-00 00:00:00'),
(3, 1, 'Tres niños migrantes mueren en naufragio en Chiapas', '&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Regeneraci&oacute;n, 23 de julio 2016.- Tres ni&ntilde;os salvadore&ntilde;os murieron luego de que la embarcaci&oacute;n en la que viajaban se volteara debido a las fuertes lluvias en Barra de San Jos&eacute;, ubicado en el municipio de Mazat&aacute;n, Chiapas, de acuerdo con un comunicado de la Procuradur&iacute;a General de Justicia del Estado.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Los menores eran transportados por traficantes en compa&ntilde;&iacute;a de su padre, quien logr&oacute; sobrevivir.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;En la b&uacute;squeda y localizaci&oacute;n de los cuerpos participaron elementos de la Secretar&iacute;a de la Marina, el Instituto Nacional de Migraci&oacute;n y autoridades locales.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;La Fiscal&iacute;a Especializada en Delitos Cometidos en Contra de Inmigrantes inici&oacute; las investigaciones correspondientes y los consulados acreditados de Centroam&eacute;rica en Tapachula est&aacute;n llevando a cabo la identificaci&oacute;n de las v&iacute;ctimas.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;&lt;span style=&quot;box-sizing: border-box; font-weight: 700;&quot;&gt;A continuaci&oacute;n el texto completo del comunicado:&lt;/span&gt;&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Investiga PGJE muerte de menores migrantes que viajaban a bordo de una embarcaci&oacute;n&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Tuxtla Guti&eacute;rrez, Chiapas.- La Procuradur&iacute;a General de Justicia del Estado (PGJE), inform&oacute; que dio inicio a las investigaciones en torno a la muerte de tres menores migrantes, originarios de El Salvador, quienes viajaban a bordo de una embarcaci&oacute;n en barra de San Jos&eacute; en el municipio de Mazat&aacute;n.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;El Ministerio P&uacute;blico investigador adscrito a la Fiscal&iacute;a Especializada en Delitos Cometidos en Contra de Inmigrantes dio inicio a la Carpeta de Investigaci&oacute;n correspondiente.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;De acuerdo a las primeras investigaciones, los menores viajaban acompa&ntilde;ados de su padre, quien logr&oacute; sobrevivir, luego que la embarcaci&oacute;n en la que eran transportados por traficantes de personas se volteara derivado a las fuertes lluvias.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Cabe se&ntilde;alar que, los Consulados acreditados de Centroam&eacute;rica en Tapachula est&aacute;n llevando a cabo la identificaci&oacute;n de las v&iacute;ctimas.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;En la b&uacute;squeda y localizaci&oacute;n de los cuerpos participaron elementos de la Procuradur&iacute;a de Chiapas, en coordinaci&oacute;n con la Secretar&iacute;a de la Marina, Secretar&iacute;a de Seguridad y Protecci&oacute;n Ciudadana (SSyPC), Secretar&iacute;a de Seguridad P&uacute;blica Municipal (SSPM) y el Instituto Nacional de Migraci&oacute;n (INM).&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;En este sentido, la Procuradur&iacute;a General de Justicia del Estado contin&uacute;a con el desahogo de las diligencias para dar con el paradero de los responsables, quienes ser&aacute;n llevados ante la justicia.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: border-box; margin: 0px 0px 15px; font-family: arial; font-size: 16px; color: rgb(84, 84, 84); line-height: 24px;&quot;&gt;Informaci&oacute;n de Aristegui Noticias.&lt;/p&gt;\n', '', '', 0, 0, '<iframe width="560" height="315" src="https://www.youtube.com/embed/ZBm1zBhe1SY" frameborder="0" allowfullscreen></iframe>', '1', 1, 1, '2016-07-23 14:56:21', 0, '0000-00-00 00:00:00'),
(4, 1, 'Tres niños migrantes mueren en naufragio en Chiapas', '&lt;p&gt;&lt;iframe allowfullscreen=&quot;&quot; frameborder=&quot;0&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/ZBm1zBhe1SY&quot; width=&quot;560&quot;&gt;&lt;/iframe&gt;&lt;/p&gt;\n', '', '', 0, 0, '', '1', 1, 1, '2016-07-23 15:47:22', 0, '0000-00-00 00:00:00'),
(5, 1, 'mi video', '&lt;p&gt;&lt;iframe allowfullscreen=&quot;&quot; frameborder=&quot;0&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/jv-21ksttRQ&quot; width=&quot;560&quot;&gt;&lt;/iframe&gt;&lt;/p&gt;\n', '', '', 0, 0, '<iframe width="560" height="315" src="https://www.youtube.com/embed/jv-21ksttRQ" frameborder="0" allowfullscreen></iframe>', '1', 1, 1, '2016-07-23 16:33:49', 0, '0000-00-00 00:00:00'),
(6, 1, 'Casa nueva de 2 pisos', 'En Fraccionamineto Del Valle San Pedro Garza Garcia', '1000000', '', 0, 0, '', '1', 2, 1, '2016-07-23 16:49:57', 0, '0000-00-00 00:00:00'),
(7, 1, 'Ciclo de vida de un egresado universitario: Desde que finaliza la carrera y hasta que se convierte e', '&lt;h2 style=&quot;box-sizing: inherit; clear: both; color: rgb(0, 0, 0); font-family: Exo, sans-serif;&quot;&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/deluxer/application/assets/application/img/post/post_1/7814cb902bf0922a8e838f0e4768cb14.jpg&quot; style=&quot;width: 627px; height: 363px;&quot; /&gt;&lt;/h2&gt;\n\n&lt;h2 style=&quot;box-sizing: inherit; clear: both; color: rgb(0, 0, 0); font-family: Exo, sans-serif;&quot;&gt;El tr&aacute;gico ciclo god&iacute;nez&lt;/h2&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-Octavo semestre de la carrera:&lt;/strong&gt;&amp;nbsp;El universitario le echa todas las ganas a las pr&aacute;cticas profesionales y se deja&amp;nbsp;&lt;em style=&quot;box-sizing: inherit;&quot;&gt;negrear&lt;/em&gt;&amp;nbsp;pensando que &ldquo;se va a quedar a laborar en la empresa&rdquo; y que har&aacute; un trabajo espectacular, sin embargo al final lo ponen de &ldquo;YVM&rdquo; (&lt;i style=&quot;box-sizing: inherit;&quot;&gt;ve y traime esto, ve y traime (sic) lo otro&lt;/i&gt;). No lo contratan como pensaba porque el siguiente semestre llegan nuevos estudiantes igual de ilusionados que &eacute;l, los cuales tambi&eacute;n trabajar&aacute;n&amp;nbsp;gratis.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-Inmediatamente despu&eacute;s de egresar:&lt;/strong&gt;&amp;nbsp;El ex universitario se mete a &ldquo;OCC&rdquo; y &ldquo;Compu Trabajo&rdquo; a buscar empleo (solo que ahora en la secci&oacute;n de &ldquo;trabajos de tiempo completo&rdquo; en vez de &ldquo;pr&aacute;cticas&rdquo;). Su primer empleo es muy parecido al de las pr&aacute;cticas con la diferencia de que le pagan (menos del salario m&iacute;nimo, pero le pagan). El egresado sube 1000 fotos a Facebook en su oficina&amp;nbsp;&lt;a href=&quot;http://eldeforma.com/2015/09/28/godinez-lleva-vida-mas-plena-gracias-su-equipo-fantasy-de-la-nfl/&quot; style=&quot;box-sizing: inherit; color: rgb(14, 157, 87); background-color: transparent;&quot;&gt;para presumirle a todos su nuevo y primer empleo &ldquo;formal&rdquo;.&lt;/a&gt;&lt;/p&gt;\n\n&lt;div class=&quot;ym&quot; id=&quot;ym_1125346643267663945&quot; style=&quot;box-sizing: inherit; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 1.5em;&quot;&gt;&amp;nbsp;&lt;/div&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-6 meses despu&eacute;s de egresar:&lt;/strong&gt;&amp;nbsp;El ex universitario se cansa y decide buscar un trabajo &ldquo;mejor y en donde le paguen m&aacute;s&rdquo;, sin embargo termina en otra empresa exactamente igual. &Eacute;l y sus ex compa&ntilde;eros se van rolando de compa&ntilde;&iacute;as y todos terminan trabajando en los mismos lugares (se repite el ciclo entre 2 y 3 veces m&aacute;s).&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-2 a&ntilde;os despu&eacute;s de egresar:&lt;/strong&gt;&amp;nbsp;El egresado decide &ldquo;probar suerte&rdquo; y poner un negocio propio. El negocio fracasa. Su familia y amigos (incluso gente que esta peor que &eacute;l) le empiezan a decir que &ldquo;se deje de payasadas&rdquo; y comience a buscar un trabajo con estabilidad laboral.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-2 a&ntilde;os y medio despu&eacute;s:&lt;/strong&gt;&amp;nbsp;Acepta un trabajo horrible (donde se siente asfixiado) &ldquo;para ganar experiencia&rdquo;, En este ciclo llega a aguantar 1 o 2 a&ntilde;os. Se percata que sus compa&ntilde;eros de trabajo son infelices pero fingen vivir una vida plena porque tienen prestaciones, le da un miedo terrible terminar as&iacute; por lo que decide renunciar.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-4 a&ntilde;os y medio despu&eacute;s:&lt;/strong&gt;&amp;nbsp;sigue soportando las presiones de sus padres y amigos (que tienen un trabajo estable pero est&aacute;n amargados) de buscar un empleo con IMSS, Afore, aguinaldo, etc. La personas hace caso omiso hasta que ya no tiene para comer, por lo que decide &ldquo;buscar un trabajo que mas o menos le guste&rdquo; en lo que ahorra algo.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-5 a&ntilde;os despu&eacute;s:&lt;/strong&gt;&amp;nbsp;el sujeto es infeliz pero se ha acostumbrado al trabajo (ya personaliz&oacute; su cub&iacute;culo). Comienza a tener dinero el cual gasta el fin de semana (ya que entre semana se la pasa 10 horas en la oficina). Analiza su situaci&oacute;n y se compara con gente desempleada y llega a la conclusi&oacute;n que&lt;a href=&quot;http://eldeforma.com/2015/09/16/godinez-se-sienten-raros-de-ver-la-championsleague-por-tv-y-se-preparan-para-sintonizarla-en-sus-computadoras/&quot; style=&quot;box-sizing: inherit; color: rgb(14, 157, 87); background-color: transparent;&quot;&gt;&amp;nbsp;&ldquo;igual no esta tan mal su situaci&oacute;n&rdquo;.&lt;/a&gt;&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-6 a&ntilde;os despu&eacute;s de egresar:&lt;/strong&gt;&amp;nbsp;La persona se ha acostumbrado a tener una estabilidad econ&oacute;mica y poco a poco va abandonando sus sue&ntilde;os de ser un famoso&lt;i style=&quot;box-sizing: inherit;&quot;&gt;&amp;nbsp;rockero&lt;/i&gt;&amp;nbsp;o un visionario director de cine.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-8 a&ntilde;os despu&eacute;s:&lt;/strong&gt;&amp;nbsp;El individuo embaraza a su novia &ldquo;por error&rdquo; as&iacute; que deciden juntar sus puntos de INFONAVIT para formar un hogar. Sabe que no hay marcha atr&aacute;s y deber&aacute; esforzarse para que su hijo no sufra carencias. Incluso agradece tener IMSS ya que as&iacute; su mujer tuvo un lugar &ldquo;seguro&rdquo; para&amp;nbsp;&lt;i style=&quot;box-sizing: inherit;&quot;&gt;aliviarse&lt;/i&gt;.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-10 a&ntilde;os despu&eacute;s:&lt;/strong&gt;&amp;nbsp;El sujeto ya&lt;span class=&quot;TextRun SCX201929029&quot; style=&quot;box-sizing: inherit;&quot; xml:lang=&quot;ES-ES&quot;&gt;&amp;nbsp;est&aacute; en su fase final de&lt;/span&gt;&amp;nbsp;transformaci&oacute;n god&iacute;nez. Est&aacute; conforme con tener un trabajo estable (el cual odiaba al principio pero con el que ya aprendi&oacute; a lidiar). La persona pone todas sus esperanzas en su hijo para que sea &ldquo;lo que &eacute;l no pudo ser&rdquo; y asegura que lo educar&aacute; &ldquo;para que se convierta en todo un triunfador&rdquo;.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&lt;strong style=&quot;box-sizing: inherit;&quot;&gt;-11 a&ntilde;os despu&eacute;s:&lt;/strong&gt;&amp;nbsp;El egresado ya olvid&oacute; por completo los sue&ntilde;os que ten&iacute;a (igual todav&iacute;a conserva un vago recuerdo). Su vida ahora se resume en&amp;nbsp;&lt;i style=&quot;box-sizing: inherit;&quot;&gt;tuppers&lt;/i&gt;&amp;nbsp;con comida, oficina de 10 am a 8 pm de lunes a s&aacute;bado, prestaciones, aguinaldo, una semana de vacaciones al a&ntilde;o (m&aacute;s un d&iacute;a adicional por cada 12 meses), etc. El alguna vez universitario con ilusiones ahora esta totalmente transformado en una de las tantas variedades God&iacute;nez que existen (todas m&iacute;as, matado, pap&aacute; God&iacute;nez, God&iacute;nez amargado, huev&oacute;n,&lt;i style=&quot;box-sizing: inherit;&quot;&gt;&amp;nbsp;chicharachero&lt;/i&gt;, etc.)&lt;/p&gt;\n', '', '', 0, 0, '', '1', 1, 1, '2016-07-24 10:08:02', 0, '0000-00-00 00:00:00'),
(8, 1, '6 pokemones mexicanos para el Pokémon GO', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/deluxer/application/assets/application/img/post/post_1/10151c1379eb6988dcfbe7fc5ddd0687.jpg&quot; style=&quot;width: 600px; height: 300px;&quot; /&gt;&lt;/p&gt;\n\n&lt;h2 style=&quot;box-sizing: inherit; clear: both; color: rgb(0, 0, 0); font-family: Exo, sans-serif;&quot;&gt;&iquest;Listos para ver como manchamos la imagen de AMLO?&lt;/h2&gt;\n\n&lt;div class=&quot;right_align&quot; style=&quot;box-sizing: inherit; float: right; padding: 10px; margin: 20px 0px 10px 10px; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&amp;nbsp;&lt;/div&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;Internet.- Han llegado a nuestro redacci&oacute;n fotos con la imagen de AMLO manchada.&lt;/p&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;Un sobre an&oacute;nimo con las iniciales &ldquo;M. del poder&rdquo; y &ldquo;Mafia del p.&rdquo; nos hizo llegar la evidencia para difundirla y perjudicar su movimiento.&lt;/p&gt;\n\n&lt;div class=&quot;ym&quot; id=&quot;ym_1125346643267663945&quot; style=&quot;box-sizing: inherit; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px; margin-bottom: 1.5em;&quot;&gt;&amp;nbsp;&lt;/div&gt;\n\n&lt;p style=&quot;box-sizing: inherit; margin-bottom: 1.5em; color: rgb(0, 0, 0); font-family: Exo, sans-serif; font-size: 16px; line-height: 24px;&quot;&gt;En un ejercicio de transparencia e informaci&oacute;n period&iacute;stica, compartimos las fotos que manchan la imagen de AMLO.&lt;/p&gt;\n', '', '', 0, 0, '', '1', 1, 1, '2016-07-24 11:25:59', 1, '2016-07-24 11:38:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mypost_addcar`
--

CREATE TABLE IF NOT EXISTS `mypost_addcar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purchase` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` char(11) NOT NULL,
  `oldprice` char(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_imgpost` int(11) NOT NULL,
  `category` varchar(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `registred_by` int(11) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_vars_system`
--

CREATE TABLE IF NOT EXISTS `_vars_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('bool','int','float','string','array') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'string',
  `name` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `registred_by` int(11) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
