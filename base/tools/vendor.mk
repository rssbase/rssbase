vendor: composer.lock
	@composer install --optimize-autoloader
	@touch -f $@

composer.lock: composer.json
	@composer update
	@touch -f $@
