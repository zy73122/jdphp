/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : jdphp108

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2013-10-05 12:38:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jd_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `jd_admin_user`;
CREATE TABLE `jd_admin_user` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `level` int(1) NOT NULL DEFAULT '0',
  `adminright` text,
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_admin_user
-- ----------------------------
INSERT INTO `jd_admin_user` VALUES ('9', 'admin', '74160f6ece09fe631c0774ecb415e294', '1', null, '1358694549', '127.0.0.1');
INSERT INTO `jd_admin_user` VALUES ('10', 'aaaaaa', 'a5e70230e2c2d839f74982324e1ab570', '0', 'a:19:{s:18:\"?c=login&a=welcome\";s:1:\"1\";s:9:\"?c=member\";s:1:\"1\";s:7:\"?c=html\";s:1:\"1\";s:27:\"?c=cache&a=update_all_cache\";s:1:\"1\";s:16:\"?c=config&a=info\";s:1:\"1\";s:23:\"?c=config&a=performance\";s:1:\"1\";s:16:\"?c=config&a=mail\";s:1:\"1\";s:14:\"?c=config&a=ip\";s:1:\"1\";s:18:\"?c=config&a=upload\";s:1:\"1\";s:19:\"?c=security&a=agent\";s:1:\"1\";s:16:\"?c=security&a=cc\";s:1:\"1\";s:7:\"?c=plan\";s:1:\"1\";s:13:\"?c=plan&a=add\";s:1:\"1\";s:18:\"?c=log&a=log_admin\";s:1:\"1\";s:18:\"?c=log&a=log_mysql\";s:1:\"1\";s:16:\"?c=log&a=log_php\";s:1:\"1\";s:22:\"?m=cms&a=category_list\";s:1:\"1\";s:9:\"?c=plugin\";s:1:\"1\";s:9:\"?c=widget\";s:1:\"1\";}', '1351092855', '127.0.0.1');
INSERT INTO `jd_admin_user` VALUES ('11', 'bbbbbb', 'f54e019999c0009380b301f48ee76501', '0', 'a:2:{s:9:\"?c=plugin\";s:1:\"1\";s:9:\"?c=widget\";s:1:\"1\";}', '1350231700', '127.0.0.1');

