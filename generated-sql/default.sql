
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories`
(
    `id_categories` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pictures
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pictures`;

CREATE TABLE `pictures`
(
    `id_pictures` INTEGER NOT NULL AUTO_INCREMENT,
    `id_users` INTEGER NOT NULL,
    `canvas` TEXT NOT NULL,
    `thumb` TEXT NOT NULL,
    `id_categories` INTEGER NOT NULL,
    PRIMARY KEY (`id_pictures`),
    INDEX `id_users` (`id_users`),
    INDEX `id_categories` (`id_categories`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id_users` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` enum('admin','membre') NOT NULL,
    `salt` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_users`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
