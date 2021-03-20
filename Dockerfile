ARG PHP_VERSION=8.0

# "php" stage
FROM php:${PHP_VERSION}-cli-alpine AS cli_php

# persistent / runtime deps
RUN apk add --no-cache \
    git \
;

ARG APCU_VERSION=5.1.19
RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		libzip-dev \
		zlib-dev \
	; \
    docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		intl \
		zip \
	; \
    pecl install \
		apcu-${APCU_VERSION} \
	; \
    pecl clear-cache; \
	docker-php-ext-enable \
		apcu \
		opcache \
	; \
    runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
    apk add --no-cache --virtual .phpexts-rundeps $runDeps; \
	apk del .build-deps

RUN ln -s $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
VOLUME /var/run/php
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
WORKDIR /srv/app
RUN composer create-project "razshare/catpaw-template" . --stability=$STABILITY --prefer-dist --no-dev --no-progress --no-interaction; \
	composer clear-cache
###> recipes ###
###< recipes ###
COPY . .
RUN composer update \
    && composer dump-autoload -o
VOLUME /srv/app/var
CMD ["php","./scripts/start.php"]