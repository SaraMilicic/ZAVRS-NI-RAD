-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 09, 2016 at 12:33 AM
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
(1, '2', '3', '4', 5, 1),
(123, '3', '3', '3', 3, 1),
(10000, 'Zagreb', 'Grad Zagreb, smješten na zemljopisnom, kulturnom, povijesnom i političkom sjecištu istoka i zapada Europe, glavni grad Hrvatske, spaja kontinentalni i mediteranski duh u osebujnu cjelinu. Zagreb je siguran velegrad otvorenih vrata, burne povijesti i zanimljivih ličnosti, koji srdačno poziva na upoznavanje i ispunjava očekivanja.', '', 1, 1),
(20000, 'Dubrovnik', 'Više od tisuću godina povijesti Dubrovnika prisutno je u svakom dijelu ovoga Grada koji je grad muzej i živa pozornica, idealan spoj povijesti i suvremenosti. Od 1979. godine Grad Dubrovnik je pod zaštitom UNESCO-a, kao skladna, visokovrijedna cjelina gradskih zidina, povijesnih građevina,ulica, trgova i brojnih spomenika sakralne i svjetovne arhitekture.', '', 1, 1),
(31000, 'Osijek', 'Naš „Grad na Dravi“ ime je dobio od riječi oseka, četvrti je u Hrvatskoj s oko 100.000 stanovnika te je kulturno, gospodarsko i znanstveno središte regije Slavonije i Baranje. Osijek je smješten na tek 20 km od ušća Drave s Dunavom, na samoj sredini njegova 2850 km dugog toka od njemačkog Schwartzwalda do Crnog mora. U ovome dijelu europskog Podunavlja susreću se hrvatska i stara austro-ugarska baština što ćete najprije primijetiti po arhitekturi te bogatim običajima i gastronomiji.', '', 1, 1),
(52210, 'Rovinj', 'Na predivnoj obali Istre, tik ispod Limskog kanala nalazi se najromantičnije mjesto na Mediteranu! Grad Rovinj pravo je odredište svih vas koji žudite za sentimentalnom atmosferom vremena koja su nepovratno prošla. Na Mediteranu je možete pronaći ovdje, u gradu koji je svoj romantični život započeo na otoku čiji je skučeni prostor uvjetovao gradnju zbijenih kuća, uskih ulica i malenih trgova, još i danas nedirnutih modernim urbanizmom.', '', 1, 1);

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
  `email` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Hotel Rovinj', 'Opis Hotela Rovinj', 5, 'Rovinjska 10', '', 52210, 1),
(2, 'Hotel Dubrovnik', 'Opis Hotela Dubrovnik', 5, 'Dubrovačka 10', '', 20000, 1),
(3, 'Hotel Zagreb', 'Opis Hotela Zagreb', 5, 'Zagrebačka 10', '', 10000, 1),
(4, 'Hotel Osijek', 'Opis Hotela Osijek', 5, 'Osječka 10', '', 31000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date_departure` date NOT NULL,
  `date_arrival` date NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_guest` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date_departure`, `date_arrival`, `id_room`, `id_guest`) VALUES
(1, '2016-08-22', '2016-08-23', 4, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `type`, `floor`, `price`, `image`, `id_hotel`) VALUES
(2, 'Dvokrevetna', 1, '1000.00', '', 1),
(3, 'Dvokrevetna', 1, '1000.00', '', 2),
(4, 'Dvokrevetna', 1, '1000.00', '', 3),
(5, 'Dvokrevetna', 1, '1000.00', '', 4),
(6, 'Dvokrevetna', 1, '1000.00', '', 3),
(7, 'Dvokrevetna', 1, '1000.00', '', 3);

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
(1, 'Hrvatska', '385', 0),
(2, 'Drzava', '123', 1),
(3, 'hr', '345', 0),
(4, '', '123', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `id_role`) VALUES
(3, 'test', 'test', 'test@test.hr', 2),
(4, 'sara', 'sara', 'sara@email.com', 2),
(5, 'test@test.hr', 'test', '2@t.hr', 2),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;