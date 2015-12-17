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
    `img_md5` varchar(32) NOT NULL DEFAULT '',
    `expire` datetime NOT NULL DEFAULT '2015-12-17 00:00:00',
    `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0下架 1上架 ',
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
