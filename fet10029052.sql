-- phpMyAdmin SQL Dump
-- version 2.6.4-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: mysql5
-- Generation Time: Apr 04, 2012 at 04:27 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.4
-- 
-- Database: `fet10029052`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `customer`
-- 

CREATE TABLE `customer` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `city` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `customer`
-- 

INSERT INTO `customer` VALUES (1, 'Alexander', 'Jegtnes', '8 Branksome Crescent', 'BS34 7EQ', 'Bristol', 'saccosekk@gmail.com', '$2a$08$1BtJvIr2kOCBAWqhlKndFuUUfCGw.cu2ZnsaOrbCxvJQIxOlIMmPG');
INSERT INTO `customer` VALUES (3, 'Alex', 'J', 'Address here.', 'BS12 111', 'Dummy', 'alex@email.com', '$P$BDFv1W90iHd3QjJDFlZbN.24oPwCFS/');
INSERT INTO `customer` VALUES (4, 'What', 'Ever', 'Whatever Street', 'BS33 3DD', 'Brizzle innit', 'ba@ba.ba', '$P$BtZZ.jJOfQDvYbkEBE/1OGYdKUQO.41');
INSERT INTO `customer` VALUES (5, 'Arkie', 'Alderton', 'Fictional Address', 'BS66 6BS', 'Fictional City', 'arkie.alderton@gmail.com', '$P$BGeuV1hiEYDWMXeCXVVI1ID1aEdD7k1');

-- --------------------------------------------------------

