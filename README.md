# PayDunya Lotto

## Contexte
PayDunya Lotto est une loterie où les participants peuvent jouer en achetant un billet au prix de 500 FCFA. Une fois le paiement du billet effectué, le joueur pourra ensuite choisir 7 nombres distincts compris entre 1 et 50 pour participer au prochain tirage.

## Les profils disponibles dans la solution
- Les utilisateurs
- Les administrateurs

## Fonctionnalités par profils
### Un utilisateur aura la possibilité de
- Les utilisateurs
- Les administrateurs

## Diagramme de cas d’utilisation

## Diagramme de cas de classe

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
