-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: StoryTail
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;
SET FOREIGN_KEY_CHECKS = 0;
--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities`
(
    `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `title`       varchar(255)        NOT NULL,
    `description` text                NOT NULL,
    `created_at`  timestamp           NULL DEFAULT NULL,
    `updated_at`  timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `activities`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_book`
--

DROP TABLE IF EXISTS `activity_book`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_book`
(
    `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `activity_id` bigint(20) unsigned NOT NULL,
    `book_id`     bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `activity_book_activity_id_foreign` (`activity_id`),
    KEY `activity_book_book_id_foreign` (`book_id`),
    CONSTRAINT `activity_book_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
    CONSTRAINT `activity_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_book`
--

LOCK TABLES `activity_book` WRITE;
/*!40000 ALTER TABLE `activity_book`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_book`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_book_user`
--

DROP TABLE IF EXISTS `activity_book_user`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_book_user`
(
    `id`               bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `activity_book_id` bigint(20) unsigned NOT NULL,
    `user_id`          bigint(20) unsigned NOT NULL,
    `progress`         int(11)             NOT NULL,
    PRIMARY KEY (`id`),
    KEY `activity_book_user_activity_book_id_foreign` (`activity_book_id`),
    KEY `activity_book_user_user_id_foreign` (`user_id`),
    CONSTRAINT `activity_book_user_activity_book_id_foreign` FOREIGN KEY (`activity_book_id`) REFERENCES `activity_book` (`id`),
    CONSTRAINT `activity_book_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_book_user`
--

LOCK TABLES `activity_book_user` WRITE;
/*!40000 ALTER TABLE `activity_book_user`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_book_user`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_images`
--

DROP TABLE IF EXISTS `activity_images`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_images`
(
    `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `activity_id` bigint(20) unsigned NOT NULL,
    `title`       varchar(255)        NOT NULL,
    `image_url`   varchar(255)        NOT NULL,
    `created_at`  timestamp           NULL DEFAULT NULL,
    `updated_at`  timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `activity_images_activity_id_foreign` (`activity_id`),
    CONSTRAINT `activity_images_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_images`
--

LOCK TABLES `activity_images` WRITE;
/*!40000 ALTER TABLE `activity_images`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_images`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `age_groups`
--

DROP TABLE IF EXISTS `age_groups`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `age_groups`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `age_group`  varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `age_groups_age_group_unique` (`age_group`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age_groups`
--

LOCK TABLES `age_groups` WRITE;
/*!40000 ALTER TABLE `age_groups`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `age_groups`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author_book`
--

DROP TABLE IF EXISTS `author_book`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author_book`
(
    `id`        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `author_id` bigint(20) unsigned NOT NULL,
    `book_id`   bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `author_book_author_id_foreign` (`author_id`),
    KEY `author_book_book_id_foreign` (`book_id`),
    CONSTRAINT `author_book_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
    CONSTRAINT `author_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author_book`
--

LOCK TABLES `author_book` WRITE;
/*!40000 ALTER TABLE `author_book`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `author_book`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors`
(
    `id`               bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `first_name`       varchar(255)        NOT NULL,
    `last_name`        varchar(255)        NOT NULL,
    `description`      text                     DEFAULT NULL,
    `author_photo_url` varchar(255)             DEFAULT NULL,
    `nationality`      varchar(255)             DEFAULT NULL,
    `created_at`       timestamp           NULL DEFAULT NULL,
    `updated_at`       timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `authors`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_user_favourite`
--

DROP TABLE IF EXISTS `book_user_favourite`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_user_favourite`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`    bigint(20) unsigned NOT NULL,
    `user_id`    bigint(20) unsigned NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `book_user_favourite_book_id_foreign` (`book_id`),
    KEY `book_user_favourite_user_id_foreign` (`user_id`),
    CONSTRAINT `book_user_favourite_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
    CONSTRAINT `book_user_favourite_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_user_favourite`
--

LOCK TABLES `book_user_favourite` WRITE;
/*!40000 ALTER TABLE `book_user_favourite`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `book_user_favourite`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_user_read`
--

DROP TABLE IF EXISTS `book_user_read`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_user_read`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`    bigint(20) unsigned NOT NULL,
    `user_id`    bigint(20) unsigned NOT NULL,
    `progress`   int(11)             NOT NULL,
    `rating`     int(11)                  DEFAULT NULL,
    `read_date`  date                     DEFAULT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `book_user_read_book_id_foreign` (`book_id`),
    KEY `book_user_read_user_id_foreign` (`user_id`),
    CONSTRAINT `book_user_read_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
    CONSTRAINT `book_user_read_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_user_read`
--

LOCK TABLES `book_user_read` WRITE;
/*!40000 ALTER TABLE `book_user_read`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `book_user_read`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `book_suggestions`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_suggestions`
(
    `id`           bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`      bigint(20) unsigned NOT NULL,
    `user_id`      bigint(20) unsigned NOT NULL,
    `suggested_by` bigint(20) unsigned NOT NULL,
    `created_at`   timestamp           NULL DEFAULT NULL,
    `updated_at`   timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `book_suggestions_book_id_foreign` (`book_id`),
    KEY `book_suggestions_user_id_foreign` (`user_id`),
    KEY `book_suggestions_suggested_by_foreign` (`suggested_by`),
    CONSTRAINT `book_suggestions_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
    CONSTRAINT `book_suggestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    CONSTRAINT `book_suggestions_suggested_by_foreign` FOREIGN KEY (`suggested_by`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `book_suggestions` WRITE;
/*!40000 ALTER TABLE `book_suggestions`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `book_suggestions`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books`
(
    `id`           bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `title`        varchar(255)        NOT NULL,
    `description`  text                NOT NULL,
    `cover_url`    varchar(255)        NOT NULL,
    `read_time`    int(11)             NOT NULL,
    `age_group_id` bigint(20) unsigned NOT NULL,
    `is_active`    tinyint(1)          NOT NULL DEFAULT 1,
    `access_level` varchar(255)        NOT NULL,
    `created_at`   timestamp           NULL     DEFAULT NULL,
    `updated_at`   timestamp           NULL     DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `books`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache`
(
    `key`        varchar(255) NOT NULL,
    `value`      mediumtext   NOT NULL,
    `expiration` int(11)      NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `cache`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks`
(
    `key`        varchar(255) NOT NULL,
    `owner`      varchar(255) NOT NULL,
    `expiration` int(11)      NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `uuid`       varchar(255)        NOT NULL,
    `connection` text                NOT NULL,
    `queue`      text                NOT NULL,
    `payload`    longtext            NOT NULL,
    `exception`  longtext            NOT NULL,
    `failed_at`  timestamp           NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches`
(
    `id`             varchar(255) NOT NULL,
    `name`           varchar(255) NOT NULL,
    `total_jobs`     int(11)      NOT NULL,
    `pending_jobs`   int(11)      NOT NULL,
    `failed_jobs`    int(11)      NOT NULL,
    `failed_job_ids` longtext     NOT NULL,
    `options`        mediumtext DEFAULT NULL,
    `cancelled_at`   int(11)    DEFAULT NULL,
    `created_at`     int(11)      NOT NULL,
    `finished_at`    int(11)    DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs`
(
    `id`           bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `queue`        varchar(255)        NOT NULL,
    `payload`      longtext            NOT NULL,
    `attempts`     tinyint(3) unsigned NOT NULL,
    `reserved_at`  int(10) unsigned DEFAULT NULL,
    `available_at` int(10) unsigned    NOT NULL,
    `created_at`   int(10) unsigned    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255)     NOT NULL,
    `batch`     int(11)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 21
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations`
    DISABLE KEYS */;
INSERT INTO `migrations`
VALUES (1, '2024_10_09_221127_create_user_types_table', 1),
       (2, '2024_10_08_210317_create_tag_table', 2),
       (3, '0001_01_01_000000_create_users_table', 3),
       (4, '0001_01_01_000001_create_cache_table', 3),
       (5, '0001_01_01_000002_create_jobs_table', 3),
       (6, '2024_10_08_210416_create_age_groups_table', 4),
       (7, '2024_10_05_230114_create_books_table', 5),
       (8, '2024_10_06_123109_create_authors_table', 5),
       (9, '2024_10_06_123350_create_author_book_table', 5),
       (10, '2024_10_08_210010_create_pages_table', 5),
       (11, '2024_10_08_210048_create_videos_table', 5),
       (12, '2024_10_08_210237_create_tagging_tagged_table', 5),
       (13, '2024_10_08_210542_create_activities_table', 6),
       (14, '2024_10_08_210449_create_activity_book_table', 7),
       (15, '2024_10_08_210609_create_activity_images_table', 7),
       (16, '2024_10_08_210942_create_activity_book_user_table', 8),
       (17, '2024_10_08_213545_create_book_user_favourite_table', 8),
       (18, '2024_10_08_213628_create_book_user_read_table', 8),
       (19, '2024_10_09_221455_create_plans_table', 9),
       (20, '2024_10_08_213815_create_subscriptions_table', 10);
/*!40000 ALTER TABLE `migrations`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages`
(
    `id`             bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`        bigint(20) unsigned NOT NULL,
    `page_image_url` varchar(255)        NOT NULL,
    `audio_url`      varchar(255)             DEFAULT NULL,
    `page_index`     int(11)             NOT NULL,
    `created_at`     timestamp           NULL DEFAULT NULL,
    `updated_at`     timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `pages_book_id_foreign` (`book_id`),
    CONSTRAINT `pages_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `pages`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens`
(
    `email`      varchar(255) NOT NULL,
    `token`      varchar(255) NOT NULL,
    `created_at` timestamp    NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans`
(
    `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(255)        NOT NULL,
    `acess_level` varchar(255)        NOT NULL,
    `created_at`  timestamp           NULL DEFAULT NULL,
    `updated_at`  timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `plans`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions`
(
    `id`            varchar(255) NOT NULL,
    `user_id`       bigint(20) unsigned DEFAULT NULL,
    `ip_address`    varchar(45)         DEFAULT NULL,
    `user_agent`    text                DEFAULT NULL,
    `payload`       longtext     NOT NULL,
    `last_activity` int(11)      NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`    bigint(20) unsigned NOT NULL,
    `plan_id`    bigint(20) unsigned NOT NULL,
    `start_date` date                NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `subscriptions_user_id_foreign` (`user_id`),
    KEY `subscriptions_plan_id_foreign` (`plan_id`),
    CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
    CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `tag_name_unique` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `tag`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tagged`
--

DROP TABLE IF EXISTS `tagging_tagged`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tagged`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`    bigint(20) unsigned NOT NULL,
    `tag_id`     bigint(20) unsigned NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `tagging_tagged_book_id_foreign` (`book_id`),
    KEY `tagging_tagged_tag_id_foreign` (`tag_id`),
    CONSTRAINT `tagging_tagged_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
    CONSTRAINT `tagging_tagged_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tagged`
--

LOCK TABLES `tagging_tagged` WRITE;
/*!40000 ALTER TABLE `tagging_tagged`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tagged`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_type`  varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `user_types`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `user_data`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id`                bigint UNSIGNED                         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`              varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`             varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp                               NULL DEFAULT NULL,
    `password`          varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token`    varchar(100) COLLATE utf8mb4_unicode_ci      DEFAULT NULL,
    `created_at`        timestamp                               NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        timestamp                               NULL DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data`
(
    `id`             bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_type_id`   bigint(20) unsigned NOT NULL,
    `user_id`        bigint unsigned     NOT NULL,
    `first_name`     varchar(255)        NOT NULL,
    `last_name`      varchar(255)        NOT NULL,
    `user_photo_url` varchar(255)             DEFAULT NULL,
    `created_at`     timestamp           NULL DEFAULT NULL,
    `updated_at`     timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_data_user_user_id` (`user_id`),
    KEY `users_user_type_id_foreign` (`user_type_id`),
    CONSTRAINT `users_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `users`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `book_id`    bigint(20) unsigned NOT NULL,
    `title`      varchar(255)        NOT NULL,
    `video_url`  varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `videos_book_id_foreign` (`book_id`),
    CONSTRAINT `videos_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `videos`
    ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;
SET FOREIGN_KEY_CHECKS = 1;
-- Dump completed on 2024-10-10 19:57:44