-- 
-- Table structure for table `customer_order`
-- 

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL auto_increment,
  `cu_id` int(11) NOT NULL,
  `total_price` int(11) default NULL,
  `order_placed_datetime` int(11) default NULL,
  PRIMARY KEY  (`order_id`,`cu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `customer_order`
-- 

INSERT INTO `customer_order` VALUES (1, 3, NULL, 1333494707);
INSERT INTO `customer_order` VALUES (2, 5, 1333509373, 197);
INSERT INTO `customer_order` VALUES (3, 5, 1333509588, 0);
INSERT INTO `customer_order` VALUES (4, 5, 1333509691, 0);
INSERT INTO `customer_order` VALUES (5, 5, 1333509726, 0);
INSERT INTO `customer_order` VALUES (6, 5, 1333509777, 0);
INSERT INTO `customer_order` VALUES (7, 5, 1333509841, 13);

-- --------------------------------------------------------

-- 
-- Table structure for table `order_items`
-- 

CREATE TABLE `order_items` (
  `cu_order_id` int(11) NOT NULL,
  `cu_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY  (`cu_order_id`,`cu_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `order_items`
-- 

INSERT INTO `order_items` VALUES (1, 3, 34);
INSERT INTO `order_items` VALUES (1, 4, 1);
INSERT INTO `order_items` VALUES (2, 4, 1);
INSERT INTO `order_items` VALUES (2, 7, 3);
INSERT INTO `order_items` VALUES (2, 12, 6);
INSERT INTO `order_items` VALUES (2, 14, 6);
INSERT INTO `order_items` VALUES (2, 15, 10);
INSERT INTO `order_items` VALUES (7, 3, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `prod_book`
-- 

CREATE TABLE `prod_book` (
  `product_id` int(11) NOT NULL,
  `author` varchar(25) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `page_number` int(11) default NULL,
  `isbn_10` int(11) default NULL,
  `isbn_13` varchar(14) default NULL,
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prod_book`
-- 

INSERT INTO `prod_book` VALUES (3, 'Douglas Adams', 'Del Rey Books', 832, 345453743, '978-0345453747');
INSERT INTO `prod_book` VALUES (4, 'Timothy Zahn', 'Bantam Books', NULL, 553564927, '978-0553564921');
INSERT INTO `prod_book` VALUES (5, 'Timothy Zahn', 'Bantam Books', 406, 553404423, '978-0553404425');
INSERT INTO `prod_book` VALUES (6, 'Timothy Zahn', 'Bantam Books', 400, 553404717, '978-0553404715');
INSERT INTO `prod_book` VALUES (7, 'Steve Perry', 'Bantam Books', 272, 752816551, '978-0752816555');

-- --------------------------------------------------------

-- 
-- Table structure for table `prod_film`
-- 

CREATE TABLE `prod_film` (
  `product_id` int(11) NOT NULL,
  `director` varchar(25) NOT NULL,
  `length` bigint(20) NOT NULL,
  `studio` varchar(25) NOT NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `prod_film`
-- 

INSERT INTO `prod_film` VALUES (12, 'Joss Whedon', 119, 'UCA');
INSERT INTO `prod_film` VALUES (13, 'Mick Jackson', 110, 'Revelation');
INSERT INTO `prod_film` VALUES (14, 'Robert Zemeckis', 116, 'Universal');
INSERT INTO `prod_film` VALUES (15, 'Ivan Reitman', 105, 'Sony Pictures');
INSERT INTO `prod_film` VALUES (16, 'Lana Wachowski', 131, 'Warner Home Video');

-- --------------------------------------------------------

-- 
-- Table structure for table `product`
-- 

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL auto_increment,
  `prod_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `description` varchar(5000) default NULL,
  `release_year` int(11) default NULL,
  `image_url` varchar(200) default NULL,
  `language` varchar(50) default NULL,
  `stock_level` int(11) default NULL,
  PRIMARY KEY  (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `product`
-- 

INSERT INTO `product` VALUES (3, 0, 'The Ultimate Hitchhiker''s Guide to the Galaxy', 12.99, 'At last in paperback in one complete volume, here are the five classic novels from Douglas Adams’s beloved Hitchhiker series.', 2002, 'images/books/hitchhikers.jpg', 'English', 50);
INSERT INTO `product` VALUES (4, 0, 'Star Wars: The Last Command', 5.99, 'It is five years after the events of the Return of the Jedi. The fragile New Republic reels from the attacks of Grand Admiral Thrawn, who has not only rallied the remaining Imperial forces but has driven the rebels back with an abdominable new technology: clone soldiers.  Hopes are dim as Trawn mounts a final seige against the Republic. While Han and Chewbacca struggle to form a wary alliance of smugglers in a last-ditch attack against the Empire, Leia keeps the Alliance together and prepares for the birth of her Jedi twins. But the Empire has too many ships and too many clones to combat. The Republic''s only hope lies in sending a small force, led by Luke, into the very stronghold that houses Thrawn''s terrible cloning machines.  There a final danger awaits. The dark Jedi C''baoth schemes in his secret fortress, directing the battle against the rebels, nursing his insanity, and building his strength to finish what he had already started - the destruction of Luke Skywalker.  An odyssey of fast-paced action, stunning revelation, and the final confrontation, The Last Command spans a galaxy in flames - a tale that will conclude in this third and last instalment as Good and Evil battle ''a long time ago, in a galaxy far, far away...'' ', 1993, 'images/books/thelastcommand.jpg', 'English', 5);
INSERT INTO `product` VALUES (5, 0, 'Star Wars: Dark Force Rising', 5.99, 'Dark Force Rising moves with the speed of light, across a dazzling landscape of galactic proportions, from world to world, from adventure to adventure, as Good and Evil clash across the vastness of space ''a long time ago, in a galaxy far, far away...''  Five years after the Return of the Jedi, the fragile Republic that was born with the defeat of Darth Vader, the Emperor and the infamous Death Star stands threatened from within and without. The dying Empire''s most cunning and ruthless warlord - Grand Admiral Thrawn - has taken command of the remnants of the Imperial fleet and launched a massive campaign aimed at the Republic''s destruction. With the aid of unimaginable weapons Thrawn plans to overwhelm the New Republic, and impose his iron rule throughout the Galaxy.  Meanwhile, dissension and personal ambition threaten to tear the Republic apart. As Princess Leia - pregnant with Jedi twins - risks her life to bring a proud and lethal alien race into alliance with the Republic, Han and Lando Calrissian race against time to find proof of treason inside the highest Republic Council.  But most dangerous of all is a new Dark Jedi, risen from the ashes of a shrouded past, consumed by bitterness, and thoroughly, utterly insane... ', 1992, 'images/books/darkforcerising.jpg', 'English', 7);
INSERT INTO `product` VALUES (6, 0, 'Star Wars: Heir to the Empire', 5.99, 'A LONG TIME AGO IN A GALAXY FAR, FAR AWAY...  It is a time of renewal, five years after the destruction of the Death Star and the defeat of Darth Vader and the Empire.  But with the war seemingly won, strains are now beginning to show in the rebel alliance. New challenges to galactic peace have arisen, and Luke Skywalker hears a voice from his past, a voice with a warning.  Beware the Dark Side...  HEIR TO THE EMPIRE is the first of a three-book cycle which picks up where the movie trilogy left off. ', 1991, 'images/books/heirtotheempire.jpg', 'English', 10);
INSERT INTO `product` VALUES (7, 0, 'Aliens Vs Predator: Prey', 6.99, 'Stunning new cover treatment for this clash of the genre titans - sales of this series now in excess of 200,000. Both the Alien and the Predator are famed amongst fans of science fiction films. The Aliens and Predator movies have put the 2 classic monsters into the centre of popular culture. In this 1st of the novels pitting them head to head a young woman finds herself pitched into a job supervising a ranching colony that turns into the supervision of a full scale war. ', 1994, 'images/books/avp_prey.jpg', 'English', 3);
INSERT INTO `product` VALUES (12, 1, 'Serenity', 9.99, 'In the future, a spaceship called Serenity is harboring a passenger with a deadly secret. Six rebels on the run. An assassin in pursuit. When the renegade crew of Serenity agrees to hide a fugitive on their ship, they find themselves in an awesome action-packed battle between the relentless military might of a totalitarian regime who will destroy anything - or anyone - to get the girl back and the bloodthirsty creatures who roam the uncharted areas of space. But, the greatest danger of all may be on their ship. ', 2005, 'images/films/serenity.jpg', 'English', 16);
INSERT INTO `product` VALUES (13, 1, 'Threads', 6.99, 'It is the mid-1980''s, during the Cold War. Ruth Beckett & Jimmy Kemp, residents of the British city of Sheffield are planning for their upcoming marriage and birth of their first child. Sheffield is home to a major R.A.F. base and has a major industrial base of steel production. But the Soviet Union marches troops into Iran, in a plan to convert it to a Soviet satellite state. The United States, the United Kingdom, and other members of NATO angrily condemn the Soviet aggression and military activity in the United Kingdom starts to mount, especially at the nearby R.A.F. base. The families of Ruth & Jimmy go about their daily business, paying little attention to what is going on in Iran. One spring day, without warning, the Soviet Union attacks the United Kingdom with ICBMs - two of which hit Sheffield, annihilating most of the city and its inhabitants. But what is even more horrifying is the aftermath that follows - a world without public order, clean food, water, electricity, or the ability to produce any of them. Ruth struggles for more than 10 years just to stay alive in this horrible, barren, radioactive homeland... ', 1984, 'images/films/threads.jpg', 'English', 10);
INSERT INTO `product` VALUES (14, 1, 'Back to the Future', 9.99, 'Marty McFly, a typical American teenager of the Eighties, is accidentally sent back to 1955 in a plutonium-powered DeLorean "time machine" invented by slightly mad scientist. During his often hysterical, always amazing trip back in time, Marty must make certain his teenage parents-to-be meet and fall in love - so he can get back to the future. ', 1985, 'images/films/backtothefuture.jpg', 'English', 6);
INSERT INTO `product` VALUES (15, 1, 'Ghostbusters', 4.99, 'When Dr. Peter Venkman (Bill Murray) and his Columbia University colleagues (Dan Aykroyd, Harold Ramis, Ernie Hudson) are kicked out of their prestigious academic posts, they start a private practice as professional ghost-catchers. Although things do not start auspiciously for the three parascientists, their television advertisements finally pay off when beautiful Dana Barrett (Sigourney Weaver) contracts them. It seems her apartment has become the entryway for ghastly ghosts and goofy ghouls hellbent on terrorising New York City. Soon they''re not just going to her rescue, but trying to rid the whole city of the slimy creatures. Ghostbusters hit US screens in June of 1984 and went on to become one of the most successful comedy films of all time, spawning a sequel and a popular animated series. ', 1984, 'images/films/ghostbusters.jpg', 'English', 15);
INSERT INTO `product` VALUES (16, 1, 'The Matrix', 3.99, 'Thomas A. Anderson is a man living two lives. By day he is an average computer programmer and by night a hacker known as Neo. Neo has always questioned his reality, but the truth is far beyond his imagination. Neo finds himself targeted by the police when he is contacted by Morpheus, a legendary computer hacker branded a terrorist by the government. Morpheus awakens Neo to the real world, a ravaged wasteland where most of humanity have been captured by a race of machines that live off of the humans'' body heat and electrochemical energy and who imprison their minds within an artificial reality known as the Matrix. As a rebel against the machines, Neo must return to the Matrix and confront the agents: super-powerful computer programs devoted to snuffing out Neo and the entire human rebellion. ', 1999, 'images/films/thematrix.jpg', 'English', 4);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `prod_book`
-- 
ALTER TABLE `prod_book`
  ADD CONSTRAINT `prod_book_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Constraints for table `prod_film`
-- 
ALTER TABLE `prod_film`
  ADD CONSTRAINT `prod_film_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
