-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2018 年 01 月 14 日 08:03
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `news20180111`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `news`
-- 

CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(64) NOT NULL,
  `keywords` varchar(64) NOT NULL,
  `autor` varchar(16) NOT NULL,
  `addtime` date NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- 
-- 导出表中的数据 `news`
-- 

INSERT INTO `news` VALUES (2, '新闻2', '军事', '李四', '2018-01-13', '港媒称歼20开展首次实战训练');
INSERT INTO `news` VALUES (3, '新闻3', '科技', '王五', '2018-01-12', '英特尔再曝新漏洞，黑客可控制笔记本');
INSERT INTO `news` VALUES (5, '新闻5', '历史', '赵七', '2018-01-06', '毛泽东生前警卫：不孤独因有毛主席相伴');
INSERT INTO `news` VALUES (4, '新闻4', '电影', '马六', '2018-01-09', '2018内地好莱坞引进片前瞻');
INSERT INTO `news` VALUES (1, '新闻1', '社会', '张三', '2018-01-14', '2018春运售票进入高峰期');
INSERT INTO `news` VALUES (6, '新闻6', '财经', '周八', '2018-01-01', '新年楼市松绑真相');
