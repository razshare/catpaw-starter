configure:
	@printf "\
	name = out/app\n\
	main = src/main.php\n\
	libraries = src/lib\n\
	environment = env.ini\n\
	match = \"/(^\.\/(\.build-cache|src|vendor)\/.*)|(^\.\/(\.env|env\.ini|env\.yml))/\"\n\
	" > build.ini && printf "Build configuration file restored.\n"
	composer update
	composer dump-autoload -o

clean:
	rm app.phar -f
	rm vendor -fr

test: vendor/bin/phpunit
	php \
	-dxdebug.mode=off \
	-dxdebug.start_with_request=no \
	vendor/bin/phpunit tests

fix: vendor/bin/php-cs-fixer
	php \
	-dxdebug.mode=off \
	-dxdebug.start_with_request=no \
	vendor/bin/php-cs-fixer fix .

start: vendor/bin/catpaw src/main.php
	php \
	-dxdebug.mode=off \
	-dxdebug.start_with_request=no \
	-dopcache.enable_cli=1 \
	-dopcache.jit_buffer_size=100M \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php

dev: vendor/bin/catpaw src/main.php
	php \
	-dxdebug.mode=debug \
	-dxdebug.start_with_request=yes \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php

watch: vendor/bin/catpaw src/main.php
	php \
	-dxdebug.mode=off \
	-dxdebug.start_with_request=no \
	vendor/bin/catpaw \
	--environment=env.ini \
	--libraries=src/lib \
	--main=src/main.php \
	--resources=src \
	--watch \
	--spawner="php -dxdebug.mode=debug -dxdebug.start_with_request=yes"

build: vendor/bin/catpaw-cli
	test -f build.ini || make configure
	test -d out || mkdir out
	php \
	-dxdebug.mode=off \
	-dxdebug.start_with_request=no \
	-dphar.readonly=0 \
	vendor/bin/catpaw-cli \
	--build \
	--optimize
