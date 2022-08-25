-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2022 a las 05:10:14
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projectapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `ACC_ID` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `ACC_NOMBRE` varchar(200) NOT NULL,
  `ACC_PAGINA` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`ACC_ID`, `id_rol`, `ACC_NOMBRE`, `ACC_PAGINA`) VALUES
(0, 0, 'Registrar citas', 'registrar'),
(1, 0, 'Citas registradas', 'mostrar'),
(2, 0, 'Modificar citas', 'modificar'),
(4, 1, 'Mostrar Citas', 'citasdoctor'),
(5, 1, 'Asignar Medicamento', 'asignar'),
(6, 0, 'Historial', 'historial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `nombre`) VALUES
(1, 'Odontología'),
(2, 'Fisioterapia'),
(3, 'Obstetricia'),
(4, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(30) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_doctor` int(11) DEFAULT NULL,
  `id_disponibilidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_cita`
--

CREATE TABLE `disponibilidad_cita` (
  `id_disponibilidad` int(11) NOT NULL,
  `id_turno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disponibilidad_cita`
--

INSERT INTO `disponibilidad_cita` (`id_disponibilidad`, `id_turno`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `id_doctor` int(11) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_especialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`id_doctor`, `disponibilidad`, `id_usuario`, `id_area`, `id_especialidad`) VALUES
(10, 1, 10, 3, 3),
(59, 1, 59, 1, 1),
(60, 1, 60, 1, 1),
(61, 1, 61, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `nombre`) VALUES
(1, 'Odontólogo'),
(2, 'Fisioteraopeuta'),
(3, 'Obstetra'),
(4, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_receta` int(11) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `id_cita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `url` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(0, 'P'),
(1, 'D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `hora_inicio`, `hora_final`) VALUES
(1, '07:00:00', '07:30:00'),
(2, '07:30:00', '08:00:00'),
(3, '08:00:00', '08:30:00'),
(4, '08:30:00', '09:00:00'),
(5, '09:00:00', '09:30:00'),
(6, '09:30:00', '10:00:00'),
(7, '10:00:00', '10:30:00'),
(8, '10:30:00', '11:00:00'),
(9, '11:00:00', '11:30:00'),
(10, '11:30:00', '12:00:00'),
(11, '13:00:00', '13:30:00'),
(12, '13:30:00', '14:00:00'),
(13, '14:00:00', '14:30:00'),
(14, '14:30:00', '15:00:00'),
(15, '15:00:00', '15:30:00'),
(16, '15:30:00', '16:00:00'),
(17, '16:00:00', '16:30:00'),
(18, '16:30:00', '17:00:00'),
(19, '17:00:00', '17:30:00'),
(20, '17:30:00', '18:00:00'),
(21, '18:00:00', '18:30:00'),
(22, '18:30:00', '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha` date DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `user_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `cedula`, `email`, `nombres`, `apellidos`, `fecha`, `ciudad`, `sexo`, `password`, `imagen`, `user_rol`) VALUES
(7, '2450110859', 'paciente@gmail.com', 'Bryan', 'Soria', '2002-08-07', 'La libertad', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/1.jpeg', 0),
(10, '123456', 'doctor@gmail.com', 'Juan', 'Piguave', '1992-08-07', 'La libertad', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/2.jpeg', 1),
(59, '131313', 'odontologo1@gmail.com', 'Daniel', 'Rosales', '1989-05-01', 'Quito', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/11.jpeg', 1),
(60, '13271', 'odontologo2@gmail.com', 'Ariel', 'Borbor', '1995-05-21', 'Guayaquil', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/5.jpeg', 1),
(61, '13271', 'fisio@gmail.com', 'Bacilio', 'Espinoza', '1980-05-21', 'Guayaquil', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/7.jpeg', 1),
(62, '13271', 'fisio2@gmail.com', 'Diego', 'Soria', '1988-11-08', 'Guayaquil', 'Masculino', '123456', 'https://rickandmortyapi.com/api/character/avatar/9.jpeg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`ACC_ID`),
  ADD KEY `fk_idAcc` (`id_rol`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_disponibilidad` (`id_disponibilidad`),
  ADD KEY `cita_ibfk_2` (`id_doctor`),
  ADD KEY `idd` (`id_usuario`);

--
-- Indices de la tabla `disponibilidad_cita`
--
ALTER TABLE `disponibilidad_cita`
  ADD PRIMARY KEY (`id_disponibilidad`),
  ADD KEY `id_turno` (`id_turno`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id` (`id_cita`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_receta` (`id_receta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `user_rol` (`user_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT de la tabla `disponibilidad_cita`
--
ALTER TABLE `disponibilidad_cita`
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `fk_idAcc` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id_doctor`),
  ADD CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`id_disponibilidad`) REFERENCES `disponibilidad_cita` (`id_disponibilidad`),
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `disponibilidad_cita`
--
ALTER TABLE `disponibilidad_cita`
  ADD CONSTRAINT `disponibilidad_cita_ibfk_1` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `doctor_ibfk_3` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `historial` (`id_receta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`user_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
