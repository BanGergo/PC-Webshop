-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 09. 11:30
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pc-webshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `billingdate` date NOT NULL,
  `deliverydate` date NOT NULL,
  `paymentstatus` enum('kifizetendő','kifizetve') DEFAULT NULL,
  `deliverystatus` enum('kiszállítandó','kiszállítva') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filter_options`
--

CREATE TABLE `filter_options` (
  `tul_nev_id` int(11) NOT NULL,
  `mode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `filter_options`
--

INSERT INTO `filter_options` (`tul_nev_id`, `mode`) VALUES
(1, 'exact'),
(2, 'exact'),
(3, 'range'),
(4, 'exact'),
(5, 'range'),
(6, 'range'),
(7, 'range'),
(8, 'exact'),
(9, 'range'),
(10, 'range'),
(11, 'range'),
(12, 'range'),
(13, 'exact'),
(14, 'exact'),
(15, 'exact'),
(16, 'exact'),
(17, 'range'),
(18, 'range'),
(19, 'range'),
(20, 'range'),
(21, 'exact'),
(22, 'range'),
(23, 'exact'),
(24, 'exact'),
(25, 'exact'),
(26, 'exact'),
(27, 'range'),
(28, 'exact'),
(29, 'exact'),
(30, 'exact'),
(31, 'exact'),
(32, 'exact'),
(33, 'range'),
(34, 'range'),
(35, 'range'),
(36, 'exact'),
(37, 'range'),
(38, 'range'),
(39, 'exact'),
(40, 'range'),
(41, 'range'),
(42, 'exact'),
(43, 'exact'),
(44, 'range'),
(45, 'range'),
(46, 'range'),
(47, 'range'),
(48, 'exact'),
(49, 'exact'),
(50, 'exact'),
(51, 'exact'),
(52, 'exact'),
(53, 'range'),
(54, 'range'),
(55, 'range'),
(56, 'range'),
(57, 'range'),
(58, 'range'),
(59, 'range'),
(60, 'range'),
(61, 'range'),
(62, 'range'),
(63, 'range'),
(64, 'range'),
(65, 'exact'),
(66, 'exact'),
(67, 'exact'),
(68, 'exact'),
(69, 'exact'),
(70, 'range'),
(71, 'exact'),
(72, 'exact'),
(73, 'range'),
(74, 'range'),
(75, 'range'),
(76, 'range'),
(77, 'range'),
(78, 'exact'),
(79, 'range'),
(80, 'range'),
(81, 'range'),
(82, 'range'),
(83, 'exact'),
(84, 'range'),
(85, 'range'),
(86, 'range'),
(87, 'range'),
(88, 'range'),
(89, 'range'),
(90, 'exact'),
(91, 'range'),
(92, 'exact'),
(93, 'exact'),
(94, 'exact'),
(95, 'exact'),
(96, 'range'),
(97, 'range'),
(98, 'range'),
(99, 'range'),
(100, 'exact'),
(101, 'exact'),
(102, 'range');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` int(11) NOT NULL,
  `irszam` varchar(255) NOT NULL,
  `varos` varchar(255) NOT NULL,
  `uha` varchar(255) NOT NULL,
  `megj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyarto`
--

CREATE TABLE `gyarto` (
  `gyarto_id` int(11) NOT NULL,
  `gyarto_nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `gyarto`
--

INSERT INTO `gyarto` (`gyarto_id`, `gyarto_nev`) VALUES
(1, 'Kingston'),
(2, 'Samsung'),
(3, 'Western Digital'),
(4, 'Crucial'),
(5, 'Apacer'),
(6, 'Silicon Power'),
(7, 'Seagate Barracuda'),
(8, 'Seagate Exos'),
(9, 'Toshiba'),
(10, 'ASUS'),
(11, 'MSI'),
(12, 'GIGABYTE'),
(13, 'AMD'),
(14, 'Intel'),
(15, 'FSP'),
(16, 'Seasonic'),
(17, 'Corsair'),
(18, 'be quiet!'),
(19, 'Zalman'),
(20, 'Deepcool'),
(21, 'NZXT'),
(22, 'Thermaltake'),
(23, 'Cooler Master'),
(24, 'ARCTIC'),
(25, 'Noctua');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `image`
--

