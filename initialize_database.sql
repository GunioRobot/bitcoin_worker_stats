/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : bitcoin_worker

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2011-08-10 15:27:03
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `personal_stats`
-- ----------------------------
DROP TABLE IF EXISTS `personal_stats`;
CREATE TABLE `personal_stats` (
  `confirmed_rewards` double DEFAULT NULL,
  `hashrate` double DEFAULT NULL,
  `payout_history` double DEFAULT NULL,
  `total_pps_work` double DEFAULT NULL,
  `paid_pps_work` double DEFAULT NULL,
  `pps_donated` double DEFAULT NULL,
  `pps_shares` double DEFAULT NULL,
  `stale_shares` double DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of personal_stats
-- ----------------------------

-- ----------------------------
-- Table structure for `workers`
-- ----------------------------
DROP TABLE IF EXISTS `workers`;
CREATE TABLE `workers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of workers
-- ----------------------------

-- ----------------------------
-- Table structure for `worker_history`
-- ----------------------------
DROP TABLE IF EXISTS `worker_history`;
CREATE TABLE `worker_history` (
  `id` bigint(20) NOT NULL,
  `alive` int(11) DEFAULT NULL,
  `hashrate` double DEFAULT NULL,
  `shares` double DEFAULT NULL,
  `stale_shares` double DEFAULT NULL,
  `last_share_counted` datetime DEFAULT NULL,
  `pps_work` double DEFAULT NULL,
  `pps_donate` double DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of worker_history
-- ----------------------------
