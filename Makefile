install:
	@echo ------------------------------- composer install -------------------------------
	@composer install

dump-autoload autoload:
	@echo ------------------------------- composer dump-autoload -------------------------------
	@composer dump-autoload

run:
	@echo ------------------------------- php ./example/example.php -------------------------------
	@php ./example/example.php

setup: install dump-autoload