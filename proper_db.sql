-- phpMyAdmin SQL Dump
-- version 2.6.4-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: mysql5
-- Generation Time: Mar 12, 2012 at 11:33 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.4
-- 
-- Database: `fet10029052`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `book_type`
-- 

CREATE TABLE IF NOT EXISTS `book_type` (
  `book_type_id` int(11) NOT NULL,
  `book_type_name` varchar(8) default NULL,
  PRIMARY KEY  (`book_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `book_type`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `customer`
-- 

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `city` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `customer`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `customer_order`
-- 

CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `order_placed_date` date default NULL,
  `order_status` int(11) NOT NULL,
  `fk1_id` int(11) NOT NULL,
  PRIMARY KEY  (`order_id`,`cu_id`),
  KEY `fk1_customer_order_to_customer` (`fk1_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `customer_order`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `film_type`
-- 

CREATE TABLE IF NOT EXISTS `film_type` (
  `film_type_id` int(11) NOT NULL,
  `film_type_name` varchar(8) default NULL,
  PRIMARY KEY  (`film_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `film_type`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `order_items`
-- 

CREATE TABLE IF NOT EXISTS `order_items` (
  `cu_order_id` int(11) NOT NULL,
  `cu_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `fk1_product_id` int(11) NOT NULL,
  `fk1_type_id` int(11) NOT NULL,
  `fk1_fk1_prod_book_type_id` int(11) NOT NULL,
  `fk1_fk1_book_type` int(11) NOT NULL,
  `fk1_fk2_prod_film_type_id` int(11) NOT NULL,
  `fk2_order_id` int(11) NOT NULL,
  `fk2_cu_id` int(11) NOT NULL,
  PRIMARY KEY  (`cu_order_id`,`cu_product_id`),
  KEY `fk1_order_items_to_product` (`fk1_product_id`,`fk1_type_id`,`fk1_fk1_prod_book_type_id`,`fk1_fk1_book_type`,`fk1_fk2_prod_film_type_id`),
  KEY `fk2_order_items_to_customer_order` (`fk2_order_id`,`fk2_cu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `order_items`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prod_book`
-- 

CREATE TABLE IF NOT EXISTS `prod_book` (
  `prod_book_type_id` int(11) NOT NULL,
  `book_type` int(11) NOT NULL,
  `author` varchar(25) NOT NULL,
  `page_number` int(11) default NULL,
  `isbn_10` int(11) default NULL,
  `isbn_13` int(11) default NULL,
  `fk1_book_type_id` int(11) NOT NULL,
  PRIMARY KEY  (`prod_book_type_id`,`book_type`),
  KEY `fk1_prod_book_to_book_type` (`fk1_book_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prod_book`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `prod_film`
-- 

CREATE TABLE IF NOT EXISTS `prod_film` (
  `prod_film_type_id` int(11) NOT NULL,
  `film_type` int(11) default NULL,
  `director` varchar(25) default NULL,
  `length` bigint(20) default NULL,
  `studio` varchar(25) default NULL,
  `fk1_film_type_id` int(11) NOT NULL,
  PRIMARY KEY  (`prod_film_type_id`),
  KEY `fk1_prod_film_to_film_type` (`fk1_film_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prod_film`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `product`
-- 

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) default NULL,
  `release_year` int(11) default NULL,
  `publisher` varchar(50) default NULL,
  `image_url` varchar(200) default NULL,
  `language` varchar(50) default NULL,
  `stock_level` int(11) default NULL,
  `fk1_prod_book_type_id` int(11) NOT NULL,
  `fk1_book_type` int(11) NOT NULL,
  `fk2_prod_film_type_id` int(11) NOT NULL,
  PRIMARY KEY  (`product_id`,`type_id`,`fk1_prod_book_type_id`,`fk1_book_type`,`fk2_prod_film_type_id`),
  KEY `fk1_product_to_prod_book` (`fk1_prod_book_type_id`,`fk1_book_type`),
  KEY `fk2_product_to_prod_film` (`fk2_prod_film_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `product`
-- 

