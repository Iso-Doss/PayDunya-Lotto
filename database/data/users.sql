INSERT INTO `users` (`id`, `profile`, `email`, `password`, `name`, `user_type`, `first_name`, `last_name`, `user_name`,
                     `registration_number`, `phone_number`, `ifu`, `avatar`, `gender`, `birthday`, `city`, `address`,
                     `website`, `has_default_password`, `activated_at`, `verified_at`, `email_verified_at`,
                     `phone_number_verified_at`)
VALUES (null, 'CUSTOMER', 'paydunyalotto@gmail.com', '$2y$10$Zpq/S05v2J6KzYR1ilhq7.pJJLHc9wOO05rWToYC2zuf2StPeCSBq',
        NULL, 'PHYSICAL-PERSON', 'Lotto', 'PAYDUNYA', NULL, 'registration-6516da286e710', '97000000', NULL, NULL, NULL,
        NULL, NULL, NULL, NULL, 0, current_timestamp, current_timestamp, current_timestamp, current_timestamp),
       (null, 'ADMINISTRATOR', 'paydunyalotto@gmail.com', '$2y$10$Zpq/S05v2J6KzYR1ilhq7.pJJLHc9wOO05rWToYC2zuf2StPeCSBq',
        NULL, 'PHYSICAL-PERSON', 'Lotto', 'PAYDUNYA', NULL, 'registration-6516da286e711', '97000001', NULL, NULL, NULL,
        NULL, NULL, NULL, NULL, 0, current_timestamp, current_timestamp, current_timestamp, current_timestamp);
