# PayDunya Lotto

## Contexte
PayDunya Lotto est une loterie où les participants peuvent jouer en achetant un billet au prix de 500 FCFA. Une fois le paiement du billet effectué, le joueur pourra ensuite choisir 7 nombres distincts compris entre 1 et 50 pour participer au prochain tirage.

## Les profils disponibles dans la solution
- Les utilisateurs
- Les administrateurs

## Fonctionnalités par profils
https://docs.google.com/document/d/122qylRTeTwBDIjW1YianodSRYoh_gQf2z-UzKYXaiNg/edit

## Pré-requis
- PHP > 8.1 (installer et disponible en ligne de commande)
- Composer (installer et disponible en ligne de commande)
- Une base de donnée (De préférence MySql)
- Configurer son fichier d'environment à partir du fichier .env.example (Plus précisément la partir relative à la base de donnée)


## Étapes de déploiement
    git clone https://github.com/Iso-Doss/PayDunya-Lotto.git paydunya-lotto
    
    cd paydunya-lotto
    
    composer install
    
    npm install
    
    php artisan migrate (onfigurer son fichier d'environment à partir du fichier .env.example (Plus précisément la partir relative à la base de donnée))
    
    php artisan storage:link
    
    php artisan serve
    
    php artisan queue:listen

    Importer dans votre base de donner les donnés au format .sql disponible dans le dossier database/data (countries.sql, statutses.sql, tickets.sql, transaction_types.sql et users.sql)

## Comptes d'utilisateurs
- Utilisateur / Joueur : 
    - Email : paydunyalotto@gmail.com
    - Mot de passe : paydunyalotto@gmail.com
- Administrateur : 
    - Email : paydunyalotto@gmail.com
    - Mot de passe : paydunyalotto@gmail.com
