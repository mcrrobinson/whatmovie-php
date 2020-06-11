-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.169.0.177
-- Generation Time: Jun 09, 2020 at 09:21 PM
-- Server version: 5.7.16
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whatmovi_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_key`
--

CREATE TABLE `ac_key` (
  `ac_key` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_key`
--

INSERT INTO `ac_key` (`ac_key`) VALUES
('Fe2G#%C9=Un(8wKfd?EU6UVpB');

-- --------------------------------------------------------

--
-- Table structure for table `movieData`
--

CREATE TABLE `movieData` (
  `movieID` int(5) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `release_date` int(4) NOT NULL,
  `genre_id` varchar(10) NOT NULL,
  `popularity_rating` int(3) NOT NULL,
  `vote_average` int(255) NOT NULL,
  `vote_count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movieData`
--

INSERT INTO `movieData` (`movieID`, `movieName`, `release_date`, `genre_id`, `popularity_rating`, `vote_average`, `vote_count`) VALUES
(0, '', 0, '', 0, 0, 0),
(11, 'Star Wars', 1977, '', 44, 8, 11275),
(12, 'Finding Nemo', 2003, '', 23, 8, 11387),
(13, 'Forrest Gump', 1994, '', 24, 8, 13840),
(22, 'Pirates of the Caribbean: The Curse of the Black Pearl', 2003, '', 0, 0, 0),
(73, 'American History X', 1998, '', 20, 8, 5548),
(101, 'LÃ©on', 1995, '', 23, 8, 7277),
(105, 'Back to the Future', 1985, '', 21, 8, 10739),
(120, 'The Lord of the Rings: The Fellowship of the Ring', 2001, '', 0, 0, 0),
(121, 'The Lord of the Rings: The Two Towers', 2002, '', 0, 0, 0),
(122, 'The Lord of the Rings: The Return of the King', 2003, '', 39, 8, 12462),
(128, 'Princess Mononoke', 1997, '', 18, 8, 3553),
(129, 'Spirited Away', 2001, '', 26, 9, 6920),
(155, 'The Dark Knight', 2008, '', 35, 8, 17986),
(207, 'Dead Poets Society', 1989, '', 15, 8, 5496),
(238, 'The Godfather', 1972, '', 26, 9, 9457),
(240, 'The Godfather: Part II', 1974, '', 16, 9, 5511),
(272, 'Batman Begins', 2005, '', 0, 0, 0),
(278, 'The Shawshank Redemption', 1994, '', 28, 9, 12354),
(311, 'Once Upon a Time in America', 1984, '', 14, 8, 2125),
(346, 'Seven Samurai', 1954, '', 13, 8, 1414),
(389, '12 Angry Men', 1957, '', 17, 8, 3518),
(429, 'The Good, the Bad and the Ugly', 1966, '', 19, 8, 3849),
(497, 'The Green Mile', 1999, '', 23, 8, 7675),
(539, 'Psycho', 1960, '', 18, 8, 4554),
(550, 'Fight Club', 1999, '', 26, 8, 15413),
(567, 'Rear Window', 1954, '', 11, 8, 2753),
(585, 'Monsters, Inc.', 2001, '', 21, 8, 10608),
(597, 'Titanic', 1997, '', 0, 0, 0),
(598, 'City of God', 2002, '', 12, 8, 3155),
(599, 'Sunset Boulevard', 1950, '', 10, 8, 979),
(603, 'The Matrix', 1999, '', 0, 0, 0),
(637, 'Life Is Beautiful', 1997, '', 18, 8, 6799),
(672, 'Harry Potter and the Chamber of Secrets', 2002, '', 44, 8, 11554),
(673, 'Harry Potter and the Prisoner of Azkaban', 2004, '', 32, 8, 11369),
(674, 'Harry Potter and the Goblet of Fire', 2005, '', 31, 8, 10900),
(675, 'Harry Potter and the Order of the Phoenix', 2007, '', 34, 8, 10597),
(680, 'Pulp Fiction', 1994, '', 27, 8, 14288),
(769, 'GoodFellas', 1990, '', 21, 8, 5333),
(797, 'Persona', 1966, '', 10, 8, 684),
(895, 'Andrei Rublev', 1966, '', 9, 8, 256),
(901, 'City Lights', 1931, '', 11, 8, 821),
(914, 'The Great Dictator', 1940, '', 10, 8, 1383),
(975, 'Paths of Glory', 1957, '', 9, 8, 1100),
(1726, 'Iron Man', 2008, '', 0, 0, 0),
(1771, 'Captain America: The First Avenger', 2011, '', 0, 0, 0),
(1891, 'The Empire Strikes Back', 1980, '', 19, 8, 9445),
(3782, 'Ikiru', 1952, '', 6, 8, 373),
(4247, 'Scary Movie', 2000, '', 15, 6, 3151),
(10138, 'Iron Man 2', 2010, '', 0, 0, 0),
(10195, 'Thor', 2011, '', 0, 0, 0),
(10376, 'The Legend of 1900', 1998, '', 9, 8, 1064),
(10681, 'WALLÂ·E', 2008, '', 21, 8, 10620),
(11216, 'Cinema Paradiso', 1988, '', 13, 8, 1639),
(11324, 'Shutter Island', 2010, '', 18, 8, 12279),
(11659, 'The Best of Youth', 2003, '', 8, 8, 198),
(12444, 'Harry Potter and the Deathly Hallows: Part 1', 2010, '', 33, 8, 10582),
(12445, 'Harry Potter and the Deathly Hallows: Part 2', 2011, '', 38, 8, 11344),
(12477, 'Grave of the Fireflies', 1988, '', 1, 8, 1892),
(14160, 'Up', 2009, '', 0, 0, 0),
(14537, 'Harakiri', 1962, '', 8, 8, 231),
(16869, 'Inglourious Basterds', 2009, '', 30, 8, 11736),
(18148, 'Tokyo Story', 1953, '', 9, 8, 331),
(18491, 'Neon Genesis Evangelion: The End of Evangelion', 1997, '', 10, 8, 294),
(19404, 'Dilwale Dulhania Le Jayenge', 1995, '', 15, 9, 2010),
(19995, 'Avatar', 2009, '', 24, 7, 18137),
(20914, 'My Friends', 1975, '', 7, 8, 273),
(24428, 'The Avengers', 2012, '', 57, 8, 18658),
(26451, 'Investigation of a Citizen Above Suspicion', 1970, '', 8, 8, 219),
(27205, 'Inception', 2010, '', 30, 8, 21515),
(37257, 'Witness for the Prosecution', 1957, '', 10, 8, 487),
(49026, 'The Dark Knight Rises', 2012, '', 0, 0, 0),
(49051, 'The Hobbit: An Unexpected Journey', 2012, '', 0, 0, 0),
(68718, 'Django Unchained', 2012, '', 24, 8, 15355),
(68721, 'Iron Man 3', 2013, '', 0, 0, 0),
(70160, 'The Hunger Games', 2012, '', 0, 0, 0),
(76341, 'Mad Max: Fury Road', 2015, '', 0, 0, 0),
(99861, 'Avengers: Age of Ultron', 2015, '', 0, 0, 0),
(100402, 'Captain America: The Winter Soldier', 2014, '', 26, 8, 10753),
(101299, 'The Hunger Games: Catching Fire', 2013, '', 21, 7, 11002),
(102899, 'Ant-Man', 2015, '', 40, 7, 11661),
(106646, 'The Wolf of Wall Street', 2013, '', 0, 0, 0),
(118340, 'Guardians of the Galaxy', 2014, '', 49, 8, 17139),
(135397, 'Jurassic World', 2015, '', 0, 0, 0),
(150540, 'Inside Out', 2015, '', 0, 0, 0),
(157336, 'Interstellar', 2014, '', 36, 8, 17956),
(209112, 'Batman v Superman: Dawn of Justice', 2016, '', 0, 0, 0),
(238636, 'The Purge: Anarchy', 2014, '', 30, 7, 3598),
(244786, 'Whiplash', 2014, '', 37, 8, 7531),
(259316, 'Fantastic Beasts and Where to Find Them', 2016, '', 24, 7, 11851),
(263115, 'Logan', 2017, '', 0, 0, 0),
(265177, 'Mommy', 2014, '', 10, 8, 1315),
(271110, 'Captain America: Civil War', 2016, '', 0, 0, 0),
(281957, 'The Revenant', 2015, '', 18, 7, 10862),
(283995, 'Guardians of the Galaxy Vol. 2', 2017, '', 0, 0, 0),
(284052, 'Doctor Strange', 2016, '', 0, 0, 0),
(284053, 'Thor: Ragnarok', 2017, '', 71, 8, 11066),
(284054, 'Black Panther', 2018, '', 115, 7, 11782),
(286217, 'The Martian', 2015, '', 0, 0, 0),
(290098, 'The Handmaiden', 2016, '', 12, 8, 1121),
(293660, 'Deadpool', 2016, '', 27, 8, 19547),
(297761, 'Suicide Squad', 2016, '', 0, 0, 0),
(297762, 'Wonder Woman', 2017, '', 0, 0, 0),
(299536, 'Avengers: Infinity War', 2018, '', 0, 0, 0),
(313106, 'Doctor Who: The Day of the Doctor', 2013, '', 7, 8, 488),
(315635, 'Spider-Man: Homecoming', 2017, '', 41, 7, 11225),
(321612, 'Beauty and the Beast', 2017, '', 27, 7, 10882),
(324857, 'Spider-Man: Into the Spider-Verse', 2018, '', 225, 9, 2070),
(346364, 'It', 2017, '', 14, 7, 10708),
(372058, 'Your Name.', 2016, '', 27, 9, 3714),
(374430, 'Black Mirror: White Christmas', 2014, '', 9, 8, 778),
(398818, 'Call Me by Your Name', 2017, '', 19, 8, 4567),
(432517, 'Sherlock: The Final Problem', 2017, '', 8, 8, 644),
(452522, 'Twin Peaks', 1989, '', 10, 8, 263),
(455661, 'In a Heartbeat', 2017, '', 6, 8, 644),
(490132, 'Green Book', 2019, '', 83, 8, 2445),
(517814, 'Capernaum', 2018, '', 24, 8, 175);

-- --------------------------------------------------------

--
-- Table structure for table `userInfo`
--

CREATE TABLE `userInfo` (
  `id` int(11) NOT NULL,
  `movieID` int(5) NOT NULL,
  `movieRating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userInfo`
--

INSERT INTO `userInfo` (`id`, `movieID`, `movieRating`) VALUES
(64, 19404, 77),
(64, 278, 84),
(64, 238, 66),
(64, 372058, 96),
(64, 240, 65),
(64, 497, 67),
(64, 155, 74),
(64, 550, 63),
(64, 13, 84),
(64, 637, 50),
(64, 4247, 71),
(64, 238636, 76),
(64, 18491, 50),
(64, 346, 36),
(64, 11216, 70),
(64, 769, 71),
(64, 311, 91),
(64, 129, 50),
(64, 324857, 50),
(64, 680, 50),
(64, 122, 64),
(64, 0, 50),
(64, 539, 50),
(64, 389, 50),
(64, 12477, 69),
(64, 374430, 56),
(64, 3782, 62),
(64, 429, 71),
(64, 432517, 69),
(64, 313106, 100),
(64, 128, 79),
(64, 1891, 100),
(64, 37257, 50),
(101, 0, 68),
(64, 27205, 50),
(64, 293660, 83),
(64, 24428, 59),
(64, 19995, 71),
(64, 157336, 50),
(64, 118340, 74),
(64, 99861, 67),
(64, 150540, 63),
(64, 49051, 68),
(64, 259316, 66),
(64, 321612, 50),
(64, 281957, 50),
(64, 100402, 50),
(64, 105, 50),
(64, 346364, 50),
(64, 10681, 50),
(64, 585, 50),
(64, 675, 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `last_login` date NOT NULL,
  `usrCounter` int(5) NOT NULL,
  `ulocked` int(1) NOT NULL,
  `cPage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `gender`, `email`, `password`, `date_registered`, `last_login`, `usrCounter`, `ulocked`, `cPage`) VALUES
(1, 'mattrobo', '', '', 0, '15robinso11nma@baw4qkeleygreenutc.org.uk', '2ac9cb7dc02b3c0083eb70898e549b63', '0000-00-00', '0000-00-00', 0, 0, 1),
(64, 'matt', 'Matt', 'Robinson', 0, 'mattawd.com', '$2y$10$cQ6zOBA7QDm9diQrluxARubwvV9dqMqmeL0tf34Z.rLq19a7qiuEq', '2019-03-01', '2019-08-02', 4, 1, 1),
(97, 'Matt_Robinson', 'Matt', 'Robinson', 0, 'MattRsd123il.com', '$2y$10$e3SIiKZ87n2Ow3bvviizaO3yKCCQilSSjyC3NnvdMMTZ3Qk3vopWC', '2019-03-03', '2019-03-03', 0, 0, 1),
(98, 'Ruxaroh', 'Ruxaroh', 'Ruxaroh', 0, 'georg23xcas!l.com', '$2y$10$nZPfsBMhiCibIM.37AmvzO5nVSzu0VkeB2zq.oNm8TFcp/z7Njnoi', '2019-03-08', '2019-03-08', 0, 0, 1),
(99, 'TheGreatOne', 'Ed', 'McDonald', 0, '16123bbbmutc.org.uk', '$2y$10$Zo13XIS6NQQaIbGr0JfZ5.5AezMktiiFx4xfrTG0W4ct8pVyOVNBq', '2019-03-13', '2019-03-13', 0, 0, 1),
(100, 'Ruxaroh', 'George', 'Chilton', 0, 'geoef234sail.com', '$2y$10$U2iodmIxj6M9lTfDloITaeb1PE5ErAasa8Xs2KNFQq/TiYwfhOMWa', '2019-03-19', '2019-03-19', 0, 0, 1),
(101, 'jim', 'Jim', 'Jackson', 0, 'jimja1wdd445il.com', '$2y$10$SYWjKam5wnc0dcKfWi88pexEuC24JeHx6rDsMZcjENVeTc2/d.P1S', '2019-03-19', '2019-03-25', 0, 0, 1),
(102, 'cakcca', 'cack', 'cackka', 1, 'acoaooka@gmail.com', '$2y$10$00sTyuYwILFN.vxNIUR8XumI6TOjgBZxwQkke/uVgn4ueQ.whYzDm', '2019-03-19', '2019-03-19', 0, 0, 1),
(103, 'testopen', 'Matt', 'Jilbert', 0, 'jilbaaa@gmail.com', '$2y$10$ahc3mj1FYy5lhAugBw2ZY.EMhSNxw9.xEs4FjeKFKdqRD5jXZ3qEy', '2019-03-20', '2019-03-20', 0, 0, 1),
(104, 'test', 'test', 'test', 0, 'test@gmail.com', '$2y$10$f9DiO1oE9FNLpDx2F6MkUOPY52zhe5xOHQjQ.5XZkxzIZobrUadOm', '2019-03-22', '2019-03-25', 0, 0, 1),
(105, 'DLkWet', 'DLkWet', 'DLkWetEU', 0, 'ekonomitch@yandex.com', '$2y$10$W6fakYHUQ5p6hEtBwqUCdeL0qNtKDCbJIs2Pz2.dLnrZu6J78ZCDO', '2019-03-23', '2019-03-23', 0, 0, 1),
(106, 'username', 'user', 'name', 0, 'username@gmail.com', '$2y$10$k8Mxl6ZIK0txvbuufFI4NuQYjgByfuy1Cy0iH8Uf8x7hJ4FtfTDWq', '2019-03-25', '2019-03-25', 0, 0, 1),
(107, 'dunelm11', 'J', 'P', 0, 'geyd1ey', '$2y$10$4vdt8iHz2aQhVLA7PWvElOm77J3n8RT3eBLCgEHCq21yE5TGv3oQ2', '2019-03-26', '2019-03-26', 0, 0, 0),
(108, 'hhhhh', 'hh', 'hh', 1, 'hh@gg', '$2y$10$tHsnk2csyGroD7lgjKOA9erK7hCGS2atvUtbgz43YcE.PCHfd9u3q', '2019-03-26', '2019-03-26', 0, 0, 0),
(109, 'XenWet', 'XenWet', 'XenWetVP', 0, '4e7dfdg@yandex.com', '$2y$10$Os3lfNpnZ8XDYaYFyjrSIu0WhQmpzo7Bi/7gFCDt2XrObi2uEkHtu', '2019-04-01', '2019-04-01', 0, 0, 0),
(110, 'timtim', 'tim', 'tim', 0, 'tim@gmail.com', '$2y$10$jb9QiRkE3O38PyYxqmz.yOMRDtBLQwhkPGJg8emvwzP7VAPK5advC', '2019-05-09', '2019-05-09', 0, 0, 0),
(111, 'AlexeyKIP', 'AlexeyKIP', 'AlexeyKIPBO', 0, 'alexey1554.Incem@163.com', '$2y$10$D7THZ1RcYrj0XqPB5/.nkuyQjhnpbWx.92lMuic7qUWgardkfCUJG', '2019-05-22', '2019-05-22', 0, 0, 0),
(112, 'KnutInvorma', 'KnutInvorma', 'KnutunioguindFK', 0, 'kobaidze.gena@mail.ru', '$2y$10$LD47elP/bAPh2cdl4ofOoOD76mv25eP366K3JhTDJ4lFfwPdMiacG', '2019-05-24', '2019-05-24', 0, 0, 0),
(113, 'Grimbollmum', 'Grimbollmum', 'GrimbollnicWN', 0, 'valera.banifatov@mail.ru', '$2y$10$.DBh2yB1rvzOckWYOQOT2uOGNUu.U1F4cKk/NXA2ze/8B0asLJ.NS', '2019-05-24', '2019-05-24', 0, 0, 0),
(114, 'kozlykas', 'kozlykas', 'kozlykasNP', 0, 'kozlyk312@gmail.com', '$2y$10$McOB5sxsWlTJQPILfM7WLe5jnUTz.7IKzDAV5Brz..HeX2f9mCVU.', '2019-05-29', '2019-05-29', 0, 0, 0),
(115, 'BÐ¾nus www.bitly.com/2EUV6zv nex', 'BÐ¾nus www.bitly.com/2EUV6zv nex', 'Priz www.bitly.com/2MvAlkr nexJZ', 0, 'nadya.love.9@mail.ru', '$2y$10$NKc/N4cB8oWEwrFr1lrwce7vzs5dxrcwFbxheqw3j585uNUAKRgCu', '2019-06-07', '2019-06-07', 0, 0, 0),
(116, '<a/* */href=\"http://google.com\">Bablos</a> nex', '<a/* */href=\"http://google.com\">Bablos</a> nex', '<a/* */href=\"http://google.com\">Bablos</a> nexMM', 0, 'fcilgk4f@list.ru', '$2y$10$EBiDioQwtaOg14UFzVzp1e5mHZHHUCzveCxyF9OBPZwNarpf3h6iO', '2019-06-10', '2019-06-10', 0, 0, 0),
(117, 'RobertSwaps', 'RobertSwaps', 'RobertSwapsXX', 0, 'trumburty@yandex.com', '$2y$10$hinpGOG/s3Q.1ZRgDca.QOhX0ieOGsIixZZQa2pwjz9CFWOzvPrFi', '2019-07-19', '2019-07-19', 0, 0, 0),
(118, 'Floydjapkll', 'Floydjapkll', 'FloydjapwrvZK', 0, 'a.rt.e.mole.g.o.vi.ch.196.4@gmail.com\r\n', '$2y$10$b7yJaG58bhuymJqmydGVv.6LZXLY88iQmcZRb/j9yQ.BZBhXTA4pC', '2019-07-25', '2019-07-25', 0, 0, 0),
(119, 'SawWqeuiGows', 'SawWqeuiGows', 'SawWqeuiGowsAY', 0, 'romayunusov000@mail.ru', '$2y$10$QI4K8kIBZWhnt4HkKyS82OpAodNVkhXDB3STpt5ivW6aRcwnrmyZ2', '2019-07-27', '2019-07-27', 0, 0, 0),
(120, 'BruceVok', 'BruceVok', 'BruceVokKJ', 0, 'bruce.messam@gmail.com', '$2y$10$vG.WopuSzjBxF480dmD8pOUqlVQP7aL3VN.YjnfUBOemOzkrUylQe', '2019-07-29', '2019-08-28', 0, 0, 0),
(121, 'hydraagino', 'hydraagino', 'hydraaginoVQ', 0, 'crazyorange@hydrakozel.press', '$2y$10$zEsvoWvViw9oGOlVL9OHB.kg//ahK6P7MPtZGx5JuoxDB1Y2tBMo6', '2019-07-29', '2019-07-29', 0, 0, 0),
(122, 'StevenDum', 'StevenDum', 'StevenDumQM', 0, 'steven.thompson.calif@gmail.com', '$2y$10$b.p7D7Lko7YP56A36kOs.eY8X5zM79msMwYrhLGYWIksYd0p8bOBa', '2019-07-31', '2019-07-31', 0, 0, 0),
(123, 'oksisakova', 'oksisakova', 'srozdabaraN', 0, 'truxanov1985@ukr.net', '$2y$10$3IGZCnGem8jkcxWWbf6FyusJQd0lXB8hToxu0pN66gzKVGGD0xM/S', '2019-08-01', '2019-08-01', 0, 0, 0),
(124, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'pite.r.morg.ans.po.r.tsto.r.e.w.o.rl.d.20.16@gmail.com', '$2y$10$03J/QUmP6bstUKtEqPqdyOiQf.dPzrMs2B3mjWgrYzXOulzRpnyse', '2019-08-02', '2019-08-02', 0, 0, 0),
(125, 'Stevenplalp', 'Stevenplalp', 'StevenplalpHD', 0, 'makssemenovsk@rambler.ru', '$2y$10$uI7F00rD3s3II/y2rYeKn.qokkZtEeUoyroRg4SQYqBADA9wrt0Zi', '2019-08-02', '2019-08-20', 0, 0, 0),
(126, 'FrancisDot', 'FrancisDot', 'FrancisDotIT', 0, 'a.rte.m.o.le.g.o.v.ic.h.19.6.4@gmail.com\r\n', '$2y$10$.6Nmu.EDT7Jt84254GVgmOKCRjayWBVtEjCqtaDMskWxVFZ/uxHF.', '2019-08-03', '2019-08-03', 0, 0, 0),
(127, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'pi.t.e.rm.or.g.a.ns.por.tsto.r.ew.or.ld.2.01.6@gmail.com', '$2y$10$SddljiBmMSf7v1cVpNmUke9Ep747MVAJmfiBSYp8UJwk09Gs0dA.O', '2019-08-07', '2019-08-07', 0, 0, 0),
(128, 'JosiBrees', 'JosiBrees', 'JosiBreesCT', 0, 'goledeq@mail.ru', '$2y$10$FCL6rSKI98Z.Y.Hi0ai.7ucUINV/yT8XgeWXlwB7RPf5qUtKiD6m2', '2019-08-08', '2019-08-08', 0, 0, 0),
(129, 'Alinalip', 'Alinalip', 'AlinalipYJ', 0, 'murzilkinaalina@gmail.com', '$2y$10$Do9Ztubptjo5rcoo.aUcd.BVb1CHOWgXCNemV3kyZc0uOgbK1r3Ue', '2019-08-08', '2019-08-09', 0, 0, 0),
(130, 'RandyGaike', 'RandyGaike', 'RandyGaikeCN', 0, 'v1k1nav@ya.ru', '$2y$10$O5ioGdme/pRn5k4mQKn4fekCnrtT5Tm.Qu6GqCeL3pN5LkTXbwqhi', '2019-08-11', '2019-08-11', 0, 0, 0),
(131, 'hydraagino', 'hydraagino', 'hydraaginoVQ', 0, 'tsum@hydrakozel.press', '$2y$10$/lEPnZG4qUmWp36iy6qwDebsCPNXGHRU4BwVFZnVCQ/nvaO0d6EpS', '2019-08-11', '2019-08-11', 0, 0, 0),
(132, 'Ruxaroh', 'Ruxaroh', 'Ruxaroh', 0, 'ruxaroh@gmail.com', '$2y$10$tTAO.lTjWSKE/XGTc686XOjCyuHnX8zQzdPFfgQ.jju/98mzNKst.', '2019-08-11', '2019-08-11', 0, 0, 0),
(133, 'Kathrynblony', 'Kathrynblony', 'KathrynblonyBK', 0, 'kathrynneugszadubina@yandex.com', '$2y$10$ynklu0Hg2sJ8QVsPUKDOO.4Rs2wl7uHRVDLyIgu83HY.RAZlPJ72G', '2019-08-12', '2019-08-12', 0, 0, 0),
(134, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'p.iter.mo.rg.ans.po.rt.s.to.r.e.w.orld.2.0.16@gmail.com', '$2y$10$uMqScszsf7Gu/IBQIGh9kObxBEQuBBDUSqVthLoCKOuNDWo7jlzDS', '2019-08-12', '2019-08-12', 0, 0, 0),
(135, 'FrancisDot', 'FrancisDot', 'FrancisDotIT', 0, 'a.r.tem.o.l.e.g.ov.ic.h.1.9.64@gmail.com\r\n', '$2y$10$ZIN6ARAjP9hUkpI8RVphIOQqnsp/iUhhAQiw7FI9eJDrZ0s4UzOKS', '2019-08-13', '2019-08-13', 0, 0, 0),
(136, 'KetyZer', 'KetyZer', 'KetyZerTP', 0, 'rumasero@mail.ru', '$2y$10$h00kSGXvPw2IRVdkmQNyH.0mSLsqMGiMTEO3olo.gfc/PU9ISaQAC', '2019-08-15', '2019-08-15', 0, 0, 0),
(137, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'pit.erm.o.rg.an.sp.orts.t.ore.wo.r.ld20.1.6@gmail.com', '$2y$10$9xsUj/Lxznj//CmjaXEkxOK.zkj9sEzrfjWXyokQAzpRcPA/9vZa.', '2019-08-18', '2019-08-18', 0, 0, 0),
(138, 'Dennisvox', 'Dennisvox', 'DennisvoxJG', 0, 'fev.gen708@gmail.com', '$2y$10$5/K8Gol1AF5XcJHoK5BUm.37cGzuF50KFS.yXPHs6k8Zg3fVOrgKS', '2019-08-19', '2019-08-19', 0, 0, 0),
(139, 'TinaSove', 'TinaSove', 'TinaSoveYE', 0, 'berguciems@gmail.com', '$2y$10$hphzxkyJw3ua3oI/iq2fLumT6x/y4mADJGfDTKnZVp/EO.dAsAQDO', '2019-08-19', '2019-08-19', 0, 0, 0),
(140, 'Michellrouct', 'Michellrouct', 'MichellrouctRN', 0, 'mcrmp@yandex.com', '$2y$10$Ct7Vpw2xbHd16Q0snQdzb.7BJ6NCp.oWwTuHRYGiZ1uKRMrqFH.3C', '2019-08-22', '2019-08-22', 0, 0, 0),
(141, 'hydraagino', 'hydraagino', 'hydraaginoVQ', 0, 'highquality@hydrakozel.press', '$2y$10$xguNhrKG3PQ7XOv/W7XY/u4k4mnbJr/OPR5JvUOX4NdhpfOytejAC', '2019-08-23', '2019-08-23', 0, 0, 0),
(142, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'pi.te.rmorg.a.nsp.o.rt.s.t.o.r.e.w.orl.d20.16@gmail.com', '$2y$10$hdLka36KULLW5AS6Ch1XfeghehrcdCfDhBmuc6nWXd5jtDUmBLyRe', '2019-08-23', '2019-08-23', 0, 0, 0),
(143, 'Louissliff', 'Louissliff', 'LouissliffBD', 0, 'murt4r@yandex.com', '$2y$10$EuXK.5r/TkxMApfAWWWwx.nUOXhR.jq9.hhBeZx9iXKDXobcaiL7q', '2019-08-24', '2019-08-24', 0, 0, 0),
(144, 'Danielkaw', 'Danielkaw', 'DanielkawGS', 0, 'je.csww22qqa@gmail.com', '$2y$10$hvMBELokehMaChsaO.VVLOKdnH1jRtRgUIgxwpWbT2RObNHT.o5Me', '2019-08-25', '2019-08-25', 0, 0, 0),
(145, 'Ashleyacelt', 'Ashleyacelt', 'AshleyaceltBX', 0, 'lolnoobspam@yandex.ru', '$2y$10$VRMHszdGou3gzMSVUoJPA.lWAfDOkKloSGml/ic1xci52UzAALd2.', '2019-08-26', '2019-08-26', 0, 0, 0),
(146, 'Oramnnege', 'Oramnnege', 'OramnnegeII', 0, 'steve.bannon@fourr.org', '$2y$10$OwC53XRnWHDxEk.EDgk0nuppJd7zkmfskS9BDu.gEVCvSWSXDugja', '2019-08-26', '2019-08-26', 0, 0, 0),
(147, 'RemususVX', 'RemususVX', 'Bookjewels', 0, 'vasegorov86@mail.ru', '$2y$10$FSwG1PdJXny9Cidrpg..weZ6DThxxO3a8etnZfjGNCJhUrL4hPGYK', '2019-08-27', '2019-08-27', 0, 0, 0),
(148, 'hydraagino', 'hydraagino', 'hydraaginoVQ', 0, 'gangbang@hydrapetuh.lgbt', '$2y$10$P.WYWhdBz7yol1TqiLRUPOK0ksZMm6fkUDTOLq6YDjZrzRA4e/.Dm', '2019-08-28', '2019-08-28', 0, 0, 0),
(149, 'piterTems', 'piterTems', 'piterTemsVH', 0, 'pite.rm.o.rgans.po.rtsto.r.ew.orl.d.20.16.@gmail.com', '$2y$10$yLTP1iSSOQlcKCW4/eeKTedh1i2P7RNNLAbfeyghznDIlmdfzV07y', '2019-08-28', '2019-08-28', 0, 0, 0),
(150, 'JeffreyFuple', 'JeffreyFuple', 'JeffreyFupleCK', 0, 'jec.sww22qqa@gmail.com', '$2y$10$lINog46fSl7q4DdfcTcazuExmnabpcYa.iSn8LTsnNiVzBmWlBnUm', '2019-08-28', '2019-08-28', 0, 0, 0),
(151, 'Charlietwity', 'Charlietwity', 'CharlietwityLH', 0, 'vurdonov85@ukr.net', '$2y$10$QtWnKrGUlwUYO9wPCrscPuPqRtTPVNiZGMyYG9ILXQuERNchQAn6a', '2019-08-28', '2019-08-28', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movieData`
--
ALTER TABLE `movieData`
  ADD PRIMARY KEY (`movieID`);

--
-- Indexes for table `userInfo`
--
ALTER TABLE `userInfo`
  ADD KEY `id` (`id`),
  ADD KEY `movie` (`movieID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userInfo`
--
ALTER TABLE `userInfo`
  ADD CONSTRAINT `userInfo_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userInfo_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `movieData` (`movieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
