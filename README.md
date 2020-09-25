

```
composer install
vendor/bin/doctrine orm:schema-tool:create
php -d memory_limit=-1 benchmark.php
```
