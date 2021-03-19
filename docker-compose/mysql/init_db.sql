DROP TABLE IF EXISTS `disburse`;
CREATE TABLE `disburse` (
  `id` bigint(20) unsigned NOT NULL,
  `amount` bigint(20) NOT NULL DEFAULT 0,
  `status` varchar(36) NOT NULL DEFAULT "",
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_code` varchar(36) NOT NULL,
  `account_number` varchar(36) NOT NULL,
  `beneficiary_name` varchar(36) NOT NULL,
  `remark` text,
  `receipt` text, 
  `time_served` timestamp,
  `fee` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE INDEX disburse_idx
ON disburse (id);

