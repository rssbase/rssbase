vendor/bin/php-cs-fixer: vendor

vendor: composer.lock
	composer install
	@touch -f $@

composer.lock: composer.json
	composer update
	@touch -f $@
