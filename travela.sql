-- Tạo Cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS travela CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travela;

-- --------------------------------------------------------
-- 1. CÁC BẢNG ĐỘC LẬP (Không có khóa ngoại)
-- --------------------------------------------------------

CREATE TABLE `tbl_admin` (
  `adminId` INT(11) NOT NULL AUTO_INCREMENT,
  `userName` VARCHAR(50) NOT NULL,
  `passWord` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `createDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_user` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `userName` VARCHAR(50) NOT NULL,
  `passWord` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phoneNumber` VARCHAR(15) DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT NULL,
  `ipAdress` VARCHAR(50) DEFAULT NULL,
  `isActive` ENUM('y', 'n') NOT NULL DEFAULT 'n',
  `isStatus` ENUM('d', 'b') DEFAULT NULL,
  `role` ENUM('a', 'c') NOT NULL DEFAULT 'c',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_tours` (
  `tourId` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `domain` ENUM('b', 't', 'n') NOT NULL COMMENT 'b: Bắc, t: Trung, n: Nam',
  `time` VARCHAR(255) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `priceAdult` INT(11) NOT NULL,
  `priceChild` INT(11) NOT NULL,
  `destination` VARCHAR(255) NOT NULL,
  `availability` TINYINT(1) NOT NULL,
  `description` TEXT NOT NULL,
  `reviews` VARCHAR(255) DEFAULT NULL,
  `startDate` DATE NOT NULL,
  `endDate` DATE NOT NULL,
  PRIMARY KEY (`tourId`),
  INDEX (`startDate`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_promotion` (
  `promotionId` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `discount` INT(11) NOT NULL,
  `startDate` DATE NOT NULL,
  `endDate` DATE NOT NULL,
  `quality` INT(11) NOT NULL,
  PRIMARY KEY (`promotionId`)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- 2. CÁC BẢNG CÓ KHÓA NGOẠI (Phụ thuộc vào các bảng trên)
-- --------------------------------------------------------

CREATE TABLE `tbl_booking` (
  `bookingId` INT(11) NOT NULL AUTO_INCREMENT,
  `tourId` INT(11) NOT NULL,
  `userId` INT(11) NOT NULL,
  `bookingDate` DATE NOT NULL,
  `numAdults` INT(11) NOT NULL,
  `numChild` INT(11) NOT NULL,
  `totalPrice` DOUBLE NOT NULL,
  `bookingStatus` VARCHAR(255) NOT NULL,
  `specialRequestes` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`bookingId`),
  CONSTRAINT `fk_booking_tour` FOREIGN KEY (`tourId`) REFERENCES `tbl_tours` (`tourId`),
  CONSTRAINT `fk_booking_user` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_payment` (
  `paymentId` INT(11) NOT NULL AUTO_INCREMENT,
  `bookingId` INT(11) NOT NULL,
  `payment_method` VARCHAR(50) NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `discount_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `final_amount` DECIMAL(12,2) NOT NULL,
  `status` VARCHAR(50) DEFAULT 'pending',
  `transaction_id` VARCHAR(255) DEFAULT NULL,
  `payment_details` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`paymentId`),
  CONSTRAINT `fk_payment_booking` FOREIGN KEY (`bookingId`) REFERENCES `tbl_booking` (`bookingId`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `tbl_images` (
  `imageId` INT(11) NOT NULL AUTO_INCREMENT,
  `tourId` INT(11) NOT NULL,
  `imageURL` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `uploadDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`imageId`),
  CONSTRAINT `fk_image_tour` FOREIGN KEY (`tourId`) REFERENCES `tbl_tours` (`tourId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_timeline` (
  `timeLineId` INT(11) NOT NULL AUTO_INCREMENT,
  `tourId` INT(11) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`timeLineId`),
  CONSTRAINT `fk_timeline_tour` FOREIGN KEY (`tourId`) REFERENCES `tbl_tours` (`tourId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_reviews` (
  `reviewId` INT(11) NOT NULL AUTO_INCREMENT,
  `tourId` INT(11) NOT NULL,
  `userId` INT(11) NOT NULL,
  `rating` FLOAT NOT NULL,
  `comment` VARCHAR(255) DEFAULT NULL,
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewId`),
  CONSTRAINT `fk_review_tour` FOREIGN KEY (`tourId`) REFERENCES `tbl_tours` (`tourId`),
  CONSTRAINT `fk_review_user` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`)
) ENGINE=InnoDB;

CREATE TABLE `tbl_chat` (
  `chatId` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) NOT NULL,
  `adminId` INT(11) NOT NULL,
  `messages` VARCHAR(250) NOT NULL,
  `readStatus` ENUM('y', 'n') DEFAULT 'n',
  `createDate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipAdress` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`chatId`),
  CONSTRAINT `fk_chat_user` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`),
  CONSTRAINT `fk_chat_admin` FOREIGN KEY (`adminId`) REFERENCES `tbl_admin` (`adminId`)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- 3. CÁC BẢNG HỆ THỐNG (Laravel/Cache/Jobs)
-- --------------------------------------------------------

CREATE TABLE `migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`user_id`),
  INDEX (`last_activity`)
) ENGINE=InnoDB;

CREATE TABLE `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB;