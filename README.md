# Get-Address
- Creating an API using Slim framework for PHP.

# Additional Steps
- Download the project to your computer.
- If you don’t have composer for PHP run this in the directory you want to install composer in:
``` bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '8a6138e2a05a8c28539c9f0fb361159823655d7ad2deecb371b04a83966c61223adc522b0189079e3e9e277cd72b8897') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
- If you want to install globally run this:
```bash
mv composer.phar /usr/local/bin/composer
````
- Installing Slim in <em>address-api<em> folder, run the following commands:
```bash
cd WHERE_YOU_HAVE_DOWNLOADED_THE_PROJECT/address-api
composer require slim/slim:"4.*"
composer require slim/psr7
```
- After doing this a <em>**vendor**</em> will be created in <em>address-api</em> folder.
- Now you can run a local server in your computer to run the api and the project.
