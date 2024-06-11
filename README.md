# Order management backend

### Requirements:
* php 8.2
* composer v2
* docker

### Run following commands in root directory to setup and run project:
* composer install
* cp .env.example .env
* .vendor/bin/sail up -d
* .vendor/bin/sail artisan key:generate
* .vendor/bin/sail artisan jwt:secret
* .vendor/bin/sail artisan migrate --seed
