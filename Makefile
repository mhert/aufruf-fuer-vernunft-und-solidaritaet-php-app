APP_ENV:=test
CONNECTION_NAME_DEFAULT:=default
ENTITY_MANAGER_NAME_DEFAULT:=default

.PHONY: help
help:
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: it
it: coding-standards static-code-analysis tests

.PHONY: coding-standards
coding-standards: vendor
	mkdir -p build/php-cs-fixer
	yamllint -c yamllint.config.yaml --strict .
	tools/composer validate --strict
	tools/composer normalize --diff
	tools/php-cs-fixer fix --config=php-cs-fixer.config.php --diff --verbose

.PHONY: dependency-analysis
dependency-analysis: vendor
	tools/composer-require-checker check --config-file=$(shell pwd)/composer-require-checker.json

.PHONY: static-code-analysis
static-code-analysis: vendor
	mkdir -p build/phpstan
	tools/phpstan --configuration=phpstan.config.neon clear-result-cache
	tools/phpstan --configuration=phpstan.config.neon --memory-limit=-1

.PHONY: tests
tests: vendor
	mkdir -p build/phpunit
	tools/phpunit --configuration=test/Unit/phpunit.xml
	tools/phpunit --configuration=test/Integration/phpunit.xml
	tools/phpunit --configuration=test/Functional/phpunit.xml

vendor: composer.json composer.lock
	tools/composer install --no-interaction --no-progress
