##
### Project

.PHONY: install
install: ## Install project dependencies
install: vendor
	composer auto-scripts
	bin/console cache:warmup

.PHONY: clean
clean: ## Remove generated files
	rm -rf \
		vendor \
		tools/*/vendor \
		var/cache/* \
		var/log/*

##
### Utils

cs: ## Run php-cs-fixer
	tools/php-cs-fixer/bin -v

phpstan: ## Run phpstan
	tools/phpstan/bin

psalm: ## Run psalm
	tools/psalm/bin

rector: ## Run rector
	tools/rector/bin -v

twigcs: ## Run twigcs
	tools/twigcs/bin

##
### Tests

.PHONY: tests
tests: ## Run all tests
tests: tu tf

tu: ## Run unit tests
tu: vendor
	bin/phpunit --exclude-group functional

tf: ## Run functional tests
tf: vendor
	bin/phpunit --group functional

#
# Logical creation based on files
#

vendor: composer.lock
	composer install --prefer-dist --no-scripts
	composer dump-autoload --optimize --no-scripts
	@touch -f $@

.DEFAULT_GOAL := help
help: Makefile
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
