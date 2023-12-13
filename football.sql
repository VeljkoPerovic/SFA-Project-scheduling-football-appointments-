-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table football_balon.termin
CREATE TABLE IF NOT EXISTS `termin` (
  `termin_id` int(11) NOT NULL AUTO_INCREMENT,
  `teren_termina` varchar(50) NOT NULL,
  `datum_termina` varchar(10) NOT NULL,
  `vreme_termina` enum('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00') NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`termin_id`),
  CONSTRAINT `termin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table football_balon.termin: ~6 rows (approximately)
INSERT INTO `termin` (`termin_id`, `teren_termina`, `datum_termina`, `vreme_termina`, `user_id`) VALUES
	(181, 'Stadion(70m)', '27.11.2023', '18:00', 16),
	(182, 'Stadion(70m)', '30.11.2023', '12:00', 15),
	(190, 'Balon', '29.11.2023', '14:00', 34),
	(191, 'Balon', '29.11.2023', '15:00', 34),
	(192, 'Stadion(70m)', '29.11.2023', '13:00', 36),
	(193, 'Balon', '02.12.2023', '17:00', 36);

-- Dumping structure for table football_balon.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('korisnik','administrator') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table football_balon.users: ~23 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
	(12, 'velja', 'veljkoperovic0@gmail.com', '$2y$10$hht4Tj8Xy4A7cTMIDAdQWu49TpkSYTIAkoMiNs7SWK0J.bekR87/C', '2023-11-26 13:15:18', 'korisnik'),
	(13, 'VeljaNevolja', 'veljko.perovic.21@singimail.rs', '$2y$10$fPjC8LDxQmh7zJ9u9ixvYeLNOnDZ2LfK51ye0dJ6tUI2gXAPwkK62', '2023-11-26 13:17:27', 'korisnik'),
	(14, 'VeljaNevolja', 'veljkoperovic1@gmail.com', '$2y$10$Wl75Bfh72P/TrEC90CCLi.WYPBdMIAEumZecdZS.aQ/r1zNy15K16', '2023-11-26 13:19:12', 'korisnik'),
	(15, 'User', 'user1@gmail.com', '$2y$10$990NTSBuuyfg7EKiH2eIWuG08ZGWfamukpJh2xbPQMfqIPDasEWkG', '2023-11-26 13:27:25', 'administrator'),
	(16, 'user2', 'user2@gmail.com', '$2y$10$2CE2BgbVPxQjn.qc.CQG2uUFks7rvvjf1zqWvFn26XpfpsoCqwP7G', '2023-11-26 13:43:06', 'korisnik'),
	(17, 'User', 'user3@gmail.com', '$2y$10$OCEdvLlCNHmjSPgDr0kT8uKN14ShT1ciImo7Npy4ZxBIpf1q2zVzW', '2023-11-26 13:44:42', 'korisnik'),
	(18, 'user4', 'user4@gmail.com', '$2y$10$XKF1ZJd1Nk7Vv0kDGU3ZYuypI20dwt8GilQae/N5OvFaBjQN9LdR.', '2023-11-26 13:56:58', 'korisnik'),
	(19, 'user5', 'user5@gmail.com', '$2y$10$.pJn7RewjYy37ZZjcOtXpukQwullt0Rf1XEWPmiiSmCuoMy2w5Nkm', '2023-11-26 13:57:57', 'korisnik'),
	(20, 'user6', 'user6@gmail.com', '$2y$10$Vipx5.i6qhyLDFK1j5OMgej6fpG7XkOYwgIONrslJXYPYLjMvGnMe', '2023-11-26 13:59:24', 'korisnik'),
	(21, 'user7', 'user7@gmail.com', '$2y$10$u.CeSHSTJYS.cWhEOZLM3.8MEod0C68mESdqPyWhAJlL2mU1FNwdC', '2023-11-26 14:01:19', 'korisnik'),
	(22, 'user8', 'user8@gmail.com', '$2y$10$FVNhRQGD1OrZZFXoRWJg/OurisRBzvJG82zC8ToKS20zW0z2mkm5m', '2023-11-26 14:20:19', 'korisnik'),
	(23, 'delic', 'delic@gmail.com', '$2y$10$WzU77cKO.a.stEidEe6FT.NQJGcWBqmygENKdiDf30K9xouiX.Dha', '2023-11-26 14:34:52', 'korisnik'),
	(24, 'stefan', 'stefan@gmail.com', '$2y$10$fbqp8c/tZS5l8sjDe2ppruaylZPpVePDv2tvGAqEuXZEnA9Snf9W6', '2023-11-26 14:38:59', 'korisnik'),
	(25, 'coda', 'coda1@gmail.com', '$2y$10$Q0KIam46flBn6EWda7del.3r2mJexcug6Uy4HnA/HTkgmnXTjJQFe', '2023-11-26 15:06:33', 'korisnik'),
	(26, 'dabu', 'dabu@gmail.com', '$2y$10$ZUBq0ysSuVOJGbnYpQ0m3uNobNIyZ9sSExiRNgGesPhrroev27FnK', '2023-11-26 16:12:36', 'korisnik'),
	(27, 'user10', 'user10@gmail.com', '$2y$10$6kLOIcX9ikQF2sU/vvmttef8H/2vUedCKu0YDGzDAdpJ.5trxxA2a', '2023-11-26 19:06:14', 'korisnik'),
	(28, 'duka', 'duka1@gmail.com', '$2y$10$Y2uyNO1wrIvBW2dcYq6l1.Etflth/jjAvNNzaBw8F729N0bDY870q', '2023-11-26 19:40:32', 'korisnik'),
	(29, 'moma', 'moma@gmail.com', '$2y$10$yjt8uH4bcKn.BApMdDcsm.ypaX5QQhtcBu6xdNcM/rHK9R6Ehewja', '2023-11-26 19:47:48', 'korisnik'),
	(30, 'peca', 'pecalove@gmail.com', '$2y$10$.JS3BsBWf1U/1D1S8jhw5.5pV/4JYHyg77uDKihUTH57.SIK2ra9C', '2023-11-27 12:28:56', 'administrator'),
	(31, 'miki', 'miki@gmail.com', '$2y$10$3w34c1Ijx1B610VevDv/EeHwppPF8YChG.ToO5K1H2URVGHncGagS', '2023-11-27 13:27:32', 'korisnik'),
	(32, 'mikiA', 'mikiA@gmail.com', '$2y$10$VH/EopXFdgPQLsAC8NDkSOdva/uPyfgOZOn6b28pCgLeh48ws8Sy.', '2023-11-27 13:28:58', 'administrator'),
	(33, 'steva', '', '$2y$10$qFE8WEKTWtWJM1sPGoH2ZelDS7YeEWFfn8ifS9EK1OaBfUuukG7.m', '2023-11-27 13:43:09', 'korisnik'),
	(34, 'steva', 'steva@gmail.com', '$2y$10$D.FH/kgzcG.h2O2Fq5GtzuC.GHWYeHUZfoX5yjA52DcjyR02Tn9rK', '2023-11-27 13:43:32', 'administrator'),
	(35, 'anci', 'ana@gmail.com', '$2y$10$vGyjAQT5OINx565IOJq6AOnmP9I9t5t4TiSoWN3TYoQyRdPIFaRnC', '2023-11-27 22:29:20', 'korisnik'),
	(36, 'ana', 'ana1@gmail.com', '$2y$10$KmRfT3c47V3nugspZPbGqe61KQFVpoXAGZk8uV.cLMDc9nhhc0a/a', '2023-11-27 22:30:02', 'administrator');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
