-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 14, 2016 at 12:19 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `postal_code` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_state` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`postal_code`, `name`, `about`, `image`, `id_state`, `is_active`) VALUES
(10000, 'Zagreb', 'Grad Zagreb, smješten na zemljopisnom, kulturnom, povijesnom i političkom sjecištu istoka i zapada Europe, glavni grad Hrvatske, spaja kontinentalni i mediteranski duh u osebujnu cjelinu. Zagreb je siguran velegrad otvorenih vrata, burne povijesti i zanimljivih ličnosti, koji srdačno poziva na upoznavanje i ispunjava očekivanja.', 'zagreb1.jpg', 1, 1),
(20000, 'Dubrovnik', 'Više od tisuću godina povijesti Dubrovnika prisutno je u svakom dijelu ovoga Grada koji je grad muzej i živa pozornica, idealan spoj povijesti i suvremenosti. Od 1979. godine Grad Dubrovnik je pod zaštitom UNESCO-a, kao skladna, visokovrijedna cjelina gradskih zidina, povijesnih građevina,ulica, trgova i brojnih spomenika sakralne i svjetovne arhitekture.', 'dubrovnik.jpg', 1, 1),
(21000, 'Split', 'Punih 17 stoljeća traje priča o Splitu, još otkako je rimski car Dioklecijan odlučio baš na tom poluotoku blizu velikog rimskog grada Salone izgraditi palaču u kojoj bi u miru proveo posljednje godine svoga života. U tih 1700 godina Palača je polako postajala i postala grad, koji danas mami bogatom tradicijom, veličanstvenom poviješću, ljepotom prirodne i kulturne baštine.\r\nDioklecijanova palača i cijela povijesna jezgra Splita na spisku su svjetske baštine UNESCO - a još od 1979., i to ne samo zbog izvanredne očuvanosti same Palače, nego bar jednako zbog toga što Palača i njezin grad (ili grad i njegova Palača, kako vam drago) i dalje žive punim životom. U toj strukturi vidljivi su i još uvijek živi svi povijesni slojevi od starog Rima, preko srednjeg vijeka do danas. Šetnjom kroz drevni grad moguće je putovati kroz vrijeme, promatrati vrhunske primjere antičke arhitekture poput Peristila, srednjovjekovne romaničke crkvice i gotičke palače, renesansne portale plemićkih kuća, barokne fasade, sve do moderne arhitekture izvanredno uklopljene u bogatu baštinu.', 'split3.jpg', 1, 1),
(21220, 'Trogir', 'Trogir je smješten u centru Dalmacije, na istočnoj obali Jadranskog mora. Samo srce Trogira čini mali poluotok koji se pruža između kopna i obale otoka Čiovo. Trogir, malen grad s tek nekih 12.000 stanovnika čini centar ove regije koja pokriva oko 250km2. ', 'trogir.jpg', 1, 1),
(31000, 'Osijek', 'Naš „Grad na Dravi“ ime je dobio od riječi oseka, četvrti je u Hrvatskoj s oko 100.000 stanovnika te je kulturno, gospodarsko i znanstveno središte regije Slavonije i Baranje. Osijek je smješten na tek 20 km od ušća Drave s Dunavom, na samoj sredini njegova 2850 km dugog toka od njemačkog Schwartzwalda do Crnog mora. U ovome dijelu europskog Podunavlja susreću se hrvatska i stara austro-ugarska baština što ćete najprije primijetiti po arhitekturi te bogatim običajima i gastronomiji.', 'osijek.jpg', 1, 1),
(52100, 'Pula', 'Pula (tal. Pola, istrovenetski Poła, istriotski Puola, lat. Pietas Iulia, stariji hrv. čak. Pul,[2] slov. Pulj, njem. Polei), grad u Hrvatskoj. Najveći je grad Istarske županije, leži na jugozapadnom području istarskog poluotoka u dobro zaštićenom zaljevu.\r\n\r\nPoput ostatka regije poznata je po svojoj blagoj klimi, mirnome moru i netaknutoj prirodi. Grad ima dugu tradiciju vinarstva, ribarstva, brodogradnje i turizma, a ujedno je i tranzitna luka. Pula je administrativni centar Istre još od rimskoga doba.', 'pula.jpg', 1, 1),
(52210, 'Rovinj', 'Na predivnoj obali Istre, tik ispod Limskog kanala nalazi se najromantičnije mjesto na Mediteranu! Grad Rovinj pravo je odredište svih vas koji žudite za sentimentalnom atmosferom vremena koja su nepovratno prošla. Na Mediteranu je možete pronaći ovdje, u gradu koji je svoj romantični život započeo na otoku čiji je skučeni prostor uvjetovao gradnju zbijenih kuća, uskih ulica i malenih trgova, još i danas nedirnutih modernim urbanizmom.', 'rovinj1.jpg', 1, 1),
(52440, 'Poreč', 'U današnjem obliku osmislili su ga Rimljani prije dva tisućljeća, nakon što su pokorili starosjedioce Histre. Grad je najprije bio vojni logor, potom utvrđen grad, da bi prerastao u značajni upravni i gospodarski centar, zvan Colonia Iulia Parentium. Od 1267. godine, pa narednih pola milenija, Porečom gospodari Venecija, za kojom ostaju najljepše palače u gradu, 1363. nastaje gradski statut, a u 15. st. grade se, tada najsuvremenije, osebujne i do danas dobro očuvane istočne (kopnene) kule i zidine. Najznačajniji spomenik kulture ostavio nam je Bizant - Eufrazijevu baziliku s biskupijom iz 6. stoljeća.', 'porec.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `passport_number` varchar(20) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `first_name`, `last_name`, `passport_number`, `phone_number`, `email`) VALUES
(9, 'Sara', 'Miličić', '12345', '099123123123', 'sara.milicic@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `about` text NOT NULL,
  `category` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `about`, `category`, `address`, `image`, `postal_code`, `is_active`) VALUES
(1, 'Hotel Rovinj', 'Opis Hotela Rovinj', 5, 'Rovinjska 10', 'hotel-rovinj.jpg', 52210, 1),
(2, 'Hotel Dubrovnik', 'Opis Hotela Dubrovnik', 5, 'Dubrovačka 10', 'hotel-dubrovnik.jpg', 20000, 1),
(3, 'Hotel Zagreb', 'Opis Hotela Zagreb', 5, 'Zagrebačka 10', 'hotel-zagreb.jpg', 10000, 1),
(4, 'Hotel Osijek', 'Opis Hotela Osijek', 5, 'Osječka 10', 'hotel-osijek.jpg', 31000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date_arrival` date NOT NULL,
  `date_departure` date NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_guest` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date_arrival`, `date_departure`, `id_room`, `id_guest`, `id_user`) VALUES
