CREATE TABLE `admin` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(45) NOT NULL,
    `pwd` varchar(32) NOT NULL,
    `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1=启用 0=禁用',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `is_super_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=不是 1=是',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0=禁用 1=启用',
    `mobile` varchar(15) NOT NULL DEFAULT '',
    `real_name` varchar(5) NOT NULL DEFAULT '',
    `address` varchar(100) NOT NULL DEFAULT '',
    `wx_id` varchar(50) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE KEY `mobile_unq` (`mobile`),
    KEY `real_name` (`real_name`),
    KEY `user_search_key` (`mobile`, `real_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `template_class` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(20) NOT NULL DEFAULT '',
    `sort` int(10) NOT NULL DEFAULT '0',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0=禁用 1=启用',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `banner` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `sort` int(10) NOT NULL DEFAULT '0',
    `elink` varchar(255) NOT NULL DEFAULT '',
    `img_md5` varchar(100) NOT NULL DEFAULT '',
    `expire` datetime NOT NULL DEFAULT '2015-12-17 00:00:00',
    `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0下架 1上架 ',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `template` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL DEFAULT '',
    `sort` int(10) NOT NULL DEFAULT '0',
    `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0下架 1上架 ',
    `price` decimal(6,2) NOT NULL DEFAULT '0',
    `class` int(11) unsigned NOT NULL DEFAULT '0',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `class_search` (`class`, `sort`),
    CONSTRAINT `class` FOREIGN KEY (`class`) REFERENCES `template_class` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `template_source` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `source` varchar(100) NOT NULL DEFAULT '',
    `template_id` int(11) unsigned NOT NULL DEFAULT '0',
    `is_front` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否封面1是 0不是',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `search_key` (`template_id`, `is_front`),
    CONSTRAINT `template_id` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `album` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(11) unsigned NOT NULL DEFAULT '0',
    `class` int(11) unsigned NOT NULL DEFAULT '0',
    `template_id` int(11) unsigned NOT NULL DEFAULT '0',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `class` (`class`),
    KEY `search_key` (`user_id`,`class`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `album_source` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `album_id` int(11) unsigned NOT NULL DEFAULT '0',
    `source` varchar(100) NOT NULL DEFAULT '',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    `is_front` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示在列表里面 默认第一张是封面',
    PRIMARY KEY (`id`),
    KEY `album_id` (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `activity` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `subject` varchar(100) NOT NULL DEFAULT '',
    `content` text,
    `start_time` datetime NOT NULL,
    `expire` datetime NOT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `search_key` (`start_time`, `expire`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(11) unsigned NOT NULL DEFAULT '0',
    `album_id` int(11) unsigned NOT NULL DEFAULT '0',
    `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1下单2已打印3已发货4已完成',
    `quantity` int(10) NOT NULL DEFAULT '1' COMMENT '定制的相册数量',
    `total_amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '总计金额',
    `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未支付 1为已支付',
    `out_trade_no` varchar(64) NOT NULL DEFAULT '' COMMENT '付款订单号',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `user_id` (`user_id`),
    KEY `search_key` (`user_id`, `status`, `pay_status`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pay_ment` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `out_trade_no` varchar(64) NOT NULL COMMENT '付款订单号',
    `notify_time` datetime DEFAULT NULL COMMENT '异步回调通知时间',
    `subject` varchar(256) DEFAULT NULL COMMENT '商品名称',
    `quantity` int(11) DEFAULT NULL COMMENT '购买数量',
    `total_fee` decimal(10,2) DEFAULT NULL COMMENT '交易金额 该笔订单的总金额。',
    `price` decimal(10,2) DEFAULT NULL,
    `body` varchar(400) DEFAULT NULL COMMENT '商品描述',
    `gmt_create` datetime DEFAULT NULL COMMENT '交易创建时间',
    `user_id` int(11) unsigned NOT NULL DEFAULT '0',
    `client_paid` varchar(25) DEFAULT NULL COMMENT '告知后端客户端是否已经支付完成',
    `server_paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '异步回调是否成功 0失败 1成功',
    `result_code` varchar(64) DEFAULT NULL COMMENT '业务结果',
    `return_code` varchar(64) DEFAULT NULL COMMENT '返回状态码',
    `transaction_id` varchar(64) DEFAULT NULL COMMENT '微信支付订单号',
    `time_end` varchar(64) DEFAULT NULL COMMENT '支付完成时间',
    `openid` varchar(64) DEFAULT NULL COMMENT '用户标识 ',
    PRIMARY KEY (`id`),
    KEY `out_trade_no` (`out_trade_no`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
