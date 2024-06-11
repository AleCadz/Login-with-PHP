-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2024 a las 21:03:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `imgSrc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `type`, `active`, `phoneNumber`, `birthdate`, `RFC`, `imgSrc`) VALUES
(1, 'pepe', 'ce61649168c4550c2f7acab92354dc6e', 'pepe@gmail.com', 'a', 0, '+123456789', '2000-01-01', 'RFC1', 'pepe.jpg'),
(2, 'usuario2', '2e248e7a3b4fbaf2081b3dff10ee402b', 'usuario2@example.com', 'Tipo233', 0, '+987654321', '2001-02-02', 'RFC22', NULL),
(3, 'usuario3', '26a31a2a50b9c2d86f16a2a7749bf904', 'usuario3@example.com', 'Tipo3', 0, '+111222333', '1999-03-03', 'RFC3', NULL),
(4, 'usuario4', '040173afc2e9520e65a1773779691d3e', 'usuario4@example.com', 'Tipo1', 0, NULL, '1998-04-04', 'RFC4', NULL),
(5, 'usuario5', '02c33208e2385b501d3b9658dc93777b', 'usuario5@example.com', 'Tipo2', 0, '+444555666', '1997-05-05', 'RFC5', NULL),
(6, 'usuario6', 'd9180ed1b56e76418a28de83e0b9629f', 'usuario6@example.com', 'Tipo3', 0, '+777888999', '1996-06-06', 'RFC6', NULL),
(7, 'usuario7', 'abfce0ecd55a9245fc17c581039632fa', 'usuario7@example.com', 'Tipo1', 0, NULL, '1995-07-07', 'RFC7', NULL),
(8, 'usuario8', '7d347cf0ee68174a3588f6cba31b8a67', 'usuario8@example.com', 'Tipo2', 0, '+111222333', '1994-08-08', 'RFC8', NULL),
(9, 'usuario9', 'c2a16cdaf9bd2102d1d1e115c6bc2e00', 'usuario9@example.com', 'Tipo3', 0, '+444555666', '1993-09-09', 'RFC9', NULL),
(10, 'usuario10', '4ae95041d151e8997a3dde671bf8ae59', 'usuario10@example.com', 'Tipo1', 0, '+777888999', '1992-10-10', 'RFC10', NULL),
(11, 'Alejandro', '$2y$10$MDET6yFAO9rfpT2DB/UB7O2S4QDlwvp8yv28o/KUZ27x9ejg7jnAu', 'alejandrodelcastillodiaz@gmail.com', 'Admn', 1, '81 4334 6957', '2024-06-06', 'CADA020921HP9', NULL),
(12, 'jose', '$2y$10$yOy9CEOLOsIc7P06HAQmq.5l1Z8y6xfWi2KWIkYeHmldy9389bMY2', 'josemadero@gmail.com', 'Admin', 0, '8143346957', '2024-05-31', 'CADA020921HP9', NULL),
(13, 'Jose Madero Vizcaino', '$2y$10$DR2vH96jJED/McoSqeP4sOzJwiWonlfd0D86XQzPxpnMiPwpU9aVq', 'hola@gmail.com', 'Empleado', 1, '8133350923', '2024-06-25', 'CADA020921HP9', '../img/Jose Madero Vizcaino.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
