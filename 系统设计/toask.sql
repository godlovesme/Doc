/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : toask

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2018-06-02 17:55:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_ask
-- ----------------------------
DROP TABLE IF EXISTS `tp_ask`;
CREATE TABLE `tp_ask` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '描述',
  `gold` int(11) NOT NULL DEFAULT '0' COMMENT '悬赏金币',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `is_new` tinyint(1) NOT NULL DEFAULT '1' COMMENT '最新的',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '热门的',
  `visit_num` int(11) NOT NULL DEFAULT '0' COMMENT '游览数量',
  `reply_num` int(11) NOT NULL DEFAULT '0' COMMENT '回复数量',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户问题';

-- ----------------------------
-- Records of tp_ask
-- ----------------------------

-- ----------------------------
-- Table structure for tp_ask_tag
-- ----------------------------
DROP TABLE IF EXISTS `tp_ask_tag`;
CREATE TABLE `tp_ask_tag` (
  `tag_id` int(11) NOT NULL,
  `ask_id` int(11) NOT NULL,
  UNIQUE KEY `tag_ask` (`tag_id`,`ask_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题标签';

-- ----------------------------
-- Records of tp_ask_tag
-- ----------------------------

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类';

-- ----------------------------
-- Records of tp_category
-- ----------------------------

-- ----------------------------
-- Table structure for tp_reply
-- ----------------------------
DROP TABLE IF EXISTS `tp_reply`;
CREATE TABLE `tp_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `ask_id` int(11) NOT NULL DEFAULT '0' COMMENT '问题ID',
  `content` text COMMENT '回答的内容',
  `approval_num` int(11) NOT NULL DEFAULT '0' COMMENT '赞同的数量',
  `is_accept` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否采纳',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回复';

-- ----------------------------
-- Records of tp_reply
-- ----------------------------

-- ----------------------------
-- Table structure for tp_reply_comment
-- ----------------------------
DROP TABLE IF EXISTS `tp_reply_comment`;
CREATE TABLE `tp_reply_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '评论上级',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `ask_id` int(11) NOT NULL DEFAULT '0' COMMENT '问题的ID',
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复的id',
  `conent` text NOT NULL COMMENT '评论内容',
  `approval_num` int(11) NOT NULL DEFAULT '0' COMMENT '赞同数量',
  `add_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='回复评论';

-- ----------------------------
-- Records of tp_reply_comment
-- ----------------------------

-- ----------------------------
-- Table structure for tp_tag
-- ----------------------------
DROP TABLE IF EXISTS `tp_tag`;
CREATE TABLE `tp_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL COMMENT '标签',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在标签云上显示',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签';

-- ----------------------------
-- Records of tp_tag
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `phone` int(11) NOT NULL DEFAULT '0' COMMENT '手机号',
  `email` varchar(90) DEFAULT NULL COMMENT '邮箱',
  `password` char(32) NOT NULL COMMENT '密码',
  `sex` enum('保密','男','女') NOT NULL DEFAULT '保密',
  `birthday` date DEFAULT NULL,
  `face_path` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `my_desc` varchar(255) DEFAULT NULL COMMENT '自我介绍',
  `good_at` varchar(60) DEFAULT NULL COMMENT '擅长',
  `pay_path` varchar(255) DEFAULT NULL COMMENT '支付二维码',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user_config
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_config`;
CREATE TABLE `tp_user_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_notice` varchar(255) DEFAULT NULL COMMENT '站内通知 {"reply":1,"care":1,"comment_article":1,"accept_reply":1,"reply_article_comment":1,"comment_reply":1}，当有人回答我问题时,当有人关注我时,当有人评论我的文章时,当有人采纳我的回答时,当有人回复我的文章评论时 ,当有人评论我的回答时',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户配置';

-- ----------------------------
-- Records of tp_user_config
-- ----------------------------
