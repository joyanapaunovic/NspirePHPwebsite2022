-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 04:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nspire`
--

-- --------------------------------------------------------

--
-- Table structure for table `baner`
--

CREATE TABLE `baner` (
  `id_baner_slika` int(3) NOT NULL,
  `naziv_baner` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datum_dodavanja` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `baner`
--

INSERT INTO `baner` (`id_baner_slika`, `naziv_baner`, `datum_dodavanja`) VALUES
(1, 'baner.jpg', '2022-04-01 17:49:25'),
(2, 'baner2.jpg', '2022-04-01 17:49:25'),
(3, 'baner3.jpg', '2022-04-01 17:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `brend`
--

CREATE TABLE `brend` (
  `id_brend` int(3) NOT NULL,
  `naziv_brend` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brend`
--

INSERT INTO `brend` (`id_brend`, `naziv_brend`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Puma'),
(4, 'Reebok'),
(5, 'Champion'),
(6, 'Ellesse'),
(7, 'Skechers'),
(8, 'New Balance');

-- --------------------------------------------------------

--
-- Table structure for table `instagram_slike`
--

CREATE TABLE `instagram_slike` (
  `id_slika_ig` int(3) NOT NULL,
  `ig_slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naziv_objava` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instagram_slike`
--

INSERT INTO `instagram_slike` (`id_slika_ig`, `ig_slika`, `naziv_objava`) VALUES
(1, 'nike-court-borough-low-patike.jpg', 'PATIKE'),
(2, 'decision-hat.jpg', 'KAČKETI'),
(3, 'nike-sweatshirt.jpg', 'DUKSEVI'),
(4, 'nike-brasilia-torba.jpg', 'TORBE'),
(5, 'ring-sport-teg.jpg', 'OPREMA'),
(6, 'nike-premier-league-pitch-third-lopta.jpg', 'LOPTE');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorija` int(3) NOT NULL,
  `naziv_kategorija` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorija`, `naziv_kategorija`) VALUES
(1, 'Muškarci'),
(2, 'Žene'),
(3, 'Deca');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_podkategorija`
--

CREATE TABLE `kategorija_podkategorija` (
  `id_kategorija` int(3) NOT NULL,
  `id_podkategorija` int(3) NOT NULL,
  `id_proizvod` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorija_podkategorija`
--

INSERT INTO `kategorija_podkategorija` (`id_kategorija`, `id_podkategorija`, `id_proizvod`) VALUES
(2, 1, 1),
(1, 1, 2),
(2, 1, 5),
(1, 1, 6),
(3, 1, 7),
(2, 3, 8),
(2, 1, 9),
(3, 1, 11),
(2, 1, 12),
(1, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(255) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default-avatar.jpg',
  `telefon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_uloga` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `ime`, `prezime`, `email`, `lozinka`, `avatar`, `telefon`, `ulica`, `datum`, `id_uloga`) VALUES
(1, 'Jovana', 'Paunović', 'admin@gmail.com', '917eb5e9d6d6bca820922a0c6f7cc28b', 'default-avatar.jpg', '+381 611234567', 'Zdravka Čelara 16', '2022-05-21 09:12:44', 1),
(2, 'Petar', 'Petrović', 'pera.peric_123@hotmail.com', 'd34754a88e3384944d4bb4ab25fb5bdf', 'default-avatar.jpg', '+381 6123234564', 'Zdravka Čelara 10', '2022-05-21 09:22:11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id_korpa` int(255) NOT NULL,
  `id_korisnik` int(255) NOT NULL,
  `kolicina` int(50) NOT NULL,
  `id_velicina` int(3) NOT NULL,
  `id_proizvod` int(255) NOT NULL,
  `cena_porudzbine` decimal(10,2) NOT NULL,
  `datum_porudzbine` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id_korpa`, `id_korisnik`, `kolicina`, `id_velicina`, `id_proizvod`, `cena_porudzbine`, `datum_porudzbine`) VALUES
(1, 2, 4, 5, 12, '5803.25', '2022-05-29 10:52:10'),
(2, 2, 1, 4, 6, '15737.70', '2022-05-29 10:53:42'),
(3, 2, 1, 2, 9, '6489.78', '2022-05-29 11:01:39'),
(4, 2, 1, 3, 9, '6489.78', '2022-05-29 11:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `navigacija`
--

CREATE TABLE `navigacija` (
  `id_navigacija` int(3) NOT NULL,
  `ime_linka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigacija`
--

INSERT INTO `navigacija` (`id_navigacija`, `ime_linka`, `link`) VALUES
(1, 'Početna', 'index.php'),
(2, 'Muškarci', 'index.php?page=muskarci&idKategorija=1'),
(3, 'Žene', 'index.php?page=zene&idKategorija=2'),
(4, 'Deca', 'index.php?page=deca&idKategorija=3'),
(5, 'Registracija', 'index.php?page=registracija');

-- --------------------------------------------------------

--
-- Table structure for table `podkategorija`
--

CREATE TABLE `podkategorija` (
  `id_podkategorija` int(3) NOT NULL,
  `naziv_podkategorija` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `podkategorija`
--

INSERT INTO `podkategorija` (`id_podkategorija`, `naziv_podkategorija`) VALUES
(1, 'Odeća'),
(2, 'Obuća'),
(3, 'Aksesoari');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `id_proizvod` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `stara_cena` decimal(10,2) DEFAULT NULL,
  `sifra` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `id_brend` int(3) NOT NULL,
  `id_slika` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`id_proizvod`, `naziv`, `cena`, `stara_cena`, `sifra`, `id_brend`, `id_slika`) VALUES
(1, 'ESSENTIALS FLEECE 3-STRIPES FULL-ZIP HOODIE', '4158.18', '5864.10', 'T1', 2, 1),
(2, 'Nike Dri-FIT', '2789.70', NULL, 'M1', 1, 2),
(5, 'ADIDAS SPORTSWEAR FUTURE ICONS 3-STRIPES HOODED TR', '5722.86', '6823.41', 'D1', 2, 3),
(6, 'Men\'s Pullover Hoodie', '15407.70', NULL, 'D2', 1, 5),
(7, 'Summer Roar Logo Girls\' Tee', '2201.10', NULL, 'M2', 3, 6),
(8, 'MYT Backpack', '3298.35', '4402.20', 'R1', 4, 7),
(9, 'Nike Yoga Luxe Women\'s Textured Cover-Up', '6159.78', '9904.95', 'D3', 1, 8),
(11, 'BIG KIDS\' CLASSIC TEE, WAVY BOX SCRIPT', '985.19', '1532.51', 'M8', 5, 16),
(12, 'Catic 1/2 Zip Track Top Light Grey', '5473.25', '6899.99', 'E1', 6, 17),
(13, 'Classics Men\'s Logo Hoodie FL', '6567.90', NULL, 'P3', 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `id_slika` int(3) NOT NULL,
  `manja_slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `veca_slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`id_slika`, `manja_slika`, `veca_slika`) VALUES
(1, 'women-adidas-thumb.jpg', 'women-adidas.jpg'),
(2, 'men-nike.jpg', 'men-nike.jpg'),
(3, 'women-sportswear-adidas-thumbnail.jpg', 'women-sportswear-adidas.jpg'),
(4, 'nike-sportswear-kids-thumbnail.png', 'nike-sportswear-kids.png'),
(5, 'men-sportswear-adidas-thumbnail.png', 'men-sportswear-adidas.png'),
(6, 'puma-sportswear-kids-thumbnail.png', 'puma-sportswear-kids.png'),
(7, 'backpack-reebok-thumbnail.jpg', 'backpack-reebok.jpg'),
(8, 'nike-yoga-luxe-thumbnail.png', 'nike-yoga-luxe.png'),
(16, '1653752082_champion-kids-tshirt-thumbnail.jpg', '1653752082_champion-kids-tshirt.jpg'),
(17, '1653752837_ellesse-women-thumbnail.jpg', '1653752837_ellesse-women.jpg'),
(18, '1653753431_puma-men-thumbnail.jpg', '1653753431_puma-men.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(3) NOT NULL,
  `naziv_uloga` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv_uloga`) VALUES
(1, 'admin'),
(2, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `velicina`
--

CREATE TABLE `velicina` (
  `id_velicina` int(11) NOT NULL,
  `naziv_velicina` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `id_podkategorija` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velicina`
--

INSERT INTO `velicina` (`id_velicina`, `naziv_velicina`, `id_podkategorija`) VALUES
(1, 'XS', 1),
(2, 'S', 1),
(3, 'M', 1),
(4, 'L', 1),
(5, 'XL', 1),
(6, 'XXL', 1),
(7, '36', 2),
(8, '37', 2),
(9, '38', 2),
(10, '39', 2),
(11, '40', 2),
(12, '41', 2),
(13, '42', 2),
(14, '43', 2),
(15, 'Univerzalno', 3);

-- --------------------------------------------------------

--
-- Table structure for table `velicina_proizvod`
--

CREATE TABLE `velicina_proizvod` (
  `id_velicina` int(3) NOT NULL,
  `id_proizvod` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `velicina_proizvod`
--

INSERT INTO `velicina_proizvod` (`id_velicina`, `id_proizvod`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(3, 1),
(6, 1),
(1, 2),
(2, 2),
(4, 2),
(6, 2),
(3, 5),
(4, 5),
(2, 5),
(3, 6),
(5, 6),
(4, 6),
(2, 7),
(1, 7),
(15, 8),
(5, 9),
(2, 9),
(3, 9),
(4, 9),
(1, 11),
(2, 12),
(3, 12),
(5, 12),
(3, 13),
(4, 13),
(5, 13),
(6, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baner`
--
ALTER TABLE `baner`
  ADD PRIMARY KEY (`id_baner_slika`);

--
-- Indexes for table `brend`
--
ALTER TABLE `brend`
  ADD PRIMARY KEY (`id_brend`);

--
-- Indexes for table `instagram_slike`
--
ALTER TABLE `instagram_slike`
  ADD PRIMARY KEY (`id_slika_ig`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indexes for table `kategorija_podkategorija`
--
ALTER TABLE `kategorija_podkategorija`
  ADD KEY `id_kategorija` (`id_kategorija`),
  ADD KEY `id_podkategorija` (`id_podkategorija`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_uloga` (`id_uloga`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id_korpa`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_velicina` (`id_velicina`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- Indexes for table `navigacija`
--
ALTER TABLE `navigacija`
  ADD PRIMARY KEY (`id_navigacija`);

--
-- Indexes for table `podkategorija`
--
ALTER TABLE `podkategorija`
  ADD PRIMARY KEY (`id_podkategorija`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`id_proizvod`),
  ADD KEY `id_brend` (`id_brend`),
  ADD KEY `id_slika` (`id_slika`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`id_slika`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `velicina`
--
ALTER TABLE `velicina`
  ADD PRIMARY KEY (`id_velicina`),
  ADD KEY `id_kategorija` (`id_podkategorija`);

--
-- Indexes for table `velicina_proizvod`
--
ALTER TABLE `velicina_proizvod`
  ADD KEY `id_velicina` (`id_velicina`),
  ADD KEY `id_proizvod` (`id_proizvod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baner`
--
ALTER TABLE `baner`
  MODIFY `id_baner_slika` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brend`
--
ALTER TABLE `brend`
  MODIFY `id_brend` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instagram_slike`
--
ALTER TABLE `instagram_slike`
  MODIFY `id_slika_ig` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorija` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id_korpa` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `navigacija`
--
ALTER TABLE `navigacija`
  MODIFY `id_navigacija` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `podkategorija`
--
ALTER TABLE `podkategorija`
  MODIFY `id_podkategorija` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `id_proizvod` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `id_slika` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `velicina`
--
ALTER TABLE `velicina`
  MODIFY `id_velicina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategorija_podkategorija`
--
ALTER TABLE `kategorija_podkategorija`
  ADD CONSTRAINT `kategorija_podkategorija_ibfk_1` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija` (`id_kategorija`),
  ADD CONSTRAINT `kategorija_podkategorija_ibfk_2` FOREIGN KEY (`id_podkategorija`) REFERENCES `podkategorija` (`id_podkategorija`),
  ADD CONSTRAINT `kategorija_podkategorija_ibfk_3` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id_uloga`);

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`),
  ADD CONSTRAINT `korpa_ibfk_2` FOREIGN KEY (`id_velicina`) REFERENCES `velicina` (`id_velicina`),
  ADD CONSTRAINT `korpa_ibfk_4` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_ibfk_2` FOREIGN KEY (`id_brend`) REFERENCES `brend` (`id_brend`),
  ADD CONSTRAINT `proizvod_ibfk_3` FOREIGN KEY (`id_slika`) REFERENCES `slika` (`id_slika`);

--
-- Constraints for table `velicina`
--
ALTER TABLE `velicina`
  ADD CONSTRAINT `velicina_ibfk_1` FOREIGN KEY (`id_podkategorija`) REFERENCES `podkategorija` (`id_podkategorija`);

--
-- Constraints for table `velicina_proizvod`
--
ALTER TABLE `velicina_proizvod`
  ADD CONSTRAINT `velicina_proizvod_ibfk_1` FOREIGN KEY (`id_velicina`) REFERENCES `velicina` (`id_velicina`),
  ADD CONSTRAINT `velicina_proizvod_ibfk_2` FOREIGN KEY (`id_proizvod`) REFERENCES `proizvod` (`id_proizvod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
