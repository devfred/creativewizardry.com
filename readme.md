# CreativeWizardry

## Changelog

## TODO
- (DONE) Setup Content Form	
- (DONE) Setup taxonomy(categories/tags) for content items.
- (DONE) Connect newsletter form to mail service(MailChimp or ConstantContact)
- (DONE) Pagination 
- (DONE) Forms 
	- (DONE) Content
	- (DONE) Tag 
	- (DONE) Category
- (DONE) Search
- (DONE) Comments 
- Content Negotiation
- Make excerpt optional
- (DONE)Organize routes
- (DONE) Move Search to top nav bar
- Edits/Delete Functionality
	- Tags
	- Categories
	- (DONE) Content Items
- Create Admin Sections
	- Dashboard 
	- (DONE) Content
	- (DONE) Categories
	- (DONE) Tags

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