CREATE TABLE `image` (
  `img_id` int(11) NOT NULL,
  `cikkszam` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `image`
--

INSERT INTO `image` (`img_id`, `cikkszam`, `url`) VALUES
(1, 100000, 'https://p1.akcdn.net/full/1327752862.kingston-nv3-1tb-snv3s-1000g.jpg'),
(2, 100001, 'https://p1.akcdn.net/full/1355981266.samsung-990-evo-plus-2tb-mz-v9s2t0bw.jpg'),
(3, 100002, 'https://p1.akcdn.net/full/1062118176.samsung-990-pro-1tb-m-2-nvme-mz-v9p1t0bw.jpg'),
(4, 100003, 'https://p1.akcdn.net/full/884558361.kingston-fury-renegade-1tb-m-2-pcie-nvme-sfyrs-1000g.jpg'),
(5, 100004, 'https://p1.akcdn.net/full/931856871.western-digital-wd-black-sn770-1tb-m-2-nvme-wds100t3x0e.jpg'),
(6, 100005, 'https://p1.akcdn.net/full/644129319.crucial-bx500-2-5-1tb-sata3-ct1000bx500ssd1.jpg'),
(7, 100006, 'https://p1.akcdn.net/full/766422429.samsung-2-5-870-evo-1tb-sata3-mz-77e1t0b.jpg'),
(8, 100007, 'https://p1.akcdn.net/full/785307459.apacer-2-5-as350x-512gb-sata3-ap512gas350xr-1.jpg'),
(9, 100008, 'https://p1.akcdn.net/full/486929315.kingston-a400-2-5-960gb-sata3-sa400s37-960g.jpg'),
(10, 100009, 'https://p1.akcdn.net/full/477591739.silicon-power-a55-2-5-512gb-sata3-sp512gbss3a55s25.jpg'),
(11, 100010, 'https://p1.akcdn.net/full/1143672498.seagate-barracuda-1tb-sata3-7200rpm-st1000dm014.jpg'),
(12, 100011, 'https://p1.akcdn.net/full/498620815.seagate-barracuda-3-5-2tb-7200rpm-256mb-sata3-st2000dm008.jpg'),
(13, 100012, 'https://p1.akcdn.net/full/119234976.western-digital-blue-3-5-1tb-7200rpm-64mb-sata3-wd10ezex.jpg'),
(14, 100013, 'https://p1.akcdn.net/full/795036603.western-digital-wd-blue-3-5-2tb-7200rpm-256mb-sata3-wd20ezbx.jpg'),
(15, 100014, 'https://p1.akcdn.net/full/935444883.seagate-exos-7e10-3-5-8tb-sata-7200rpm-256mb-st8000nm017b.jpg'),
(16, 100015, 'https://p1.akcdn.net/full/738599532.toshiba-p300-3-5-2tb-hdwd220uzsva.jpg'),
(17, 100016, 'https://p1.akcdn.net/full/1409075311.asus-radeon-rx-9070-xt-prime-oc-16gb-gddr6-256bit-90yv0l71-m0na00.jpg'),
(18, 100017, 'https://p1.akcdn.net/full/1410131872.asus-geforce-rtx-5090-rog-astral-oc-32gb-gddr7-512bit-rog-astral-rtx5090-o32g-gaming-90yv0lw0-m0na00.jpg'),
(19, 100018, 'https://p1.akcdn.net/full/1401690508.msi-geforce-rtx-5070-ti-gaming-trio-oc-plus-16gb-gddr7-256bit.jpg'),
(20, 100019, 'https://p1.akcdn.net/full/1153066179.msi-geforce-rtx-4060-ti-ventus-2x-black-oc-8gb-gddr6-128bit-v515-017r.jpg'),
(21, 100020, 'https://p1.akcdn.net/full/1029949635.gigabyte-geforce-rtx-3060-windforce-oc-12gb-gddr6-gv-n3060wf2oc-12gd.jpg'),
(22, 100021, 'https://p1.akcdn.net/full/1247548363.gigabyte-radeon-rx-7600-xt-gaming-oc-16gb-gddr6-gv-r76xtgaming-oc-16gd.jpg'),
(23, 100022, 'https://p1.akcdn.net/full/1373913661.amd-ryzen-7-9800x3d-box-100-100001084wof.jpg'),
(24, 100023, 'https://p1.akcdn.net/full/744222552.amd-ryzen-5-5600x-6-core-3-7ghz-am4-box-100-100000065box.jpg'),
(25, 100024, 'https://p1.akcdn.net/full/1037057073.amd-ryzen-9-7950x-16-core-4-5ghz-am5-box-100-100000514wof.jpg'),
(26, 100025, 'https://p1.akcdn.net/full/1207451239.intel-core-i9-14900k-24-core-3-2ghz-lga1700-box-bx8071514900k.jpg'),
(27, 100026, 'https://p1.akcdn.net/full/1240000549.intel-core-i5-14400f-10-core-2-5ghz-lga1700-box-bx8071514400f.jpg'),
(28, 100027, 'https://p1.akcdn.net/full/1355470963.intel-core-ultra-7-265k-20-core-3-3ghz-lga1851-box-bx80768265k.jpg'),
(29, 100028, 'https://p1.akcdn.net/full/1047869556.msi-mag-b650-tomahawk-wifi.jpg'),
(30, 100029, 'https://p1.akcdn.net/full/1351450867.asus-rog-strix-x870-f-gaming-wifi.jpg'),
(31, 100030, 'https://p1.akcdn.net/full/709763796.gigabyte-b550m-aorus-elite.jpg'),
(32, 100031, 'https://p1.akcdn.net/full/1129265466.asus-tuf-gaming-b760-plus-wifi.jpg'),
(33, 100032, 'https://p1.akcdn.net/full/1053571014.msi-mag-z790-tomahawk-wifi.jpg'),
(34, 100033, 'https://p1.akcdn.net/full/1368126625.asus-rog-maximus-z890-hero.jpg'),
(35, 100034, 'https://p1.akcdn.net/full/912697227.fsp-hydro-k-pro-750w-atx3-0-80-plus-bronze-ppa7506901.jpg'),
(36, 100035, 'https://p1.akcdn.net/full/1351465240.seasonic-focus-gx-850w-80-plus-gold-v4-gx-850-v4.jpg'),
(37, 100036, 'https://p1.akcdn.net/full/1338007672.corsair-rmx-series-rm850x-850w-80-plus-gold-cp-9020270-eu.jpg'),
(38, 100037, 'https://p1.akcdn.net/full/1105017756.be-quiet-pure-power-12-m-850w-80-plus-gold-bn344.jpg'),
(39, 100038, 'https://p1.akcdn.net/full/1410510340.asus-rog-strix-1200w-80-plus-platinum-90ye00w0-b0na00.jpg'),
(40, 100039, 'https://p1.akcdn.net/full/1351464946.seasonic-focus-gx-1000w-80-plus-gold-v4-gx-1000-v4.jpg'),
(41, 100040, 'https://p1.akcdn.net/full/824254329.zalman-n5-mf-rgb.jpg'),
(42, 100041, 'https://p1.akcdn.net/full/1385074288.deepcool-cg530-black-r-cg530-bknda0-g-1.jpg'),
(43, 100042, 'https://p1.akcdn.net/full/680782575.be-quiet-pure-base-500dx-black-bgw37.jpg'),
(44, 100043, 'https://p1.akcdn.net/full/725166519.corsair-4000d-airflow-cc-9011200.jpg'),
(45, 100044, 'https://p1.akcdn.net/full/1060934541.nzxt-h5-flow-cc-h51fw-01.jpg'),
(46, 100045, 'https://p1.akcdn.net/full/1219789021.be-quiet-pure-wings-3-120mm-pwm-bl105.jpg'),
(47, 100046, 'https://p1.akcdn.net/full/1219789483.be-quiet-pure-wings-3-140mm-pwm-high-speed-bl109.jpg'),
(48, 100047, 'https://p1.akcdn.net/full/1243163419.thermaltake-cl-f170-pl14sw-a.jpg'),
(49, 100048, 'https://p1.akcdn.net/full/1248330979.cooler-master-mobius-140p-argb-mfz-m4dn-19np2-r1.jpg'),
(50, 100049, 'https://p1.akcdn.net/full/1219788895.be-quiet-pure-wings-3-120mm-pwm-high-speed-bl106.jpg'),
(51, 100050, 'https://p1.akcdn.net/full/1207456087.be-quiet-dark-rock-pro-5-bk036.jpg'),
(52, 100051, 'https://p1.akcdn.net/full/1257181918.arctic-liquid-freezer-iii-360-a-rgb-acfre00144a.jpg'),
(53, 100052, 'https://p1.akcdn.net/full/258793402.noctua-nh-d15-noctua-fan-nh-d15.jpg'),
(54, 100053, 'https://p1.akcdn.net/full/1178084517.deepcool-ak620-digital-120mm-r-ak620-bkadmn-g.jpg'),
(55, 100054, 'https://p1.akcdn.net/full/1257182887.arctic-liquid-freezer-iii-360-a-rgb-acfre00152a.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `kat_id` int(11) NOT NULL,
  `kat_nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`kat_id`, `kat_nev`) VALUES
(1, 'Processzor'),
(2, 'Videokártya'),
(3, 'Alaplap'),
(4, 'Memória (RAM)'),
(5, 'SSD'),
(6, 'Tápegység'),
(7, 'Számítógép ház'),
(8, 'Számítógép hűtő'),
(9, 'Processzorhűtő'),
(10, 'Periféria'),
(11, 'Merevlemez (HDD)'),
(12, 'Egyéb');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kat_tul`
--

CREATE TABLE `kat_tul` (
  `kat_tul_id` int(11) NOT NULL,
  `kat_id` int(11) NOT NULL,
  `tul_nev_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kat_tul`
--

INSERT INTO `kat_tul` (`kat_tul_id`, `kat_id`, `tul_nev_id`) VALUES
(1, 1, 36),
(2, 1, 37),
(3, 1, 38),
(4, 1, 39),
(5, 1, 40),
(6, 1, 41),
(7, 1, 42),
(8, 1, 43),
(9, 1, 44),
(10, 1, 45),
(11, 1, 46),
(12, 1, 47),
(13, 2, 14),
(14, 2, 15),
(15, 2, 16),
(16, 2, 17),
(17, 2, 18),
(18, 2, 19),
(19, 2, 20),
(20, 2, 21),
(21, 2, 22),
(22, 2, 23),
(23, 2, 24),
(24, 2, 25),
(25, 2, 26),
(26, 2, 27),
(27, 2, 28),
(28, 2, 29),
(29, 2, 30),
(30, 2, 31),
(31, 2, 32),
(32, 2, 33),
(33, 2, 34),
(34, 2, 35),
(35, 3, 48),
(36, 3, 49),
(37, 3, 50),
(38, 3, 51),
(39, 3, 52),
(40, 3, 53),
(41, 3, 54),
(42, 3, 55),
(43, 3, 56),
(44, 3, 57),
(45, 3, 58),
(46, 3, 59),
(47, 3, 60),
(48, 3, 61),
(49, 3, 62),
(50, 3, 63),
(51, 3, 64),
(52, 3, 65),
(53, 3, 66),
(54, 3, 67),
(55, 3, 68),
(56, 4, 103),
(57, 4, 104),
(58, 4, 105),
(59, 4, 106),
(60, 4, 107),
(61, 4, 108),
(62, 4, 109),
(63, 4, 110),
(64, 4, 111),
(65, 4, 112),
(66, 4, 113),
(67, 5, 1),
(68, 5, 2),
(69, 5, 3),
(70, 5, 4),
(71, 5, 5),
(72, 5, 6),
(73, 5, 7),
(74, 5, 8),
(75, 6, 69),
(76, 6, 70),
(77, 6, 71),
(78, 6, 72),
(79, 6, 73),
(80, 6, 74),
(81, 6, 75),
(82, 6, 76),
(83, 6, 77),
(84, 6, 78),
(85, 6, 79),
(86, 6, 80),
(87, 6, 81),
(88, 6, 82),
(89, 7, 83),
(90, 7, 84),
(91, 7, 85),
(92, 7, 86),
(93, 7, 87),
(94, 7, 88),
(95, 7, 89),
(96, 7, 90),
(97, 7, 91),
(98, 7, 92),
(99, 7, 93),
(100, 7, 94),
(101, 8, 95),
(102, 8, 96),
(103, 8, 97),
(104, 8, 98),
(105, 8, 99),
(106, 8, 100),
(107, 8, 101),
(108, 8, 102),
(109, 9, 95),
(110, 9, 96),
(111, 9, 97),
(112, 9, 98),
(113, 9, 99),
(114, 9, 100),
(115, 9, 101),
(116, 9, 102),
(117, 11, 9),
(118, 11, 10),
(119, 11, 11),
(120, 11, 12),
(121, 11, 13);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `loyalty`
--

CREATE TABLE `loyalty` (
  `loyalty_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `currentft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ranks`
--

CREATE TABLE `ranks` (
  `rank_id` int(11) NOT NULL,
  `rankname` varchar(255) DEFAULT NULL,
  `discount` tinyint(4) NOT NULL,
  `minft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ranks`
--

INSERT INTO `ranks` (`rank_id`, `rankname`, `discount`, `minft`) VALUES
(1, 'Platinum', 10, 500000),
(2, 'Arany', 7, 275000),
(3, 'Ezüst', 5, 125000),
(4, 'Bronz', 2, 45000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles_tetel`
--

CREATE TABLE `rendeles_tetel` (
  `order_id` int(11) NOT NULL,
  `rendt_id` int(11) NOT NULL,
  `cikkszam` int(11) NOT NULL,
  `menny` int(11) NOT NULL,
  `netto` int(11) NOT NULL,
  `afa` float NOT NULL DEFAULT 1.27
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendeles_torzs`
--

CREATE TABLE `rendeles_torzs` (
  `rendt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `ossz` int(11) NOT NULL,
  `paymentmethod` enum('előre utalás','utánvétel') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cikkszam` int(11) NOT NULL,
  `review` text NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek`
--

CREATE TABLE `termek` (
  `cikkszam` int(11) NOT NULL,
  `termek_nev` varchar(255) NOT NULL,
  `keszlet` int(11) NOT NULL DEFAULT 10,
  `netto` int(11) NOT NULL,
  `afa` float NOT NULL DEFAULT 1.27,
  `kedv` tinyint(4) NOT NULL DEFAULT 0,
  `kat_id` int(11) NOT NULL,
  `gyarto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `termek`
--

INSERT INTO `termek` (`cikkszam`, `termek_nev`, `keszlet`, `netto`, `afa`, `kedv`, `kat_id`, `gyarto_id`) VALUES
(100000, 'Kingston NV3 1TB (SNV3S/1000G)', 10, 17213, 1.27, 0, 5, 1),
(100001, 'Samsung 990 EVO Plus 2TB (MZ-V9S2T0BW)', 10, 43299, 1.27, 0, 5, 2),
(100002, 'Samsung 990 PRO 1TB M.2 NVMe (MZ-V9P1T0BW)', 10, 34039, 1.27, 0, 5, 2),
(100003, 'Kingston FURY Renegade 1TB M.2 PCIe NVMe (SFYRS/1000G)', 10, 27961, 1.27, 0, 5, 1),
(100004, 'Western Digital WD Black SN770 1TB M.2 NVMe (WDS100T3X0E)', 10, 24409, 1.27, 0, 5, 3),
(100005, 'Crucial BX500 2.5 1TB SATA3 (CT1000BX500SSD1)', 10, 18063, 1.27, 0, 5, 4),
(100006, 'Samsung 2.5 870 EVO 1TB SATA3 (MZ-77E1T0B)', 10, 31417, 1.27, 0, 5, 2),
(100007, 'Apacer 2.5 AS350X 512GB SATA3 (AP512GAS350XR-1)', 10, 9790, 1.27, 0, 5, 5),
(100008, 'Kingston A400 2.5 960GB SATA3 (SA400S37/960G)', 10, 16528, 1.27, 0, 5, 1),
(100009, 'Silicon Power A55 2.5 512GB SATA3 (SP512GBSS3A55S25)', 10, 8890, 1.27, 0, 5, 6),
(100010, 'Seagate Barracuda 1TB SATA3 7200rpm (ST1000DM014)', 10, 18701, 1.27, 0, 11, 7),
(100011, 'Seagate BarraCuda 3.5 2TB 7200rpm 256MB SATA3 (ST2000DM008)', 10, 19438, 1.27, 0, 11, 7),
(100012, 'Western Digital Blue 3.5 1TB 7200rpm 64MB SATA3 (WD10EZEX)', 10, 18913, 1.27, 0, 11, 3),
(100013, 'Western Digital WD Blue 3.5 2TB 7200rpm 256MB SATA3 (WD20EZBX)', 10, 20543, 1.27, 0, 11, 3),
(100014, 'Seagate Exos 7E10 3.5 8TB SATA 7200rpm 256MB (ST8000NM017B)', 10, 60265, 1.27, 0, 11, 8),
(100015, 'Toshiba P300 3.5 2TB (HDWD220UZSVA)', 10, 18787, 1.27, 0, 11, 9),
(100016, 'ASUS Radeon RX 9070 XT PRIME OC 16GB GDDR6 256bit (90YV0L71-M0NA00) Videokártya', 10, 338575, 1.27, 0, 2, 10),
(100017, 'ASUS GeForce RTX 5090 ROG ASTRAL OC 32GB GDDR7 512bit (ROG-ASTRAL-RTX5090-O32G-GAMING/90YV0LW0-M0NA00) Videokártya', 10, 1540220, 1.27, 0, 2, 10),
(100018, 'MSI GeForce RTX 5070 Ti GAMING TRIO OC PLUS 16GB GDDR7 256bit Videokártya', 10, 475441, 1.27, 0, 2, 11),
(100019, 'MSI GeForce RTX 4060 Ti VENTUS 2X BLACK OC 8GB GDDR6 128bit (V515-017R) Videokártya', 10, 145953, 1.27, 0, 2, 11),
(100020, 'GIGABYTE GeForce RTX 3060 WINDFORCE OC 12GB GDDR6 (GV-N3060WF2OC-12GD) Videokártya', 10, 97315, 1.27, 0, 2, 12),
(100021, 'GIGABYTE Radeon RX 7600 XT Gaming OC 16GB GDDR6 (GV-R76XTGAMING OC-16GD) Videokártya', 10, 113370, 1.27, 0, 2, 12),
(100022, 'AMD Ryzen 7 9800X3D Box (100-100001084WOF) Processzor', 10, 180646, 1.27, 0, 1, 13),
(100023, 'AMD Ryzen 5 5600X 6-Core 3.7GHz AM4 Box (100-100000065BOX) Processzor', 10, 41287, 1.27, 0, 1, 13),
(100024, 'AMD Ryzen 9 7950X 16-Core 4.5GHz AM5 Box (100-100000514WOF) Processzor', 10, 167480, 1.27, 0, 1, 13),
(100025, 'Intel Core i9-14900K 24-Core 3.2GHz LGA1700 Box (BX8071514900K) Processzor', 10, 156134, 1.27, 0, 1, 14),
(100026, 'Intel Core i5-14400F 10-Core 2.5GHz LGA1700 Box (BX8071514400F) Processzor', 10, 46047, 1.27, 0, 1, 14),
(100027, 'Intel Core Ultra 7 265K 20-Core 3.3GHz LGA1851 Box (BX80768265K) Processzor', 10, 129094, 1.27, 0, 1, 14),
(100028, 'MSI MAG B650 Tomahawk WIFI Alaplap', 10, 67205, 1.27, 0, 3, 11),
(100029, 'ASUS ROG STRIX X870-F GAMING WIFI Alaplap', 10, 145838, 1.27, 0, 3, 10),
(100030, 'GIGABYTE B550M AORUS ELITE Alaplap', 10, 31386, 1.27, 0, 3, 12),
(100031, 'ASUS TUF Gaming B760-PLUS WIFI Alaplap', 10, 60370, 1.27, 0, 3, 10),
(100032, 'MSI MAG Z790 TOMAHAWK WIFI Alaplap', 10, 92189, 1.27, 0, 3, 11),
(100033, 'ASUS ROG MAXIMUS Z890 HERO Alaplap', 10, 282606, 1.27, 0, 3, 10),
(100034, 'FSP Hydro K PRO 750W ATX3.0 80 PLUS Bronze (PPA7506901)', 10, 22717, 1.27, 0, 6, 15),
(100035, 'Seasonic FOCUS GX 850W 80 PLUS Gold V4 (GX-850-V4)', 10, 56917, 1.27, 0, 6, 16),
(100036, 'Corsair RMx Series RM850x 850W 80 PLUS Gold (CP-9020270-EU)', 10, 48780, 1.27, 0, 6, 17),
(100037, 'be quiet! Pure Power 12 M 850W 80 PLUS Gold (BN344)', 10, 46761, 1.27, 0, 6, 18),
(100038, 'ASUS ROG STRIX 1200W 80 PLUS Platinum (90YE00W0-B0NA00)', 10, 119606, 1.27, 0, 6, 10),
(100039, 'Seasonic FOCUS GX-1000W 80 PLUS Gold V4 (GX-1000-V4)', 10, 68090, 1.27, 0, 6, 16),
(100040, 'Zalman N5 MF RGB', 10, 17600, 1.27, 0, 7, 19),
(100041, 'Deepcool CG530 Black (R-CG530-BKNDA0-G-1)', 10, 26709, 1.27, 0, 7, 20),
(100042, 'be quiet! Pure Base 500DX Black (BGW37)', 10, 39853, 1.27, 0, 7, 18),
(100043, 'Corsair 4000D Airflow (CC-9011200)', 10, 32512, 1.27, 0, 7, 17),
(100044, 'NZXT H5 Flow (CC-H51FW-01)', 10, 30693, 1.27, 0, 7, 21),
(100045, 'be quiet! Pure Wings 3 120mm PWM (BL105)', 10, 3709, 1.27, 0, 8, 18),
(100046, 'be quiet! Pure Wings 3 140mm PWM high-speed (BL109)', 10, 4205, 1.27, 0, 8, 18),
(100047, 'Thermaltake CL-F170-PL14SW-A', 10, 28654, 1.27, 0, 8, 22),
(100048, 'Cooler Master Mobius 140P ARGB (MFZ-M4DN-19NP2-R1)', 10, 9756, 1.27, 0, 8, 23),
(100049, 'be quiet! Pure Wings 3 120mm PWM high-speed (BL106)', 10, 3709, 1.27, 0, 8, 18),
(100050, 'be quiet! DARK ROCK PRO 5 (BK036)', 10, 31890, 1.27, 0, 9, 18),
(100051, 'ARCTIC Liquid Freezer III 360 A-RGB (ACFRE00144A)', 10, 31890, 1.27, 0, 9, 24),
(100052, 'Noctua NH-D15 (NOCTUA-FAN-NH-D15)', 10, 42906, 1.27, 0, 9, 25),
(100053, 'Deepcool AK620 Digital 120mm (R-AK620-BKADMN-G)', 10, 28850, 1.27, 0, 9, 20),
(100054, 'ARCTIC Liquid Freezer III 360 A-RGB (ACFRE00152A)', 10, 31346, 1.27, 0, 9, 24);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek_tul`
--

CREATE TABLE `termek_tul` (
  `kat_tul_id` int(11) NOT NULL,
  `cikkszam` int(11) NOT NULL,
  `tul_ertek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `termek_tul`
--

INSERT INTO `termek_tul` (`kat_tul_id`, `cikkszam`, `tul_ertek`) VALUES
(67, 100000, 'M.2'),
(68, 100000, '2280'),
(69, 100000, '1000 GB'),
(70, 100000, 'QLC'),
(71, 100000, '6000 MB/s'),
(72, 100000, '4000 MB/s'),
(73, 100000, '320 TBW'),
(74, 100000, 'PCI-e 4.0'),
(67, 100001, 'M.2'),
(68, 100001, '2280'),
(69, 100001, '2000 GB'),
(70, 100001, 'TLC'),
(71, 100001, '7250 MB/s'),
(72, 100001, '6300 MB/s'),
(73, 100001, '1200 TBW'),
(74, 100001, 'PCI-e 4.0'),
(67, 100002, 'M.2'),
(68, 100002, '2280'),
(69, 100002, '1000 GB'),
(70, 100002, 'TLC'),
(71, 100002, '7450 MB/s'),
(72, 100002, '6900 MB/s'),
(73, 100002, '600 TBW'),
(74, 100002, 'PCI-e 4.0'),
(67, 100003, 'M.2'),
(68, 100003, '2280'),
(69, 100003, '1000 GB'),
(70, 100003, 'TLC'),
(71, 100003, '7300 MB/s'),
(72, 100003, '6000 MB/s'),
(73, 100003, '1000 TBW'),
(74, 100003, 'PCI-e 4.0'),
(67, 100004, 'M.2'),
(68, 100004, '2280'),
(69, 100004, '1000 GB'),
(70, 100004, 'TLC'),
(71, 100004, '5150 MB/s'),
(72, 100004, '4900 MB/s'),
(73, 100004, '600 TBW'),
(74, 100004, 'PCI-e 4.0'),
(67, 100005, '2.5 inch'),
(68, 100005, 'Nincs'),
(69, 100005, '1000 GB'),
(70, 100005, 'TLC'),
(71, 100005, '540 MB/s'),
(72, 100005, '500 MB/s'),
(73, 100005, '360 TBW'),
(74, 100005, 'SATA3'),
(67, 100006, '2.5 inch'),
(68, 100006, 'Nincs'),
(69, 100006, '1000 GB'),
(70, 100006, 'TLC'),
(71, 100006, '560 MB/s'),
(72, 100006, '530 MB/s'),
(73, 100006, '600 TBW'),
(74, 100006, 'SATA3'),
(67, 100007, '2.5 inch'),
(68, 100007, 'Nincs'),
(69, 100007, '512 GB'),
(70, 100007, 'TLC'),
(71, 100007, '560 MB/s'),
(72, 100007, '530 MB/s'),
(73, 100007, '320 TBW'),
(74, 100007, 'SATA3'),
(67, 100008, '2.5 inch'),
(68, 100008, 'Nincs'),
(69, 100008, '960 GB'),
(70, 100008, 'TLC'),
(71, 100008, '500 MB/s'),
(72, 100008, '450 MB/s'),
(73, 100008, '300 TBW'),
(74, 100008, 'SATA3'),
(67, 100009, '2.5 inch'),
(68, 100009, 'nincs'),
(69, 100009, '512 GB'),
(70, 100009, 'TLC'),
(71, 100009, '560 MB/s'),
(72, 100009, '530 MB/s'),
(73, 100009, '250 TBW'),
(74, 100009, 'SATA3'),
(117, 100010, '1000 GB'),
(118, 100010, '7200 RPM'),
(119, 100010, '256 MB'),
(120, 100010, '6 Gbit/s'),
(121, 100010, 'SATA3'),
(117, 100011, '2000 GB'),
(118, 100011, '7200 RPM'),
(119, 100011, '256 MB'),
(120, 100011, '6 Gbit/s'),
(121, 100011, 'SATA3'),
(117, 100012, '1000 GB'),
(118, 100012, '7200 RPM'),
(119, 100012, '64 MB'),
(120, 100012, '6 Gbit/s'),
(121, 100012, 'SATA3'),
(117, 100013, '2000 GB'),
(118, 100013, '7200 RPM'),
(119, 100013, '256 MB'),
(120, 100013, '6 Gbit/s'),
(121, 100013, 'SATA3'),
(117, 100014, '8000 GB'),
(118, 100014, '7200 RPM'),
(119, 100014, '256 MB'),
(120, 100014, '6 Gbit/s'),
(121, 100014, 'SATA3'),
(117, 100015, '2000 GB'),
(118, 100015, '5400 RPM'),
(119, 100015, '128 MB'),
(120, 100015, '6 Gbit/s'),
(121, 100015, 'SATA3'),
(13, 100016, 'PCI-Express'),
(14, 100016, 'AMD Radeon RX 9070 XT'),
(15, 100016, 'Aktív hűtés'),
(16, 100016, '3 darab'),
(17, 100016, '3030 MHz'),
(18, 100016, '20000 MHz'),
(19, 100016, '16 GB'),
(20, 100016, 'GDDR6'),
(21, 100016, '256 bit'),
(22, 100016, '7680 x 4320 pixel'),
(23, 100016, '12'),
(24, 100016, '4.6'),
(25, 100016, '3 x 8-pin'),
(26, 100016, '750 W'),
(27, 100016, 'Nincs'),
(28, 100016, 'Nincs'),
(29, 100016, '1 db'),
(30, 100016, '3 db'),
(31, 100016, 'Nincs'),
(32, 100016, '130 mm'),
(33, 100016, '312 mm'),
(34, 100016, '50 mm'),
(13, 100017, 'PCI-Express'),
(14, 100017, 'Nvidia GeForce RTX 5090'),
(15, 100017, 'Aktív hűtés'),
(16, 100017, '3 darab'),
(17, 100017, '2610 MHz'),
(18, 100017, '28000 MHz'),
(19, 100017, '16 GB'),
(20, 100017, 'GDDR7'),
(21, 100017, '512 bit'),
(22, 100017, '7680 x 4320 pixel'),
(23, 100017, '12'),
(24, 100017, '4.6'),
(25, 100017, '1 x 16-pin'),
(26, 100017, '1000 W'),
(27, 100017, 'Nincs'),
(28, 100017, 'Nincs'),
(29, 100017, '2 db'),
(30, 100017, '3 db'),
(31, 100017, 'Nincs'),
(32, 100017, '149 mm'),
(33, 100017, '357 mm'),
(34, 100017, '76 mm'),
(13, 100018, 'PCI-Express'),
(14, 100018, 'Nvidia GeForce RTX 5070 Ti'),
(15, 100018, 'Aktív hűtés'),
(16, 100018, '3 darab'),
(17, 100018, '2580 MHz'),
(18, 100018, '28000 MHz'),
(19, 100018, '16 GB'),
(20, 100018, 'GDDR7'),
(21, 100018, '256 bit'),
(22, 100018, '7680 x 4320 pixel'),
(23, 100018, '12'),
(24, 100018, '4.6'),
(25, 100018, '1 x 16-pin'),
(26, 100018, '750 W'),
(27, 100018, 'Nincs'),
(28, 100018, 'Nincs'),
(29, 100018, '1 db'),
(30, 100018, '3 db'),
(31, 100018, 'Nincs'),
(32, 100018, '140 mm'),
(33, 100018, '338 mm'),
(34, 100018, '50 mm'),
(13, 100019, 'PCI-Express'),
(14, 100019, 'Nvidia GeForce RTX 4060 Ti'),
(15, 100019, 'Aktív hűtés'),
(16, 100019, '2 darab'),
(17, 100019, '2580 MHz'),
(18, 100019, '18000 MHz'),
(19, 100019, '8 GB'),
(20, 100019, 'GDDR6'),
(21, 100019, '128 bit'),
(22, 100019, '7680 x 4320 pixel'),
(23, 100019, '12'),
(24, 100019, '4.6'),
(25, 100019, '1 x 8-pin'),
(26, 100019, '550 W'),
(27, 100019, 'Nincs'),
(28, 100019, 'Nincs'),
(29, 100019, '1 db'),
(30, 100019, '3 db'),
(31, 100019, 'Nincs'),
(32, 100019, '120 mm'),
(33, 100019, '199 mm'),
(34, 100019, '42 mm'),
(13, 100020, 'PCI-Express'),
(14, 100020, 'Nvidia GeForce RTX 3060'),
(15, 100020, 'Aktív hűtés'),
(16, 100020, '2 darab'),
(17, 100020, '1792 MHz'),
(18, 100020, '15000 MHz'),
(19, 100020, '12 GB'),
(200, 100020, 'GDDR6'),
(21, 100020, '192 bit'),
(22, 100020, '7680 x 4320 pixel'),
(23, 100020, '12'),
(24, 100020, '4.6'),
(25, 100020, '1 x 8-pin'),
(26, 100020, '550 W'),
(27, 100020, 'Nincs'),
(28, 100020, 'Nincs'),
(29, 100020, '2 db'),
(30, 100020, '2 db'),
(31, 100020, 'Nincs'),
(32, 100020, '121 mm'),
(33, 100020, '198 mm'),
(34, 100020, '39 mm'),
(13, 100021, 'PCI-Express'),
(14, 100021, 'Nvidia GeForce RTX 3060'),
(15, 100021, 'Aktív hűtés'),
(16, 100021, '3 darab'),
(17, 100021, '2810 MHz'),
(18, 100021, '18000 MHz'),
(19, 100021, '16 GB'),
(20, 100021, 'GDDR6'),
(21, 100021, '128 bit'),
(22, 100021, '7680 x 4320 pixel'),
(23, 100021, '12'),
(24, 100021, '4.6'),
(25, 100021, '2 x 8-pin'),
(26, 100021, '600 W'),
(27, 100021, 'Nincs'),
(28, 100021, 'Nincs'),
(29, 100021, '2 db'),
(30, 100021, '2 db'),
(31, 100021, 'Nincs'),
(32, 100021, '116 mm'),
(33, 100021, '281 mm'),
(34, 100021, '5 mm'),
(1, 100022, 'AMD Ryzen 7'),
(2, 100022, '8 mag'),
(3, 100022, '16 szál'),
(4, 100022, 'AMD Socket AM5'),
(5, 100022, '4700 MHz'),
(6, 100022, '5200 MHz'),
(7, 100022, '4 nm'),
(8, 100022, 'AMD Radeon Graphics'),
(9, 100022, '8 MB'),
(10, 100022, '96 MB'),
(11, 100022, '120 W'),
(12, 100022, 'DDR5-5600'),
(1, 100023, 'AMD Ryzen 5'),
(2, 100023, '6 mag'),
(3, 100023, '12 szál'),
(4, 100023, 'AMD Socket AM4'),
(5, 100023, '3700 MHz'),
(6, 100023, '4600 MHz'),
(7, 100023, '7 nm'),
(8, 100023, 'Nincs'),
(9, 100023, '33 MB'),
(10, 100023, '32 MB'),
(11, 100023, '165 W'),
(12, 100023, 'DDR4-3200'),
(1, 100024, 'AMD Ryzen 9'),
(2, 100024, '16 mag'),
(3, 100024, '32 szál'),
(4, 100024, 'AMD Socket AM5'),
(5, 100024, '4500 MHz'),
(6, 100024, '5700 MHz'),
(7, 100024, '5 nm'),
(8, 100024, 'AMD Radeon Graphics'),
(9, 100024, '16 MB'),
(10, 100024, '64 MB'),
(11, 100024, '170 W'),
(12, 100024, 'DDR5-5200'),
(1, 100025, 'Intel Core i9'),
(2, 100025, '24 mag'),
(3, 100025, '32 szál'),
(4, 100025, 'Intel Socket 1700'),
(5, 100025, '2400 MHz'),
(6, 100025, '6000 MHz'),
(7, 100025, '10 nm'),
(8, 100025, 'Intel UHD Graphics 770'),
(9, 100025, '32 MB'),
(10, 100025, '36 MB'),
(11, 100025, '125 W'),
(12, 100025, 'DDR5-5600'),
(1, 100026, 'Intel Core i5'),
(2, 100026, '10 mag'),
(3, 100026, '16 szál'),
(4, 100026, 'Intel Socket 1700'),
(5, 100026, '1800 MHz'),
(6, 100026, '4700 MHz'),
(7, 100026, '10 nm'),
(8, 100026, 'Nincs'),
(9, 100026, '9.5 MB'),
(10, 100026, '20 MB'),
(11, 100026, '65 W'),
(12, 100026, 'DDR5-4800'),
(1, 100027, 'Intel Core Ultra 7'),
(2, 100027, '20 mag'),
(3, 100027, '20 szál'),
(4, 100027, 'Intel Socket 1851'),
(5, 100027, '3300 MHz'),
(6, 100027, '5500 MHz'),
(7, 100027, '3 nm'),
(8, 100027, 'Intel Graphics'),
(9, 100027, '36 MB'),
(10, 100027, '30 MB'),
(11, 100027, '125 W'),
(12, 100027, 'DDR5-6400'),
(35, 100028, 'Socket AM5'),
(36, 100028, 'AMD B650'),
(37, 100028, 'AMD'),
(38, 100028, 'DDR5'),
(39, 100028, 'PCI-E'),
(40, 100028, 'Van'),
(41, 100028, 'Van'),
(42, 100028, '4'),
(43, 100028, '6'),
(44, 100028, '2'),
(45, 100028, '1'),
(46, 100028, '3'),
(47, 100028, '3'),
(48, 100028, '10'),
(49, 100028, '8'),
(50, 100028, '4'),
(51, 100028, '192 GB'),
(52, 100028, '10/100/1000/2500 Mbit/s'),
(53, 100028, '0, 1, 10'),
(54, 100028, 'ATX'),
(55, 100028, '243 x 304'),
(35, 100029, 'Socket AM5'),
(36, 100029, 'AMD x870'),
(37, 100029, 'AMD'),
(38, 100029, 'DDR5'),
(39, 100029, 'PCI-E'),
(40, 100029, 'Van'),
(41, 100029, 'Van'),
(42, 100029, '4'),
(43, 100029, '4'),
(44, 100029, '2'),
(45, 100029, '0'),
(46, 100029, '4'),
(47, 100029, '4'),
(48, 100029, '2'),
(49, 100029, '0'),
(50, 100029, '5'),
(51, 100029, '192 GB'),
(52, 100029, '10/100/1000/2500 Mbit/s'),
(53, 100029, '0, 1, 5, 10'),
(54, 100029, 'ATX'),
(55, 100029, '305 x 244'),
(35, 100030, 'Socket AM4'),
(36, 100030, 'AMD b550'),
(37, 100030, 'AMD'),
(38, 100030, 'DDR4'),
(39, 100030, 'PCI-E'),
(40, 100030, 'Van'),
(41, 100030, 'Van'),
(42, 100030, '4'),
(43, 100030, '4'),
(44, 100030, '2'),
(45, 100030, '1'),
(46, 100030, '4'),
(47, 100030, '1'),
(48, 100030, '5'),
(49, 100030, '6'),
(50, 100030, '0'),
(51, 100030, '128 GB'),
(52, 100030, '10/100/1000 Mbit/s'),
(53, 100030, '0, 1, 10'),
(54, 100030, 'ATX'),
(55, 100030, '244 x 244'),
(35, 100031, 'Socket 1700'),
(36, 100031, 'Intel B760'),
(37, 100031, 'Intel'),
(38, 100031, 'DDR5'),
(39, 100031, 'PCI-E'),
(40, 100031, 'Van'),
(41, 100031, 'Van'),
(42, 100031, '4'),
(43, 100031, '4'),
(44, 100031, '1'),
(45, 100031, '2'),
(46, 100031, '4'),
(47, 100031, '3'),
(48, 100031, '5'),
(49, 100031, '0'),
(50, 100031, '1'),
(51, 100031, '128 GB'),
(52, 100031, '10/100/1000/2500 Mbit/s'),
(53, 100031, '0, 1, 5, 10'),
(54, 100031, 'ATX'),
(55, 100031, '244 x 305'),
(35, 100032, 'Socket 1700'),
(36, 100032, 'Intel Z790'),
(37, 100032, 'Intel'),
(38, 100032, 'DDR5'),
(39, 100032, 'PCI-E'),
(40, 100032, 'Van'),
(41, 100032, 'Van'),
(42, 100032, '4'),
(43, 100032, '7'),
(44, 100032, '2'),
(45, 100032, '1'),
(46, 100032, '7'),
(47, 100032, '4'),
(48, 100032, '0'),
(49, 100032, '0'),
(50, 100032, '4'),
(51, 100032, '128 GB'),
(52, 100032, '10/100/1000/2500 Mbit/s'),
(53, 100032, '0, 1, 5, 10'),
(54, 100032, 'ATX'),
(55, 100032, '244 x 305'),
(35, 100033, 'Socket 1851'),
(36, 100033, 'Intel Z890'),
(37, 100033, 'Intel'),
(38, 100033, 'DDR5'),
(39, 100033, 'PCI-E'),
(40, 100033, 'Van'),
(41, 100033, 'Nincs'),
(42, 100033, '4'),
(43, 100033, '4'),
(44, 100033, '2'),
(45, 100033, '1'),
(46, 100033, '4'),
(47, 100033, '6'),
(48, 100033, '0'),
(49, 100033, '0'),
(50, 100033, '4'),
(51, 100033, '192 GB'),
(52, 100033, '10/100/1000/2500 Mbit/s'),
(53, 100033, '0, 1, 5, 10'),
(54, 100033, 'ATX'),
(55, 100033, '305 x 244'),
(75, 100034, 'Fix kábelezésű tápegység'),
(76, 100034, '750 W'),
(77, 100034, '80+ Bronze'),
(78, 100034, 'Aktív'),
(79, 100034, '120 MM'),
(80, 100034, '20 A'),
(81, 100034, '20 A'),
(82, 100034, '62.5 A'),
(83, 100034, '0.3 A'),
(84, 100034, 'Van'),
(85, 100034, '1'),
(86, 100034, '2'),
(87, 100034, '8'),
(88, 100034, '4'),
(75, 100035, 'Moduláris tápegység'),
(76, 100035, '850 W'),
(77, 100035, '80+ Gold'),
(78, 100035, 'Aktív'),
(79, 100035, '135 MM'),
(80, 100035, '20 A'),
(81, 100035, '20 A'),
(82, 100035, '70 A'),
(83, 100035, '0.3 A'),
(84, 100035, 'Van'),
(85, 100035, '0'),
(86, 100035, '3'),
(87, 100035, '8'),
(88, 100035, '3'),
(75, 100036, 'Moduláris tápegység'),
(76, 100036, '850 W'),
(77, 100036, '80+ Gold'),
(78, 100036, 'Aktív'),
(79, 100036, '135 MM'),
(80, 100036, '20 A'),
(81, 100036, '3 A'),
(82, 100036, '70.8 A'),
(83, 100036, '0.3 A'),
(84, 100036, 'Van'),
(85, 100036, '0'),
(86, 100036, '4'),
(87, 100036, '14'),
(88, 100036, '4'),
(75, 100037, 'Moduláris tápegység'),
(76, 100037, '850 W'),
(77, 100037, '80+ Gold'),
(78, 100037, 'Aktív'),
(79, 100037, '120 MM'),
(80, 100037, '22 A'),
(81, 100037, '22 A'),
(82, 100037, '22 A'),
(83, 100037, '0.3 A'),
(84, 100037, 'Van'),
(85, 100037, '0'),
(86, 100037, '2'),
(87, 100037, '6'),
(88, 100037, '4'),
(75, 100038, 'Moduláris tápegység'),
(76, 100038, '1200 W'),
(77, 100038, '80+ Platinum'),
(78, 100038, 'Aktív'),
(79, 100038, '135 MM'),
(80, 100038, '25 A'),
(81, 100038, '25 A'),
(82, 100038, '100 A'),
(83, 100038, '0.3 A'),
(84, 100038, 'Van'),
(85, 100038, '0'),
(86, 100038, '3'),
(87, 100038, '6'),
(88, 100038, '4'),
(75, 100039, 'Moduláris tápegység'),
(76, 100039, '1000 W'),
(77, 100039, '80+ Gold'),
(78, 100039, 'Aktív'),
(79, 100039, '135 MM'),
(80, 100039, '25 A'),
(81, 100039, '25 A'),
(82, 100039, '83 A'),
(83, 100039, '0.3 A'),
(84, 100039, 'Van'),
(85, 100039, '0'),
(86, 100039, '3'),
(87, 100039, '8'),
(88, 100039, '3'),
(89, 100040, 'MidiTower'),
(90, 100040, '4'),
(91, 100040, '2'),
(92, 100040, '200 mm'),
(93, 100040, '437 mm'),
(94, 100040, '450 mm'),
(95, 100040, '3600 g'),
(96, 100040, 'ATX, Micro ATX, Mini ITX'),
(97, 100040, '3'),
(98, 100040, 'Van'),
(99, 100040, 'Van'),
(100, 100040, 'Fekete'),
(89, 100041, 'MidiTower'),
(90, 100041, '2'),
(91, 100041, '2'),
(92, 100041, '285 mm'),
(93, 100041, '440 mm'),
(94, 100041, '399 mm'),
(95, 100041, '2000 g'),
(96, 100041, 'ATX, Micro ATX, Mini ITX'),
(97, 100041, '3'),
(98, 100041, 'Van'),
(99, 100041, 'Van'),
(100, 100041, 'Fekete'),
(89, 100042, 'MidiTower'),
(90, 100042, '4'),
(91, 100042, '2'),
(92, 100042, '232 mm'),
(93, 100042, '463 mm'),
(94, 100042, '450 mm'),
(95, 100042, '7800 g'),
(96, 100042, 'ATX, Micro ATX, Mini ITX'),
(97, 100042, '2'),
(98, 100042, 'Van'),
(99, 100042, 'Van'),
(100, 100042, 'Fekete'),
(89, 100043, 'MidiTower'),
(90, 100043, '2'),
(91, 100043, '2'),
(92, 100043, '230 mm'),
(93, 100043, '466 mm'),
(94, 100043, '433 mm'),
(95, 100043, '7800 g'),
(96, 100043, 'ATX, Micro ATX, EATX, Mini ITX'),
(97, 100043, '2'),
(98, 100043, 'Van'),
(99, 100043, 'Van'),
(100, 100043, 'Fekete'),
(89, 100044, 'MidiTower'),
(90, 100044, '2'),
(91, 100044, '1'),
(92, 100044, '227 mm'),
(93, 100044, '464 mm'),
(94, 100044, '446 mm'),
(95, 100044, '7000 g'),
(96, 100044, 'ATX, Micro ATX, EATX, Mini ITX'),
(97, 100044, '2'),
(98, 100044, 'Van'),
(99, 100044, 'Van'),
(100, 100044, 'Fehér'),
(101, 100045, 'Aktív hűtő'),
(102, 100045, '120 mm'),
(103, 100045, '1600 rpm'),
(104, 100045, '25.5 dB'),
(105, 100045, '49.9 CFM'),
(106, 100045, 'Nincs'),
(107, 100045, '120 x 120 x 25 mm'),
(108, 100045, '147 g'),
(101, 100046, 'Aktív hűtő'),
(102, 100046, '140 mm'),
(103, 100046, '1800 rpm'),
(104, 100046, '30.5 dB'),
(105, 100046, '72.2 CFM'),
(106, 100046, 'Nincs'),
(107, 100046, '140 x 140 x 25 mm'),
(108, 100046, '188 g'),
(101, 100047, 'Aktív hűtő'),
(102, 100047, '140 mm'),
(103, 100047, '2000 rpm'),
(104, 100047, '38.8 dB'),
(105, 100047, '81.6 CFM'),
(106, 100047, 'Van'),
(107, 100047, '140 x 140 x 25 mm'),
(108, 100047, '505 g'),
(101, 100048, 'Aktív hűtő'),
(102, 100048, '140 mm'),
(103, 100048, '2000 rpm'),
(104, 100048, '30 dB'),
(105, 100048, '76.5 CFM'),
(106, 100048, 'Van'),
(107, 100048, '140 x 140 x 25 mm'),
(108, 100048, '222 g'),
(101, 100049, 'Aktív hűtő'),
(102, 100049, '120 mm'),
(103, 100049, '2100 rpm'),
(104, 100049, '30 dB'),
(105, 100049, '59.6 CFM'),
(106, 100049, 'Nincs'),
(107, 100049, '120 x 120 x 25 mm'),
(108, 100049, '176 g'),
(109, 100050, 'Aktív hűtő'),
(110, 100050, '135 mm'),
(111, 100050, '1700 rpm'),
(112, 100050, '23.3 dB'),
(113, 100050, 'Nincs'),
(114, 100050, 'Nincs'),
(115, 100050, '145 x 136 x 168 mm'),
(116, 100050, '1290 g'),
(117, 100051, 'Fekete'),
(109, 100051, 'Folyadék hűtő'),
(110, 100051, '120 mm'),
(111, 100051, '2000 rpm'),
(112, 100051, '32.2 dB'),
(113, 100051, '48.82 CFM'),
(114, 100051, 'Van'),
(115, 100051, '398 x 120 x 38 mm'),
(116, 100052, '1870 g'),
(117, 100052, 'Fekete'),
(109, 100052, 'Aktív hűtő'),
(110, 100052, '140 mm'),
(111, 100052, '1500 rpm'),
(112, 100052, '24.6 dB'),
(113, 100052, '140.2 CFM'),
(114, 100052, 'Nincs'),
(115, 100053, '165 x 160 x 161 mm'),
(116, 100053, '1320 g'),
(117, 100053, 'Fekete'),
(109, 100053, 'Aktív hűtő'),
(110, 100053, '120 mm'),
(111, 100053, '1850 rpm'),
(112, 100053, '28 dB'),
(113, 100053, '68.99 CFM'),
(114, 100054, 'Van'),
(115, 100054, '129 x 138 x 162 mm'),
(116, 100054, '1486 g'),
(117, 100054, 'Fekete'),
(109, 100054, 'Folyadék hűtő'),
(110, 100054, '120 mm'),
(111, 100054, '2000 rpm'),
(112, 100054, '32.2 dB'),
(113, 100054, '146.46 CFM'),
(114, 100054, 'Van'),
(115, 100054, '398 x 120 x 38 mm'),
(116, 100054, '1870 g'),
(117, 100054, 'Fehér');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tulajdonsag`
--

CREATE TABLE `tulajdonsag` (
  `tul_nev_id` int(11) NOT NULL,
  `tul_nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `tulajdonsag`
--

INSERT INTO `tulajdonsag` (`tul_nev_id`, `tul_nev`) VALUES
(1, 'Kialakítás'),
(2, 'M.2 méret'),
(3, 'Kapacitás'),
(4, 'NAND flash típusa'),
(5, 'Maximális SSD olvasási sebesség'),
(6, 'Maximális SSD írási sebesség'),
(7, 'Írástűrés'),
(8, 'Csatlakozók'),
(9, 'Kapacitás'),
(10, 'Fordulatszám'),
(11, 'Cache mérete'),
(12, 'Maximális adatátviteli sebesség'),
(13, 'Csatlakozók'),
(14, 'Csatolófelület'),
(15, 'Video chipset és termékcsalád'),
(16, 'Hűtés típusa'),
(17, 'Ventilátorok száma'),
(18, 'Grafikus chip sebessége'),
(19, 'Grafikus memória sebessége'),
(20, 'Memória mérete'),
(21, 'Memória típusa'),
(22, 'Memória sávszélesség'),
(23, 'Maximális felbontás'),
(24, 'DirectX'),
(25, 'OpenGL'),
(26, 'Tápcsatlakozó'),
(27, 'Ajánlott tápegység'),
(28, 'VGA'),
(29, 'DVI csatlakozók száma'),
(30, 'HDMI csatlakozók száma'),
(31, 'DisplayPort csatlakozók száma'),
(32, 'USB Type-C'),
(33, 'Szélesség'),
(34, 'Hosszúság'),
(35, 'Vastagság'),
(36, 'Típus'),
(37, 'Magok száma'),
(38, 'Szálak száma'),
(39, 'Processzor foglalat'),
(40, 'Processzor órajel'),
(41, 'Processzor Turbo órajel'),
(42, 'Gyártási technológia'),
(43, 'Integrált grafikai processzor'),
(44, 'L2 cache'),
(45, 'L3 cache'),
(46, 'TDP'),
(47, 'Rendszermemória'),
(48, 'CPU Foglalat'),
(49, 'Chipset'),
(50, 'Processzor gyártó'),
(51, 'Memória típusa'),
(52, 'Videokártya típusa'),
(53, 'HDMI'),
(54, 'DisplayPort'),
(55, 'Memória foglalatok száma'),
(56, 'SATA csatlakozók száma'),
(57, 'PCI-Express 16x csatlakozó száma'),
(58, 'PCI-Express 1x csatlakozók száma'),
(59, 'SATA 3 csatlakozók száma'),
(60, 'm.2 csatlakozók száma'),
(61, 'Hátlapi USB 2.0 portok száma'),
(62, 'Hátlapi USB 3.2 Gen 1 portok száma'),
(63, 'Hátlapi USB 3.2 Gen 2 portok száma'),
(64, 'Maximum memória mérete'),
(65, 'Integrált LAN sebessége'),
(66, 'RAID szintek'),
(67, 'Méret szabvány'),
(68, 'Alaplap mérete'),
(69, 'Tápegység típusa'),
(70, 'Tápegység teljesítménye'),
(71, 'Hatásfok'),
(72, 'PFC'),
(73, 'Ventilátor mérete'),
(74, 'Maximum áramfelvétel +3,3V'),
(75, 'Maximum áramfelvétel +5V'),
(76, 'Maximum áramfelvétel +12V'),
(77, 'Maximum áramfelvétel -12V'),
(78, 'Tápkapcsoló'),
(79, 'FDD csatlakozó'),
(80, 'HDD csatlakozó'),
(81, 'SATA csatlakozó'),
(82, 'PCI-E csatlakozó'),
(83, 'Típus'),
(84, '2.5\" belső bővítőhely'),
(85, '3.5\" belső bővítőhely'),
(86, 'Szélesség'),
(87, 'Magasság'),
(88, 'Mélység'),
(89, 'Tömeg'),
(90, 'Támogatott alaplaptípusok'),
(91, 'USB csatlakozók száma'),
(92, 'Audio az előlapon'),
(93, 'Átlátszó oldalfal'),
(94, 'Szín'),
(95, 'Típus'),
(96, 'Ventilátor átmérője'),
(97, 'Ventilátor fordulatszáma'),
(98, 'Maximális zajszint'),
(99, 'Levegőáramlás'),
(100, 'LED megvilágítás'),
(101, 'Méretek'),
(102, 'Tömeg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `irszam` varchar(255) DEFAULT NULL,
  `varos` varchar(255) DEFAULT NULL,
  `uha` varchar(255) DEFAULT NULL,
  `megj` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`);

--
-- A tábla indexei `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefon` (`telefon`);

--
-- A tábla indexei `gyarto`
--
ALTER TABLE `gyarto`
  ADD PRIMARY KEY (`gyarto_id`);

--
-- A tábla indexei `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `cikkszam` (`cikkszam`);

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kat_id`);

--
-- A tábla indexei `kat_tul`
--
ALTER TABLE `kat_tul`
  ADD PRIMARY KEY (`kat_tul_id`);

--
-- A tábla indexei `loyalty`
--
ALTER TABLE `loyalty`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`rank_id`);

--
-- A tábla indexei `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cikkszam` (`cikkszam`),
  ADD KEY `rendt_id` (`rendt_id`);

--
-- A tábla indexei `rendeles_torzs`
--
ALTER TABLE `rendeles_torzs`
  ADD PRIMARY KEY (`rendt_id`),
  ADD UNIQUE KEY `billing_id` (`billing_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `guest_id` (`guest_id`);

--
-- A tábla indexei `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `cikkszam` (`cikkszam`);

--
-- A tábla indexei `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`cikkszam`),
  ADD UNIQUE KEY `termek_nev` (`termek_nev`),
  ADD KEY `kat_id` (`kat_id`),
  ADD KEY `gyarto_id` (`gyarto_id`);

--
-- A tábla indexei `termek_tul`
--
ALTER TABLE `termek_tul`
  ADD KEY `cikkszam` (`cikkszam`);

--
-- A tábla indexei `tulajdonsag`
--
ALTER TABLE `tulajdonsag`
  ADD PRIMARY KEY (`tul_nev_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `gyarto`
--
ALTER TABLE `gyarto`
  MODIFY `gyarto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT a táblához `image`
--
ALTER TABLE `image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `kat_tul`
--
ALTER TABLE `kat_tul`
  MODIFY `kat_tul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT a táblához `loyalty`
--
ALTER TABLE `loyalty`
  MODIFY `loyalty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rendeles_torzs`
--
ALTER TABLE `rendeles_torzs`
  MODIFY `rendt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `termek`
--
ALTER TABLE `termek`
  MODIFY `cikkszam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100055;

--
-- AUTO_INCREMENT a táblához `tulajdonsag`
--
ALTER TABLE `tulajdonsag`
  MODIFY `tul_nev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `termek` (`cikkszam`);

--
-- Megkötések a táblához `loyalty`
--
ALTER TABLE `loyalty`
  ADD CONSTRAINT `loyalty_ibfk_1` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`rank_id`),
  ADD CONSTRAINT `loyalty_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Megkötések a táblához `rendeles_tetel`
--
ALTER TABLE `rendeles_tetel`
  ADD CONSTRAINT `rendeles_tetel_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `termek` (`cikkszam`),
  ADD CONSTRAINT `rendeles_tetel_ibfk_2` FOREIGN KEY (`rendt_id`) REFERENCES `rendeles_torzs` (`rendt_id`);

--
-- Megkötések a táblához `rendeles_torzs`
--
ALTER TABLE `rendeles_torzs`
  ADD CONSTRAINT `rendeles_torzs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `rendeles_torzs_ibfk_2` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`),
  ADD CONSTRAINT `rendeles_torzs_ibfk_3` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`);

--
-- Megkötések a táblához `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`cikkszam`) REFERENCES `termek` (`cikkszam`);

--
-- Megkötések a táblához `termek`
--
ALTER TABLE `termek`
  ADD CONSTRAINT `termek_ibfk_1` FOREIGN KEY (`kat_id`) REFERENCES `kategoria` (`kat_id`),
  ADD CONSTRAINT `termek_ibfk_2` FOREIGN KEY (`gyarto_id`) REFERENCES `gyarto` (`gyarto_id`);

--
-- Megkötések a táblához `termek_tul`
--
ALTER TABLE `termek_tul`
  ADD CONSTRAINT `termek_tul_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `termek` (`cikkszam`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
