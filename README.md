# Dette

## Projet

Ce projet est en ligne sur le site : https://dette.gcousin.site/

L'ojectif de ce projet est d'avoir un retour sur ce que je doit à mes amis et ce qu'il me doivent.

On peut aussi retrouver les dettes qui sont du à un abonnment. Ces dettes vont s'incrémenter tous les mois automatiquement.

## Installation
```
composer install
yarn install
yarn encore prod
composer dump-env prod
```

## Installation prod

Run file ``installation.sh``

```shell script
#!/bin/sh
rm -rf dette
git clone https://github.com/Ashay78/dette.git
cd dette
'' > .env
echo "psql password :"
read -r mdp
var='DATABASE_URL="pgsql://gcousin:'$mdp'@127.0.0.1:5432/dette"'
echo "$var" >> .env
echo "APP_SECRET=c7652897af658b9a1123fede3477a107" >> .env
echo "APP_ENV=dev" >> .env
composer install
yarn install
yarn encore prod
composer dump-env prod
```