(8, '2016-09-23', '2016-09-30', 3, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin_user'),
(2, 'base_user');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `floor` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `type`, `floor`, `price`, `image`, `id_hotel`) VALUES
(2, 'Dvokrevetna', 1, '1000.00', '', 1),
(3, 'Dvokrevetna', 1, '1000.00', '', 2),
(4, 'Dvokrevetna', 1, '1000.00', '', 3),
(5, 'Dvokrevetna', 1, '1000.00', '', 4),
(6, 'Dvokrevetna', 1, '3000.00', '', 3),
(7, 'Dvokrevetna', 1, '1000.00', '', 3),
(8, 'Dvokrevetna', 1, '2000.00', '', 2),
(9, 'Jednokrevetna', 2, '500.00', '', 1),
(10, 'Jednokrevetna', 3, '300.00', '', 2),
(11, 'Jednokrevetna', 2, '500.00', '', 1),
(12, 'Jednokrevetna', 3, '300.00', '', 2),
(13, 'Jednokrevetna', 5, '600.00', '', 3),
(14, 'Jednokrevetna', 1, '500.00', '', 4),
(15, 'Trokrevetna', 1, '1500.00', '', 1),
(16, 'Trokrevetna', 2, '1200.00', '', 2),
(17, 'Trokrevetna', 1, '1800.00', '', 3),
(18, 'Jednokrevetna', 1, '2500.00', '', 4),
(19, 'Trokrevetna', 1, '2500.00', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `country_code`, `is_active`) VALUES
(1, 'Hrvatska', '385', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `id_role`) VALUES
(3, 'test', 'test', 'test@test.hr', 2),
(6, 'admin', 'admin', 'admin@email.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`postal_code`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;