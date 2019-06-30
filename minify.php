<?php
require_once __DIR__.'/vendor/autoload.php';

use MatthiasMullie\Minify;
use com\github\tncrazvan\CatPaw\Tools\Strings;

define("DEBUG",true);

$css = __DIR__."/src/css/minified.css";
Strings::minify([
    "https://fonts.googleapis.com/icon?family=Material+Icons",
    __DIR__."/src/css/materialize.css",
    __DIR__."/src/css/style.css"
],$css,!DEBUG);
echo "CSS minified in $css\n";

$js=__DIR__."/src/js/minified.js";
Strings::minify([
    __DIR__."/vendor/tncrazvan/elk/Main.js",
    __DIR__."/src/js/materialize.js",
    __DIR__."/vendor/tncrazvan/book/Book.js",
    __DIR__."/src/js/Component/Views/Article.js",
    __DIR__."/src/js/Component/Views/Home.js",
    __DIR__."/src/js/Component/Wrappers/Nav.js",
    __DIR__."/src/js/Component/Wrappers/Logo.js",
    __DIR__."/src/js/Component/Wrappers/Content.js",
    __DIR__."/src/js/Component/Assets/Button.js",
    __DIR__."/src/js/Component/Assets/DeleteArticle.js",
    __DIR__."/src/js/Component/Assets/SubmitArticle.js",
    __DIR__."/src/js/Component/Assets/NavButton.js",
    __DIR__."/src/js/Component/Assets/ArticlesList.js",
    __DIR__."/src/js/index.js"
],$js,!DEBUG);
echo "JS minified in $js\n";