### Установка библиотеки

 ```sh 
composer require megabonus/laravel-affiliate
```

### Публикация config

 ```sh 
php artisan vendor:publish --provider="Megabonus\Laravel\Affiliate\Providers\AffiliateServiceProvider" --tag=config
```

### Прописываем provider и alias (config/app.php)

 ```sh 
\Megabonus\Laravel\Affiliate\Providers\AffiliateServiceProvider::class,
-----------------------------------------------------------------------
'Affiliate' => \Megabonus\Laravel\Affiliate\Facades\Affiliate::class,
```

Теперь фасад доступен в любом месте приложения 

 ```sh 
Affiliate::check('https://www.aliexpress.us/item/2255799974540002.html', false)
```
