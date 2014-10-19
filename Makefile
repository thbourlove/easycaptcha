ctags:
	ctags -R --fields=+aimS --languages=php --php-kinds=cidf --exclude=tests

cscope:
	find . -name '*.php' > ./cscope.files
	cscope -b
	rm cscope.files

test:
	vendor/bin/phpunit --coverage-text

build-dev:
	composer install

build:
	composer install --no-dev

demo:
	php -S 0.0.0.0:8999 -t examples/
