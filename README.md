# php-game-of-life
Run:  
```
cd docker
sudo docker-compose up -d --build
sudo docker exec -it php_web /bin/bash
composer install
composer dump-autoload
php src/index.php
```

NOTE: Modify config.json file to change the game.