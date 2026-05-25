CREATE TABLE IF NOT EXISTS `aspiration_submissions` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100)    NOT NULL,
    `last_name`  VARCHAR(100)    NOT NULL,
    `email`      VARCHAR(255)    NOT NULL,
    `message`    TEXT            NOT NULL,
    `read_at`    TIMESTAMP       NULL DEFAULT NULL,
    `created_at` TIMESTAMP       NULL DEFAULT NULL,
    `updated_at` TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2026_05_23_165150_create_aspiration_submissions_table', 1);
