INSERT INTO `statuses` (`id`, `name`, `code`, `description`, `message`, `entity`, `priority_level`, `icon`, `color`)
VALUES (null, 'En attente du tirage', 'WAITING_DRAW', 'En attente du tirage', 'En attente du tirage', 'LOTTERY', 0,
        null, null),
       (null, 'Aucun gagnant', 'NO_WINNER', 'Aucun gagnant', 'Aucun gagnant', 'LOTTERY', 0,
        null, null),
       (null, 'Un gagnant', 'A_WINNER', 'Un gagnant', 'Un gagnant', 'LOTTERY', 0,
        null, null),
       (null, 'Plusieurs gagnants', 'MULTIPLE_WINNER', 'Plusieurs gagnants', 'Plusieurs gagnants', 'LOTTERY', 0,
        null, null),


       (null, 'En attente du tirage', 'WAITING_DRAW', 'En attente du tirage', 'En attente du tirage', 'LOTTERY_USER', 0,
        null, null),
       (null, 'Gagnant', 'WINNER', 'Gagnant', 'Gagnant', 'LOTTERY_USER', 0, null, null),
       (null, 'Perdant', 'LOSING', 'Perdant', 'Perdant', 'LOTTERY_USER', 0, null, null),


       (null, 'En attente', 'WAITING', 'En attente du tirage', 'En attente du tirage', 'TRANSACTION', 0, null, null),
       (null, 'Succès', 'SUCCESS', 'Succès', 'Succès', 'TRANSACTION', 0, null, null),
       (null, 'Échouée', 'FAILED', 'Échouée', 'Échouée', 'TRANSACTION', 0, null, null);
