CREATE TABLE `Usuarios` (
  `ID_Usuario` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre` varchar(50),
  `Apellidos` varchar(100),
  `Correo` varchar(100) UNIQUE,
  `Username` varchar(50),
  `Contraseña` varchar(100),
  `Fecha_Registro` datetime
);

CREATE TABLE `Deportes` (
  `ID_Deporte` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Deporte` varchar(50)
);

CREATE TABLE `Actividades` (
  `ID_Actividad` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Actividad` varchar(100),
  `Tipo_Deporte` int,
  `Ubicacion` varchar(255),
  `Fecha` datetime,
  `Nivel_Dificultad` varchar(50),
  `Numero_Participantes` int,
  `Creador` int,
  `Estado` varchar(20)
);

CREATE TABLE `Ubicaciones` (
  `ID_Ubicacion` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Ubicacion` varchar(100),
  `Direccion` varchar(255),
  `Latitud` decimal(10,8),
  `Longitud` decimal(11,8)
);

CREATE TABLE `Roles_Usuarios` (
  `ID_Rol` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Rol` varchar(50)
);

CREATE TABLE `Historial_Sesiones` (
  `ID_Sesion` int PRIMARY KEY AUTO_INCREMENT,
  `ID_Usuario` int,
  `Fecha_Inicio` datetime,
  `Fecha_Fin` datetime,
  `IP_Acceso` varchar(45)
);

CREATE TABLE `Categorias_Actividades` (
  `ID_Categoria` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Categoria` varchar(50),
  `Descripcion` text
);

CREATE TABLE `Comentarios` (
  `ID_Comentario` int PRIMARY KEY AUTO_INCREMENT,
  `ID_Usuario` int,
  `ID_Actividad` int,
  `Texto_Comentario` text,
  `Fecha_Comentario` datetime
);

CREATE TABLE `Preferencias_Notificacion` (
  `ID_Preferencia` int PRIMARY KEY AUTO_INCREMENT,
  `ID_Usuario` int,
  `Tipo_Notificacion` varchar(50),
  `Activo` boolean
);

CREATE TABLE `Historial_Actividades` (
  `ID_Historial` int PRIMARY KEY AUTO_INCREMENT,
  `ID_Actividad` int,
  `ID_Usuario` int,
  `Estado_Participacion` varchar(20),
  `Fecha_Participacion` datetime
);

CREATE TABLE `Niveles_Dificultad` (
  `ID_Dificultad` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Dificultad` varchar(50),
  `Descripcion` text
);

CREATE TABLE `Tags` (
  `ID_Tag` int PRIMARY KEY AUTO_INCREMENT,
  `Nombre_Tag` varchar(50)
);

CREATE TABLE `Actividad_Tags` (
  `ID_Actividad` int,
  `ID_Tag` int
);

CREATE UNIQUE INDEX `Actividad_Tags_index_0` ON `Actividad_Tags` (`ID_Actividad`, `ID_Tag`);

ALTER TABLE `Actividades` ADD FOREIGN KEY (`Tipo_Deporte`) REFERENCES `Deportes` (`ID_Deporte`);

ALTER TABLE `Actividades` ADD FOREIGN KEY (`Creador`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Historial_Sesiones` ADD FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Comentarios` ADD FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Comentarios` ADD FOREIGN KEY (`ID_Actividad`) REFERENCES `Actividades` (`ID_Actividad`);

ALTER TABLE `Preferencias_Notificacion` ADD FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Historial_Actividades` ADD FOREIGN KEY (`ID_Actividad`) REFERENCES `Actividades` (`ID_Actividad`);

ALTER TABLE `Historial_Actividades` ADD FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Actividad_Tags` ADD FOREIGN KEY (`ID_Actividad`) REFERENCES `Actividades` (`ID_Actividad`);

ALTER TABLE `Actividad_Tags` ADD FOREIGN KEY (`ID_Tag`) REFERENCES `Tags` (`ID_Tag`);
