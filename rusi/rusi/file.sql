CREATE DATABASE dealers;

--CREATING TABLE accounts
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(100) NOT NULL,
  `model_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `terms` varchar(100) NOT NULL,
  `monthly_installment` decimal(10,2) NOT NULL,
  `totalpaid` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `contract_price` decimal(10,2) NOT NULL,
  `months` int(11) NOT NULL,
  `datepayment` date NOT NULL,
  `downpayment` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO accounts
INSERT INTO accounts VALUES ('1','CUSTOMERID-AJCJO5XKQ','','open','','0.00','0.00','0.00','0.00','0.00','0','0000-00-00','0.00');
INSERT INTO accounts VALUES ('2','CUSTOMERID-3OY3COD3X','','open','','0.00','0.00','0.00','0.00','0.00','0','0000-00-00','0.00');



--CREATING TABLE categories
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO categories
INSERT INTO categories VALUES ('1','honda');
INSERT INTO categories VALUES ('2','suzuki');
INSERT INTO categories VALUES ('3','isuzu');



--CREATING TABLE content
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `model_name` text NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO content



--CREATING TABLE customerlists
CREATE TABLE `customerlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `tin` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO customerlists
INSERT INTO customerlists VALUES ('1','CUSTOMERID-AJCJO5XKQ','awjdhawdh','dajwhkdh','dkhwkdjhkjwhkj','hdkhawhdkahwd','kjhdawjhdk','123123','../images/');
INSERT INTO customerlists VALUES ('2','CUSTOMERID-3OY3COD3X','123jh123','qwehkqjwhe','awejhqwekh','qwjheqhe','awhekjhaw','123123','&lt;p&gt;wdawdawdawd&lt;/p&gt;');



--CREATING TABLE history
CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(20) NOT NULL,
  `model_id` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `terms` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO history



--CREATING TABLE inventory
CREATE TABLE `inventory` (
  `categoryid` varchar(20) NOT NULL,
  `modelid` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `chassis` varchar(50) NOT NULL,
  `enginenumber` varchar(50) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO inventory



--CREATING TABLE logs
CREATE TABLE `logs` (
  `activityid` int(11) NOT NULL AUTO_INCREMENT,
  `activity` text NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`activityid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO logs
INSERT INTO logs VALUES ('1','ADDING CATEGORIES: suzuki ','admin','2016-02-01 18:03:34');
INSERT INTO logs VALUES ('2','ADDING CATEGORIES: isuzu ','admin','2016-02-01 18:03:47');
INSERT INTO logs VALUES ('3','ADDING MODEL: strada ','admin','2016-02-01 18:04:17');
INSERT INTO logs VALUES ('4','ADDING MODEL: raider 125 ','admin','2016-02-01 18:04:30');
INSERT INTO logs VALUES ('5','ADDING MODEL: raider 200 ','admin','2016-02-01 18:04:47');
INSERT INTO logs VALUES ('6','ADDING MODEL: rush 120 ','admin','2016-02-01 18:05:02');



--CREATING TABLE models
CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO models
INSERT INTO models VALUES ('1','isuzu','strada','100000.00','20000.00');
INSERT INTO models VALUES ('2','honda','raider 125','60000.00','10000.00');
INSERT INTO models VALUES ('3','honda','raider 200','70000.00','10000.00');
INSERT INTO models VALUES ('4','suzuki','rush 120','80000.00','20000.00');



--CREATING TABLE settings
CREATE TABLE `settings` (
  `penalty_rate` decimal(10,2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monthly_rate` decimal(10,2) NOT NULL,
  `addons` decimal(10,2) NOT NULL,
  `rebate_rate` decimal(10,2) NOT NULL,
  `extend_days` int(11) NOT NULL,
  `months_notify` int(11) NOT NULL,
  `lcp_rate` decimal(10,2) NOT NULL,
  `constant_rate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO settings
INSERT INTO settings VALUES ('0.05','1','0.50','0.00','300.00','3','0','0.10','0.00');



--CREATING TABLE sold_items
CREATE TABLE `sold_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transid` varchar(111) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `engine` varchar(100) NOT NULL,
  `chassis` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(100) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO sold_items



--CREATING TABLE stocks
CREATE TABLE `stocks` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `model_name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL,
  `color` varchar(100) NOT NULL,
  `engine_number` varchar(30) NOT NULL,
  `chassis` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='stocks';

--INSERTING DATA INTO stocks
INSERT INTO stocks VALUES ('1','honda','raider','60000.00','1000.00','red','engeigh','fajfwij','sold','Mandaue');
INSERT INTO stocks VALUES ('2','honda','xrm1234','10000.00','1000.00','red','engine','chassis','sold','Mandaue');
INSERT INTO stocks VALUES ('3','isuzu','strada','100000.00','20000.00','red','egnine123','chassi','new','Mandaue');



--CREATING TABLE transaction
CREATE TABLE `transaction` (
  `trans_id` varchar(100) NOT NULL,
  `customerid` varchar(100) NOT NULL,
  `model_id` varchar(100) NOT NULL,
  `datepayment` date NOT NULL,
  `total_paid` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `rebate` double(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO transaction



--CREATING TABLE users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--INSERTING DATA INTO users
INSERT INTO users VALUES ('1','admin','admin','Fejie','Sorono','Fariolen','09322324465','','Administrator','active','any');
INSERT INTO users VALUES ('2','andie','andie123','Shalou','Ragasi','Misa','09322324571','','Accounting','active','Mandaue');



-- THE END

