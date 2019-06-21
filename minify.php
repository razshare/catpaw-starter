<?php
require_once __DIR__.'/vendor/autoload.php';

use MatthiasMullie\Minify;
use com\github\tncrazvan\CatPaw\Tools\Strings;


Strings::minify([
    __DIR__."/src/css/tailwind.css",
    __DIR__."/src/css/style.css"
],__DIR__."/src/css/minified.css");

Strings::minify([
    __DIR__."/vendor/tncrazvan/elk/Main.js",
    __DIR__."/src/js/index.js",
    __DIR__."/vendor/tncrazvan/book/Book.js",
    __DIR__."/src/js/index.js",
    __DIR__."/src/js/Component/Assets/ArticleButton.js",
    __DIR__."/src/js/Component/Assets/Button.js",
    __DIR__."/src/js/Component/Assets/NavButton.js",
    __DIR__."/src/js/Component/Assets/PageWrapper.js",
    __DIR__."/src/js/Component/Assets/PrimaryButton.js",
    __DIR__."/src/js/Component/About.js",
    __DIR__."/src/js/Component/Article.js",
    __DIR__."/src/js/Component/Contacts.js",
    __DIR__."/src/js/Component/Content.js",
    __DIR__."/src/js/Component/Home.js",
    __DIR__."/src/js/Component/NavMenu.js",
],__DIR__."/src/js/minified.js");