.PHONY: help, create_challenge, dev, test, test-group

# Variables
PORT ?= 8000

# Commands
help: ## Display this help message
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# Get the arg parameter and give it to ./scripts/new_challenge.sh
create_challenge: ## Create a new challenge file (make create_challenge code=CHALLENGE_CODE)
	@$(eval code ?=)
	$(shell ./scripts/new_challenge.sh $(code))
	./scripts/new_challenge.sh $(code)

dev: ## Launch PHP dev server at localhost:8000 for example
	php -S localhost:$(PORT)

test: ## Run all phpunit tests
	./vendor/bin/phpunit tests

test-group: ## Run phpunit tests based on the group in "group" variable (make test-group group=GROUP_NAME)
	./vendor/bin/phpunit --group $(group) tests

lint: ## Run Psalm static analysis
	./vendor/bin/psalm