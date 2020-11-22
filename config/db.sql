DROP DATABASE IF EXISTS `asperger`;
CREATE DATABASE `asperger` CHARACTER SET utf8;

USE `asperger`;

CREATE TABLE `Users`
(
    `id`    TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(50)     NOT NULL,
    `image` VARCHAR(50)     UNIQUE,
    `email` VARCHAR(100)    NOT NULL    UNIQUE,
    `pass`  VARCHAR(100)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Articles`
(
  `id`              TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `name`            VARCHAR(30)     NOT NULL    UNIQUE,
  `created_date`    DATETIME        NOT NULL,
  `updated_date`    DATETIME        NOT NULL,
  `content`         TEXT
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Resources`
(
  `id`          TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `name`        VARCHAR(30)     NOT NULL    UNIQUE,
  `link`        VARCHAR(60)     NOT NULL    UNIQUE,
  `category`    VARCHAR(30)     NOT NULL,
  `description` TEXT
)
ENGINE=INNODB DEFAULT CHARSET=utf8;
