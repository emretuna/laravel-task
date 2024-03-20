## About App

To use locally run docker-compose file for db

```bash
docker-compose up -d
```

This will set up mariadb in docker container.

Run composed install command then run db migration

```bash
composer install
php artisan migrate
```

Run npm run dev so that laravel will bundle libraries.

```bash
npm run dev
```

Lastly

```bash
php artisan serve
```

and it will start running on localhost:8000 (port may differ if occupied)
