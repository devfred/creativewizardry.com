# CreativeWizardry

## Changelog

## TODO
- Content Negotiation
- Make excerpt optional
- Create Admin Sections
	- Dashboard 

## Useful Commands

### Composer Update 
```composer update```

### Run unit tests
```vendor/bin/phpunit -debug```

### Reseed DB
```php artisan migrate:refresh --seed```

## Notes

### Laravel Workflow 
- Create the model and migrations

```php artisan make:model [ModelName]```

- Create a controller

```php artisan make:controller --plain [ControllerName]Controller```

- Add route for created controller
- Create a view
- Setup request if needed
