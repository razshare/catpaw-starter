<?php
require_once __DIR__.'/vendor/autoload.php';

use MatthiasMullie\Minify;
use com\github\tncrazvan\CatPaw\Tools\Strings;

$css = __DIR__."/src/css/minified.css";
Strings::minify([
    __DIR__."/src/css/materialize.css",
    __DIR__."/src/css/style.css"
],$css);
echo "CSS minified in $css\n";

$js=__DIR__."/src/js/minified.js";
Strings::minify([
    //__DIR__."/vendor/tncrazvan/elk/Main.js",
    __DIR__."/src/js/materialize.js",
    __DIR__."/vendor/tncrazvan/book/Book.js",
    __DIR__."/src/js/Component/Views/Article.js",
    __DIR__."/src/js/Component/Wrappers/Nav.js",
    __DIR__."/src/js/Component/Wrappers/Content.js",
    __DIR__."/src/js/Component/Assets/Button.js",
    __DIR__."/src/js/Component/Assets/NavButton.js",
    __DIR__."/src/js/index.js"
],$js);
echo "JS minified in $js\n";