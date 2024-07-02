SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

-- tabulka registrovaných uživatelů
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

-- vložení základních uživatelů pro test / administraci
INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1,	'jv',	'jvtest'),
(2,	'Mike',	'theone'),
(3,	'Nemo',	  'alreadyfound');

-- tabulka playlistů
DROP TABLE IF EXISTS `playlists`;
CREATE TABLE `playlists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `album` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `listened` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`username`) REFERENCES `users` (`username`)
);
