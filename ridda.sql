-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 04:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ridda`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('win','closed','progress') NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `bidder_id`, `product_id`, `amount`, `status`) VALUES
(1, 6, 0, 100002, 'progress'),
(9, 1, 2, 100002, 'progress'),
(10, 27, 3, 100002, 'win'),
(11, 26, 20, 100002, 'progress'),
(12, 6, 2, 100002, 'progress'),
(13, 28, 2, 23000, 'win'),
(14, 6, 20, 20000, 'win'),
(15, 6, 17, 20, 'progress'),
(16, 6, 5, 100, 'progress'),
(17, 6, 13, 20000, 'progress');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'approve'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `status`) VALUES
(1, 'mobile', 'approve'),
(2, 'computer and accessories', 'approve'),
(3, 'fashion', 'approve'),
(4, 'entertainment', 'approve'),
(5, 'electronics', 'approve'),
(6, 'home and kitchen', 'approve'),
(7, 'baby, kids and toys', 'approve'),
(8, 'automobile', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_riders`
--

CREATE TABLE `merchant_riders` (
  `id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_riders`
--

INSERT INTO `merchant_riders` (`id`, `merchant_id`, `rider_id`) VALUES
(0, 1, 2),
(0, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_type` enum('bidda','merchant') NOT NULL DEFAULT 'bidda',
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `images` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `product_type`, `name`, `description`, `category_id`, `qty`, `price`, `images`, `date`) VALUES
(1, 1, 'merchant', 'infinix note 11', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_infinix note 11_2021-01-17.jpg', '2021-01-17 08:33:22'),
(2, 6, 'bidda', 'infinix note', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_infinix note_2021-01-17.jpg', '2021-01-17 08:34:04'),
(3, 6, 'bidda', 'infinix note 10', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 1, 10, 10000, '1_infinix note 10_2021-01-17.jpg', '2021-01-17 08:34:17'),
(4, 1, 'merchant', 'sydee stack 2.0', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 1, 1, 1000, '1_sydee stack 2.0_2021-01-17.jpg', '2021-01-17 08:35:14'),
(5, 1, 'bidda', 'toys', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 100, 10, '1_toys_2021-01-17.jpg', '2021-01-17 08:37:43'),
(6, 1, 'bidda', 'mens slip on formal shoes fashion soft leather shoes black', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 3, 100, 10, '1_mens slip on formal shoes fashion soft leather shoes black_2021-01-17.jpg', '2021-01-17 08:38:02'),
(7, 1, 'bidda', 'mens slip on formal shoes fashion soft leather shoes', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 3, 100, 10, '1_mens slip on formal shoes fashion soft leather shoes_2021-01-17.jpg', '2021-01-17 08:38:23'),
(8, 1, 'bidda', 'mens slip on formal shoes fashion', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 3, 100, 10, '1_mens slip on formal shoes fashion_2021-01-17.jpg', '2021-01-17 08:38:40'),
(9, 1, 'bidda', 'shoe', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 1, 10, 10000, '1_shoe_2021-01-17.jpg', '2021-01-17 08:39:46'),
(10, 1, 'bidda', 'shirt', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 1, 10, 10000, '1_shirt_2021-01-17.jpg', '2021-01-17 08:40:04'),
(11, 1, 'bidda', 'techno 7', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_techno 7_2021-01-17.jpg', '2021-01-17 08:40:26'),
(12, 1, 'bidda', 'laptop 12', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_laptop 12_2021-01-17.jpg', '2021-01-17 08:41:10'),
(13, 1, 'bidda', 'hp laserjet 2021', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_hp laserjet 2021_2021-01-17.jpg', '2021-01-17 08:41:27'),
(14, 1, 'bidda', 'hp laserjet 2200', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_hp laserjet 2200_2021-01-17.jpg', '2021-01-17 08:41:37'),
(15, 1, 'bidda', 'hp inkjet 2200', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_hp inkjet 2200_2021-01-17.jpg', '2021-01-17 08:41:49'),
(16, 1, 'bidda', 'laserjet', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 10, 10000, '1_laserjet_2021-01-17.jpg', '2021-01-17 08:42:38'),
(17, 1, 'bidda', 'hi', 'Experience the power of an everyday classic\r\nOne of the world’s smallest all-rounder 14-inch laptops\r\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178° viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it’s powered by up to an 8th Generation Intel® Core™ i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA® MX250 discrete graphics.\r\n\r\nDual Storage\r\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel® Optane™ memory1 technology so apps load faster and multitasking feels smoother.\r\n\r\nGet a wider view of the world\r\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what’s in front of you.\r\n\r\nStylish & Portable\r\n\r\nEmpower your dynamic lifestyle!\r\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.\r\n\r\nRich, crystal-clear audio\r\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.\r\n\r\nModel: X409JA-BV017T\r\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz\r\nOperating System: Windows 10 Home\r\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM\r\nDisplay: 14.0', 2, 78, 10, '1_hi_2021-01-17.jpg', '2021-01-17 08:48:53'),
(18, 1, 'bidda', 'ear pod', '<p><strong>Experience the power of an everyday classic</strong><br />\nOne of the world&rsquo;s smallest all-rounder 14-inch laptops<br />\nWhether for work or play, ASUS X409 is the entry-level laptop that delivers powerful performance and immersive visuals. Its NanoEdge display boasts wide 178&deg; viewing angles and a matte anti-glare coating for a truly engaging experience. Inside, it&rsquo;s powered by up to an 8th Generation Intel&reg; Core&trade; i7 processor with up to 16GB 2400MHz RAM, and features NVIDIA&reg; MX250 discrete graphics.</p>\n\n<p><strong>Dual Storage</strong><br />\nASUS X409 has a dual-storage design to give you the benefits of superfast data performance and a large storage capacity. Install apps on the SSD for quicker response and loading times, and use the HDD to store large files such as movies, music libraries, and photo albums. ASUS X409 also features Intel&reg; Optane&trade; memory1 technology so apps load faster and multitasking feels smoother.</p>\n\n<p><strong>Get a wider view of the world</strong><br />\nThe NanoEdge display gives ASUS X409 a vast screen area for an immersive viewing experience for work and play. Its wide-view FHD panel features an anti-glare coating to reduce unwanted distractions from irritating glare and reflections, so you can truly focus on what&rsquo;s in front of you.</p>\n\n<p><strong>Stylish &amp; Portable</strong></p>\n\n<p><strong>Empower your dynamic lifestyle!</strong><br />\nWith an overall weight of just 1.65kg2, the extremely portable ASUS X409 is the lightweight laptop that keeps up with your fast-paced lifestyle. It looks good, too, with its Transparent Silver or Slate Grey finish.<br />\n<br />\n<strong>Rich, crystal-clear audio</strong><br />\nASUS SonicMaster is a combination of hardware, software and audio tuning designed with the goal of giving you the very best audio experience. A professional-grade codec ensures precise audio encoding and decoding; while amplifiers, large speakers and resonance chambers perfectly suited to ASUS X409 ensure a powerful audio delivery and deeper bass. Additional signal processing and tuning help refine minute details, filter noise and improve audio clarity so you get truly immersive sound.</p>\n\n<p>Model:&nbsp;X409JA-BV017T<br />\nProcessor: Intel Core i3-1005G1 Processor4M Cache, up to 3.40 GHz<br />\nOperating System: Windows 10 Home<br />\nMemory: 4GB Onboard memory, 1 x SO-DIMM socket , total up to 8 GB SDRAM<br />\nDisplay: 14.0&quot; (16:9) LED-backlit HD (1366x768) 60Hz Anti-Glare Panel with 45% NTSC<br />\nGraphic: Integrated Intel UHD Graphics<br />\nStorage: 1TB HDD<br />\nNetworking: Integrated Wi-Fi 5 (802.11 ac), Bluetooth 5.0<br />\nBattery: 2 -Cell 32 Wh lithium-polymer battery<br />\nInterface:<br />\n1 x COMBO audio jack<br />\n1 x Type-C USB 3.0 (USB 3.1 Gen 1)<br />\n1 x Type-A USB 3.0 (USB 3.1 Gen 1)<br />\n2 x USB 2.0 port(s)<br />\n1 x HDMI</p>\n', 1, 78, 10, '1_ear pod_2021-01-17.jpg', '2021-01-17 08:57:31'),
(19, 1, 'bidda', 'lucky pen (biro)', '<p>Lucky Pen (biro)</p>\n', 1, 1000, 100, '1_lucky pen (biro)_2021-01-19.jpg', '2021-01-19 21:21:03'),
(20, 6, 'bidda', 'car', '<p>this care is best in&nbsp;</p>\r\n', 6, 120, 23, '6_car_2023-03-14.jpg', '2023-03-14 12:41:09'),
(21, 6, 'merchant', 'bag', '<p>This is an arabian bag, made with tiger fur and heavely sought after by the arabian royal house.&nbsp;</p>\r\n\r\n<p>Having this in your collection will greatly propel your social status</p>\r\n', 3, 20, 230000, '6_bag_2023-03-14.jpg', '2023-03-14 21:30:30'),
(22, 6, 'bidda', 'personal', '<p>adkjdkj</p>\r\n', 6, 98, 87, '6_personal_2023-03-16.jpg', '2023-03-16 00:28:59'),
(23, 6, 'merchant', 'personal3', '<p>adkjdkj</p>\r\n', 6, 98, 87, '6_personal3_2023-03-16.jpg', '2023-03-16 00:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `trading_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `subaccount_id` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `userid`, `trading_name`, `account_number`, `account_name`, `subaccount_id`, `country`, `bank`, `bank_code`, `dob`, `address`, `city`, `state`, `date`) VALUES
(1, 1, 'sydee stack', '48846700', 'SAEED MARYAM', 'RS_9332DF2E80DF77E24F0EEEADBA3210DC', 'NG', 'GTBANK PLC', '058', '2021-01-07', 'lokoja kogi state', 'lokoja', 'kogi state', '2021-01-15 23:05:02'),
(2, 6, 'testing testing', '176078309', 'AKA&apos;ABA MUSA AKIDI', 'RS_6EE95BCAD4F50D5CA28220A881115C57', 'NG', 'GTBANK PLC', '058', '2023-03-22', 'suite 1', 'lokoja', 'kogi', '2023-03-14 12:46:52'),
(3, 28, '', '', '', '', '', '', '', '2023-03-14', 'babcock university', 'ilisha', 'ogun', '2023-03-14 21:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `subaccount_id` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `number_of_fleet` varchar(255) NOT NULL,
  `company_document` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`id`, `userid`, `company_name`, `company_phone`, `account_number`, `bank`, `account_name`, `bank_name`, `subaccount_id`, `country`, `company_address`, `number_of_fleet`, `company_document`, `status`, `date`) VALUES
(1, 6, 'sydee logistics', '07064711513', '0176078309', '058', 'AKA&apos;ABA MUSA AKIDI', 'GTBANK PLC', 'RS_67A99D97CD06818D17733F6B41908D3C', 'NG', 'lokoja kogi state', '10', '6_sydee logistics_2021-01-15.pdf', 'approved', '2021-01-15 16:44:08'),
(2, 1, 'sydee stack', '07064711513', '0176078309', '058', 'AKA&apos;ABA MUSA AKIDI', 'GTBANK PLC', 'RS_67A99D97CD06818D17733F6B41908D3C', 'NG', 'no 5 zaria street, lokoja', '10', '1_sydee stack_2021-01-15.pdf', 'approved', '2021-01-15 20:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `trasaction_id` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `merchant_id`, `product_id`, `qty`, `rider_id`, `trasaction_id`, `date`) VALUES
(24, 1, 1, 4, 5, 1, '1850829', '2021-01-19 19:13:25'),
(25, 1, 1, 3, 4, 1, '1850829', '2021-01-19 19:15:01'),
(26, 1, 1, 4, 5, 1, '1850829', '2021-01-19 19:15:01'),
(27, 1, 1, 4, 1, 1, '1850842', '2021-01-19 19:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `transaction_code` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `verification_code` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `gender`, `country`, `type`, `password`, `transaction_code`, `status`, `verification_code`, `date`) VALUES
(1, 'aka\'aba musa akidi', 'sydeestack@gmail.com', '07064711513', 'm', 'nigeria', 'admin', '$2y$10$4fqOQsSMj5lf5wNDz33/fOWOFFuWa3dSgkmc6oU2P1lhoOZ1QajEi', '1850782', 'active', 'xtskeituuy', '2021-01-14 23:18:39'),
(6, 'aka\'aba musa akidi', 'onlinemraam@gmail.com', '07064355463', 'm', 'nigeria', 'rider', '$2y$10$jvCEzkOYBRm9VqyxVWryB.yLrRTA.29eyA2mLJ0kWMa4ofw.1GL3e', 'null', 'active', 'xtskeituuy', '2021-01-15 11:26:43'),
(26, 'aka\'aba musa akidi', 'kingakidi@gmail.com', '08064711513', 'm', 'nigeria', 'merchant', '$2y$10$syhxgCSg.o47yFb0eHwtgemQXBflxVtTcVty/nf3cvPhHsLRMFUBG', '1848850', 'active', 'xtskeituuy', '2021-01-19 07:18:45'),
(27, 'musa aka\'aba', 'akaabaakidi@gmail.com', '07032889876', 'm', 'nigeria', 'merchant', '$2y$10$SgvMyLE7v0vRGroYPoZuU.FPeYkNicHxgS3gWlcbRykLDHSSVdkka', 'null', 'active', 'xtskeituuy', '2023-03-14 11:58:14'),
(28, 'adetutu olubusoye', 'adetutuolubusoye@gmail.com', '0908765443', 'f', 'nigeria', 'merchant', '$2y$10$bmrVAOmQI1Zu60.94uQFpOa/Lh4wQU7i7CC48xUNwTrOiIVqIe1Uu', '1850782', 'active', 'xtskeituuy', '2023-03-14 21:09:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