-- ----------------------------
-- Table structure for `jd_appcation`
-- ----------------------------
DROP TABLE IF EXISTS `jd_appcation`;
CREATE TABLE `jd_appcation` (
  `id` int(11) NOT NULL,
  `tpl_name` int(11) NOT NULL DEFAULT '0' COMMENT '模板',
  `menu_name` int(11) NOT NULL DEFAULT '0' COMMENT '管理菜单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用系统';

-- ----------------------------
-- Records of jd_appcation
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_cmsml_article`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cmsml_article`;
CREATE TABLE `jd_cmsml_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content_en` text NOT NULL,
  `category` int(10) NOT NULL,
  `author` varchar(60) NOT NULL,
  `from` varchar(180) NOT NULL,
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '击率点',
  `digit` int(10) NOT NULL DEFAULT '0' COMMENT '顶一下',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cmsml_article
-- ----------------------------
INSERT INTO `jd_cmsml_article` VALUES ('1', '我司乔迁新址！', 'Jointer series geomembrane welding', '<p>网站公告111</p>', '<p>notice 111</p>', '15', '', 'http://localhost', '5', '0', '0', '0', '1296027069');
INSERT INTO `jd_cmsml_article` VALUES ('2', '公告2', 'notice2', '<p>2222 cn</p>', '<p>222 en</p>', '15', '', 'http://localhost', '3', '0', '0', '1296027109', '1296027090');
INSERT INTO `jd_cmsml_article` VALUES ('3', '关于我们', 'About Us', '<p><img height=\"207\" align=\"left\" width=\"301\" src=\"/jdphp/data/upload/fckeditor/image/about.jpg\" alt=\"\" />福州亿灏数码科技有限公司（福州杰因特塑料焊接设备有限公司）是一家专业从事机电一体化产品的开发与销售的高科技企业。&quot;求实务实、谦逊真诚、精益 求精、力求完美&quot;是公司全体员工所秉持的追求，努力为用户提供先进的技术、优质的产品、周到的服务是本公司一贯宗旨。公司拥有先进的生产与测试设备,并经 常对工人实施技术培训,以保证技术与装备的先进性,为生产高品质低成本产品创造良好条件。公司有着完善的品质保证体系，产品从原材料采购、生产过程、出厂 检验等层层把关，保证产品能够百分百合格出厂。</p>\r\n<p>公司始终遵循质量第一，用户至上的原则。用最好的产品投入市场，用最好的服务回报用户。公司将不断的进行技术创新、改进生产工艺、提高产品质量、强化售后服务，为用户消除后顾之忧。用户的需要就是我们的追求。我们真诚期待着与您合作、与您共创辉煌的事业。</p>\r\n<p>Jointer系列土工膜焊接机是福州亿灏数码科技有限公司与科研院所联合研制的新一代土工膜自动爬行焊接产品，满足了土工膜在现代社会各 个工程领域不断拓展的应用需求。该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规格厚度的土工膜产品进行焊接，适用于HDPE、 LDPE、PVC、EVA、PP等一切可热熔性材料的焊接。该系列焊机温度控制部分采用自动恒温PID控制，控制精度高，温度波动小，速度控制部分采用脉 宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，能在爬坡，垂直爬行及路面负载发生变化时保持速度恒定。该系列焊接机工作性 能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填埋、建筑防水等工程。</p>\r\n<p>福州亿灏数码科技有限公司将永远站在技术最前沿,不断地开拓进取完善自我，坚定地与合作伙伴一起走向更美好的明天。</p>', '<p><img height=\"207\" align=\"left\" width=\"301\" src=\"/jdphp/data/upload/fckeditor/image/about.jpg\" alt=\"\" />Jointer series geomembrane welding machine is our new developed  products, which can weld geomembrane of various thickness and are  applicable for welding of all thermal-fused material such as LDPE, PVC,  HDPE, EVA, PP and the like.</p>\r\n<p>The control of this series of welding machine adopts PID automatic  thermostatic control with high control accuracy and low temperature  fluctuation; speed control adopts PWM automatic voltage and speed  regulation circuit, driven by DC servo motor, with great output torque  and the operating is stable. It can maintain a constant speed on the  condition of creeping, vertical creeping and variable road load. Also  this series of welding machine is stable in performance despite of  external temperature and voltage variation.</p>\r\n<p>This series of welding machine is excellent in performance and easy  for operating, with high welding speed and good work quality. It is  extensively used in engineering projects such as expressways, tunnels,  reservoirs, waterproof of construction and so on.</p>', '14', '', 'http://localhost', '129', '0', '0', '0', '1296027217');
INSERT INTO `jd_cmsml_article` VALUES ('4', '联系我们', 'Contact Us', '<ul class=\"s1\">\r\n    <li><span style=\"font-size: medium;\">地址：福建省福州市北环西路392号左海科技大厦B区1007</span></li>\r\n    <li><span style=\"font-size: medium;\">邮编：350003</span></li>\r\n    <li><span style=\"font-size: medium;\">电话：0591-83811002（销售热线）、0591-83818850（服务热线）</span></li>\r\n    <li><span style=\"font-size: medium;\">传真：0591-83811003</span></li>\r\n    <li><span style=\"font-size: medium;\">手机：13705086024、13358210221、13905009626</span></li>\r\n    <li><span style=\"font-size: medium;\">邮箱：sales@jointer.cn，</span><a><span style=\"font-size: medium;\">lzy@jointer.cn</span></a></li>\r\n</ul>\r\n<p><span style=\"font-size: medium;\"><br />\r\n</span></p>', '<ul class=\"s1\">\r\n    <li><span style=\"font-size: medium;\">Address : 392 BeiHuan West Road, Fuzhou, Fujian, ZuoHai Science Technology Building B1007</span></li>\r\n    <li><span style=\"font-size: medium;\">Postcode : 350003</span></li>\r\n    <li><span style=\"font-size: medium;\">Tel : 0591-83811002 (Sales) , 0591-83818850(Service)</span></li>\r\n    <li><span style=\"font-size: medium;\">Fax : 0591-83811003</span></li>\r\n    <li><span style=\"font-size: medium;\">Phone : 13705086024、13358210221、13905009626</span></li>\r\n    <li><span style=\"font-size: medium;\">E-mail : sales@jointer.cn，</span><a><span style=\"font-size: medium;\">lzy@jointer.cn</span></a></li>\r\n</ul>\r\n<p><span style=\"font-size: medium;\"><br />\r\n</span></p>', '14', '', 'http://localhost', '34', '0', '0', '0', '1296027266');
INSERT INTO `jd_cmsml_article` VALUES ('5', 'GL-145', 'GL-145 en', '<div class=\"info1\">\r\n<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132053_713.jpg\" alt=\"\" /></p>\r\n</div>\r\n<p>&nbsp;</p>', '<div class=\"info1\">\r\n<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132053_713.jpg\" alt=\"\" /></p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '1', '', 'http://localhost', '36', '0', '1', '1331990585', '1296027985');
INSERT INTO `jd_cmsml_article` VALUES ('22', 'Two Wheels Fair Oct.2009 SauPaulo Brazil', 'DTwo Wheels Fair Oct.2009 SauPaulo Brazil', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '17', '', 'http://localhost', '25', '0', '0', '1331992294', '1296031011');
INSERT INTO `jd_cmsml_article` VALUES ('23', 'Enterprice 11', 'Enterprice Mailbox Is Ready In Use', '<p>中文</p>', '<p>en</p>', '17', '', 'http://localhost', '37', '0', '0', '1332648185', '1331992252');
INSERT INTO `jd_cmsml_article` VALUES ('24', 'aa', 'aaa', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120318060237_962.jpg\" alt=\"\" /></p>', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120318060237_962.jpg\" alt=\"\" /></p>', '2', '', 'http://localhost', '3', '0', '0', '1332050564', '1332050426');
INSERT INTO `jd_cmsml_article` VALUES ('6', 'AN-125', 'AN-125 en', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132330_733.jpg\" alt=\"\" /></p>\r\n<br />', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132330_733.jpg\" alt=\"\" /></p>\r\n<br />\r\n<p>&nbsp;</p>', '1', '', 'http://localhost', '47', '0', '2', '1331990632', '1296029886');
INSERT INTO `jd_cmsml_article` VALUES ('7', 'Dec.12th 2009 17th Anniversary', 'Dec.12th 2009 17th Anniversary', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '17', '', 'http://localhost', '18', '0', '0', '1331991407', '1296031011');
INSERT INTO `jd_cmsml_article` VALUES ('8', 'From 11th Feb to 20th Feb our holiday', 'From 11th Feb to 20th Feb our holiday', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '<p>YOG Automobile Parts Co.,Ltd. is one of the earliest and most famous companies,  which is specialized in manufacturing and selling parts of motorcycles. Our  products are in great variety, and we have got the intellectual property rights  in the trademark YOG,which is well-known all over the nation and even the  world.</p>\r\n<p>&nbsp;&nbsp;&nbsp; After twenty years\'experience of new products\'research and development,  quality control,and corporate management,the trademark YOG is supported by our  powerful technology and its quality is firmly assured. At the same time, the  series products of our company have become the representation of optimum quality  compared with our competitors. The annual sales keep growing and our company has  been designated as the original equipment manufacturer by many motorcycle  manufacture corporations.</p>\r\n<p>&nbsp;&nbsp;&nbsp; We have always pursued a policy of steady quality and excellent  after-sell service and we have set up a good reputation in motorcycle parts  market. We will supply the best products to our customer domestic and oversea  with low price but high spead.</p>\r\n<p>&nbsp;&nbsp;&nbsp; The company will serve all the customers through innovative research and  development. We will take customers\'s satisfactions as our objective for  operation development, so as to enable our series of products to be sold  throughout the world.</p>', '17', '', 'http://localhost', '17', '0', '0', '1331991356', '1296031011');
INSERT INTO `jd_cmsml_article` VALUES ('9', 'SY-125（B4）', 'SY-125（B4） en', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132419_515.jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132419_515.jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '1', '', 'http://localhost', '15', '0', '3', '1331990678', '1296029886');
INSERT INTO `jd_cmsml_article` VALUES ('10', 'SY-125（B3）', 'SY-125（B3）en', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132507_302.jpg\" alt=\"\" /></p>\r\n<br />', '<p><img height=\"115\" width=\"163\" src=\"/jdphp1.07/data/upload/fckeditor/20120317132507_302.jpg\" alt=\"\" /></p>\r\n<br />\r\n<p>&nbsp;</p>', '1', '', 'http://localhost', '1', '0', '4', '1331990719', '1296029886');
INSERT INTO `jd_cmsml_article` VALUES ('11', '土工膜焊接机JIT-910_copy', 'aaaaaaaaaaa', '<div class=\"info1\">\r\n<p><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新 一代土工膜自动爬行焊接产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规 格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接。该系列焊机温度控制部分采用自动恒温PID控 制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，能在爬坡，垂直爬行及路面 负载发生变化时保持速度恒定。该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填 埋、建筑防水等工程。</p>\r\n<p>JIT-910型土工膜焊接机技术参数：</p>\r\n<p>输入电压V：220V  频率：50Hz</p>\r\n<p>功率P：1800W</p>\r\n<p>焊接速度V：0.5~5m/min</p>\r\n<p>加热温度T：0~450℃</p>\r\n<p>焊接材料厚度：1mm~3mm(单层膜厚)</p>\r\n<p>焊缝宽度：14mm&times;2 中间空腔16mm</p>\r\n<p>焊缝强度&ge;85%母材（剪切方向抗拉）</p>\r\n<p>搭接宽度：120mm</p>\r\n</div>', '<p><span id=\"result_box\" class=\"long_text\"><span style=\"background-color: rgb(255, 255, 255);\" title=\"Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新一代土工膜自动爬行焊接\"><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer  (Jieyin Te) brand geomembrane welding machine (welding machine  waterproof board, impervious membrane welding machine, welding  climbing), Fuzhou billion Hao and research institutes Digital Technology  Co., Ltd. jointly developed a new generation of automatic crawling  welding geomembrane </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。\">products to meet the geomembrane various engineering fields in modern society expanding application needs. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接\">The  machine uses an advanced thermal wedge structure, material properties  can be different for different sizes and thickness of the geomembrane  welding products for HDPE, LDPE, PVC, EVA, PP and all other materials  can be hot-melt welding </span><span title=\"。\">. </span><span title=\"该系列焊机温度控制部分采用自动恒温PID控制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，\">This  series of welding machine with automatic temperature control part of  the PID temperature control, high control precision, the temperature  fluctuation is small, the speed control part of the pulse-width  modulation (PWM) circuit steady speed automatic voltage regulator, DC  servo motor, output torque, smooth running, </span><span title=\"能在爬坡，垂直爬行及路面负载发生变化时保持速度恒定。\">in climbing, vertical crawling and road load changes to maintain a constant speed. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填埋、建筑防水等工程。\">This  series of welding machines stable performance, easy operation, welding,  high efficiency, reliability, widely used in highway, railway, tunnel,  reservoir drainage, sewage pond, landfill, construction waterproofing  works. <br />\r\n<br />\r\n</span><span title=\"JIT-910型土工膜焊接机技术参数：\">JIT-910 type of geomembrane welding machine Technical parameters: <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"输入电压V：220V 频率：50Hz\">Input voltage V: 220V Frequency: 50Hz <br />\r\n<br />\r\n</span><span title=\"功率P：1800W\">Power P: 1800W <br />\r\n<br />\r\n</span><span title=\"焊接速度V：0.5~5m/min\">Welding speed V: 0.5 ~ 5m/min <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"加热温度T：0~450℃\">Heating temperature T: 0 ~ 450 ℃ <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊接材料厚度：1mm~3mm(单层膜厚)\">Welding material thickness: 1mm ~ 3mm (single thickness) <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝宽度：14mm&times;2 中间空腔16mm\">Weld width: 14mm &times; 2 16mm cavity between <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝强度&ge;85%母材（剪切方向抗拉）\">&ge; 85% weld strength of base metal (tensile shear directio
n) <br />\r\n<br />\r\n</span><span title=\"搭接宽度：120mm\">Lap width: 120mm <br />\r\n</span></span></p>', '1', '', 'http://localhost', '0', '0', '5', '1296028057', '1296027985');
INSERT INTO `jd_cmsml_article` VALUES ('12', '土工膜焊接机JIT-910_copy', 'aaaaaaaaaaa', '<div class=\"info1\">\r\n<p><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新 一代土工膜自动爬行焊接产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规 格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接。该系列焊机温度控制部分采用自动恒温PID控 制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，能在爬坡，垂直爬行及路面 负载发生变化时保持速度恒定。该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填 埋、建筑防水等工程。</p>\r\n<p>JIT-910型土工膜焊接机技术参数：</p>\r\n<p>输入电压V：220V  频率：50Hz</p>\r\n<p>功率P：1800W</p>\r\n<p>焊接速度V：0.5~5m/min</p>\r\n<p>加热温度T：0~450℃</p>\r\n<p>焊接材料厚度：1mm~3mm(单层膜厚)</p>\r\n<p>焊缝宽度：14mm&times;2 中间空腔16mm</p>\r\n<p>焊缝强度&ge;85%母材（剪切方向抗拉）</p>\r\n<p>搭接宽度：120mm</p>\r\n</div>', '<p><span id=\"result_box\" class=\"long_text\"><span style=\"background-color: rgb(255, 255, 255);\" title=\"Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新一代土工膜自动爬行焊接\"><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer  (Jieyin Te) brand geomembrane welding machine (welding machine  waterproof board, impervious membrane welding machine, welding  climbing), Fuzhou billion Hao and research institutes Digital Technology  Co., Ltd. jointly developed a new generation of automatic crawling  welding geomembrane </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。\">products to meet the geomembrane various engineering fields in modern society expanding application needs. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接\">The  machine uses an advanced thermal wedge structure, material properties  can be different for different sizes and thickness of the geomembrane  welding products for HDPE, LDPE, PVC, EVA, PP and all other materials  can be hot-melt welding </span><span title=\"。\">. </span><span title=\"该系列焊机温度控制部分采用自动恒温PID控制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，\">This  series of welding machine with automatic temperature control part of  the PID temperature control, high control precision, the temperature  fluctuation is small, the speed control part of the pulse-width  modulation (PWM) circuit steady speed automatic voltage regulator, DC  servo motor, output torque, smooth running, </span><span title=\"能在爬坡，垂直爬行及路面负载发生变化时保持速度恒定。\">in climbing, vertical crawling and road load changes to maintain a constant speed. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填埋、建筑防水等工程。\">This  series of welding machines stable performance, easy operation, welding,  high efficiency, reliability, widely used in highway, railway, tunnel,  reservoir drainage, sewage pond, landfill, construction waterproofing  works. <br />\r\n<br />\r\n</span><span title=\"JIT-910型土工膜焊接机技术参数：\">JIT-910 type of geomembrane welding machine Technical parameters: <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"输入电压V：220V 频率：50Hz\">Input voltage V: 220V Frequency: 50Hz <br />\r\n<br />\r\n</span><span title=\"功率P：1800W\">Power P: 1800W <br />\r\n<br />\r\n</span><span title=\"焊接速度V：0.5~5m/min\">Welding speed V: 0.5 ~ 5m/min <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"加热温度T：0~450℃\">Heating temperature T: 0 ~ 450 ℃ <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊接材料厚度：1mm~3mm(单层膜厚)\">Welding material thickness: 1mm ~ 3mm (single thickness) <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝宽度：14mm&times;2 中间空腔16mm\">Weld width: 14mm &times; 2 16mm cavity between <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝强度&ge;85%母材（剪切方向抗拉）\">&ge; 85% weld strength of base metal (tensile shear directio
n) <br />\r\n<br />\r\n</span><span title=\"搭接宽度：120mm\">Lap width: 120mm <br />\r\n</span></span></p>', '1', '', 'http://localhost', '0', '0', '6', '1296028057', '1296027985');
INSERT INTO `jd_cmsml_article` VALUES ('13', '土工膜焊接机JIT-910_copy', 'aaaaaaaaaaa', '<div class=\"info1\">\r\n<p><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新 一代土工膜自动爬行焊接产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规 格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接。该系列焊机温度控制部分采用自动恒温PID控 制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，能在爬坡，垂直爬行及路面 负载发生变化时保持速度恒定。该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填 埋、建筑防水等工程。</p>\r\n<p>JIT-910型土工膜焊接机技术参数：</p>\r\n<p>输入电压V：220V  频率：50Hz</p>\r\n<p>功率P：1800W</p>\r\n<p>焊接速度V：0.5~5m/min</p>\r\n<p>加热温度T：0~450℃</p>\r\n<p>焊接材料厚度：1mm~3mm(单层膜厚)</p>\r\n<p>焊缝宽度：14mm&times;2 中间空腔16mm</p>\r\n<p>焊缝强度&ge;85%母材（剪切方向抗拉）</p>\r\n<p>搭接宽度：120mm</p>\r\n</div>', '<p><span id=\"result_box\" class=\"long_text\"><span style=\"background-color: rgb(255, 255, 255);\" title=\"Jointer（杰因特）品牌系列土工膜焊接机（防水板焊接机、防渗膜焊接机、爬焊机）是福州亿灏数码科技有限公司与科研院所联合研制的新一代土工膜自动爬行焊接\"><img height=\"484\" width=\"598\" src=\"/jdphp/data/upload/fckeditor/image/20110126074714_108.jpg\" alt=\"\" />Jointer  (Jieyin Te) brand geomembrane welding machine (welding machine  waterproof board, impervious membrane welding machine, welding  climbing), Fuzhou billion Hao and research institutes Digital Technology  Co., Ltd. jointly developed a new generation of automatic crawling  welding geomembrane </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"产品，满足了土工膜在现代社会各个工程领域不断拓展的应用需求。\">products to meet the geomembrane various engineering fields in modern society expanding application needs. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该机器采用了先进的热楔式结构，可以面向各种不同材质特性和不同规格厚度的土工膜产品进行焊接，适用于HDPE、LDPE、PVC、EVA、PP等一切可热熔性材料的焊接\">The  machine uses an advanced thermal wedge structure, material properties  can be different for different sizes and thickness of the geomembrane  welding products for HDPE, LDPE, PVC, EVA, PP and all other materials  can be hot-melt welding </span><span title=\"。\">. </span><span title=\"该系列焊机温度控制部分采用自动恒温PID控制，控制精度高，温度波动小，速度控制部分采用脉宽调制（PWM）自动稳压稳速电路，直流伺服电机驱动，输出力矩大，行走平稳，\">This  series of welding machine with automatic temperature control part of  the PID temperature control, high control precision, the temperature  fluctuation is small, the speed control part of the pulse-width  modulation (PWM) circuit steady speed automatic voltage regulator, DC  servo motor, output torque, smooth running, </span><span title=\"能在爬坡，垂直爬行及路面负载发生变化时保持速度恒定。\">in climbing, vertical crawling and road load changes to maintain a constant speed. </span><span style=\"background-color: rgb(255, 255, 255);\" title=\"该系列焊接机工作性能稳定、操作方便、焊接效率高、可靠性强，广泛应用于高速公路、铁路、隧道、水库水渠、污水池、垃圾填埋、建筑防水等工程。\">This  series of welding machines stable performance, easy operation, welding,  high efficiency, reliability, widely used in highway, railway, tunnel,  reservoir drainage, sewage pond, landfill, construction waterproofing  works. <br />\r\n<br />\r\n</span><span title=\"JIT-910型土工膜焊接机技术参数：\">JIT-910 type of geomembrane welding machine Technical parameters: <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"输入电压V：220V 频率：50Hz\">Input voltage V: 220V Frequency: 50Hz <br />\r\n<br />\r\n</span><span title=\"功率P：1800W\">Power P: 1800W <br />\r\n<br />\r\n</span><span title=\"焊接速度V：0.5~5m/min\">Welding speed V: 0.5 ~ 5m/min <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"加热温度T：0~450℃\">Heating temperature T: 0 ~ 450 ℃ <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊接材料厚度：1mm~3mm(单层膜厚)\">Welding material thickness: 1mm ~ 3mm (single thickness) <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝宽度：14mm&times;2 中间空腔16mm\">Weld width: 14mm &times; 2 16mm cavity between <br />\r\n<br />\r\n</span><span style=\"background-color: rgb(255, 255, 255);\" title=\"焊缝强度&ge;85%母材（剪切方向抗拉）\">&ge; 85% weld strength of base metal (tensile shear directio
n) <br />\r\n<br />\r\n</span><span title=\"搭接宽度：120mm\">Lap width: 120mm <br />\r\n</span></span></p>', '1', '', 'http://localhost', '0', '0', '7', '1296028057', '1296027985');
INSERT INTO `jd_cmsml_article` VALUES ('19', '荣誉证书', 'certification', '<p>企业证书企业证书</p>', '<p>certificationcertification</p>', '14', '', 'http://localhost', '15', '0', '0', '1332078063', '1331389065');

-- ----------------------------
-- Table structure for `jd_cmsml_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cmsml_category`;
CREATE TABLE `jd_cmsml_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `type` enum('pro','new') DEFAULT 'new' COMMENT '产品，新闻',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cmsml_category
-- ----------------------------
INSERT INTO `jd_cmsml_category` VALUES ('1', '13', 'Camshaft cn', 'Camshaft', '<p><img width=\"724\" height=\"889\" alt=\"\" src=\"/jdphp1.07/data/upload/fckeditor/20120317145141_186.jpg\" /></p>', '<p><img width=\"724\" height=\"889\" alt=\"\" src=\"/jdphp1.07/data/upload/fckeditor/20120317145141_186.jpg\" /></p>', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('2', '13', 'Starting Clutch', 'Starting Clutch', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('3', '13', 'Valve Rocker Arm', 'Valve Rocker Arm', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('4', '13', 'Valve', 'Valve', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('5', '13', 'Gold Valve', 'Gold Valve', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('6', '13', 'Guide Valve', 'Guide Valve', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('7', '13', 'Cylinder Head', 'Cylinder Head', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('8', '13', 'Cylinder', 'Cylinder', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('11', '0', '新闻中心', 'News', '', '', '0', 'new');
INSERT INTO `jd_cmsml_category` VALUES ('13', '0', '产品中心', 'Products', '', '', '0', 'pro');
INSERT INTO `jd_cmsml_category` VALUES ('14', '11', '系统文章', 'system', '', '', '0', 'new');
INSERT INTO `jd_cmsml_category` VALUES ('15', '11', '网站公告', 'Notice', '', '', '0', 'new');
INSERT INTO `jd_cmsml_category` VALUES ('17', '11', '公司新闻', 'Company News', '', '', '0', 'new');

-- ----------------------------
-- Table structure for `jd_cmsml_comment`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cmsml_comment`;
CREATE TABLE `jd_cmsml_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cmsml_article_id` int(10) unsigned NOT NULL,
  `uname` varchar(255) NOT NULL COMMENT '评论者名字',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cmsml_article_id` (`cmsml_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cmsml_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_cmsml_comment_bannedword`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cmsml_comment_bannedword`;
CREATE TABLE `jd_cmsml_comment_bannedword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cmsml_comment_bannedword
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_cmsml_image`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cmsml_image`;
CREATE TABLE `jd_cmsml_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cmsml_article_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `src` varchar(255) NOT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cmsml_article_id` (`cmsml_article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cmsml_image
-- ----------------------------
INSERT INTO `jd_cmsml_image` VALUES ('1', '3', '', '', '/jdphp1.07/data/upload/fckeditor/image/about.jpg', '0', '1296027217');
INSERT INTO `jd_cmsml_image` VALUES ('7', '5', '', '', '/jdphp1.07/data/upload/fckeditor/20120317132053_713.jpg', '0', '1331990585');
INSERT INTO `jd_cmsml_image` VALUES ('8', '6', '', '', '/jdphp1.07/data/upload/fckeditor/20120317132330_733.jpg', '0', '1331990632');
INSERT INTO `jd_cmsml_image` VALUES ('9', '9', '', '', '/jdphp1.07/data/upload/fckeditor/20120317132419_515.jpg', '0', '1331990678');
INSERT INTO `jd_cmsml_image` VALUES ('10', '10', '', '', '/jdphp1.07/data/upload/fckeditor/20120317132507_302.jpg', '0', '1331990719');
INSERT INTO `jd_cmsml_image` VALUES ('11', '24', '', '', '/jdphp1.07/data/upload/fckeditor/20120318060237_962.jpg', '0', '1332050564');

-- ----------------------------
-- Table structure for `jd_cms_article`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cms_article`;
CREATE TABLE `jd_cms_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` int(10) NOT NULL,
  `author` varchar(60) NOT NULL,
  `from` varchar(180) NOT NULL,
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '击率点',
  `digit` int(10) NOT NULL DEFAULT '0' COMMENT '顶一下',
  `treadit` int(10) NOT NULL DEFAULT '0' COMMENT '踩一下',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cms_article
-- ----------------------------
INSERT INTO `jd_cms_article` VALUES ('297', '企业文化', '', '89', '', 'http://localhost', '32', '0', '0', '0', '0', '1330260480');
INSERT INTO `jd_cms_article` VALUES ('298', '企业结构', '', '90', '', 'http://localhost', '10', '0', '0', '0', '0', '1330260500');
INSERT INTO `jd_cms_article` VALUES ('299', '资质证书', '', '91', '', 'http://localhost', '13', '0', '0', '0', '0', '1330260510');
INSERT INTO `jd_cms_article` VALUES ('300', '联系我们', '', '92', '', 'http://localhost', '12', '0', '0', '0', '0', '1330260524');
INSERT INTO `jd_cms_article` VALUES ('301', '人力资源', '', '87', '', 'http://localhost', '29', '0', '0', '0', '0', '1330260850');
INSERT INTO `jd_cms_article` VALUES ('302', '软件产品', '<dl>\r\n    <dt style=\"text-align: center;\"><a href=\"#\"><img height=\"120\" width=\"160\" src=\"/jdphp1.07/data/upload/fckeditor/20120305140809_830.gif\" alt=\"\" /></a>  </dt>\r\n    <dd>\r\n    <p>福州量子中金数码技术有限公司是致力于影像文档工作流程和影像文档应</p>\r\n    </dd>\r\n</dl>', '93', '', 'http://localhost', '12', '0', '0', '0', '1330956494', '1330617617');
INSERT INTO `jd_cms_article` VALUES ('303', '数字化扫描加工', '<dl>\r\n    <dt style=\"text-align: center;\"><a href=\"#\"><img height=\"120\" width=\"160\" src=\"/jdphp1.07/data/upload/fckeditor/20120305140836_639.gif\" alt=\"\" /></a>  </dt>\r\n    <dd>\r\n    <p>福州量子中金数码技术有限公司是致力于影像文档工作流程和影像文档应</p>\r\n    </dd>\r\n</dl>', '93', '', 'http://localhost', '17', '0', '0', '0', '1330956520', '1330617689');
INSERT INTO `jd_cms_article` VALUES ('283', '公司简介', '<p align=\"center\"><img height=\"246\" width=\"410\" src=\"/jdphp1.07/data/upload/fckeditor/20120226083738_403.jpg\" alt=\"\" /></p>\r\n<p>&nbsp;</p>\r\n<p>福州量子中金数码技术有限公司是致力于影像文档工作流程和影像文档应用整体解决方案的高科技企业。</p>\r\n<p>公司为金融、政府、企事业等领域提供大型应用软件开发、专业软件技术服务、系统集成及全面的解决方案。</p>\r\n<p>公司与国内外知名企业建立合作伙伴关系、同时凭借自身多年积累的行业经验不断创新，相继推出了一系列优秀的软件产品和解决方案。</p>\r\n<p><strong>软件产品：</strong><br />\r\n文档王电子文档管理系统、 <br />\r\nDMS图档辅助处理系统、 <br />\r\n综合档案管理系统、 <br />\r\n数字化档案馆、 <br />\r\n协同办公系统、 <br />\r\n影像工作流程管理、 <br />\r\n文档影像数字化加工管理系统</p>\r\n<p>服    务：承接文档数字化扫描加工服务。</p>\r\n<p>代理硬件产品：公司多年一直代理扫描仪、图形终端等硬件。</p>\r\n<p>为虹光扫描仪、中晶扫描仪福建总代理商；倚龙XPE终端福建增值代理商。</p>', '88', '', 'http://localhost', '61', '0', '0', '0', '1330257450', '1330245380');

-- ----------------------------
-- Table structure for `jd_cms_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cms_category`;
CREATE TABLE `jd_cms_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` mediumtext NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cms_category
-- ----------------------------
INSERT INTO `jd_cms_category` VALUES ('78', '0', '公司概况', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('79', '0', '资讯中心', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('80', '79', '公司动态', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('81', '79', '行业动态', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('82', '79', '媒体报道', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('83', '0', '方案案例', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('84', '83', '成功案例', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('85', '83', '典型客户', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('86', '0', '其他', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('87', '86', '人力资源', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('88', '78', '公司简介', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('89', '78', '企业文化', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('90', '78', '企业结构', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('91', '78', '资质证书', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('92', '78', '联系我们', '', '', '0');
INSERT INTO `jd_cms_category` VALUES ('93', '86', '介绍', '', '', '0');

-- ----------------------------
-- Table structure for `jd_cms_comment`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cms_comment`;
CREATE TABLE `jd_cms_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_article_id` int(10) unsigned NOT NULL,
  `uname` varchar(255) NOT NULL COMMENT '评论者名字',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cms_article_id` (`cms_article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cms_comment
-- ----------------------------
INSERT INTO `jd_cms_comment` VALUES ('36', '73', 'Guest-20110211130619', '', 'sssssssssssssssssssssssssssssssssss', '1297400779');
INSERT INTO `jd_cms_comment` VALUES ('37', '73', 'Guest-20110211131235', '', 'asdasd', '1297401155');
INSERT INTO `jd_cms_comment` VALUES ('38', '73', 'Guest-20110211131425', '', 'zy73122', '1297401265');
INSERT INTO `jd_cms_comment` VALUES ('39', '73', 'Guest-20110211131634', '', 'zy73122', '1297401394');
INSERT INTO `jd_cms_comment` VALUES ('40', '73', 'zy73122', '', 'zy73122zy73122zy73122', '1297401428');
INSERT INTO `jd_cms_comment` VALUES ('41', '73', 'zy73122', '', 'zy73122zy73122zy73122', '1297401776');
INSERT INTO `jd_cms_comment` VALUES ('42', '73', 'zy73122', '', 'zy73122zy73122zy73122', '1297401799');
INSERT INTO `jd_cms_comment` VALUES ('43', '73', 'Guest-20110211133422', '', 'ssssssssssssssssss', '1297402462');
INSERT INTO `jd_cms_comment` VALUES ('46', '75', 'zy73122', '', '支持你们。加油。。。。。那些国家工商局真不知道吃什么的？那么多人都可以注册成功，唯独正宗的传人注册不了。真怀疑是不是收了人家什么好处', '1297403635');
INSERT INTO `jd_cms_comment` VALUES ('45', '73', 'zy73122', '', 'xxxssssssssssssssss', '1297402555');
INSERT INTO `jd_cms_comment` VALUES ('47', '75', 'Guest-192.168.1.106', '', '晕死，浙江人真无耻，就会抢咱福建得东西', '1297404001');
INSERT INTO `jd_cms_comment` VALUES ('48', '75', 'Guest-192.168.1.106', '', '你不意思意思一下他会给你办，人家就懂得多了，帮忙照顾家里顺便帮帮外面的，这注册不就下来了，呆呵', '1297404091');
INSERT INTO `jd_cms_comment` VALUES ('49', '75', 'Guest-192.168.1.106', '', '太无耻了！聚春园要加油啊！不能被别人夺去我们福建闽菜的骄傲', '1297404123');
INSERT INTO `jd_cms_comment` VALUES ('50', '44', 'Guest-192.168.1.145', '', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1297404231');

-- ----------------------------
-- Table structure for `jd_cms_comment_bannedword`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cms_comment_bannedword`;
CREATE TABLE `jd_cms_comment_bannedword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cms_comment_bannedword
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_cms_image`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cms_image`;
CREATE TABLE `jd_cms_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_article_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `src` varchar(255) NOT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cms_article_id` (`cms_article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cms_image
-- ----------------------------
INSERT INTO `jd_cms_image` VALUES ('92', '303', '', '', '/jdphp1.07/data/upload/fckeditor/20120305140836_639.gif', '0', '1330956520');
INSERT INTO `jd_cms_image` VALUES ('86', '283', '', '', '/jdphp1.07/data/upload/fckeditor/20120226083738_403.jpg', '0', '1330257450');
INSERT INTO `jd_cms_image` VALUES ('91', '302', '', '', '/jdphp1.07/data/upload/fckeditor/20120305140809_830.gif', '0', '1330956494');

-- ----------------------------
-- Table structure for `jd_config`
-- ----------------------------
DROP TABLE IF EXISTS `jd_config`;
CREATE TABLE `jd_config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cf_name` varchar(30) NOT NULL DEFAULT '',
  `cf_value` text NOT NULL,
  `cf_desc` varchar(30) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cf_name` (`cf_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2843 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_config
-- ----------------------------
INSERT INTO `jd_config` VALUES ('1', 'cf_admingd', '0', '');
INSERT INTO `jd_config` VALUES ('2704', 'cf_cc', '1', '');
INSERT INTO `jd_config` VALUES ('2829', 'cf_ceoconnect', 'http://localhost', '');
INSERT INTO `jd_config` VALUES ('2830', 'cf_ceoemail', 'zy73122@163.com', '');
INSERT INTO `jd_config` VALUES ('5', 'cf_cookiepath', '/', '');
INSERT INTO `jd_config` VALUES ('6', 'cf_clickcount', '1', '');
INSERT INTO `jd_config` VALUES ('7', 'cf_cvtime', '0', '');
INSERT INTO `jd_config` VALUES ('8', 'cf_datefm', 'Y-m-j H:i', '');
INSERT INTO `jd_config` VALUES ('2767', 'cf_debug', '1', '');
INSERT INTO `jd_config` VALUES ('10', 'cf_footertime', '1', '');
INSERT INTO `jd_config` VALUES ('11', 'cf_hash', 'djfdosp^%&^21313ffsdfsd', '');
INSERT INTO `jd_config` VALUES ('2838', 'cf_icp', '闽ICP备06028669号', '');
INSERT INTO `jd_config` VALUES ('2839', 'cf_icpurl', 'http://www.miibeian.gov.cn', '');
INSERT INTO `jd_config` VALUES ('14', 'cf_ifjump', '1', '');
INSERT INTO `jd_config` VALUES ('2713', 'cf_ipban', '', '');
INSERT INTO `jd_config` VALUES ('2842', 'cf_ipstat', '', '');
INSERT INTO `jd_config` VALUES ('17', 'cf_ipstates', '1', '');
INSERT INTO `jd_config` VALUES ('2703', 'cf_loadavg', '2', '');
INSERT INTO `jd_config` VALUES ('19', 'cf_lp', '1', '');
INSERT INTO `jd_config` VALUES ('2841', 'cf_metadescrip', '广州市永友机动车配件有限公司是全国成立时间最早，生产规模最大的知名摩托车配件专业生产，销售企业之一，拥有全国乃至世界知名的摩托车配件品牌\"YOG\"的独立知识产权和系列配套产品。永友公司在经历了二十年的产品研发，品质控制和企业管理经验的积累，使得\"YOG\"品牌获得了强大的技术支持和品质保证，其系列产品已成为同行业最佳品质的代表，并成为大型摩托车生产企业所指定的OEM供应商，公司的销售额也因此逐年上升。', '');
INSERT INTO `jd_config` VALUES ('2840', 'cf_metakeyword', '摩配,摩托车,摩托车配件,摩托车附件,摩托车备件,广州市永友机动车配件有限公司', '');
INSERT INTO `jd_config` VALUES ('2765', 'cf_obstart', '0', '');
INSERT INTO `jd_config` VALUES ('2719', 'cf_proxy', '0', '');
INSERT INTO `jd_config` VALUES ('24', 'cf_refreshtime', '0', '');
INSERT INTO `jd_config` VALUES ('2827', 'cf_sysname', 'Jdphp框架', '');
INSERT INTO `jd_config` VALUES ('26', 'cf_sysopen', '1', '');
INSERT INTO `jd_config` VALUES ('2828', 'cf_sysurl', 'http://www.jdphp.com/', '');
INSERT INTO `jd_config` VALUES ('28', 'cf_timedf', '8', '');
INSERT INTO `jd_config` VALUES ('29', 'cf_isp', '1', '');
INSERT INTO `jd_config` VALUES ('30', 'cf_mulindex', '', '');
INSERT INTO `jd_config` VALUES ('31', 'cf_enmemcache', '0', '');
INSERT INTO `jd_config` VALUES ('32', 'cf_memcacheserver', '192.168.1.233', '');
INSERT INTO `jd_config` VALUES ('33', 'cf_memcacheport', '11211', '');
INSERT INTO `jd_config` VALUES ('34', 'cf_sendemail', '1', '');
INSERT INTO `jd_config` VALUES ('35', 'cf_sendemailtype', '1', '');
INSERT INTO `jd_config` VALUES ('36', 'cf_fromemail', 'zy73122@163.com', '');
INSERT INTO `jd_config` VALUES ('37', 'cf_smtpserver', 'smtp.163.com', '');
INSERT INTO `jd_config` VALUES ('38', 'cf_smtpport', '25', '');
INSERT INTO `jd_config` VALUES ('39', 'cf_smtpssl', '0', '');
INSERT INTO `jd_config` VALUES ('40', 'cf_smtpauth', '1', '');
INSERT INTO `jd_config` VALUES ('41', 'cf_smtpid', 'zy73122', '');
INSERT INTO `jd_config` VALUES ('42', 'cf_smtppass', '', '');
INSERT INTO `jd_config` VALUES ('2768', 'cf_display_update_info', '1', '');
INSERT INTO `jd_config` VALUES ('44', 'cf_ckdomain', '', '');
INSERT INTO `jd_config` VALUES ('45', 'cf_path_html', '/html', '');
INSERT INTO `jd_config` VALUES ('2766', 'cf_verify_code', '1', '');
INSERT INTO `jd_config` VALUES ('2810', 'cf_dirtplmain', 'company_default', '');
INSERT INTO `jd_config` VALUES ('2722', 'cf_dirtpladmin', 'default3', '');
INSERT INTO `jd_config` VALUES ('2831', 'cf_ceopostcode', '350003', '');
INSERT INTO `jd_config` VALUES ('2832', 'cf_ceotel', '0591-83811002', '');
INSERT INTO `jd_config` VALUES ('2833', 'cf_ceofax', '0591-83811003', '');
INSERT INTO `jd_config` VALUES ('2834', 'cf_ceomobile', '', '');
INSERT INTO `jd_config` VALUES ('2835', 'cf_ceoaddress', '福建省福州市北环西路392号左海科技大厦B区1007', '');
INSERT INTO `jd_config` VALUES ('2837', 'cf_ceoecopyright', 'JDphpV1.05', '');
INSERT INTO `jd_config` VALUES ('2836', 'cf_ceomsn', 'feef3@163.com', '');
INSERT INTO `jd_config` VALUES ('636', 'cf_ceoseller1', '姓名 059122236544', '');
INSERT INTO `jd_config` VALUES ('637', 'cf_ceoseller2', '姓名 059122236533', '');
INSERT INTO `jd_config` VALUES ('638', 'cf_ceoseller3', '', '');
INSERT INTO `jd_config` VALUES ('442', 'cf_random_promote', '1', '');
INSERT INTO `jd_config` VALUES ('443', 'cf_random_new', '0', '');
INSERT INTO `jd_config` VALUES ('444', 'cf_random_best', '0', '');
INSERT INTO `jd_config` VALUES ('445', 'cf_random_hot', '0', '');
INSERT INTO `jd_config` VALUES ('2036', 'cf_watermark_switch', '0', '');
INSERT INTO `jd_config` VALUES ('2037', 'cf_watermark_pos', '3', '');
INSERT INTO `jd_config` VALUES ('2038', 'cf_upload_switch', '1', '');
INSERT INTO `jd_config` VALUES ('2039', 'cf_upload_allow_type', 'jpg,png,gif', '');
INSERT INTO `jd_config` VALUES ('2622', 'cf_jcpj_index_picshow1', '5', '');
INSERT INTO `jd_config` VALUES ('2623', 'cf_jcpj_index_picshow2', '6', '');
INSERT INTO `jd_config` VALUES ('2624', 'cf_jcpj_index_picshow3', '1', '');
INSERT INTO `jd_config` VALUES ('2625', 'cf_jcpj_index_picshow4', '2', '');

-- ----------------------------
-- Table structure for `jd_cycleimage`
-- ----------------------------
DROP TABLE IF EXISTS `jd_cycleimage`;
CREATE TABLE `jd_cycleimage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_cycleimage
-- ----------------------------
INSERT INTO `jd_cycleimage` VALUES ('1', '澳大利亚：体验蓝山风光，感受澳洲风情', 'http://192.168.1.145', 'data/upload/images/201204/1333269091197846522.jpg', '0', '1', '1289290694');
INSERT INTO `jd_cycleimage` VALUES ('4', 'asd', '', 'data/upload/images/201204/1333269275174405577.jpg', '0', '1', '1333298075');

-- ----------------------------
-- Table structure for `jd_discuzpost_post`
-- ----------------------------
DROP TABLE IF EXISTS `jd_discuzpost_post`;
CREATE TABLE `jd_discuzpost_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `content` varchar(120) NOT NULL,
  `reply` text NOT NULL COMMENT '回复(多个回复用|||隔开)',
  `isposted` enum('yes','no') DEFAULT 'no',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_discuzpost_post
-- ----------------------------
INSERT INTO `jd_discuzpost_post` VALUES ('1', '111', '<p>1121212</p>', 'aaaaaaaaaaaaaa|||bbbbbbbbbbbbbbb|||cccccccccccccccc', 'yes', '0', '1291962084', '1292208694');
INSERT INTO `jd_discuzpost_post` VALUES ('2', '22', '<p>222323</p>', 'aaaaaaaaaaaaaa|||bbbbbbbbbbbbbbb|||cccccccccccccccc', 'yes', '0', '1291962091', '1291968880');

-- ----------------------------
-- Table structure for `jd_discuzpost_user`
-- ----------------------------
DROP TABLE IF EXISTS `jd_discuzpost_user`;
CREATE TABLE `jd_discuzpost_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `formhash` varchar(120) NOT NULL DEFAULT '',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `isposter` enum('yes','no') DEFAULT 'yes',
  `isreplyer` enum('yes','no') DEFAULT 'yes',
  `isuseable` enum('yes','no') DEFAULT 'yes' COMMENT '是否有效',
  `islogined` enum('yes','no') DEFAULT 'no' COMMENT '是否已经登录',
  `logintime` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_discuzpost_user
-- ----------------------------
INSERT INTO `jd_discuzpost_user` VALUES ('1', 'admin', '1', '', '', '0', 'yes', 'yes', 'yes', 'no', '1291967534', '1291961840', '0');
INSERT INTO `jd_discuzpost_user` VALUES ('2', 'yy0022', 'pass', 'yy0023@163.com', '', '0', 'yes', 'yes', 'yes', 'no', '1291967535', '1291961898', '0');
INSERT INTO `jd_discuzpost_user` VALUES ('3', 'yy0023', 'pass', 'yy0023@163.com', '', '0', 'yes', 'yes', 'yes', 'no', '1291967535', '1291961899', '0');

-- ----------------------------
-- Table structure for `jd_download`
-- ----------------------------
DROP TABLE IF EXISTS `jd_download`;
CREATE TABLE `jd_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL COMMENT '下载地址',
  `img_url` varchar(255) NOT NULL COMMENT '图片',
  `size` varchar(120) NOT NULL COMMENT '大小',
  `language_id` int(10) NOT NULL COMMENT '语言',
  `category_id` int(10) NOT NULL COMMENT '类别',
  `os_id` int(10) NOT NULL COMMENT '应用平台',
  `softtype_id` int(10) NOT NULL COMMENT '软件性质',
  `dl_count` int(10) NOT NULL COMMENT '下载次数',
  `remark` mediumtext NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='下载模块';

-- ----------------------------
-- Records of jd_download
-- ----------------------------
INSERT INTO `jd_download` VALUES ('1', 'WinRAR 3.93 简体中文版', '', '', '', '0', '2', '0', '0', '2', '流行好用的压缩工具，支持鼠标拖放及外壳扩展，完美支持 ZIP 档案，内置程序可以解开 CAB、ARJ、LZH、TAR、GZ、ACE、UUE、BZ2、JAR、ISO 等多种类型的压缩文件；具有估计压缩功能，你可以在压缩文件之前得到用 ZIP 和 RAR 两种压缩工具各三种压缩方式下的大概压缩率；具有历史记录和收藏夹功能；压缩率相当高，而资源占用相对较少、固定压缩、多媒体压缩和多卷自释放压缩是大多压缩工具所不具备的；使用非常简单方便，配置选项不多，仅在资源管理器中就可以完成你想做的工作；对于ZIP 和 RAR 的自释放档案文件( DOS 和 WINDOWS 格式均可)，点击属性就可以轻易知道此文件的压缩属性，如果有注释，还能在属性中查看其内容。', '0', '1', '1295505383', '1295507438');
INSERT INTO `jd_download` VALUES ('2', 'Adobe Photoshop CS2 9.0 官方英文试用版', 'http://125.46.13.131:82/down/Photoshop_CS2_tryout.zip', '', '329.02 M', '0', '1', '1', '1', '3', 'Photoshop CS2是对数字图形编辑和创作专业工业标准的一次重要更新。它将作为独立软件程序或Adobe Creative Suite 2的一个关键构件来发布。Photoshop CS2引入强大和精确的新标准，提供数字化的图形创作和控制体验。\r\n\r\nPhotoshop CS2主要更新：\r\n　　*)Spot Healing Brush，处理常用图片问题，如污点，红眼，模糊和变形。\r\n　　*)Smart Objects允许用户在图形不失真的情况下测量和变换图片和矢量图。\r\n　　*)创建嵌入式链接复制图，以便一次编辑，更新多张图片。\r\n　　*)支持非破坏性编辑，创建和编辑32位HDR图片，3D渲染，高级合成', '0', '1', '1295508930', '1295509055');

-- ----------------------------
-- Table structure for `jd_download_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_download_category`;
CREATE TABLE `jd_download_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父类',
  `title` varchar(255) NOT NULL COMMENT '分类名称',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_download_category
-- ----------------------------
INSERT INTO `jd_download_category` VALUES ('1', '0', '应用软件', '', '0');
INSERT INTO `jd_download_category` VALUES ('2', '0', '网络工具', '', '0');

-- ----------------------------
-- Table structure for `jd_download_language`
-- ----------------------------
DROP TABLE IF EXISTS `jd_download_language`;
CREATE TABLE `jd_download_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '语言',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_download_language
-- ----------------------------
INSERT INTO `jd_download_language` VALUES ('1', '简体中文', '', '0');
INSERT INTO `jd_download_language` VALUES ('2', '繁体中文', '', '0');
INSERT INTO `jd_download_language` VALUES ('3', '英文', '', '0');

-- ----------------------------
-- Table structure for `jd_download_os`
-- ----------------------------
DROP TABLE IF EXISTS `jd_download_os`;
CREATE TABLE `jd_download_os` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '应用平台',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_download_os
-- ----------------------------
INSERT INTO `jd_download_os` VALUES ('1', 'win98', '', '0');
INSERT INTO `jd_download_os` VALUES ('2', 'win2000', '', '0');
INSERT INTO `jd_download_os` VALUES ('3', 'win2003', '', '0');
INSERT INTO `jd_download_os` VALUES ('4', 'linux', '', '0');

-- ----------------------------
-- Table structure for `jd_download_softtype`
-- ----------------------------
DROP TABLE IF EXISTS `jd_download_softtype`;
CREATE TABLE `jd_download_softtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '软件性质',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_download_softtype
-- ----------------------------
INSERT INTO `jd_download_softtype` VALUES ('1', '免费软件', '', '0');
INSERT INTO `jd_download_softtype` VALUES ('2', '共享软件', '', '0');

-- ----------------------------
-- Table structure for `jd_employment`
-- ----------------------------
DROP TABLE IF EXISTS `jd_employment`;
CREATE TABLE `jd_employment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_title` varchar(60) NOT NULL COMMENT '职位名称',
  `number` varchar(60) NOT NULL COMMENT '招聘人数',
  `nature` varchar(60) NOT NULL COMMENT '工作性质',
  `experience` varchar(60) NOT NULL COMMENT '工作经验',
  `location` varchar(60) NOT NULL COMMENT '工作地点',
  `treatment` varchar(60) NOT NULL COMMENT '待遇',
  `tel` varchar(60) NOT NULL COMMENT '联系电话',
  `email` varchar(60) NOT NULL COMMENT 'EMail',
  `qq` varchar(60) NOT NULL COMMENT 'QQ',
  `time_start` varchar(60) NOT NULL COMMENT '发布日期',
  `time_end` varchar(60) NOT NULL COMMENT '截止日期',
  `age` varchar(60) NOT NULL COMMENT '年龄',
  `sex` varchar(60) NOT NULL COMMENT '性别',
  `language` varchar(60) NOT NULL COMMENT '语言及水平要求',
  `education` varchar(60) NOT NULL COMMENT '学历',
  `remark` mediumtext NOT NULL COMMENT '职位描述及具体要求',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_employment
-- ----------------------------
INSERT INTO `jd_employment` VALUES ('1', '界面设计师', '12', '', '', '', '', '', '', '', '2010-12-22', '2010-12-29', '', '', '英语九级', '大学', '<p>rr</p>', '0', '1', '1293185456', '1295330771');

-- ----------------------------
-- Table structure for `jd_employment_apply`
-- ----------------------------
DROP TABLE IF EXISTS `jd_employment_apply`;
CREATE TABLE `jd_employment_apply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employment_id` int(11) NOT NULL,
  `remark` mediumtext NOT NULL COMMENT '个人简历',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_employment_apply
-- ----------------------------
INSERT INTO `jd_employment_apply` VALUES ('2', '1', '大法官大法官', '0', '1293292716', '0');
INSERT INTO `jd_employment_apply` VALUES ('3', '1', '啊啊', '0', '1293292719', '0');
INSERT INTO `jd_employment_apply` VALUES ('4', '1', 'x', '0', '1300774387', '0');
INSERT INTO `jd_employment_apply` VALUES ('5', '1', '<h1 style=\"text-align: center;\">简历内容</h1>\r\n<ol>\r\n    <li>1阿达上的</li>\r\n</ol>\r\n<p style=\"margin-left: 40px;\">啊阿斯达</p>\r\n<ol>\r\n    <li>ghfgh</li>\r\n</ol>', '0', '1300776160', '0');
INSERT INTO `jd_employment_apply` VALUES ('6', '1', '<h1 style=\"text-align: center;\">简历内容</h1>\r\n<ol>\r\n    <li>1阿达上的</li>\r\n</ol>\r\n<p style=\"margin-left: 40px;\">啊阿斯达</p>\r\n<ol>\r\n    <li>ghfgh</li>\r\n</ol>', '0', '1300776191', '0');
INSERT INTO `jd_employment_apply` VALUES ('7', '1', '<p>简历内容</p>', '0', '1300776216', '0');
INSERT INTO `jd_employment_apply` VALUES ('8', '1', '简历内容', '0', '1300776239', '0');
INSERT INTO `jd_employment_apply` VALUES ('9', '1', '<p>简历内容</p>', '0', '1300776350', '0');
INSERT INTO `jd_employment_apply` VALUES ('10', '1', '<p>简历内容</p>', '0', '1325904471', '0');

-- ----------------------------
-- Table structure for `jd_flowstatus`
-- ----------------------------
DROP TABLE IF EXISTS `jd_flowstatus`;
CREATE TABLE `jd_flowstatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL DEFAULT '',
  `referer` varchar(255) NOT NULL DEFAULT '',
  `referer_desc` varchar(60) NOT NULL DEFAULT '',
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COMMENT='流量监测';

-- ----------------------------
-- Records of jd_flowstatus
-- ----------------------------
INSERT INTO `jd_flowstatus` VALUES ('1', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1329401411');
INSERT INTO `jd_flowstatus` VALUES ('2', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1329401436');
INSERT INTO `jd_flowstatus` VALUES ('3', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330156723');
INSERT INTO `jd_flowstatus` VALUES ('4', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330156737');
INSERT INTO `jd_flowstatus` VALUES ('5', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330156743');
INSERT INTO `jd_flowstatus` VALUES ('6', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330156754');
INSERT INTO `jd_flowstatus` VALUES ('7', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330156773');
INSERT INTO `jd_flowstatus` VALUES ('8', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158083');
INSERT INTO `jd_flowstatus` VALUES ('9', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158119');
INSERT INTO `jd_flowstatus` VALUES ('10', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158148');
INSERT INTO `jd_flowstatus` VALUES ('11', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158175');
INSERT INTO `jd_flowstatus` VALUES ('12', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158191');
INSERT INTO `jd_flowstatus` VALUES ('13', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158232');
INSERT INTO `jd_flowstatus` VALUES ('14', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158242');
INSERT INTO `jd_flowstatus` VALUES ('15', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158275');
INSERT INTO `jd_flowstatus` VALUES ('16', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158283');
INSERT INTO `jd_flowstatus` VALUES ('17', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158293');
INSERT INTO `jd_flowstatus` VALUES ('18', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158306');
INSERT INTO `jd_flowstatus` VALUES ('19', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158314');
INSERT INTO `jd_flowstatus` VALUES ('20', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158342');
INSERT INTO `jd_flowstatus` VALUES ('21', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158358');
INSERT INTO `jd_flowstatus` VALUES ('22', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158396');
INSERT INTO `jd_flowstatus` VALUES ('23', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158439');
INSERT INTO `jd_flowstatus` VALUES ('24', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158465');
INSERT INTO `jd_flowstatus` VALUES ('25', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158616');
INSERT INTO `jd_flowstatus` VALUES ('26', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330158976');
INSERT INTO `jd_flowstatus` VALUES ('27', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159002');
INSERT INTO `jd_flowstatus` VALUES ('28', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159079');
INSERT INTO `jd_flowstatus` VALUES ('29', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159120');
INSERT INTO `jd_flowstatus` VALUES ('30', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159336');
INSERT INTO `jd_flowstatus` VALUES ('31', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159347');
INSERT INTO `jd_flowstatus` VALUES ('32', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159379');
INSERT INTO `jd_flowstatus` VALUES ('33', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159410');
INSERT INTO `jd_flowstatus` VALUES ('34', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159420');
INSERT INTO `jd_flowstatus` VALUES ('35', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159429');
INSERT INTO `jd_flowstatus` VALUES ('36', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159442');
INSERT INTO `jd_flowstatus` VALUES ('37', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159604');
INSERT INTO `jd_flowstatus` VALUES ('38', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159611');
INSERT INTO `jd_flowstatus` VALUES ('39', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159617');
INSERT INTO `jd_flowstatus` VALUES ('40', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159619');
INSERT INTO `jd_flowstatus` VALUES ('41', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159637');
INSERT INTO `jd_flowstatus` VALUES ('42', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159639');
INSERT INTO `jd_flowstatus` VALUES ('43', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159654');
INSERT INTO `jd_flowstatus` VALUES ('44', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159772');
INSERT INTO `jd_flowstatus` VALUES ('45', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159774');
INSERT INTO `jd_flowstatus` VALUES ('46', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159796');
INSERT INTO `jd_flowstatus` VALUES ('47', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159798');
INSERT INTO `jd_flowstatus` VALUES ('48', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159799');
INSERT INTO `jd_flowstatus` VALUES ('49', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159928');
INSERT INTO `jd_flowstatus` VALUES ('50', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330159981');
INSERT INTO `jd_flowstatus` VALUES ('51', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330160018');
INSERT INTO `jd_flowstatus` VALUES ('52', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171736');
INSERT INTO `jd_flowstatus` VALUES ('53', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171786');
INSERT INTO `jd_flowstatus` VALUES ('54', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171810');
INSERT INTO `jd_flowstatus` VALUES ('55', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171811');
INSERT INTO `jd_flowstatus` VALUES ('56', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171851');
INSERT INTO `jd_flowstatus` VALUES ('57', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330171879');
INSERT INTO `jd_flowstatus` VALUES ('58', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330172865');
INSERT INTO `jd_flowstatus` VALUES ('59', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330172874');
INSERT INTO `jd_flowstatus` VALUES ('60', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330174484');
INSERT INTO `jd_flowstatus` VALUES ('61', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330174487');
INSERT INTO `jd_flowstatus` VALUES ('62', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330174488');
INSERT INTO `jd_flowstatus` VALUES ('63', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330174611');
INSERT INTO `jd_flowstatus` VALUES ('64', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330175656');
INSERT INTO `jd_flowstatus` VALUES ('65', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330175663');
INSERT INTO `jd_flowstatus` VALUES ('66', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176346');
INSERT INTO `jd_flowstatus` VALUES ('67', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176371');
INSERT INTO `jd_flowstatus` VALUES ('68', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176767');
INSERT INTO `jd_flowstatus` VALUES ('69', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176786');
INSERT INTO `jd_flowstatus` VALUES ('70', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176806');
INSERT INTO `jd_flowstatus` VALUES ('71', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176816');
INSERT INTO `jd_flowstatus` VALUES ('72', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330176957');
INSERT INTO `jd_flowstatus` VALUES ('73', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177058');
INSERT INTO `jd_flowstatus` VALUES ('74', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177075');
INSERT INTO `jd_flowstatus` VALUES ('75', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177090');
INSERT INTO `jd_flowstatus` VALUES ('76', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177104');
INSERT INTO `jd_flowstatus` VALUES ('77', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177117');
INSERT INTO `jd_flowstatus` VALUES ('78', '127.0.0.1', '', '直接输入网址', '1330177136');
INSERT INTO `jd_flowstatus` VALUES ('79', '127.0.0.1', '', '直接输入网址', '1330177151');
INSERT INTO `jd_flowstatus` VALUES ('80', '127.0.0.1', '', '直接输入网址', '1330177169');
INSERT INTO `jd_flowstatus` VALUES ('81', '127.0.0.1', '', '直接输入网址', '1330177198');
INSERT INTO `jd_flowstatus` VALUES ('82', '127.0.0.1', '', '直接输入网址', '1330177214');
INSERT INTO `jd_flowstatus` VALUES ('83', '127.0.0.1', '', '直接输入网址', '1330177226');
INSERT INTO `jd_flowstatus` VALUES ('84', '127.0.0.1', '', '直接输入网址', '1330177350');
INSERT INTO `jd_flowstatus` VALUES ('85', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177359');
INSERT INTO `jd_flowstatus` VALUES ('86', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177368');
INSERT INTO `jd_flowstatus` VALUES ('87', '127.0.0.1', '', '直接输入网址', '1330177375');
INSERT INTO `jd_flowstatus` VALUES ('88', '127.0.0.1', '', '直接输入网址', '1330177379');
INSERT INTO `jd_flowstatus` VALUES ('89', '127.0.0.1', '', '直接输入网址', '1330177392');
INSERT INTO `jd_flowstatus` VALUES ('90', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177399');
INSERT INTO `jd_flowstatus` VALUES ('91', '127.0.0.1', 'http://localhost/jdphp1.07_bak/', '其他', '1330177403');
INSERT INTO `jd_flowstatus` VALUES ('92', '127.0.0.1', '', '直接输入网址', '1330179785');
INSERT INTO `jd_flowstatus` VALUES ('93', '127.0.0.1', '', '直接输入网址', '1330179834');
INSERT INTO `jd_flowstatus` VALUES ('94', '127.0.0.1', '', '直接输入网址', '1330179836');
INSERT INTO `jd_flowstatus` VALUES ('95', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330179957');
INSERT INTO `jd_flowstatus` VALUES ('96', '127.0.0.1', 'http://localhost/jdphp1.07/?c=jdcms&dirtplmain=article_ecms&clear=1', '站内', '1330179957');
INSERT INTO `jd_flowstatus` VALUES ('97', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330179963');
INSERT INTO `jd_flowstatus` VALUES ('98', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330179984');
INSERT INTO `jd_flowstatus` VALUES ('99', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180117');
INSERT INTO `jd_flowstatus` VALUES ('100', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180156');
INSERT INTO `jd_flowstatus` VALUES ('101', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180196');
INSERT INTO `jd_flowstatus` VALUES ('102', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180236');
INSERT INTO `jd_flowstatus` VALUES ('103', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180241');
INSERT INTO `jd_flowstatus` VALUES ('104', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180250');
INSERT INTO `jd_flowstatus` VALUES ('105', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180292');
INSERT INTO `jd_flowstatus` VALUES ('106', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180307');
INSERT INTO `jd_flowstatus` VALUES ('107', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180314');
INSERT INTO `jd_flowstatus` VALUES ('108', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180424');
INSERT INTO `jd_flowstatus` VALUES ('109', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180485');
INSERT INTO `jd_flowstatus` VALUES ('110', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180492');
INSERT INTO `jd_flowstatus` VALUES ('111', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180502');
INSERT INTO `jd_flowstatus` VALUES ('112', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180814');
INSERT INTO `jd_flowstatus` VALUES ('113', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330180966');
INSERT INTO `jd_flowstatus` VALUES ('114', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330181577');
INSERT INTO `jd_flowstatus` VALUES ('115', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330181603');
INSERT INTO `jd_flowstatus` VALUES ('116', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330181638');
INSERT INTO `jd_flowstatus` VALUES ('117', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330181647');
INSERT INTO `jd_flowstatus` VALUES ('118', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330181670');
INSERT INTO `jd_flowstatus` VALUES ('119', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330183276');
INSERT INTO `jd_flowstatus` VALUES ('120', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330234308');
INSERT INTO `jd_flowstatus` VALUES ('121', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330234641');
INSERT INTO `jd_flowstatus` VALUES ('122', '127.0.0.1', 'http://localhost/jdphp1.07/?c=index', '站内', '1330265810');
INSERT INTO `jd_flowstatus` VALUES ('123', '127.0.0.1', 'http://localhost/jdphp1.07/?c=jdcms&dirtplmain=article_ecms&clear=1', '站内', '1330265810');
INSERT INTO `jd_flowstatus` VALUES ('124', '127.0.0.1', 'http://localhost/jdphp1.07/index.php?c=index', '站内', '1330274316');
INSERT INTO `jd_flowstatus` VALUES ('125', '127.0.0.1', 'http://localhost/jdphp1.07/index.php?c=index', '站内', '1330274376');
INSERT INTO `jd_flowstatus` VALUES ('126', '127.0.0.1', 'http://localhost/jdphp1.07/index.php?c=index', '站内', '1330274377');
INSERT INTO `jd_flowstatus` VALUES ('127', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330355048');
INSERT INTO `jd_flowstatus` VALUES ('128', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330358788');
INSERT INTO `jd_flowstatus` VALUES ('129', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330524440');
INSERT INTO `jd_flowstatus` VALUES ('130', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1330524809');
INSERT INTO `jd_flowstatus` VALUES ('131', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1349492707');
INSERT INTO `jd_flowstatus` VALUES ('132', '127.0.0.1', 'http://localhost/jdphp1.07/', '站内', '1349492716');

-- ----------------------------
-- Table structure for `jd_friendlink`
-- ----------------------------
DROP TABLE IF EXISTS `jd_friendlink`;
CREATE TABLE `jd_friendlink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_friendlink
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_guestbook_post`
-- ----------------------------
DROP TABLE IF EXISTS `jd_guestbook_post`;
CREATE TABLE `jd_guestbook_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `poster` varchar(120) NOT NULL COMMENT '留言者',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `admin_reply` varchar(255) NOT NULL COMMENT '管理员回复',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='留言';

-- ----------------------------
-- Records of jd_guestbook_post
-- ----------------------------
INSERT INTO `jd_guestbook_post` VALUES ('1', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646394');
INSERT INTO `jd_guestbook_post` VALUES ('2', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646406');
INSERT INTO `jd_guestbook_post` VALUES ('3', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646438');
INSERT INTO `jd_guestbook_post` VALUES ('4', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646448');
INSERT INTO `jd_guestbook_post` VALUES ('5', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646578');
INSERT INTO `jd_guestbook_post` VALUES ('6', 'aasssssssssssssss', 'dddddddddd', '0', '127.0.0.1', '', '1332646922');
INSERT INTO `jd_guestbook_post` VALUES ('7', '1111111111', 'aaaaaaa', '0', '127.0.0.1', '', '1332646957');
INSERT INTO `jd_guestbook_post` VALUES ('8', '11111111111111111111', '1111111111', '0', '127.0.0.1', '', '1332647192');
INSERT INTO `jd_guestbook_post` VALUES ('9', 'aaaaaaaaaaaaaaaaaaaaaaaaa', 'dddddddddd', '0', '127.0.0.1', '', '1332647241');
INSERT INTO `jd_guestbook_post` VALUES ('10', '咨询产品：<a href=\'../?c=jdjcpj&a=pro_desc&id=9\' target=_blank>AN-125</a>\n这件产品批发价格如何', '张钰', '0', '127.0.0.1', '', '1333293483');
INSERT INTO `jd_guestbook_post` VALUES ('11', '公司名称：xx公司\n\r\n				邮箱：<a href=mailto:zy73122@163.com target=_blank>zy73122@163.com</a>\n\r\n				电话：1223213231\n\r\n				邮编：\n\r\n				地址：\n\r\n				咨询产品：<a href=../?c=jdjcpj&a=pro_desc&id=9 target=_blank>SY-125（B4）</a>\n\r\n				留言内容：瘤啊一年内阿斯顿啊是', 'name11', '0', '127.0.0.1', '', '1333294212');
INSERT INTO `jd_guestbook_post` VALUES ('12', '公司名称：11111111111\n\r\n				邮箱：<a href=mailto:232@6.com target=_blank>232@6.com</a>\n\r\n				电话：4444444444\n\r\n				邮编：3333333333\n\r\n				地址：\n\r\n				咨询产品：<a href=../?c=jdjcpj&a=pro_desc&id=6 target=_blank>AN-125</a>\n\r\n				留言内容：aaaaaaaaaaaaaaaaaaaaaaa', '22222222222', '0', '127.0.0.1', '', '1333541554');
INSERT INTO `jd_guestbook_post` VALUES ('13', '公司名称：11111111111\n\r\n				邮箱：<a href=mailto:232@6.com target=_blank>232@6.com</a>\n\r\n				电话：4444444444\n\r\n				邮编：3333333333\n\r\n				地址：\n\r\n				咨询产品：<a href=../?c=jdjcpj&a=pro_desc&id=6 target=_blank>AN-125</a>\n\r\n				留言内容：aaaaaaaaaaaaaaaaaaaaaaa', '22222222222', '0', '127.0.0.1', '', '1333541580');
INSERT INTO `jd_guestbook_post` VALUES ('14', '公司名称：11111111111\n\r\n				邮箱：<a href=mailto:232@6.com target=_blank>232@6.com</a>\n\r\n				电话：4444444444\n\r\n				邮编：3333333333\n\r\n				地址：\n\r\n				咨询产品：<a href=../?c=jdjcpj&a=pro_desc&id=6 target=_blank>AN-125</a>\n\r\n				留言内容：aaaaaaaaaaaaaaaaaaaaaaa', '22222222222', '0', '127.0.0.1', '', '1333541656');

-- ----------------------------
-- Table structure for `jd_guestbook_reply`
-- ----------------------------
DROP TABLE IF EXISTS `jd_guestbook_reply`;
CREATE TABLE `jd_guestbook_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL COMMENT '留言id',
  `reply_content` varchar(255) NOT NULL COMMENT '回复内容',
  `replyer` varchar(120) NOT NULL COMMENT '回复者',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言_回复';

-- ----------------------------
-- Records of jd_guestbook_reply
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_chain`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_chain`;
CREATE TABLE `jd_htl_chain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chain_name` varchar(255) DEFAULT NULL,
  `chain_remark` varchar(255) DEFAULT NULL,
  `chain_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chain_name` (`chain_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_chain
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_chain_hotel`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_chain_hotel`;
CREATE TABLE `jd_htl_chain_hotel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chain_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_chain_hotel
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_hotel`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_hotel`;
CREATE TABLE `jd_htl_hotel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `hotel_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `area_id` varchar(255) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '星级',
  `score` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '评分',
  `remark_introl` text COMMENT '酒店介绍',
  `remark_traffic` varchar(255) DEFAULT NULL COMMENT '交通情况',
  `remark_sevice` varchar(255) DEFAULT NULL COMMENT '提供服务',
  `remark_card` varchar(255) DEFAULT NULL COMMENT '支持卡类',
  `remark_cater` varchar(255) DEFAULT NULL COMMENT '酒店餐饮',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_name` (`hotel_name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_hotel
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_hotel_img`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_hotel_img`;
CREATE TABLE `jd_htl_hotel_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) NOT NULL,
  `img_title` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_hotel_img
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_hotel_room`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_hotel_room`;
CREATE TABLE `jd_htl_hotel_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `network` varchar(255) DEFAULT NULL,
  `breakfast` varchar(255) DEFAULT NULL,
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `book_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_hotel_room
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_region`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_region`;
CREATE TABLE `jd_htl_region` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `region_name` varchar(120) NOT NULL DEFAULT '',
  `region_type` tinyint(1) NOT NULL DEFAULT '2',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_name` (`region_name`)
) ENGINE=MyISAM AUTO_INCREMENT=423 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_region
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_htl_room`
-- ----------------------------
DROP TABLE IF EXISTS `jd_htl_room`;
CREATE TABLE `jd_htl_room` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` int(10) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `network` varchar(255) DEFAULT NULL,
  `breakfast` varchar(255) DEFAULT NULL,
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `book_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_htl_room
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_member_address`
-- ----------------------------
DROP TABLE IF EXISTS `jd_member_address`;
CREATE TABLE `jd_member_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `realname` varchar(30) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `tel` varchar(30) NOT NULL COMMENT '头像',
  `address` varchar(255) NOT NULL DEFAULT '0' COMMENT '上次登录时间',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_member_address
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_navigate`
-- ----------------------------
DROP TABLE IF EXISTS `jd_navigate`;
CREATE TABLE `jd_navigate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_navigate
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_onlinecs`
-- ----------------------------
DROP TABLE IF EXISTS `jd_onlinecs`;
CREATE TABLE `jd_onlinecs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `qq` varchar(60) NOT NULL,
  `msn` varchar(60) NOT NULL,
  `wangwang` varchar(60) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_onlinecs
-- ----------------------------
INSERT INTO `jd_onlinecs` VALUES ('4', 'Angela', '', 'sgxangel2004@hotmail.com', '', '11111', '22222222', '', '0', '1', '1331435838', '1331441797');
INSERT INTO `jd_onlinecs` VALUES ('5', 'admin@yogauto.com', '', '', '', '', '', 'admin@yogauto.com', '0', '1', '1331435884', '0');

-- ----------------------------
-- Table structure for `jd_plan`
-- ----------------------------
DROP TABLE IF EXISTS `jd_plan`;
CREATE TABLE `jd_plan` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `month` char(2) NOT NULL DEFAULT '',
  `week` char(1) NOT NULL DEFAULT '',
  `day` char(2) NOT NULL DEFAULT '',
  `hour` varchar(80) NOT NULL DEFAULT '',
  `usetime` int(10) NOT NULL DEFAULT '0',
  `nexttime` int(10) NOT NULL DEFAULT '0',
  `ifsave` tinyint(1) NOT NULL DEFAULT '0',
  `ifopen` tinyint(1) NOT NULL DEFAULT '0',
  `filename` varchar(80) NOT NULL DEFAULT '',
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_plan
-- ----------------------------
INSERT INTO `jd_plan` VALUES ('3', 'plan_example', '*', '*', '*', '44,45,38,32', '1304049213', '0', '0', '0', 'plan_example', '');
INSERT INTO `jd_plan` VALUES ('2', '自动生成sitemaps.xml', '*', '*', '*', '1', '1303958867', '0', '0', '0', 'create_sitemaps', '');

-- ----------------------------
-- Table structure for `jd_plugin`
-- ----------------------------
DROP TABLE IF EXISTS `jd_plugin`;
CREATE TABLE `jd_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plugin_start` enum('off','on') DEFAULT 'off',
  `plugin_name` varchar(255) DEFAULT NULL,
  `plugin_remark` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT '0',
  `updated` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_plugin
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_productshow_cate`
-- ----------------------------
DROP TABLE IF EXISTS `jd_productshow_cate`;
CREATE TABLE `jd_productshow_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `remark` mediumtext NOT NULL COMMENT '描述',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `display` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  `created` int(10) NOT NULL,
  `updated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='产品展示';

-- ----------------------------
-- Records of jd_productshow_cate
-- ----------------------------
INSERT INTO `jd_productshow_cate` VALUES ('1', '0', '反对', '', '0', '1', '1329408443', '0');

-- ----------------------------
-- Table structure for `jd_productshow_pro`
-- ----------------------------
DROP TABLE IF EXISTS `jd_productshow_pro`;
CREATE TABLE `jd_productshow_pro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(120) NOT NULL COMMENT '产品名称',
  `cate_id` int(10) unsigned NOT NULL COMMENT '分类ID',
  `img_url` varchar(255) NOT NULL COMMENT '图片地址',
  `remark` mediumtext NOT NULL COMMENT '描述',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='产品展示';

-- ----------------------------
-- Records of jd_productshow_pro
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_sample`
-- ----------------------------
DROP TABLE IF EXISTS `jd_sample`;
CREATE TABLE `jd_sample` (
  `primary_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` char(32) NOT NULL COMMENT '密码，md5加密值，32位',
  `goldenmoney` int(10) NOT NULL DEFAULT '0' COMMENT '金币',
  `email` varchar(255) DEFAULT '' COMMENT '邮件地址，取回密码用',
  `isguest` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否游客，=1时为游客',
  `exp` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  `lev` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户等级',
  `sumplayed` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '参与的游戏数量',
  `sumwin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '获胜的游戏数量',
  `avatar_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '当前头像ID',
  `beginnerguide` varchar(600) NOT NULL COMMENT '新手指导',
  `avatar_active` varchar(300) NOT NULL COMMENT '激活的头像列表',
  `lastlogintime` int(10) NOT NULL DEFAULT '0' COMMENT '上一次登录时间',
  `lastloginip` varchar(20) DEFAULT NULL COMMENT '上一次登录ip',
  `logincount` int(10) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '帐号状态，=0为禁用，=1为正常，默认为=1',
  `created` int(10) unsigned NOT NULL COMMENT '账号创建时间',
  PRIMARY KEY (`primary_id`),
  KEY `UserName` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COMMENT='示例';

-- ----------------------------
-- Records of jd_sample
-- ----------------------------
INSERT INTO `jd_sample` VALUES ('1', 'blacknull', '萌军团1', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '-35', 'sand5230@163.com', '0', '80', '3', '0', '0', '101', 'a:3:{s:8:', '101,102,103,104', '1356182862', '61.241.207.126', '13', '1', '1354327484');
INSERT INTO `jd_sample` VALUES ('2', 'asd1234', '不合法', '14e1b600b1fd579f47433b88e8d85291', '100320', 'daurng@gmail.com', '0', '756', '12', '0', '0', '103', 'a:3:{s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}}', '101,102,103,104', '1357828955', '110.84.214.192', '1478', '1', '1354327720');
INSERT INTO `jd_sample` VALUES ('3', 'test011', 'test011', '3ed80171b1f4ab825f2038fc203c887c', '50', 'zy73122@163.com', '0', '13', '3', '0', '0', '103', 'a:3:{s:5:\"teach\";a:1:{i:1;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:3:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";}}', '101,102,103,104', '1357806630', '220.250.21.82', '308', '1', '1354329480');
INSERT INTO `jd_sample` VALUES ('4', 'wlan', '奥马巴', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '820', 'sand5230@163.com', '0', '765', '8', '0', '0', '101', 'a:3:{s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1357799871', '110.84.214.192', '149', '1', '1354329730');
INSERT INTO `jd_sample` VALUES ('5', 'chenguo', '国国', 'bb379f9cd74533587f51e4b72815815c', '-35', 'chenguoheart@gmail.com', '0', '106', '2', '0', '0', '101', 'a:4:{s:13:\"guideProgress\";s:1:\"1\";s:5:\"teach\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1357630501', '127.0.0.1', '61', '1', '1354330586');
INSERT INTO `jd_sample` VALUES ('6', 'ziji777', '青蛙小丸子', '7f5d5358ca63f383081bc5632ab47463', '-25', 'ziji777@163.com', '0', '77', '5', '0', '0', '101', 'a:3:{s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:5:\"teach\";a:1:{i:1;s:1:\"1\";}s:10:\"teachGuide\";s:0:\"\";}', '101,102,103,104', '1357567674', '110.84.214.192', '54', '1', '1354331563');
INSERT INTO `jd_sample` VALUES ('7', 'deAr_Cino', 'Cino', 'c29247138297843ffad5c7e605f9d65b', '65', '306491987@qq.com', '0', '35', '13', '0', '0', '101', 'a:4:{s:10:\"teachGuide\";s:0:\"\";s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:13:\"guideProgress\";s:3:\"405\";}', '101,102,103,104', '1357725569', '110.84.214.192', '70', '1', '1354333278');
INSERT INTO `jd_sample` VALUES ('8', '493376654', '冰点天空', 'c9e06bf929d2839a3e0b7a2c9621918f', '25', '493376654@qq.com', '0', '213', '6', '0', '0', '101', '', '101,102,103,104', '1355309667', '61.154.87.113', '10', '1', '1354334363');
INSERT INTO `jd_sample` VALUES ('9', 'my1354334443480', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1354711090', '27.155.220.197', '7', '1', '1354334443');
INSERT INTO `jd_sample` VALUES ('10', 'wstcwcx', '侘誰莫屬', 'fb82d21e092c0008d0d91f95cac63c4a', '0', 'wstcwcx@yahoo.com.cn', '0', '1', '1', '0', '0', '101', 'a:3:{s:8:\"tutorial\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:0:\"\";}', '101,102,103,104', '1356785899', '127.0.0.1', '9', '1', '1354335530');
INSERT INTO `jd_sample` VALUES ('11', 'asd123', '不合群', '14e1b600b1fd579f47433b88e8d85291', '0', 'dauring@gmail.com', '0', '235', '7', '0', '0', '102', 'a:4:{s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:13:\"guideProgress\";s:3:\"318\";}', '101,102,103,104', '1357828725', '110.84.214.192', '1325', '1', '1354338629');
INSERT INTO `jd_sample` VALUES ('12', 'kylin206', '林业', '14e1b600b1fd579f47433b88e8d85291', '-25', 'kylin206@hotmail.com', '0', '145', '3', '0', '0', '101', 'a:3:{s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:8:\"tutorial\";a:4:{i:1;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1356419889', '27.151.34.92', '236', '1', '1354340415');
INSERT INTO `jd_sample` VALUES ('13', 'my1354340814512', '游侠', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1357357353', '110.84.214.192', '2', '1', '1354340814');
INSERT INTO `jd_sample` VALUES ('14', 'sumeifang', '叶夫人', '14e1b600b1fd579f47433b88e8d85291', '90', '564024640@qq.com', '0', '242', '5', '0', '0', '101', 'a:4:{s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:10:\"teachGuide\";s:0:\"\";s:13:\"guideProgress\";s:1:\"1\";s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1357829085', '124.72.47.132', '114', '1', '1354341595');
INSERT INTO `jd_sample` VALUES ('15', 'wbonline', '先谢郭嘉', 'bef246cb8eaf5e3dd52ceeed87ed41c7', '50', 'angel21th@126.com', '0', '270', '8', '0', '0', '101', 'a:3:{s:5:\"teach\";a:0:{}s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:0:\"\";}', '101,102,103,104', '1357543512', '220.250.21.82', '30', '1', '1354343984');
INSERT INTO `jd_sample` VALUES ('16', 'test012', 'test012', '3ed80171b1f4ab825f2038fc203c887c', '555', '', '0', '69', '3', '0', '0', '101', '', '101,102,103,104', '1357787368', '220.250.21.82', '91', '1', '1354346211');
INSERT INTO `jd_sample` VALUES ('38', 'my1355052833928', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355052833');
INSERT INTO `jd_sample` VALUES ('17', 'my1354348037262', 'sssssss', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354348037');
INSERT INTO `jd_sample` VALUES ('18', 'testlinye', 'aaaa', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1354951626', '27.155.220.197', '5', '1', '1354351322');
INSERT INTO `jd_sample` VALUES ('35', 'asd124', 'asd124', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:3:{s:8:\"tutorial\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}s:5:\"teach\";a:1:{i:1;s:1:\"1\";}s:10:\"teachGuide\";s:0:\"\";}', '101,102,103,104', '1357554021', '110.84.214.192', '83', '1', '1354951670');
INSERT INTO `jd_sample` VALUES ('20', 'my1354455969733', 'kira', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354455969');
INSERT INTO `jd_sample` VALUES ('19', 'Ming', '溡緔神话', 'c6019a5a3775f3a70de9cc0211de56c9', '0', '948487947@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1354428042', '218.66.22.187', '1', '1', '1354355107');
INSERT INTO `jd_sample` VALUES ('30', 'wuzhangzhong0', '狂暴鸡脖', '14e1b600b1fd579f47433b88e8d85291', '0', '1160321253@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355206549', '27.155.223.34', '2', '1', '1354847768');
INSERT INTO `jd_sample` VALUES ('33', 'linye', 'kylin', '14e1b600b1fd579f47433b88e8d85291', '-25', 'kylin206@gmail.com', '0', '92', '3', '0', '0', '101', 'a:4:{s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:8:\"tutorial\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:13:\"guideProgress\";s:1:\"1\";s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1357714628', '110.84.214.192', '249', '1', '1354892324');
INSERT INTO `jd_sample` VALUES ('21', 'my1354509726694', 'test9646', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354509726');
INSERT INTO `jd_sample` VALUES ('22', 'my1354511751718', '122344455555', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354511751');
INSERT INTO `jd_sample` VALUES ('23', 'my1354523934572', '12121', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1354866993', '222.76.126.61', '3', '1', '1354523934');
INSERT INTO `jd_sample` VALUES ('24', 'my1354632439596', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354632439');
INSERT INTO `jd_sample` VALUES ('25', 'DANGER', 'DANGER', 'ddce28fca343642b950d613878e72b1f', '0', '178473431@qq.com', '0', '0', '1', '0', '0', '101', 'a:4:{s:5:\"teach\";a:0:{}s:13:\"guideProgress\";s:2:\"67\";s:8:\"tutorial\";a:4:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:6;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1357820362', '36.248.50.29', '11', '1', '1354671218');
INSERT INTO `jd_sample` VALUES ('26', 'kylin', '穷不怕', '14e1b600b1fd579f47433b88e8d85291', '0', 'kylin206@gmail.com', '0', '0', '1', '0', '0', '101', 'a:3:{s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:5:{i:8;s:1:\"1\";i:1;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:8:\"tutorial\";a:3:{i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}}', '101,102,103,104', '1357627205', '110.84.214.192', '466', '1', '1354698292');
INSERT INTO `jd_sample` VALUES ('27', 'wuzhangzhong', '北郊海人', '14e1b600b1fd579f47433b88e8d85291', '215', '1160321253@qq.com', '0', '40', '5', '0', '0', '101', 'a:3:{s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:0:{}}', '101,102,103,104', '1357725565', '110.84.214.192', '72', '1', '1354762004');
INSERT INTO `jd_sample` VALUES ('28', 'Michelle', 'Michelle', '565f1bfeb92889fa9fb4981eb8191ebc', '0', '375473471@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354764975');
INSERT INTO `jd_sample` VALUES ('29', 'my1354775970348', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1354775970');
INSERT INTO `jd_sample` VALUES ('31', 'wuzhangzhong1', '', '14e1b600b1fd579f47433b88e8d85291', '0', '1160321253@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355204216', '27.155.223.34', '1', '1', '1354848123');
INSERT INTO `jd_sample` VALUES ('32', 'wlan3', 'xxxx', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355135824', '27.151.35.26', '7', '1', '1354874305');
INSERT INTO `jd_sample` VALUES ('44', 'wlan4', 'abcd', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355136072', '127.0.0.1', '3', '1', '1355135762');
INSERT INTO `jd_sample` VALUES ('34', 'my1354930403105', 'ddddfdfs', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1357829084', '36.248.50.29', '2', '1', '1354930403');
INSERT INTO `jd_sample` VALUES ('36', '46ujt4uj5', 'bbbb', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:3:{s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1356165026', '27.151.34.92', '5', '1', '1354953387');
INSERT INTO `jd_sample` VALUES ('37', 'my1354973001773', '喜哥', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:3:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1355985143', '124.78.184.142', '16', '1', '1354973001');
INSERT INTO `jd_sample` VALUES ('39', 'my1355058361621', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355135158', '27.151.35.26', '1', '1', '1355058361');
INSERT INTO `jd_sample` VALUES ('40', 'chenchenghui', '云游负心汉', '60195c06d570069d574a0d479f3a5195', '215', '113340246@qq.com', '0', '68', '5', '0', '0', '101', '', '101,102,103,104', '1357365860', '110.84.214.192', '17', '1', '1355128076');
INSERT INTO `jd_sample` VALUES ('41', 'srslc', '孤夜', '14e1b600b1fd579f47433b88e8d85291', '0', '11442133@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355128883');
INSERT INTO `jd_sample` VALUES ('42', 'wlan1', '盟军团长', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', 'sand5230@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355135840', '27.151.35.26', '3', '1', '1355135242');
INSERT INTO `jd_sample` VALUES ('43', 'wlan2', '萌军团团长', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', 'sand5230@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355135483');
INSERT INTO `jd_sample` VALUES ('45', 'wan4ll', '777777', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355136415');
INSERT INTO `jd_sample` VALUES ('46', '556664', '66666', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355136542', '27.151.35.26', '1', '1', '1355136526');
INSERT INTO `jd_sample` VALUES ('56', 'my1355236034491', '21321321', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355236034');
INSERT INTO `jd_sample` VALUES ('47', 'wlan11', '李p', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', 'sand5230@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355206545');
INSERT INTO `jd_sample` VALUES ('48', 'my1355206589811', '墙蟹', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355211060', '27.155.223.34', '10', '1', '1355206589');
INSERT INTO `jd_sample` VALUES ('49', 'huangxingleo', '', 'c1c7a7db1efedd19930fb0ee9b1af90b', '0', 'huangxingleo@126.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355207342');
INSERT INTO `jd_sample` VALUES ('50', 'sumeifang1', 'sumeifang', '70873e8580c9900986939611618d7b1e', '0', '', '0', '52', '1', '0', '0', '101', '', '101,102,103,104', '1355214558', '218.66.174.141', '1', '1', '1355209208');
INSERT INTO `jd_sample` VALUES ('51', 'my1355210469963', '163com', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355210810', '27.155.223.34', '2', '1', '1355210469');
INSERT INTO `jd_sample` VALUES ('52', 'my1355210848146', 'www163com', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355210848');
INSERT INTO `jd_sample` VALUES ('53', 'my1355211109982', '卖水枪', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355211109');
INSERT INTO `jd_sample` VALUES ('54', 'my1355211207200', '卖水', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355211657', '27.155.223.34', '1', '1', '1355211207');
INSERT INTO `jd_sample` VALUES ('55', 'my1355211691650', 'fl大叔', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:1:{i:6;s:1:\"1\";}s:5:\"teach\";a:0:{}}', '101,102,103,104', '1355810549', '27.151.34.92', '4', '1', '1355211691');
INSERT INTO `jd_sample` VALUES ('57', 'test020', 'nickname1', '3ed80171b1f4ab825f2038fc203c887c', '0', 'zy73122@163.com', '1', '0', '1', '0', '0', '101', 's:14:\"beginnerguide1\";', '101,102,103,104', '1355239063', '59.61.137.254', '2', '1', '1355238867');
INSERT INTO `jd_sample` VALUES ('58', 'test024', 'my1355239584162', '3ed80171b1f4ab825f2038fc203c887c', '0', 'zy73122@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355407570', '59.61.137.254', '5', '1', '1355239584');
INSERT INTO `jd_sample` VALUES ('59', 'my1355240928965', 'my1355240928965', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355240944', '59.61.137.254', '1', '1', '1355240928');
INSERT INTO `jd_sample` VALUES ('60', 'my1355280029995', 'my1355280029995', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:4:{s:13:\"guideProgress\";s:3:\"405\";s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1357723466', '110.84.214.192', '4', '1', '1355280029');
INSERT INTO `jd_sample` VALUES ('61', 'woshinashly', '放开那秃驴', 'ec0bf6ac82b0afc5b36d1325ce720a72', '0', '58806337@qq.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355305409');
INSERT INTO `jd_sample` VALUES ('62', 'my1355305488812', 'my1355305488812', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355305488');
INSERT INTO `jd_sample` VALUES ('63', 'test023', 'my1355318116544', '3ed80171b1f4ab825f2038fc203c887c', '0', 'zy73122@163.com', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355318116');
INSERT INTO `jd_sample` VALUES ('64', 'my1355362410358', 'my1355362410358', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:1:{i:1;s:1:\"1\";}}', '101,102,103,104', '1355362465', '27.155.223.34', '2', '1', '1355362410');
INSERT INTO `jd_sample` VALUES ('65', '513903623', '卖切糕咯', 'b5750c6b8c74cd9a78325d53c78d1032', '0', '513903623@qq.com', '0', '0', '1', '0', '0', '101', 'a:2:{s:5:\"teach\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";}s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '0', null, '0', '1', '1355379359');
INSERT INTO `jd_sample` VALUES ('66', 'my1355389403965', 'my1355389403965', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:1:{i:6;s:1:\"1\";}}', '101,102,103,104', '0', null, '0', '1', '1355389403');
INSERT INTO `jd_sample` VALUES ('67', 'my1355389913984', 'my1355389913984', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:1:{i:2;s:1:\"1\";}s:5:\"teach\";a:0:{}}', '101,102,103,104', '1355739216', '218.66.59.233', '2', '1', '1355389913');
INSERT INTO `jd_sample` VALUES ('68', 'my1355398213482', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355403166', '27.155.223.34', '4', '1', '1355398213');
INSERT INTO `jd_sample` VALUES ('69', 'test025', 'sddd', '3ed80171b1f4ab825f2038fc203c887c', '0', 'zy73122@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355408416', '59.61.137.254', '1', '1', '1355408408');
INSERT INTO `jd_sample` VALUES ('70', 'test026', 'errrr', '3ed80171b1f4ab825f2038fc203c887c', '0', 'zy73122@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355490833', '127.0.0.1', '10', '1', '1355410539');
INSERT INTO `jd_sample` VALUES ('71', 'my1355475036459', '纯属测试', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355475036');
INSERT INTO `jd_sample` VALUES ('72', 'flyfay', 'flyfay', '68cf2cf4c83aa97eb904912e8d3f2a70', '0', '189988@qq.com', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1356675418', '220.250.21.82', '1', '1', '1355488393');
INSERT INTO `jd_sample` VALUES ('73', 'my1355489478573', 'fgwergsh', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355489478');
INSERT INTO `jd_sample` VALUES ('74', 'my1355539458524', 'klein', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355539461', '123.116.38.69', '1', '1', '1355539458');
INSERT INTO `jd_sample` VALUES ('75', 'my1355547682307', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355547682');
INSERT INTO `jd_sample` VALUES ('76', 'aircentee', 'centee', '0043a6463a21daf1ef49110a480f37e2', '0', 'cyx.qz@153.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355657893');
INSERT INTO `jd_sample` VALUES ('77', 'qiuzhifeng', 'AD01', 'cacdb03ca244e628e1844ae1fb0ee6b4', '0', 'zjj3041@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1356586545', '218.66.59.233', '5', '1', '1355741028');
INSERT INTO `jd_sample` VALUES ('78', 'test1', '厅在在', '14e1b600b1fd579f47433b88e8d85291', '0', 'test@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355751020');
INSERT INTO `jd_sample` VALUES ('79', 'wlan12', '反人类', 'ba3afc95ea5a5b2b2ef57f0a3686cd99', '0', 'sand5230@163.com', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355810894');
INSERT INTO `jd_sample` VALUES ('80', 'my1355812438115', 'klein11', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:5:\"teach\";a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1356425089', '123.123.2.162', '2', '1', '1355812438');
INSERT INTO `jd_sample` VALUES ('81', 'my1355818596898', 'aaaafsdfas', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355818596');
INSERT INTO `jd_sample` VALUES ('82', 'asd125', 'asd125', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1355838792', '27.151.34.92', '15', '1', '1355821409');
INSERT INTO `jd_sample` VALUES ('83', 'asd126', 'asd126', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1356416042', '27.151.34.92', '7', '1', '1355821703');
INSERT INTO `jd_sample` VALUES ('84', 'asd127', 'asd127', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1355833830', '27.151.34.92', '2', '1', '1355833199');
INSERT INTO `jd_sample` VALUES ('85', 'test031', '阿斯达12', '3ed80171b1f4ab825f2038fc203c887c', '0', '', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355833556', '59.61.137.254', '1', '1', '1355833544');
INSERT INTO `jd_sample` VALUES ('86', 'asd128', 'asd128', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1355834459', '27.151.34.92', '1', '1', '1355833884');
INSERT INTO `jd_sample` VALUES ('87', 'asd129', 'asd129', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1356336257', '27.151.34.92', '3', '1', '1355834493');
INSERT INTO `jd_sample` VALUES ('88', 'asd130', 'asd130', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:8:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"1\";i:8;s:1:\"1\";}}', '101,102,103,104', '1355924040', '27.151.34.92', '3', '1', '1355835288');
INSERT INTO `jd_sample` VALUES ('89', 'asd131', 'asd131', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:3:{s:5:\"teach\";a:2:{i:4;s:1:\"1\";i:1;s:1:\"1\";}s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1356437937', '27.151.34.92', '18', '1', '1355836496');
INSERT INTO `jd_sample` VALUES ('90', 'my1355893235947', 'oiuh', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', 'a:2:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}}', '101,102,103,104', '1356443580', '27.151.34.92', '1', '1', '1355893235');
INSERT INTO `jd_sample` VALUES ('91', 'my1355898610274', 'dadsa', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '0', null, '0', '1', '1355898610');
INSERT INTO `jd_sample` VALUES ('92', 'my1355901581191', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1355901586', '27.151.34.92', '1', '1', '1355901581');
INSERT INTO `jd_sample` VALUES ('93', 'asd132', 'asd132', '14e1b600b1fd579f47433b88e8d85291', '0', '', '0', '0', '1', '0', '0', '101', 'a:3:{s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:1:{i:1;s:1:\"1\";}}', '101,102,103,104', '1356438655', '27.151.34.92', '21', '1', '1355925690');
INSERT INTO `jd_sample` VALUES ('94', 'test013', '阿斯达12', '3ed80171b1f4ab825f2038fc203c887c', '0', '', '0', '0', '1', '0', '0', '1', '', 'Array', '0', null, '0', '1', '1355934436');
INSERT INTO `jd_sample` VALUES ('95', 'test014', '阿斯达12', '3ed80171b1f4ab825f2038fc203c887c', '0', '', '0', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1355934520');
INSERT INTO `jd_sample` VALUES ('96', 'my1355934668230', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1355934682', '59.61.137.254', '1', '1', '1355934668');
INSERT INTO `jd_sample` VALUES ('97', 'my1355938502830', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1355938502');
INSERT INTO `jd_sample` VALUES ('98', 'my1355970958774', '1234', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1355971122', '27.151.34.92', '1', '1', '1355970958');
INSERT INTO `jd_sample` VALUES ('99', 'jozqx', '我我', 'ff92a240d11b05ebd392348c35f781b2', '0', '123@456.com', '0', '0', '1', '0', '0', '1', 'a:3:{s:5:\"teach\";a:1:{i:1;s:1:\"1\";}s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '0', null, '0', '1', '1355983551');
INSERT INTO `jd_sample` VALUES ('100', 'my1356009568901', 'linyafang', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1356009663', '27.152.148.81', '1', '1', '1356009568');
INSERT INTO `jd_sample` VALUES ('101', 'my1356011334263', 'AD001', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1356011456', '220.250.41.94', '1', '1', '1356011334');
INSERT INTO `jd_sample` VALUES ('102', 'my1356011374641', 'kjljl', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1356011378', '220.250.41.94', '1', '1', '1356011374');
INSERT INTO `jd_sample` VALUES ('103', 'my1356056655187', 'asd133', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}}', '101,102,103,104', '1356420300', '27.151.34.92', '6', '1', '1356056655');
INSERT INTO `jd_sample` VALUES ('104', 'my1356165077335', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356165077');
INSERT INTO `jd_sample` VALUES ('105', 'my1356182795670', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356182795');
INSERT INTO `jd_sample` VALUES ('112', 'my1356404745849', 'riki将', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:2:{i:1;s:1:\"1\";i:2;s:1:\"1\";}}', '101,102,103,104', '1356404752', '111.194.49.108', '2', '1', '1356404745');
INSERT INTO `jd_sample` VALUES ('106', 'my1356326432902', '米糊', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356326432');
INSERT INTO `jd_sample` VALUES ('107', 'my1356328358752', 'aaaaa', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}}', '101,102,103,104', '0', null, '0', '1', '1356328358');
INSERT INTO `jd_sample` VALUES ('108', 'my1356329563936', '去你妹', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";s:8:\"tutorial\";a:4:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";}}', '101,102,103,104', '1356340153', '220.250.21.82', '1', '1', '1356329563');
INSERT INTO `jd_sample` VALUES ('109', 'my1356333617548', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356333617');
INSERT INTO `jd_sample` VALUES ('110', 'my1356333626487', 'Guba', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:5:\"teach\";a:4:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";}s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '0', null, '0', '1', '1356333626');
INSERT INTO `jd_sample` VALUES ('111', '155301918', '追你半条街', '4d897e1e72725e3809ca85bd7fa52352', '0', '155301918@qq.com', '0', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356337362');
INSERT INTO `jd_sample` VALUES ('113', 'my1356439078979', '阿杰', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";}}', '101,102,103,104', '1356441186', '61.241.207.126', '1', '1', '1356439078');
INSERT INTO `jd_sample` VALUES ('114', 'daur', 'daur', '14e1b600b1fd579f47433b88e8d85291', '0', 'dauring@gmail.com', '0', '0', '1', '0', '0', '1', '', '101,102,103,104', '1357632504', '110.84.214.192', '13', '1', '1356514067');
INSERT INTO `jd_sample` VALUES ('115', 'dxf00100', '嘿嘿', '2757a9a6ad29160f71f3645a01309cc6', '0', '441328977@qq.com', '0', '0', '1', '0', '0', '1', 'a:3:{s:8:\"tutorial\";a:0:{}s:5:\"teach\";a:6:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1356618437', '222.212.106.110', '1', '1', '1356537391');
INSERT INTO `jd_sample` VALUES ('116', 'my1356580817446', '123213', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:3:{s:8:\"tutorial\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";s:5:\"teach\";a:1:{i:1;s:1:\"1\";}}', '101,102,103,104', '0', null, '0', '1', '1356580817');
INSERT INTO `jd_sample` VALUES ('127', 'asd115', 'asd115', '14e1b600b1fd579f47433b88e8d85291', '0', 'as@as.as', '1', '0', '1', '0', '0', '101', '', '101,102,103,104', '1357727127', '110.84.214.192', '10', '0', '1357721812');
INSERT INTO `jd_sample` VALUES ('117', 'my1356694676725', '66778432', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1356694676');
INSERT INTO `jd_sample` VALUES ('118', '306279878', '大嘴先生', '15321755de973aa2ace80332239b8f24', '-105', 'lin306279878@qq.com', '0', '134', '2', '0', '0', '1', 'a:3:{s:8:\"tutorial\";a:2:{i:2;s:1:\"1\";i:3;s:1:\"1\";}s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:1:\"1\";}', '101,102,103,104', '1357466293', '218.104.231.178', '2', '1', '1357347483');
INSERT INTO `jd_sample` VALUES ('119', 'asd111', 'asd111', '14e1b600b1fd579f47433b88e8d85291', '0', 'asd@as.as', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1357806437', '110.84.214.192', '29', '1', '1357627481');
INSERT INTO `jd_sample` VALUES ('120', 'my1357638549696', '2222', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1357638549');
INSERT INTO `jd_sample` VALUES ('121', 'shen9075', '小熊', 'f1d54b387cf37bea192ac149ac006a1f', '0', '3136519@qq.com', '0', '0', '1', '0', '0', '1', 'a:4:{s:10:\"teachGuide\";s:0:\"\";s:5:\"teach\";a:1:{i:7;s:1:\"1\";}s:8:\"tutorial\";a:0:{}s:13:\"guideProgress\";s:3:\"405\";}', '101,102,103,104', '0', null, '0', '1', '1357642921');
INSERT INTO `jd_sample` VALUES ('122', 'my1357656343437', '1111', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', 'a:4:{s:5:\"teach\";a:0:{}s:10:\"teachGuide\";s:0:\"\";s:8:\"tutorial\";a:0:{}s:13:\"guideProgress\";s:3:\"405\";}', '101,102,103,104', '1357656605', '124.72.47.132', '2', '1', '1357656343');
INSERT INTO `jd_sample` VALUES ('123', 'my1357660980875', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '0', null, '0', '1', '1357660980');
INSERT INTO `jd_sample` VALUES ('124', 'asd112', 'asd112', '14e1b600b1fd579f47433b88e8d85291', '0', 'asd@as.as', '1', '0', '1', '0', '0', '1', '', '101,102,103,104', '1357719806', '110.84.214.192', '4', '1', '1357719533');
INSERT INTO `jd_sample` VALUES ('125', 'asd113', 'asd113', '14e1b600b1fd579f47433b88e8d85291', '0', 'as@as.as', '0', '0', '1', '0', '0', '1', '', '101,102,103,104', '1357720104', '110.84.214.192', '1', '1', '1357719878');
INSERT INTO `jd_sample` VALUES ('126', 'asd114', 'asd114', '14e1b600b1fd579f47433b88e8d85291', '0', 'as@as.as', '0', '0', '1', '0', '0', '101', '', '101,102,103,104', '1357721746', '110.84.214.192', '5', '1', '1357720165');
INSERT INTO `jd_sample` VALUES ('128', 'my1357727161511', '', '28c8edde3d61a0411511d3b1866f0636', '0', '', '0', '0', '1', '0', '0', '1', '', '101,102,103,104', '1357799714', '110.84.214.192', '8', '0', '1357727161');
INSERT INTO `jd_sample` VALUES ('129', 'my1357812387924', 'kylin1', '28c8edde3d61a0411511d3b1866f0636', '0', '', '0', '0', '1', '0', '0', '1', 'a:4:{s:13:', '101,102,103,104', '0', '', '0', '1', '1357812387');

-- ----------------------------
-- Table structure for `jd_shop_ask`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_ask`;
CREATE TABLE `jd_shop_ask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `uname` varchar(120) NOT NULL COMMENT '评论者名字',
  `postemail` varchar(120) NOT NULL COMMENT '邮箱',
  `content` mediumtext NOT NULL COMMENT '咨询内容',
  `reply` varchar(255) DEFAULT NULL COMMENT '管理员回复',
  `enable` enum('no','yes') NOT NULL DEFAULT 'yes',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_ask
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_attribute`;
CREATE TABLE `jd_shop_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) DEFAULT NULL,
  `type` enum('input','radio','select') DEFAULT 'input',
  `type_val` varchar(255) DEFAULT NULL,
  `show_in_page_product` enum('no','yes') DEFAULT 'no' COMMENT '是否显示在产品页中',
  `show_in_page_index` enum('no','yes') DEFAULT 'no' COMMENT '是否显示在首页中用来检索',
  `show_in_page_product_category` enum('yes','no') DEFAULT 'yes' COMMENT '是否显示在产品分类页面中用来检索',
  `enable` enum('no','yes') DEFAULT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_attribute
-- ----------------------------
INSERT INTO `jd_shop_attribute` VALUES ('41', '速度/使用周期', 'input', '', 'yes', 'no', 'no', 'yes', '0');
INSERT INTO `jd_shop_attribute` VALUES ('42', '单面/双面', 'input', '', 'yes', 'no', 'no', 'yes', '0');
INSERT INTO `jd_shop_attribute` VALUES ('43', '特殊功能', 'input', '', 'yes', 'no', 'no', 'yes', '0');

-- ----------------------------
-- Table structure for `jd_shop_brand`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_brand`;
CREATE TABLE `jd_shop_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_tag_id_list` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '效无',
  `img_url` varchar(255) DEFAULT NULL,
  `img_url_zs` varchar(255) DEFAULT NULL COMMENT '入驻证书',
  `remark_info` text COMMENT '品牌介绍',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `related_article` varchar(255) DEFAULT NULL COMMENT '相关文章',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_brand
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_brand_tag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_brand_tag`;
CREATE TABLE `jd_shop_brand_tag` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` tinyint(4) DEFAULT '0',
  `brand_tag_name` varchar(120) DEFAULT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_brand_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_category`;
CREATE TABLE `jd_shop_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `category_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '交通情况',
  `img_url` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` mediumtext COMMENT '描述',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_category
-- ----------------------------
INSERT INTO `jd_shop_category` VALUES ('68', '0', '硬件产品', 'A4双面彩色双平台扫描（ADF自动送稿扫描 + 平板扫描），体积小，适应性佳，适合票据扫描及商务扫描。 ·TWAIN扫描驱动软件带有智能化处理的完美页面扫描功能，完成影像的歪斜校正、原稿尺寸裁剪、去底色、旋转、去白页、加框等功能。可同时得到扫描稿件的黑白、灰度、彩色三种影像输出。 ·9个自定义编程快捷按键功能，方便用户自定义按键', 'data/upload/images/201202/1330216960022590715.gif', '', '', '1330245760', '1329494162', '0');
INSERT INTO `jd_shop_category` VALUES ('69', '68', '虹光扫描仪', '', '', '', '', '1330233075', '1329494211', '0');
INSERT INTO `jd_shop_category` VALUES ('70', '68', '中晶扫描仪', '', null, '', '', '0', '1329494237', '0');
INSERT INTO `jd_shop_category` VALUES ('71', '69', '办公类文档扫描仪', 'A4双面彩色双平台扫描（ADF自动送稿扫描 + 平板扫描），体积小，适应性佳，适合票据扫描及商务扫描。 ·TWAIN扫描驱动软件带有智能化处理的完美页面扫描功能，完成影像的歪斜校正、原稿尺寸裁剪、去底色、旋转、去白页、加框等功能。可同时得到扫描稿件的黑白、灰度、彩色三种影像输出。 ·9个自定义编程快捷按键功能，方便用户自定义按键', 'data/upload/images/201203/1330708128828559200.jpg', '', '', '1330736928', '1330178523', '0');
INSERT INTO `jd_shop_category` VALUES ('72', '69', '行业应用类文档扫描仪', 'A4双面彩色双平台扫描（ADF自动送稿扫描 + 平板扫描），体积小，适应性', 'data/upload/images/201203/1330708185106104246.jpg', '', '', '1330736985', '1330178587', '0');
INSERT INTO `jd_shop_category` VALUES ('73', '69', '特殊应用类扫描仪', 'A4双面彩色双平台扫描（ADF自动送稿扫描 + 平板扫描），体积小，适应性', null, '', '', '1330737104', '1330178605', '0');
INSERT INTO `jd_shop_category` VALUES ('75', '68', '服务器', '', null, '', '', '0', '1330275048', '0');
INSERT INTO `jd_shop_category` VALUES ('76', '68', '资质证书', '', null, '', '', '0', '1330275065', '0');
INSERT INTO `jd_shop_category` VALUES ('77', '68', '倚龙终端', '', null, '', '', '0', '1330275086', '0');
INSERT INTO `jd_shop_category` VALUES ('78', '0', '软件产品', '福州量子中金数码技术有限公司是致力于影像文档工作流程和影像文档应', 'data/upload/images/201205/1337150711224905838.gif', '', '', '1337180113', '1337179423', '0');
INSERT INTO `jd_shop_category` VALUES ('79', '0', '数字化扫描加工', '福州量子中金数码技术有限公司是致力于影像文档工作流程和影像文档应', 'data/upload/images/201205/1337150704973823878.gif', '', '', '1337180118', '1337179504', '0');
INSERT INTO `jd_shop_category` VALUES ('80', '70', '发票认证专用扫描仪', '', null, '', '', '0', '1337182897', '0');

-- ----------------------------
-- Table structure for `jd_shop_category_ptag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_category_ptag`;
CREATE TABLE `jd_shop_category_ptag` (
  `category_id` int(10) NOT NULL,
  `ptag_id` int(10) NOT NULL,
  PRIMARY KEY (`category_id`,`ptag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类相关的商品索引';

-- ----------------------------
-- Records of jd_shop_category_ptag
-- ----------------------------
INSERT INTO `jd_shop_category_ptag` VALUES ('69', '9');
INSERT INTO `jd_shop_category_ptag` VALUES ('71', '9');

-- ----------------------------
-- Table structure for `jd_shop_comment`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_comment`;
CREATE TABLE `jd_shop_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `uname` varchar(120) NOT NULL COMMENT '评论者名字',
  `poststar` tinyint(4) DEFAULT '1' COMMENT '星级',
  `advantage` varchar(255) NOT NULL COMMENT '优点',
  `shortcoming` varchar(255) NOT NULL COMMENT '缺点',
  `experience` text NOT NULL COMMENT '使用心得',
  `enable` enum('no','yes') NOT NULL DEFAULT 'yes',
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_groupbuy`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_groupbuy`;
CREATE TABLE `jd_shop_groupbuy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `groupbuy_name` varchar(120) DEFAULT NULL COMMENT '团购名称',
  `groupbuy_type` enum('appoint','percent') DEFAULT 'appoint' COMMENT '降价方式',
  `groupbuy_percent` decimal(10,0) DEFAULT '0' COMMENT '扣折',
  `groupbuy_count1` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量1',
  `groupbuy_price1` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格1',
  `groupbuy_count2` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量2',
  `groupbuy_price2` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格2',
  `groupbuy_count3` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量3',
  `groupbuy_price3` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格3',
  `remark` text COMMENT '描述',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='团购';

-- ----------------------------
-- Records of jd_shop_groupbuy
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_groupbuy_product`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_groupbuy_product`;
CREATE TABLE `jd_shop_groupbuy_product` (
  `groupbuy_id` int(11) NOT NULL DEFAULT '0' COMMENT '团购ID',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  PRIMARY KEY (`groupbuy_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_groupbuy_product
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_hotkey`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_hotkey`;
CREATE TABLE `jd_shop_hotkey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotkey_name` varchar(255) NOT NULL DEFAULT '' COMMENT '热门搜索',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_hotkey
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_order`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_order`;
CREATE TABLE `jd_shop_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `order_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '订单号',
  `order_amount` decimal(10,2) NOT NULL,
  `product_info` mediumtext NOT NULL COMMENT '序列化数组(pid、num)',
  `status` varchar(255) NOT NULL COMMENT '序列化数组(statid{add,pay,deliver,success}、time)',
  `address_info` mediumtext NOT NULL COMMENT '序列化数组(地址信息)',
  `shipping_id` int(11) NOT NULL COMMENT '配送方式ID',
  `shipping_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配送方式-价格',
  `shipping_name` varchar(60) NOT NULL DEFAULT '' COMMENT '配送方式',
  `shipping_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '货运单号',
  `shipping_name_actual` varchar(60) NOT NULL DEFAULT '' COMMENT '实际配送方法',
  `pay_code` varchar(20) NOT NULL COMMENT '支付方式',
  `pay_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付方式-价格',
  `pay_name` varchar(60) NOT NULL DEFAULT '' COMMENT '支付方式',
  `user_remark` mediumtext NOT NULL COMMENT '用户备注',
  `updated` int(10) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL DEFAULT '0',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `!enable` enum('no','yes') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_order
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_order_set_status_log`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_order_set_status_log`;
CREATE TABLE `jd_shop_order_set_status_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '订单号',
  `status_code` varchar(60) NOT NULL,
  `status_text` varchar(120) NOT NULL,
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn` (`order_sn`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='订单状态设置记录';

-- ----------------------------
-- Records of jd_shop_order_set_status_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_order_status`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_order_status`;
CREATE TABLE `jd_shop_order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_code` varchar(60) NOT NULL COMMENT '序列化数组(statid{add,pay,deliver,success}、time)',
  `status_text` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_order_status
-- ----------------------------
INSERT INTO `jd_shop_order_status` VALUES ('18', 'begin', '新订单');
INSERT INTO `jd_shop_order_status` VALUES ('19', 'pay_success', '支付成功');
INSERT INTO `jd_shop_order_status` VALUES ('20', 'pay_fialed', '支付失败');
INSERT INTO `jd_shop_order_status` VALUES ('23', 'box', '装箱');
INSERT INTO `jd_shop_order_status` VALUES ('25', 'deliver', '已发货');
INSERT INTO `jd_shop_order_status` VALUES ('26', 'invalid', '特殊订单');
INSERT INTO `jd_shop_order_status` VALUES ('27', 'end', '完成订单');

-- ----------------------------
-- Table structure for `jd_shop_payment`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_payment`;
CREATE TABLE `jd_shop_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(20) NOT NULL DEFAULT '',
  `pay_name` varchar(120) NOT NULL DEFAULT '',
  `pay_fee` varchar(10) NOT NULL DEFAULT '0' COMMENT '百分比',
  `pay_desc` text NOT NULL,
  `pay_config` text NOT NULL,
  `is_cod` enum('no','yes') NOT NULL DEFAULT 'no',
  `is_online` enum('no','yes') NOT NULL DEFAULT 'no',
  `author` varchar(60) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `version` varchar(30) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `updated` int(10) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL DEFAULT '0',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `enable` enum('no','yes') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_payment
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_shop_product`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_product`;
CREATE TABLE `jd_shop_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(255) DEFAULT NULL,
  `product_sn` varchar(255) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `original_price` varchar(60) DEFAULT NULL COMMENT '进货价',
  `market_price` decimal(10,2) DEFAULT NULL COMMENT '市场价',
  `our_price` decimal(10,2) DEFAULT NULL COMMENT '我们的价格',
  `promote_price` decimal(10,2) DEFAULT NULL COMMENT '促销价',
  `promote_starttime` int(11) DEFAULT NULL,
  `promote_endtime` int(11) DEFAULT NULL,
  `ispromote` enum('yes','no') DEFAULT 'no' COMMENT '启用促销',
  `isgroupbuy` enum('yes','no') DEFAULT 'no' COMMENT '启用团购',
  `weight` varchar(120) DEFAULT NULL,
  `remark_info` text,
  `remark_medium_info` varchar(255) DEFAULT NULL,
  `supplier_name` varchar(60) DEFAULT NULL COMMENT '供应商-联系人',
  `supplier_website1` varchar(120) DEFAULT NULL COMMENT '供应商-网址1',
  `supplier_website2` varchar(120) DEFAULT NULL COMMENT '供应商-网址2',
  `supplier_tel` varchar(60) DEFAULT NULL COMMENT '供应商-电话',
  `supplier_phone` varchar(60) DEFAULT NULL COMMENT '供应商-手机',
  `supplier_qq` varchar(60) DEFAULT NULL COMMENT '供应商-QQ',
  `supplier_other_contact` varchar(120) DEFAULT NULL COMMENT '供应商-其他联系方式',
  `supplier_address` varchar(120) DEFAULT NULL COMMENT '供应商-地址',
  `supplier_remark` mediumtext COMMENT '供应商-备注',
  `ishot` enum('no','yes') DEFAULT 'no' COMMENT '热卖',
  `isbest` enum('no','yes') DEFAULT 'no' COMMENT '精品',
  `isnew` enum('no','yes') DEFAULT 'yes' COMMENT '新品',
  `clicks` int(11) DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` mediumtext COMMENT '描述',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sn` (`product_sn`),
  KEY `cate_id` (`cate_id`),
  KEY `brand_id` (`brand_id`),
  KEY `ishot` (`ishot`),
  KEY `isbest` (`isbest`),
  KEY `isnew` (`isnew`),
  FULLTEXT KEY `product_name` (`product_name`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_product
-- ----------------------------
INSERT INTO `jd_shop_product` VALUES ('47', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"#e6e6e6\" align=\"center\">\r\n    <tbody>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品型号</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>FBH5100</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描类型</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>A3幅面快速平板扫描</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描技术</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>CIS</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光学分辨率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>600　dpi</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光源</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>长寿命冷阴极荧光灯管</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描模式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div><a id=\"OLE_LINK7\" name=\"OLE_LINK7\">黑白、灰阶（</a>16位输入/8位输出）、</div>\r\n            <div>彩色（48位输入/24位输出）三种扫描模式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">内存容量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>64MB SDRAM</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描区域</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>最大： 297&times;420mm （A3幅面）</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描速度</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>6秒/张 &nbsp;(A3,黑白模式,200dpi)</div>\r\n            <div>6秒/张 &nbsp;&nbsp;(A3,灰度模式,200dpi)</div>\r\n            <div>6秒/张&nbsp; &nbsp;(A3,彩色模式,200dpi)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">日扫描量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>建议2500张</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">输出文件格式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>支<a id=\"OLE_LINK4\" name=\"OLE_LINK4\">持</a>jpg、多页tiff、多页pdf格式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">影像特性</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN驱动带有智能化处理的完美页面扫描功能，自动纠偏、自动裁剪，可同时得到扫描稿件的黑白、灰度、彩色三种影像输出</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">控制面板</div>\r\n            </td>\r\n      
      <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>9个自定义编程快捷功能按键</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">接口方式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>高速USB2.0 接口</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">驱动接口</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN Driver</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">支持系统</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Win2K/XP/ Vista</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机配件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>随机提供USB2.0接口线</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机软件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Avision Capture Tool，Avision Button Manager</div>\r\n            <div>PaperPort SE</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">耗材零件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">可选附件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">工作环境</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>温度为：摄氏10&deg;到35&deg;，相对湿度为：10－85％</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">电源规格</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>输入：100－240V，50/60HZ&nbsp; 输出：24V，2.0A</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">功率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>&lt;38瓦</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">外观尺寸</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>585 x 485 x 96 mm&nbsp; (WxDxH)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">整机重量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>7. 6 Kg</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品认证</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>中国（CCC）、RoHS、ENERGY STAR、CE认证</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">保修</div>\r\n            </td>\r\n            <td bgc
olor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>一年有限保修，详细见保修卡或虹光网址相关内容；</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '<p>A4双面面彩色馈纸式文档扫描仪。</p>\r\n<p>A4、彩色/灰度/黑白模式、200dpi下扫描速度同速，可达每分钟25页/50面。</p>\r\n<p>TWAIN扫描驱动软件带有智能化处理的完美页面扫描功能。</p>\r\n<p>体积小，直通式短道送纸机构设计，扫描通过性好，适合各类文档扫描及商\r\n务扫描。</p>\r\n<p>ADF支持卡片多张扫描。</p>\r\n<p>带超声波重张检测。</p>\r\n<p>9个自定义编程快捷按键功能，方便用户自定义按键功能来实现软件关联。</p>', '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '8', '', '', '1330523751', '1329533407');
INSERT INTO `jd_shop_product` VALUES ('48', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"#e6e6e6\" align=\"center\">\r\n    <tbody>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品型号</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>FBH5100</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描类型</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>A3幅面快速平板扫描</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描技术</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>CIS</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光学分辨率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>600　dpi</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光源</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>长寿命冷阴极荧光灯管</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描模式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div><a id=\"OLE_LINK7\" name=\"OLE_LINK7\">黑白、灰阶（</a>16位输入/8位输出）、</div>\r\n            <div>彩色（48位输入/24位输出）三种扫描模式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">内存容量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>64MB SDRAM</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描区域</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>最大： 297&times;420mm （A3幅面）</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描速度</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>6秒/张 &nbsp;(A3,黑白模式,200dpi)</div>\r\n            <div>6秒/张 &nbsp;&nbsp;(A3,灰度模式,200dpi)</div>\r\n            <div>6秒/张&nbsp; &nbsp;(A3,彩色模式,200dpi)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">日扫描量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>建议2500张</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">输出文件格式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>支<a id=\"OLE_LINK4\" name=\"OLE_LINK4\">持</a>jpg、多页tiff、多页pdf格式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">影像特性</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN驱动带有智能化处理的完美页面扫描功能，自动纠偏、自动裁剪，可同时得到扫描稿件的黑白、灰度、彩色三种影像输出</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">控制面板</div>\r\n            </td>\r\n      
      <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>9个自定义编程快捷功能按键</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">接口方式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>高速USB2.0 接口</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">驱动接口</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN Driver</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">支持系统</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Win2K/XP/ Vista</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机配件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>随机提供USB2.0接口线</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机软件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Avision Capture Tool，Avision Button Manager</div>\r\n            <div>PaperPort SE</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">耗材零件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">可选附件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">工作环境</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>温度为：摄氏10&deg;到35&deg;，相对湿度为：10－85％</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">电源规格</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>输入：100－240V，50/60HZ&nbsp; 输出：24V，2.0A</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">功率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>&lt;38瓦</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">外观尺寸</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>585 x 485 x 96 mm&nbsp; (WxDxH)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">整机重量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>7. 6 Kg</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品认证</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>中国（CCC）、RoHS、ENERGY STAR、CE认证</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">保修</div>\r\n            </td>\r\n            <td bgc
olor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>一年有限保修，详细见保修卡或虹光网址相关内容；</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '<p>A4双面面彩色馈纸式文档扫描仪。</p>\r\n<p>A4、彩色/灰度/黑白模式、200dpi下扫描速度同速，可达每分钟25页/50面。</p>\r\n<p>TWAIN扫描驱动软件带有智能化处理的完美页面扫描功能。</p>\r\n<p>体积小，直通式短道送纸机构设计，扫描通过性好，适合各类文档扫描及商\r\n务扫描。</p>\r\n<p>ADF支持卡片多张扫描。</p>\r\n<p>带超声波重张检测。</p>\r\n<p>9个自定义编程快捷按键功能，方便用户自定义按键功能来实现软件关联。</p>', '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '2', '', '', '1330236113', '1329533449');
INSERT INTO `jd_shop_product` VALUES ('49', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"#e6e6e6\" align=\"center\">\r\n    <tbody>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品型号</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>FBH5100</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描类型</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>A3幅面快速平板扫描</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描技术</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>CIS</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光学分辨率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>600　dpi</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">光源</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>长寿命冷阴极荧光灯管</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描模式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div><a id=\"OLE_LINK7\" name=\"OLE_LINK7\">黑白、灰阶（</a>16位输入/8位输出）、</div>\r\n            <div>彩色（48位输入/24位输出）三种扫描模式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">内存容量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>64MB SDRAM</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描区域</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>最大： 297&times;420mm （A3幅面）</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">扫描速度</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>6秒/张 &nbsp;(A3,黑白模式,200dpi)</div>\r\n            <div>6秒/张 &nbsp;&nbsp;(A3,灰度模式,200dpi)</div>\r\n            <div>6秒/张&nbsp; &nbsp;(A3,彩色模式,200dpi)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">日扫描量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>建议2500张</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">输出文件格式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>支<a id=\"OLE_LINK4\" name=\"OLE_LINK4\">持</a>jpg、多页tiff、多页pdf格式</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">影像特性</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN驱动带有智能化处理的完美页面扫描功能，自动纠偏、自动裁剪，可同时得到扫描稿件的黑白、灰度、彩色三种影像输出</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">控制面板</div>\r\n            </td>\r\n      
      <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>9个自定义编程快捷功能按键</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">接口方式</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>高速USB2.0 接口</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">驱动接口</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>TWAIN Driver</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">支持系统</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Win2K/XP/ Vista</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机配件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>随机提供USB2.0接口线</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">随机软件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>Avision Capture Tool，Avision Button Manager</div>\r\n            <div>PaperPort SE</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">耗材零件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">可选附件</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>无</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">工作环境</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>温度为：摄氏10&deg;到35&deg;，相对湿度为：10－85％</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">电源规格</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>输入：100－240V，50/60HZ&nbsp; 输出：24V，2.0A</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">功率</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>&lt;38瓦</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">外观尺寸</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>585 x 485 x 96 mm&nbsp; (WxDxH)</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">整机重量</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>7. 6 Kg</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">产品认证</div>\r\n            </td>\r\n            <td bgcolor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>中国（CCC）、RoHS、ENERGY STAR、CE认证</div>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#f9f9f9\" width=\"96\">\r\n            <div align=\"right\">保修</div>\r\n            </td>\r\n            <td bgc
olor=\"#ffffff\" width=\"300\" valign=\"top\">\r\n            <div>一年有限保修，详细见保修卡或虹光网址相关内容；</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '<p>A4双面面彩色馈纸式文档扫描仪。</p>\r\n<p>A4、彩色/灰度/黑白模式、200dpi下扫描速度同速，可达每分钟25页/50面。</p>\r\n<p>TWAIN扫描驱动软件带有智能化处理的完美页面扫描功能。</p>\r\n<p>体积小，直通式短道送纸机构设计，扫描通过性好，适合各类文档扫描及商\r\n务扫描。</p>\r\n<p>ADF支持卡片多张扫描。</p>\r\n<p>带超声波重张检测。</p>\r\n<p>9个自定义编程快捷按键功能，方便用户自定义按键功能来实现软件关联。</p>', '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '22', '', '', '1330236132', '1329533629');
INSERT INTO `jd_shop_product` VALUES ('50', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<p>商品描述</p>', null, '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '0', '', '', '0', '1329534777');
INSERT INTO `jd_shop_product` VALUES ('51', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<p>商品描述</p>', null, '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '0', '', '', '0', '1329534793');
INSERT INTO `jd_shop_product` VALUES ('52', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<p>商品描述</p>', null, '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '12', '', '', '0', '1329534963');
INSERT INTO `jd_shop_product` VALUES ('53', '0', 'FBH6380C', '', '71', '0', '', '0.00', '0.00', '0.00', '0', '0', 'no', 'no', '', '<p>商品描述</p>', null, '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', '17', '', '', '0', '1329534979');
INSERT INTO `jd_shop_product` VALUES ('54', '0', 'aaaaaaaaaaaa', null, '73', null, null, null, null, null, '0', '0', 'no', 'no', null, '<p>asd</p>', 'a1111', null, null, null, null, null, null, null, null, null, 'no', 'no', 'no', '7', '', '', '1330527075', '1330527049');

-- ----------------------------
-- Table structure for `jd_shop_producttype`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_producttype`;
CREATE TABLE `jd_shop_producttype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producttype_name` varchar(255) DEFAULT NULL,
  `enable` enum('no','yes') DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_producttype
-- ----------------------------
INSERT INTO `jd_shop_producttype` VALUES ('30', '扫描仪', 'yes');
INSERT INTO `jd_shop_producttype` VALUES ('31', '服务器', 'yes');

-- ----------------------------
-- Table structure for `jd_shop_producttype_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_producttype_attribute`;
CREATE TABLE `jd_shop_producttype_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producttype_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_producttype_attribute
-- ----------------------------
INSERT INTO `jd_shop_producttype_attribute` VALUES ('78', '30', '41');
INSERT INTO `jd_shop_producttype_attribute` VALUES ('79', '30', '42');
INSERT INTO `jd_shop_producttype_attribute` VALUES ('80', '30', '43');

-- ----------------------------
-- Table structure for `jd_shop_product_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_product_attribute`;
CREATE TABLE `jd_shop_product_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(255) DEFAULT NULL,
  `attr_val` varchar(255) DEFAULT NULL,
  `attr_price` varchar(10) DEFAULT NULL COMMENT '格价波动',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=656 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_product_attribute
-- ----------------------------
INSERT INTO `jd_shop_product_attribute` VALUES ('634', '47', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('635', '47', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('636', '47', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('637', '48', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('638', '48', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('639', '48', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('640', '49', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('641', '49', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('642', '49', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('643', '50', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('644', '50', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('645', '50', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('646', '51', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('647', '51', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('648', '51', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('649', '52', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('650', '52', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('651', '52', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('652', '53', '42', '双面', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('653', '53', '43', '大小紧凑可便携，智能触控便于使用', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('654', '53', '41', '每分钟20页<br>每天500页', '+0.00');
INSERT INTO `jd_shop_product_attribute` VALUES ('655', '54', '41', 'aaaa', '');

-- ----------------------------
-- Table structure for `jd_shop_product_img`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_product_img`;
CREATE TABLE `jd_shop_product_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `img_title` varchar(255) DEFAULT NULL COMMENT '交通情况',
  `img_url` varchar(255) DEFAULT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_product_img
-- ----------------------------
INSERT INTO `jd_shop_product_img` VALUES ('63', '47', '', 'data/upload/images/201202/1330207298545214902.jpg', '0', '0');
INSERT INTO `jd_shop_product_img` VALUES ('64', '48', '', 'data/upload/images/201202/1330207313964832196.jpg', '0', '0');
INSERT INTO `jd_shop_product_img` VALUES ('65', '49', '', 'data/upload/images/201202/1330207332399337925.jpg', '0', '0');

-- ----------------------------
-- Table structure for `jd_shop_product_ptag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_product_ptag`;
CREATE TABLE `jd_shop_product_ptag` (
  `product_id` int(10) NOT NULL,
  `ptag_id` int(10) NOT NULL,
  `ptag_val` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`product_id`,`ptag_id`,`ptag_val`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品相关的商品索引';

-- ----------------------------
-- Records of jd_shop_product_ptag
-- ----------------------------
INSERT INTO `jd_shop_product_ptag` VALUES ('51', '9', 'a');

-- ----------------------------
-- Table structure for `jd_shop_ptag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_ptag`;
CREATE TABLE `jd_shop_ptag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `ptag_name` varchar(60) NOT NULL DEFAULT '索引名',
  `ptag_val_list` varchar(60) NOT NULL DEFAULT '' COMMENT '索引值,多个请用逗号隔开',
  `enable` enum('no','yes') NOT NULL DEFAULT 'yes' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='商品索引';

-- ----------------------------
-- Records of jd_shop_ptag
-- ----------------------------
INSERT INTO `jd_shop_ptag` VALUES ('9', '0', 'asad', 'a,as', 'yes');

-- ----------------------------
-- Table structure for `jd_shop_shipping`
-- ----------------------------
DROP TABLE IF EXISTS `jd_shop_shipping`;
CREATE TABLE `jd_shop_shipping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `shipping_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '交通情况',
  `img_url` varchar(255) DEFAULT NULL,
  `insure` varchar(10) DEFAULT NULL COMMENT '保价',
  `is_cod` enum('no','yes') NOT NULL DEFAULT 'no' COMMENT '货到付款',
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `enable` enum('no','yes') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_shop_shipping
-- ----------------------------
INSERT INTO `jd_shop_shipping` VALUES ('37', '0', '邮政快递包裹', '邮政快递包裹的描述内容。', '', '1%', 'no', '1290490960', '1290483785', '0', 'yes');
INSERT INTO `jd_shop_shipping` VALUES ('38', '0', '申通快递', '江、浙、沪地区首重为15元/KG，其他地区18元/KG， 续重均为5-6元/KG， 云南地区为8元', '', '', 'no', '1290491175', '1290491064', '0', 'yes');
INSERT INTO `jd_shop_shipping` VALUES ('39', '0', '上门取货', '买家自己到商家指定地点取货', '', '', 'yes', '0', '1290491214', '0', 'yes');

-- ----------------------------
-- Table structure for `jd_testdbgate_category`
-- ----------------------------
DROP TABLE IF EXISTS `jd_testdbgate_category`;
CREATE TABLE `jd_testdbgate_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_testdbgate_category
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_testdbgate_product`
-- ----------------------------
DROP TABLE IF EXISTS `jd_testdbgate_product`;
CREATE TABLE `jd_testdbgate_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(120) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `count_img` int(11) DEFAULT NULL,
  `count_tag` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_testdbgate_product
-- ----------------------------
INSERT INTO `jd_testdbgate_product` VALUES ('3', null, null, null, null, null);

-- ----------------------------
-- Table structure for `jd_testdbgate_product_img`
-- ----------------------------
DROP TABLE IF EXISTS `jd_testdbgate_product_img`;
CREATE TABLE `jd_testdbgate_product_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `img_title` varchar(120) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_testdbgate_product_img
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_testdbgate_product_to_tag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_testdbgate_product_to_tag`;
CREATE TABLE `jd_testdbgate_product_to_tag` (
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`product_id`,`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_testdbgate_product_to_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_testdbgate_tag`
-- ----------------------------
DROP TABLE IF EXISTS `jd_testdbgate_tag`;
CREATE TABLE `jd_testdbgate_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jd_testdbgate_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_vote`
-- ----------------------------
DROP TABLE IF EXISTS `jd_vote`;
CREATE TABLE `jd_vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `created` int(10) NOT NULL DEFAULT '0',
  `updated` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='投票';

-- ----------------------------
-- Records of jd_vote
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_vote_log`
-- ----------------------------
DROP TABLE IF EXISTS `jd_vote_log`;
CREATE TABLE `jd_vote_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_id` int(10) unsigned NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='投票记录';

-- ----------------------------
-- Records of jd_vote_log
-- ----------------------------

-- ----------------------------
-- Table structure for `jd_vote_option`
-- ----------------------------
DROP TABLE IF EXISTS `jd_vote_option`;
CREATE TABLE `jd_vote_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '投票选项',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '投票人数',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='投票选项';

-- ----------------------------
-- Records of jd_vote_option
-- ----------------------------
