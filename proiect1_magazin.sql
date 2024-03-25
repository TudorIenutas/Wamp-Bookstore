-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2024 at 07:24 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proiect1_magazin`
--

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

DROP TABLE IF EXISTS `clienti`;
CREATE TABLE IF NOT EXISTS `clienti` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `client_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_pass` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_str` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_oras` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_tara` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_codpost` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_nrcard` int NOT NULL,
  `client_tipcard` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `client_dataexp` datetime NOT NULL,
  `acceptareemail` int NOT NULL,
  `client_nume` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `clienti`
--

INSERT INTO `clienti` (`client_id`, `client_username`, `client_pass`, `client_email`, `client_str`, `client_oras`, `client_tara`, `client_codpost`, `client_nrcard`, `client_tipcard`, `client_dataexp`, `acceptareemail`, `client_nume`) VALUES
(10, 'tudor', '$2y$10$NPTUDGErHbY.1NklwKEQsOAjppJc7lL2QVymFxilsQU/OjOaeptw2', 'tudor@gmail.com', 'Marului', 'Carei', 'Romania', '445100', 123456789, 'Visa', '2025-06-30 00:00:00', 1, 'Tudor'),
(13, 'Tudorel', '$2y$10$gIH0r0egS.baLEneoVAQx.YGMjTYQBidpAb8QosiBKkkaBlzgWMdy', 'tudor.ienutas@gmail.com', '', '', '', '', 0, '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `id_member` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=542 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `product_id`, `quantity`, `id_member`) VALUES
(541, 1, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `image` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `code`, `image`, `price`, `description`) VALUES
(1, 'Acolo unde canta racii - Delia Owens', 'wL95Awe6', 'carte1.png', 50.85, 'Cartea care a creat senzatie in intreaga lume si fenomenul care a cucerit mai mult de douasprezece milioane de cititori.\r\n\r\nCea mai importanta carte a deceniului pentru Business Insider, cartea #1 a anului si bestseller international #1.\r\n\r\nBestsellerul anului pentru The New York Times Book Review.\r\n\r\nAni de-a randul, Barkley Cove, un orasel linistit de pe coasta Carolinei de Nord, a fost bantuit de zvonuri nelamurite despre Fata Mlastinii. Asa se face ca, spre sfarsitul anului 1969, cand frumosul Chase Andrews este gasit mort, localnicii o banuiesc pe Kya Clark, cea pe care ei o numesc Fata Mlastinii. Insa Kya nu e cum umbla vorba.\r\n\r\nSensibila si inteligenta, ea a supravietuit ani in sir, singura, in pustietatea mlastinii, casa ei, gasind prieteni printre pescarusi si lectii de viata printre nisipuri. Si a venit vremea cand ea tanjeste dupa apropierea semenilor, dupa dragoste. Cand doi tineri din oras se lasa atrasi de frumusetea salbatica a fetei, Kya se simte tentata de perspectiva unei vieti noi, fara macar sa se gandeasca la ce-ar putea sa-i aduca viitorul.'),
(2, 'Atomic Habits - James Clear\r\n', 'aFDt3Ne7', 'carte2.png', 48.26, 'Schimbari mici, rezultate remarcabile.\r\n\r\nInspirandu-se din cele mai noi descoperiri din biologie, psihologie si neurostiinte, James Clear a conceput un ghid usor de asimilat, cu ajutorul caruia obiceiurile bune devin inevitabile, iar cele rele, imposibile.\r\n\r\nInvata:\r\n\r\nsa-ti construiesti un sistem pentru a deveni cu 1% mai bun in fiecare zi\r\nsa renunti la obiceiurile rele si sa le pastrezi pe cele bune\r\nsa eviti greselile comise in general de cei care incearca sa-si schimbe obiceiurile\r\nsa depasesti lipsa de motivatie si de vointa\r\nsa-ti dezvolti o identitate mai puternica si sa crezi in tine insuti\r\nsa-ti faci timp pentru noile obiceiuri (chiar si cand viata o ia razna)\r\nsa-ti concepi un mediu care sa favorizeze succesul\r\nsa faci schimbari mici, usoare, care ofera rezultate mari\r\nsa-ti revii atunci cand te abati de la drum\r\nsi, cel mai important, cum sa aplici aceste idei in viata reala\r\nsi multe altele.\r\nIndiferent daca e vorba de o echipa care incearca sa castige un campionat, o organizatie care spera sa redefineasca o industrie sau pur si simplu un om care vrea sa se lase de fumat, sa slabeasca, sa reduca stresul ori sa realizeze orice alt obiectiv, Atomic Habits este solutia.'),
(3, 'Un veac de singuratate - Gabriel Garcia Marquez', 'ViHdie5r', 'carte3.png', 25.00, 'Un veac de singuratate, capodopera care l-a propulsat pe Gabriel Garc&iacute;a M&aacute;rquez pe orbita celebritatii internationale si i-a adus premiul Nobel (1982), este, in opinia unanima a criticii - dupa Don Quijote de la Mancha, nemuritoarea creatie a lui Cervantes -, cel mai frumos roman de expresie spaniola din toate timpurile, asa cum marturiseste si Pablo Neruda care il numeste &bdquo;Don Quijote al timpului nostru&ldquo;. Istoria celor o suta de ani ai fabuloasei aventuri traite de cele sapte generatii ale familiei Buend&iacute;a, cu fanteziile, obsesiile, tragediile, pasiunile, disperarile si sperantele lor, este de fapt istoria miticului Macondo, intemeiat de patriarhul Jos&eacute; Arcadio Buend&iacute;a, teritoriu prodigios, unde fantasticul, irealul, se insinueaza adesea in realitate, miraculosul convietuind firesc cu viata de zi cu zi. insa intregul demers narativ sugereaza ideea ca Macondo nu se margineste la o arie concreta, istoria sa fiind de fapt istoria existentei umane, caci, asa cum arata autorul, &bdquo;mai curand decat un loc de pe lume, Macondo este o stare de spirit&ldquo;.'),
(6, 'Metamorfoza si alte povestiri - Franz Kafka', 'ginnhCd2', 'carte4.png', 30.00, 'Franz Kafka, reprezentant marcant al prozei moderne, a influentat puternic multi scriitori, de la existentialistii francezi la Salinger sau Saramago.\r\n\r\nEditia de fata reuneste cele mai cunoscute si mai reprezentative povestiri ale lui Franz Kafka. Personajele sale, victime ale unui univers ostil, absurd, traiesc drama imposibilitatii unei evadari, atit din propria conditie, cit si dintr-un spatiu concentrationar exterior. Fie ca sint incatusate in corpul unei ginganii inspaimintatoare, fie ca sint victime ale unui sistem opresiv, aceste personaje au in comun o vina tragica, la radacinile careia nu pot ajunge.'),
(7, 'Book', 'aaa', 'aaa', 30.00, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$VLIh8ByG8I5nodz0S5RQkOOCFUz/7Mz3ej1aF9cj/akbgNnpVrvBW', 'admin@gmail.com'),
(2, 'admin2', '$2y$10$fEJXycwkGgv48oL9CMgmYu0C1abDvYUTDmwaeldPxuwTu0r32xWAC', 'admin2@gmail.com'),
(3, 'admin3', '$2y$10$94QXGPa0eqLC0..M/XHqlulLjMX2waVSxWoPcGeskeDJdE1U9wu9m', 'admin3@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `clienti` (`client_id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
