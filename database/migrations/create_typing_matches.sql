-- Create typing_matches table
CREATE TABLE `typing_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `player1_id` bigint(20) unsigned NOT NULL,
  `player2_id` bigint(20) unsigned DEFAULT NULL,
  `winner_id` bigint(20) unsigned DEFAULT NULL,
  `text_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `player1_progress` int(11) NOT NULL DEFAULT '0',
  `player2_progress` int(11) NOT NULL DEFAULT '0',
  `player1_wpm` decimal(8,2) DEFAULT NULL,
  `player2_wpm` decimal(8,2) DEFAULT NULL,
  `player1_accuracy` decimal(5,2) DEFAULT NULL,
  `player2_accuracy` decimal(5,2) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `typing_matches_player1_id_foreign` (`player1_id`),
  KEY `typing_matches_player2_id_foreign` (`player2_id`),
  KEY `typing_matches_winner_id_foreign` (`winner_id`),
  CONSTRAINT `typing_matches_player1_id_foreign` FOREIGN KEY (`player1_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `typing_matches_player2_id_foreign` FOREIGN KEY (`player2_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `typing_matches_winner_id_foreign` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add points to users table
ALTER TABLE `users` ADD COLUMN `points` int(11) NOT NULL DEFAULT '0' AFTER `email`;
