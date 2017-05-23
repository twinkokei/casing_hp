/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.21-MariaDB : Database - casinghp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`casinghp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `casinghp`;

/*Table structure for table `banks` */

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `banks` */

insert  into `banks`(`bank_id`,`bank_name`,`bank_account_number`) values (1,'Mandiri',''),(2,'BCA',''),(3,'BRI','');

/*Table structure for table `branches` */

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(200) NOT NULL,
  `branch_img` text NOT NULL,
  `branch_desc` text NOT NULL,
  `branch_address` text NOT NULL,
  `branch_phone` varchar(100) NOT NULL,
  `branch_city` varchar(100) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `branches` */

insert  into `branches`(`branch_id`,`branch_name`,`branch_img`,`branch_desc`,`branch_address`,`branch_phone`,`branch_city`) values (3,'Cabang 1','1493784788_navy_seals.png','','alamat','0315926983','Surabaya'),(4,'Cabang 2','1493784808_navy_seals.png','Cabang Baru Balkpapan','Alamat','08123120398','Surabaya');

/*Table structure for table `item_stocks` */

DROP TABLE IF EXISTS `item_stocks`;

CREATE TABLE `item_stocks` (
  `item_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_stock_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`item_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `item_stocks` */

insert  into `item_stocks`(`item_stock_id`,`item_id`,`item_stock_qty`,`branch_id`) values (21,28,12,3),(22,29,10,3);

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_kategori` int(11) DEFAULT NULL,
  `item_type_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_original_price` int(11) DEFAULT NULL,
  `item_margin_price` int(11) DEFAULT NULL,
  `item_price` int(11) DEFAULT NULL,
  `item_img` text,
  `partner_id` int(11) DEFAULT NULL,
  `item_limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `items` */

insert  into `items`(`item_id`,`item_kategori`,`item_type_id`,`item_name`,`item_original_price`,`item_margin_price`,`item_price`,`item_img`,`partner_id`,`item_limit`) values (1,0,0,'--ALUMINIUM FOIL @30000 Cm',0,0,100000,'',0,NULL),(2,0,0,'--APPLE PIE',0,0,100000,'',0,NULL),(3,0,0,'APPLE PIE XXXX',0,0,100000,'',0,NULL),(4,0,0,'--BAWANG BOMBAY',0,0,100000,'',0,NULL),(5,0,0,'--BEEF BACON @36 Pcs',0,0,100000,'',0,NULL),(6,0,0,'--CHICKEN BREEDER @12500 Gr',0,0,100000,'',0,NULL),(7,0,0,'--BUN BLACK & WHITE SESAME 4 INCH 12x6 Pcs',0,0,100000,'',0,NULL),(8,0,0,'--CALAMANSI @600 Ml',0,0,100000,'',0,NULL),(9,0,0,'--CHICKEN BOX',0,0,100000,'',0,NULL),(10,0,0,'--CHICKEN BONELESS TIGHT FILLET @150 Gr',0,0,100000,'',0,NULL),(11,0,0,'--CHICKEN CUT 9 / 7',0,0,100000,'',0,NULL),(12,0,0,'--CUP HOT 2 OZ',0,0,100000,'',0,NULL),(13,0,0,'--COOKING OIL @18000 Ml',0,0,100000,'',0,NULL),(14,0,0,'--CUP PLASTIC 22 OZ',0,0,100000,'',0,NULL),(15,0,0,'--CHICKEN POWDER @1000 Gr',0,0,100000,'',0,NULL),(16,0,0,'--CROUTON',0,0,100000,'',0,NULL),(17,0,0,'CAESAR SALAD',0,0,100000,'',0,NULL),(18,0,0,'--CHILLI SACHET @24 Pcs',0,0,100000,'',0,NULL),(19,0,0,'--DIJON MUSTARD @370 Gr',0,0,100000,'',0,NULL),(20,0,0,'--FRENCH BAQUETTE',0,0,100000,'',0,NULL),(21,0,0,'--FRIED CHICKEN MARINADE @1000 Gr',0,0,100000,'',0,NULL),(22,0,0,'FREEDOM CHICKEN REGULER 1 PCS',0,0,100000,'',0,NULL),(23,0,0,'--FORK',0,0,100000,'',0,NULL),(24,0,0,'--GARLIC',0,0,100000,'',0,NULL),(25,0,0,'--GROUND BLACK PEPPER @500 Gr Kmsan Baru',0,0,100000,'',0,NULL),(26,0,0,'--GRAVY DRY MIX @500 Gr',0,0,100000,'',0,NULL),(27,0,0,'--GINGER GROUND',0,0,100000,'',0,NULL),(28,0,0,'--GROUND MUSTARD',0,0,100000,'',0,NULL),(29,0,0,'--GRAVY SAUCE',0,0,100000,'',0,NULL),(30,0,0,'HUNGRY CHICKEN TERIYAKI BURGER',0,0,100000,'',0,NULL),(31,0,0,'--ICE TUBE',0,0,100000,'',0,NULL),(32,0,0,'--ICE CREAM VANILLA @8000 Ml',0,0,100000,'',0,NULL),(33,0,0,'--KNIFE',0,0,100000,'',0,NULL),(34,0,0,'--LEEK BAWANG PREI',0,0,100000,'',0,NULL),(35,0,0,'--ICEBERG LETTUCE',0,0,100000,'',0,NULL),(36,0,0,'--LINER LAMINATED 18 X 25 CM @50 pcs',0,0,100000,'',0,NULL),(37,0,0,'--LINER LAMINATED 25x25cm @50 Pcs',0,0,100000,'',0,NULL),(38,0,0,'--LID SEALER PLASTIC',0,0,100000,'',0,NULL),(39,0,0,'LOYALTEA LARGE',0,0,100000,'',0,NULL),(40,0,0,'--LOYAL TEA MK',0,0,100000,'',0,NULL),(41,0,0,'--MAYONNANISE @3000 Gr',0,0,100000,'',0,NULL),(42,0,0,'--MIRIN KIKOMAN SAOCE @1600 Ml',0,0,100000,'',0,NULL),(43,0,0,'--OLIVE OIL DRESSING @3000 Ml',0,0,100000,'',0,NULL),(44,0,0,'--PARSLEY',0,0,100000,'',0,NULL),(45,0,0,'--PLASTIC BAG SMALL',0,0,100000,'',0,NULL),(46,0,0,'--PARMESAN CHEESE',0,0,100000,'',0,NULL),(47,0,0,'--ROMAIN LETTUCE',0,0,100000,'',0,NULL),(48,0,0,'--RED WINE VINEGAR @500 Ml',0,0,100000,'',0,NULL),(49,0,0,'--SALAD CREAM',0,0,100000,'',0,NULL),(50,0,0,'--SUGAR',0,0,100000,'',0,NULL),(51,0,0,'--SALT',0,0,100000,'',0,NULL),(52,0,0,'--SPOON',0,0,100000,'',0,NULL),(53,0,0,'--STRAW',0,0,100000,'',0,NULL),(54,0,0,'--SAUCE TERIYAKI',0,0,100000,'',0,NULL),(55,0,0,'--TERIYAKI SAUCE KikkoMan @250 Ml',0,0,100000,'',0,NULL),(56,0,0,'--TISSUE NAPKIN DINE IN 1x24 Pcs x100Lbr',0,0,100000,'',0,NULL),(57,0,0,'--TOMATO',0,0,100000,'',0,NULL),(58,0,0,'--TOMATO SACHET @24 Pcs',0,0,100000,'',0,NULL),(59,0,0,'--UNSALTED BUTTER',0,0,100000,'',0,NULL),(60,0,0,'--WHOLE BLACK PEPPER @100 Gr',0,0,100000,'',0,NULL),(61,0,0,'--WORCESTERCHIRE SAUCE @284Ml',0,0,100000,'',0,NULL),(62,0,0,'--WATER @19000 ml',0,0,100000,'',0,NULL);

/*Table structure for table `journal_types` */

DROP TABLE IF EXISTS `journal_types`;

CREATE TABLE `journal_types` (
  `journal_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`journal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `journal_types` */

insert  into `journal_types`(`journal_type_id`,`journal_type_name`) values (1,'Penjualan'),(2,'Pembelian'),(3,'Pemasukan lainnya'),(4,'Pengeluaran lainnya');

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_id` int(11) NOT NULL,
  `data_id` int(11) NOT NULL,
  `data_url` text NOT NULL,
  `journal_debit` int(11) NOT NULL,
  `journal_credit` int(11) NOT NULL,
  `journal_piutang` int(11) NOT NULL,
  `journal_hutang` int(11) NOT NULL,
  `journal_date` date NOT NULL,
  `journal_desc` text NOT NULL,
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_type_id`,`data_id`,`data_url`,`journal_debit`,`journal_credit`,`journal_piutang`,`journal_hutang`,`journal_date`,`journal_desc`,`bank_id`,`user_id`,`branch_id`) values (1,1,2,'',24000,0,0,0,'2017-02-28','Meja Meja 4',0,11,3),(2,1,0,'',53000,0,0,0,'2017-03-01','Meja Meja 2',0,11,3),(3,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 2',0,11,3),(4,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(5,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(6,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(7,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(8,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(9,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(10,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(11,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(12,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(13,1,0,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(14,1,15,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(15,1,16,'',55000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(16,1,17,'',110000,0,0,0,'2017-03-01','Meja Meja 4',0,11,3),(17,1,18,'',28000,0,0,0,'2017-03-02','Meja Meja 4',0,11,3),(18,1,19,'',21000,0,0,0,'2017-03-02','Meja Meja 5',0,11,3),(19,1,20,'',53000,0,0,0,'2017-03-02','Meja Meja 4',0,11,3),(20,1,21,'',30000,0,0,0,'2017-03-16','Meja Meja 3',0,11,3),(21,1,22,'',25000,0,0,0,'2017-03-16','Meja Meja 1',0,11,3),(22,1,23,'',30000,0,0,0,'2017-03-16','Meja Meja 5',0,11,3),(23,1,24,'',25000,0,0,0,'2017-03-18','Meja Meja 4',0,11,3),(24,1,25,'',25000,0,0,0,'2017-03-18','Meja Meja 2',0,11,3),(25,1,1,'',21000,0,0,0,'2017-03-30','Meja ',0,11,3);

/*Table structure for table `kategori_utama` */

DROP TABLE IF EXISTS `kategori_utama`;

CREATE TABLE `kategori_utama` (
  `id_kategori_utama` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_utama_name` varbinary(30) NOT NULL,
  PRIMARY KEY (`id_kategori_utama`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `kategori_utama` */

insert  into `kategori_utama`(`id_kategori_utama`,`kategori_utama_name`) values (1,'Bakmie'),(2,'Nasi'),(3,'Kwetiauw'),(4,'Minuman'),(5,'Paket'),(11,'Go Food');

/*Table structure for table `member_items` */

DROP TABLE IF EXISTS `member_items`;

CREATE TABLE `member_items` (
  `member_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`member_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `member_items` */

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(100) NOT NULL,
  `member_phone` varchar(100) NOT NULL,
  `member_alamat` varchar(30) NOT NULL,
  `member_email` varchar(200) NOT NULL,
  `member_settlement` int(11) NOT NULL,
  `member_discount` int(11) NOT NULL,
  `member_discount_type` int(11) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

/*Data for the table `members` */

insert  into `members`(`member_id`,`member_name`,`member_phone`,`member_alamat`,`member_email`,`member_settlement`,`member_discount`,`member_discount_type`) values (250,'Tirta Rachmandiri','085821364004','Simo Sidomulyo 5 No. 46 B','racodex@gmail.com',0,2,0);

/*Table structure for table `payment_methods` */

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `payment_methods` */

insert  into `payment_methods`(`payment_method_id`,`payment_method_name`) values (1,'Cash'),(2,'Debit'),(3,'Credit');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_jumlah` int(11) NOT NULL,
  `payment_sisa` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `payments` */

/*Table structure for table `penyesuaian_stock_cabang` */

DROP TABLE IF EXISTS `penyesuaian_stock_cabang`;

CREATE TABLE `penyesuaian_stock_cabang` (
  `penyesuaian_stock_cabang_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date_penyesuaian` datetime NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty_awal` bigint(20) NOT NULL,
  `item_qty_new` bigint(20) NOT NULL,
  PRIMARY KEY (`penyesuaian_stock_cabang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penyesuaian_stock_cabang` */

/*Table structure for table `permits` */

DROP TABLE IF EXISTS `permits`;

CREATE TABLE `permits` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `side_menu_id` int(11) NOT NULL,
  `permit_acces` varchar(10) NOT NULL,
  PRIMARY KEY (`permit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=839 DEFAULT CHARSET=latin1;

/*Data for the table `permits` */

insert  into `permits`(`permit_id`,`user_type_id`,`side_menu_id`,`permit_acces`) values (241,4,1,'0'),(242,4,2,'c,r,u,d'),(243,4,3,'0'),(244,4,4,'0'),(245,4,5,'0'),(246,4,6,'0'),(247,4,7,''),(248,4,8,''),(249,4,9,'c,r,u,d'),(250,4,10,'c,r,u,d'),(251,4,11,''),(252,4,12,'c,r,u,d'),(253,4,13,''),(254,4,14,''),(255,4,15,'c,r,u,d'),(256,4,16,''),(257,4,17,''),(258,4,18,''),(259,4,19,''),(260,4,20,''),(261,4,21,''),(262,4,22,'c,r,u,d'),(263,4,23,''),(264,4,24,''),(699,1,1,'0'),(700,1,2,'c,r,u,d'),(701,1,3,'0'),(702,1,4,'0'),(703,1,5,'0'),(704,1,6,'0'),(705,1,7,'c,r,u,d'),(706,1,8,'c,r,u,d'),(707,1,9,'c,r,u,d'),(708,1,10,'c,r,u,d'),(709,1,11,'c,r,u,d'),(710,1,12,'c,r,u,d'),(711,1,13,'c,r,u,d'),(712,1,14,'c,r,u,d'),(713,1,15,'c,r,u,d'),(714,1,16,'c,r,u,d'),(715,1,17,'c,r,u,d'),(716,1,18,'c,r,u,d'),(717,1,19,'c,r,u,d'),(718,1,20,'c,r,u,d'),(719,1,21,'c,r,u,d'),(720,1,22,'c,r,u,d'),(721,1,23,'c,r,u,d'),(722,1,24,'c,r,u,d'),(723,1,25,'c,r,u,d'),(724,1,26,'c,r,u,d'),(725,1,27,'c,r,u,d'),(726,1,28,'c,r,u,d'),(727,1,30,'c,r,u,d'),(784,2,1,'0'),(785,2,2,'c,r,u,d'),(786,2,3,'0'),(787,2,4,'0'),(788,2,5,'0'),(789,2,6,'0'),(790,2,7,''),(791,2,8,'c,r,u,d'),(792,2,9,'c,r,u,d'),(793,2,10,'c,r,u,d'),(794,2,11,''),(795,2,12,'c,r,u,d'),(796,2,13,'c,r,u,d'),(797,2,14,'c,r,u,d'),(798,2,15,'c,r,u,d'),(799,2,16,'c,r,u,d'),(800,2,17,'c,r,u,d'),(801,2,18,'c,r,u,d'),(802,2,19,'c,r,u,d'),(803,2,20,'c,r,u,d'),(804,2,21,'c,r,u,d'),(805,2,22,'c,r,u,d'),(806,2,23,''),(807,2,24,''),(808,2,25,''),(809,2,26,''),(810,2,27,''),(811,2,28,'c,r,u,d'),(812,3,1,'0'),(813,3,2,'c,r,u,d'),(814,3,3,'0'),(815,3,4,'0'),(816,3,5,'0'),(817,3,6,'0'),(818,3,7,'c,r,u,d'),(819,3,8,'c,r,u,d'),(820,3,9,'c,r,u,d'),(821,3,10,'c,r,u,d'),(822,3,11,'c,r,u,d'),(823,3,12,'c,r,u,d'),(824,3,13,'c,r,u,d'),(825,3,14,'c,r,u,d'),(826,3,15,'c,r,u,d'),(827,3,16,'c,r,u,d'),(828,3,17,'c,r,u,d'),(829,3,18,'c,r,u,d'),(830,3,19,'c,r,u,d'),(831,3,20,'c,r,u,d'),(832,3,21,'c,r,u,d'),(833,3,22,'c,r,u,d'),(834,3,23,'c,r,u,d'),(835,3,24,'c,r,u,d'),(836,3,25,'c,r,u,d'),(837,3,26,'c,r,u,d'),(838,3,27,'c,r,u,d');

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `purchase_qty` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `purchases` */

/*Table structure for table `side_menus` */

DROP TABLE IF EXISTS `side_menus`;

CREATE TABLE `side_menus` (
  `side_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `side_menu_name` varchar(100) NOT NULL,
  `side_menu_url` varchar(100) NOT NULL,
  `side_menu_parent` int(11) NOT NULL,
  `side_menu_icon` varchar(100) NOT NULL,
  `side_menu_level` int(11) NOT NULL,
  `side_menu_type_parent` int(11) NOT NULL,
  PRIMARY KEY (`side_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `side_menus` */

insert  into `side_menus`(`side_menu_id`,`side_menu_name`,`side_menu_url`,`side_menu_parent`,`side_menu_icon`,`side_menu_level`,`side_menu_type_parent`) values (1,'Master','#',0,'fa fa-edit',1,0),(2,'Order','transaction.php',3,'fa fa-mobile',2,1),(3,'Transaksi','#',0,'fa fa-shopping-cart',1,0),(4,'Accounting','#',0,'fa fa-list-alt',1,0),(5,'Laporan','#',0,'fa fa-list-alt',1,0),(6,'Setting','#',0,'fa fa-cog',1,0),(7,'Cabang','branch.php',1,'',2,1),(10,'Item','menu.php',1,'',2,1),(13,'Supplier','supplier.php',1,'',2,1),(16,'Pembelian','purchase.php',3,'',2,1),(17,'Stok','stock.php',3,'',2,1),(18,'Arus Kas','arus_kas.php',4,'',2,1),(19,'Pemasukan Dan Pengeluaran Lainnya','jurnal_umum.php',4,'',2,1),(20,'Laporan Detail','report_detail.php',5,'',2,1),(21,'Laporan Harian','report_harian.php',5,'',2,1),(23,'User','user.php',6,'',2,1),(24,'Type User','user_type.php',6,'',2,1),(25,'Penyesuaian Stock','penyesuaian_stock.php',1,'',2,1),(26,'Laporan Penyesuaian Stock','report_penyesuaian_stock.php',5,'',2,1);

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_phone` int(11) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_addres` varchar(100) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `suppliers` */

insert  into `suppliers`(`supplier_id`,`supplier_name`,`supplier_phone`,`supplier_email`,`supplier_addres`) values (6,'Bakmi Gili Pusat',315484702,'bakmie.gili@gmail.com','MT. Haryono No. 42');

/*Table structure for table `tables` */

DROP TABLE IF EXISTS `tables`;

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_id` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `data_x` int(11) NOT NULL,
  `data_y` int(11) NOT NULL,
  `chair_number` int(11) NOT NULL,
  `table_status_id` int(11) NOT NULL,
  `tms_id` int(11) NOT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `tables` */

insert  into `tables`(`table_id`,`building_id`,`table_name`,`data_x`,`data_y`,`chair_number`,`table_status_id`,`tms_id`) values (50,7,'Delivery Delta',575,417,1,1,0),(51,7,'Meja 1',746,338,4,1,0),(52,7,'Meja 2',441,326,4,1,0),(53,7,'Meja 3',590,256,4,1,0),(54,7,'Meja 4',311,242,4,1,0),(55,7,'Meja 5',454,167,4,1,0),(56,8,'Delivery TP',605,439,1,1,0),(57,8,'Meja 1',769,344,4,1,0),(58,8,'Meja 2',476,359,4,1,0),(59,8,'Meja 3',622,255,4,1,0),(60,8,'Meja 4',308,270,4,1,0),(61,8,'Meja 5',462,174,4,1,0);

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `transaction_detail_original_price` int(11) DEFAULT NULL,
  `transaction_detail_margin_price` int(11) DEFAULT NULL,
  `transaction_detail_price` int(11) DEFAULT NULL,
  `transaction_detail_price_discount` int(11) DEFAULT NULL,
  `transaction_detail_grand_price` int(11) DEFAULT NULL,
  `transaction_detail_qty` int(11) DEFAULT NULL,
  `transaction_detail_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaction_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`transaction_detail_id`,`transaction_id`,`item_id`,`transaction_detail_original_price`,`transaction_detail_margin_price`,`transaction_detail_price`,`transaction_detail_price_discount`,`transaction_detail_grand_price`,`transaction_detail_qty`,`transaction_detail_total`) values (1,1,1,21000,0,21000,0,21000,1,21000);

/*Table structure for table `transaction_tmp_details` */

DROP TABLE IF EXISTS `transaction_tmp_details`;

CREATE TABLE `transaction_tmp_details` (
  `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `transaction_detail_original_price` int(11) NOT NULL,
  `transaction_detail_margin_price` int(11) NOT NULL,
  `transaction_detail_price` int(11) NOT NULL,
  `transaction_detail_price_discount` int(11) NOT NULL,
  `transaction_detail_grand_price` int(11) NOT NULL,
  `transaction_detail_qty` int(11) NOT NULL,
  `transaction_detail_total` int(11) NOT NULL,
  `transaction_detail_status` int(11) NOT NULL,
  PRIMARY KEY (`transaction_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_tmp_details` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `transaction_discount` int(11) NOT NULL,
  `disc_member` int(11) NOT NULL,
  `transaction_grand_total` int(11) NOT NULL,
  `transaction_payment` int(11) NOT NULL,
  `transaction_change` int(11) NOT NULL,
  `transaction_disc_nominal` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL,
  `flag_code` int(1) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`transaction_id`,`transaction_code`,`branch_id`,`member_id`,`transaction_date`,`transaction_total`,`transaction_discount`,`disc_member`,`transaction_grand_total`,`transaction_payment`,`transaction_change`,`transaction_disc_nominal`,`payment_method_id`,`bank_id`,`user_id`,`bank_account_number`,`flag_code`) values (1,'1490836268',3,0,'2017-03-30 03:11:08',0,0,0,21000,21000,0,0,1,0,11,'',1);

/*Table structure for table `transactions_tmp` */

DROP TABLE IF EXISTS `transactions_tmp`;

CREATE TABLE `transactions_tmp` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `member_id` int(11) NOT NULL,
  `jml_orang` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `tot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transactions_tmp` */

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(20) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `units` */

insert  into `units`(`unit_id`,`unit_name`) values (1,'Biji'),(2,'ml'),(3,'Gram'),(4,'Pack'),(5,'Kodi');

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`user_type_id`,`user_type_name`) values (1,'Administrator'),(2,'Kasir'),(3,'Owner'),(4,'Waitress');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) DEFAULT NULL,
  `user_login` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_code` varchar(100) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `user_img` text NOT NULL,
  `user_active_status` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_type_id`,`user_login`,`user_password`,`user_name`,`user_code`,`user_phone`,`user_img`,`user_active_status`,`branch_id`) values (11,3,'admin','fe01ce2a7fbac8fafaed7c982a04e229','admin','A0001','03125435432','1493796268_default.jpg',1,3),(32,3,'maria','fe01ce2a7fbac8fafaed7c982a04e229','maria','','1111','',1,4),(34,1,'budi','101eb6ad45137d043a8e3f8fb3990135','budi','','3232','',1,3),(39,2,'dita','fe01ce2a7fbac8fafaed7c982a04e229','Dita','','085731404513','',1,3),(40,4,'elina','fe01ce2a7fbac8fafaed7c982a04e229','Lina','','085852731314','',1,4);

/*Table structure for table `widget_tmp` */

DROP TABLE IF EXISTS `widget_tmp`;

CREATE TABLE `widget_tmp` (
  `wt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `wt_desc` text NOT NULL,
  `printed` int(11) NOT NULL,
  PRIMARY KEY (`wt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `widget_tmp` */

insert  into `widget_tmp`(`wt_id`,`user_id`,`menu_id`,`jumlah`,`transaction_id`,`wt_desc`,`printed`) values (1,11,1,1,1,'',0),(2,11,1,1,2,'',0);

/*Table structure for table `widget_tmp_details` */

DROP TABLE IF EXISTS `widget_tmp_details`;

CREATE TABLE `widget_tmp_details` (
  `wtd_id` int(11) NOT NULL AUTO_INCREMENT,
  `wt_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  PRIMARY KEY (`wtd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `widget_tmp_details` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
