/*
Navicat MySQL Data Transfer

Source Server         : conn
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_canvess

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-06-01 17:25:00
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `t_follow`
-- ----------------------------
DROP TABLE IF EXISTS `t_follow`;
CREATE TABLE `t_follow` (
  `id_follow` int(11) NOT NULL AUTO_INCREMENT,
  `id_follower` int(11) NOT NULL,
  `id_followed` int(11) NOT NULL,
  PRIMARY KEY (`id_follow`),
  KEY `id_follower` (`id_follower`),
  KEY `id_followed` (`id_followed`),
  CONSTRAINT `t_follow_ibfk_1` FOREIGN KEY (`id_follower`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_follow_ibfk_2` FOREIGN KEY (`id_followed`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_follow
-- ----------------------------

-- ----------------------------
-- Table structure for `t_friendship`
-- ----------------------------
DROP TABLE IF EXISTS `t_friendship`;
CREATE TABLE `t_friendship` (
  `id_friendship` int(11) NOT NULL AUTO_INCREMENT,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  PRIMARY KEY (`id_friendship`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_friendship
-- ----------------------------

-- ----------------------------
-- Table structure for `t_gender`
-- ----------------------------
DROP TABLE IF EXISTS `t_gender`;
CREATE TABLE `t_gender` (
  `id_gender` int(11) NOT NULL,
  `nama_gender` varchar(255) NOT NULL,
  PRIMARY KEY (`id_gender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_gender
-- ----------------------------
INSERT INTO `t_gender` VALUES ('0', 'Prefer not say');
INSERT INTO `t_gender` VALUES ('1', 'Male');
INSERT INTO `t_gender` VALUES ('2', 'Female');

-- ----------------------------
-- Table structure for `t_likesmain`
-- ----------------------------
DROP TABLE IF EXISTS `t_likesmain`;
CREATE TABLE `t_likesmain` (
  `id_likesmain` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_mainchat` int(11) NOT NULL,
  PRIMARY KEY (`id_likesmain`),
  KEY `id_user` (`id_user`),
  KEY `id_mainchat` (`id_mainchat`),
  CONSTRAINT `t_likesmain_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_likesmain_ibfk_2` FOREIGN KEY (`id_mainchat`) REFERENCES `t_mainchat` (`id_mainchat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_likesmain
-- ----------------------------
INSERT INTO `t_likesmain` VALUES ('107', '9', '10');
INSERT INTO `t_likesmain` VALUES ('110', '9', '11');
INSERT INTO `t_likesmain` VALUES ('113', '15', '32');
INSERT INTO `t_likesmain` VALUES ('114', '15', '11');

-- ----------------------------
-- Table structure for `t_mainchat`
-- ----------------------------
DROP TABLE IF EXISTS `t_mainchat`;
CREATE TABLE `t_mainchat` (
  `id_mainchat` int(11) NOT NULL AUTO_INCREMENT,
  `main_message` varchar(1100) NOT NULL,
  `main_datetime` datetime NOT NULL,
  `isAnonymous` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_mainchat`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `t_mainchat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_mainchat
-- ----------------------------
INSERT INTO `t_mainchat` VALUES ('4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaera', '2023-05-26 11:18:36', '0', '2');
INSERT INTO `t_mainchat` VALUES ('6', 'aku yang lemah tanpamu aku yang rentan karena cinta yang tlah hilang darimu yang mampu menyanjungku selama mata terbuka sampai jantung tak berdetak selama itu pun aku mampu untuk mengenangmu', '2023-05-27 22:29:10', '0', '2');
INSERT INTO `t_mainchat` VALUES ('10', 'ulalalaeyeyeyyeyeye', '2023-05-28 19:13:45', '0', '1');
INSERT INTO `t_mainchat` VALUES ('11', 'ulalalallalalalalallalanhoyoyooyoyoy', '2023-05-28 19:14:12', '0', '1');
INSERT INTO `t_mainchat` VALUES ('32', 'aku adalah wujud asli chayaa', '2023-06-01 13:31:07', '1', '15');
INSERT INTO `t_mainchat` VALUES ('34', 'aku yang lemah tanpamu', '2023-06-01 14:45:18', '0', '15');
INSERT INTO `t_mainchat` VALUES ('35', 'kutukan serdi fambo', '2023-06-01 14:45:49', '1', '15');

-- ----------------------------
-- Table structure for `t_postprivacy`
-- ----------------------------
DROP TABLE IF EXISTS `t_postprivacy`;
CREATE TABLE `t_postprivacy` (
  `id_postprivacy` int(11) NOT NULL,
  `jenis_postprivacy` varchar(255) NOT NULL DEFAULT '',
  `desc_postprivacy` varchar(255) DEFAULT '',
  PRIMARY KEY (`id_postprivacy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_postprivacy
-- ----------------------------
INSERT INTO `t_postprivacy` VALUES ('0', 'Public', 'semua orang bisa liat postingan, kecuali postingan anonymous');
INSERT INTO `t_postprivacy` VALUES ('1', 'Private to non-friends', 'hanya temen yang bisa liat postingan, kecuali postingan anonymous');
INSERT INTO `t_postprivacy` VALUES ('2', 'Private to all', 'postingan apa pun ga bisa diliat oleh siapa pun');

-- ----------------------------
-- Table structure for `t_replychat`
-- ----------------------------
DROP TABLE IF EXISTS `t_replychat`;
CREATE TABLE `t_replychat` (
  `id_replychat` int(11) NOT NULL AUTO_INCREMENT,
  `reply_message` varchar(300) NOT NULL,
  `reply_datetime` datetime NOT NULL,
  `isAnonymous` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_main` int(11) NOT NULL,
  PRIMARY KEY (`id_replychat`),
  KEY `id_user` (`id_user`),
  KEY `t_replychat_ibfk_2` (`id_main`),
  CONSTRAINT `t_replychat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_replychat_ibfk_2` FOREIGN KEY (`id_main`) REFERENCES `t_mainchat` (`id_mainchat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_replychat
-- ----------------------------
INSERT INTO `t_replychat` VALUES ('1', 'keren bang', '2023-05-28 00:19:42', '0', '1', '4');
INSERT INTO `t_replychat` VALUES ('2', 'mantulll', '2023-05-28 16:45:24', '0', '2', '4');
INSERT INTO `t_replychat` VALUES ('3', 'kamu keren sekali bang', '2023-05-28 17:57:36', '0', '1', '4');
INSERT INTO `t_replychat` VALUES ('4', 'sangat amat keren', '2023-05-28 18:00:32', '1', '1', '4');
INSERT INTO `t_replychat` VALUES ('7', 'kok keren', '2023-05-28 18:06:09', '0', '1', '4');
INSERT INTO `t_replychat` VALUES ('8', 'ganteng amat', '2023-05-28 18:10:08', '0', '1', '4');
INSERT INTO `t_replychat` VALUES ('29', 'testinggggg', '2023-05-31 10:17:07', '0', '9', '11');
INSERT INTO `t_replychat` VALUES ('36', 'testtttt', '2023-05-31 10:22:17', '0', '9', '6');
INSERT INTO `t_replychat` VALUES ('37', 'kok terulang', '2023-05-31 10:25:24', '0', '9', '6');
INSERT INTO `t_replychat` VALUES ('40', 'apakah terulang', '2023-05-31 10:26:51', '0', '9', '6');
INSERT INTO `t_replychat` VALUES ('42', 'kamu keren sekali bang', '2023-06-01 03:00:43', '0', '9', '10');
INSERT INTO `t_replychat` VALUES ('43', 'hkjhkhj', '2023-06-01 15:33:07', '1', '15', '32');

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `id_gender` int(11) NOT NULL,
  `id_postprivacy` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_gender` (`id_gender`),
  KEY `id_postprivacy` (`id_postprivacy`),
  CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`id_gender`) REFERENCES `t_gender` (`id_gender`) ON UPDATE CASCADE,
  CONSTRAINT `t_user_ibfk_2` FOREIGN KEY (`id_postprivacy`) REFERENCES `t_postprivacy` (`id_postprivacy`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', 'dummy@dummy.com', 'dummy', 'dummy', null, '0', '0');
INSERT INTO `t_user` VALUES ('2', 'dummy2@dummy.com', 'dummy2', 'dumdum', null, '0', '0');
INSERT INTO `t_user` VALUES ('5', 'guest@guest.com', 'guest', 'kkdfjgoaoueuo2985729838ddkklgk48420tkkKJlkKLKKkngNjgkl__nfdl*dlf(j9df09', null, '0', '0');
INSERT INTO `t_user` VALUES ('9', 'dummy3@dummy.com', 'dummy3', '7e9d294b3f235d869f542024bee8c6ed', null, '0', '0');
INSERT INTO `t_user` VALUES ('14', 'saryagonme@gmail.com', 'testing', '5882985c8b1e2dce2763072d56a1d6e5', null, '0', '0');
INSERT INTO `t_user` VALUES ('15', 'aryayyy9604@gmail.com', 'kadalgurun', '34463c7137033b8be7a1228e79dc9ab0', null, '0', '0');
INSERT INTO `t_user` VALUES ('16', 'admcanvess001@gmail.com', 'Admin001', '9729b2b06989a9c757465918e9273563', null, '0', '0');
INSERT INTO `t_user` VALUES ('17', 'meilyaekp9570@gmail.com', 'kudalapar', '5882985c8b1e2dce2763072d56a1d6e5', null, '0', '0');
DELIMITER ;;
CREATE TRIGGER `t_main_datetime` BEFORE INSERT ON `t_mainchat` FOR EACH ROW SET NEW.main_datetime = IFNULL(NEW.main_datetime, CURRENT_TIMESTAMP)
;;
DELIMITER ;
DELIMITER ;;
CREATE TRIGGER `t_reply_datetime` BEFORE INSERT ON `t_replychat` FOR EACH ROW SET NEW.reply_datetime = IFNULL(NEW.reply_datetime, CURRENT_TIMESTAMP)
;;
DELIMITER ;
