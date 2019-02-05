#INSTRUCTIONS

Configurations requises :
 - php >= 7
 - composer
 - node
 - yarn
 - git
 
Si vous n'avez pas ***yarn*** vous pouvez l'installer en suivant les instructions
[ici.](https://yarnpkg.com/en/docs/install). C'est plus rapide que **npm**.

A taper dans la console (terminal) :

cloner le projet : 

    git clone https://rzjosia@bitbucket.org/deust/daschow_web.git

Installer les paquets composer 

    composer install
    
Installer les paquets javascript :

    yarn install
    
Modifier le fichier ***.env*** pour la base de donnée

    DB_DATABASE=nom_de_votre_bdd
    DB_USERNAME=nom_utilisateur_bd
    DB_PASSWORD=mot_de_passe_db

Lancer la migration (permet de créer les table requises dans la base de données)
    
    php artisan migrate

Démarrer le serveur :

    php artisan serve

Ouvrir l'addrese indiqué dans le terminal sur votre navigateur

Pour que chaque modification au sein des ressources soient prises en compte pendant le developement,
il est conseillé de taper cette commande

    yarn run watch
