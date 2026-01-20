-- 1. Create Tournaments Table
CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `start_date` timestamp NULL DEFAULT NULL,
  `max_participants` int(11) NOT NULL DEFAULT 16,
  `champion_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tournaments_champion_id_foreign` (`champion_id`),
  CONSTRAINT `tournaments_champion_id_foreign` FOREIGN KEY (`champion_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Create Tournament Participants Table
CREATE TABLE IF NOT EXISTS `tournament_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `seed` int(11) DEFAULT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tournament_participants_tournament_id_user_id_unique` (`tournament_id`,`user_id`),
  KEY `tournament_participants_user_id_foreign` (`user_id`),
  CONSTRAINT `tournament_participants_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tournament_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Update Typing Matches Table (Make player1 nullable and add tournament cols)
-- Make player1_id nullable
ALTER TABLE `typing_matches` MODIFY `player1_id` bigint(20) unsigned NULL;

-- Add new columns if they don't exist
-- Note: MySQL simple ALTER doesn't support IF NOT EXISTS for columns easily in one line without procedure, 
-- but running these will error safely if columns exist or you can run them one by one.
-- Assuming standard update scenario:

ALTER TABLE `typing_matches` 
ADD COLUMN `tournament_id` bigint(20) unsigned DEFAULT NULL AFTER `completed_at`,
ADD COLUMN `round` int(11) DEFAULT NULL AFTER `tournament_id`,
ADD COLUMN `bracket_index` int(11) DEFAULT NULL AFTER `round`;

-- Add Foreign Key
ALTER TABLE `typing_matches`
ADD CONSTRAINT `typing_matches_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE;
