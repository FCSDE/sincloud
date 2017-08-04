/*
MySQL Backup
Source Server Version: 5.6.26
Source Database: bdt_sincloud
Date: 04/08/2017 17:48:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `tb_agenda`
-- ----------------------------
DROP TABLE IF EXISTS `tb_agenda`;
CREATE TABLE `tb_agenda` (
  `idtb_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `ag_nome` varchar(100) DEFAULT NULL,
  `ag_telefone` varchar(20) DEFAULT NULL,
  `ag_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idtb_agenda`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
