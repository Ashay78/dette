# Dette

## Installation prod

Run file ``installation.sh``

```shell script
#!/bin/sh
rm -rf dette
git clone https://github.com/Ashay78/dette.git
cd dette
sed -i '$ d' .env
echo "psql password :"
read -r mdp
var='DATABASE_URL="pgsql://gcousin:'$mdp'@127.0.0.1:5432/dette"'
echo "$var" >> .env
composer install
yarn install
yarn encore prod
composer dump-env prod
```


