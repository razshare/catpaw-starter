load:
	composer update
	composer dump-autoload -o

dev: src/main.php
	php -dxdebug.mode=debug -dxdebug.start_with_request=yes vendor/bin/catpaw --libraries=src/lib --main=src/main.php

watch: src/main.php
	php -dxdebug.mode=debug -dxdebug.start_with_request=yes vendor/bin/catpaw --libraries=src/lib --main=src/main.php --watch --php='php -dxdebug.mode=debug -dxdebug.start_with_request=yes'

start: src/main.php
	php -dopcache.enable_cli=1 -dopcache.jit_buffer_size=100M vendor/bin/catpaw --libraries=src/lib --main=src/main.php

configure:
	@printf "\
	name = out/app\n\
	main = src/main.php\n\
	libraries = src/lib\n\
	environment = env.ini\n\
	match = \"/(^\.\/(\.build-cache|src|vendor|bin)\/.*)|(^\.\/(\.env|env\.ini|env\.yml))/\"\n\
	" > build.ini && printf "Build configuration file restored.\n"

clean:
	rm app.phar -f
	rm vendor -fr

build: clean load
	php -dphar.readonly=0 vendor/bin/catpaw-cli --build --optimize