#!/bin/sh

echo "Installation de paquets php"
composer install
echo ""

echo "Installation des paquets javascript"
yarn install
echo ""

echo "Modification du droit d'accès au storage"
sudo chmod 755 -R storage/
echo ""

if [[ ! -f ".env" ]]; then
    echo "créationd du fichier env"
    cp ./.env.example ./env
fi

echo "compilation en mode prod"
yarn run prod
echo ""

echo "génération du clé"
php artisan key:generate
echo ""

echo "L'installation est fini. Veuillez modifier le fichier les paramètres du fichier .env"
