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

kill:
	docker compose kill
	docker compose rm --force

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

##
### Utils

ecs: ## Run ecs     -- https://github.com/symplify/easy-coding-standard
	@tools/ecs/bin --fix

phpstan: ## Run phpstan -- https://phpstan.org
	@tools/phpstan/bin

psalm: ## Run psalm   -- https://psalm.dev
	@tools/psalm/bin

rector: ## Run rector  -- https://getrector.org
	@tools/rector/bin -v

twigcs: ## Run twigcs  -- https://github.com/friendsoftwig/twigcs
	@tools/twigcs/bin


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
