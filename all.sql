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
