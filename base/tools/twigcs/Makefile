vendor/bin/rector: vendor
vendor/bin/config-transformer: vendor

vendor: composer.lock
	composer install
	@touch -f $@

composer.lock: composer.json
	composer update
	@touch -f $@
