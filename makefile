install:
	composer install
	composer dump-autoload -o

update:
	composer update
	composer dump-autoload -o

dev: vendor/bin/catpaw src/main.php
	php -dxdebug.mode=debug -dxdebug.start_with_request=yes \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php \
	--die-on-stdin

watch: vendor/bin/catpaw src/main.php
	inotifywait \
	-e modify,create,delete_self,delete,move_self,moved_from,moved_to \
	-r -m -P --format '%e' src | \
	php -dxdebug.mode=off -dxdebug.start_with_request=no \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php \
	--spawner="php -dxdebug.mode=debug -dxdebug.start_with_request=yes" \
	--wait

start: vendor/bin/catpaw src/main.php
	php -dxdebug.mode=off -dxdebug.start_with_request=no \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php

build: vendor/bin/catpaw-cli
	mkdir out -p
	test -f build.ini || make configure
	php -dxdebug.mode=off -dxdebug.start_with_request=no \
	-dphar.readonly=0 \
	vendor/bin/catpaw-cli \
	--build \
	--optimize

clean:
	rm app.phar -f
	rm vendor -fr

configure:
	@printf "\
	name = out/catpaw\n\
	main = src/main.php\n\
	libraries = src/lib\n\
	environment = env.ini\n\
	match = \"/(^\.\/(\.build-cache|src|vendor|bin)\/.*)|(^\.\/(\.env|env\.ini|env\.yml))/\"\n\
	" > build.ini && printf "Build configuration file restored.\n"
	make install

fix: vendor/bin/php-cs-fixer
	php -dxdebug.mode=off -dxdebug.start_with_request=no vendor/bin/php-cs-fixer fix src && \
	php -dxdebug.mode=off -dxdebug.start_with_request=no vendor/bin/php-cs-fixer fix tests

check: vendor/bin/php-cs-fixer
	php -dxdebug.mode=off -dxdebug.start_with_request=no vendor/bin/php-cs-fixer check src && \
	php -dxdebug.mode=off -dxdebug.start_with_request=no vendor/bin/php-cs-fixer check tests

test: vendor/bin/phpunit
	php -dxdebug.mode=off -dxdebug.start_with_request=no vendor/bin/phpunit tests

hooks: vendor/bin/catpaw src/main.php
	php -dxdebug.mode=off -dxdebug.start_with_request=no \
	vendor/bin/catpaw-cli --install-pre-commit="make test"