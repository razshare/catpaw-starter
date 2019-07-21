<?php
require_once __DIR__.'/vendor/autoload.php';
use MatthiasMullie\Minify;
use com\github\tncrazvan\CatPaw\Tools\Strings;

define("DEBUG",true);

$input=[
    "css"=>[
        __DIR__."/src/css/fonts/meterial.css",
        __DIR__."/src/css/highlighter.css",
        __DIR__."/src/css/materialize.css",
        __DIR__."/src/css/style.css"
    ],
    "js"=>[
        //MAIN LIBS
        __DIR__."/vendor/tncrazvan/elk/Main.js",
        __DIR__."/src/js/materialize.js",
        __DIR__."/src/js/highlighter.js",
        //VIEWS
        //...
        //WRAPPERS
        __DIR__."/src/js/Component/Wrappers/Nav.js",
        __DIR__."/src/js/Component/Wrappers/Content.js",
        __DIR__."/src/js/Component/Wrappers/Container.js",
        //ASSETS
        __DIR__."/src/js/Component/Assets/Coding.js",
        __DIR__."/src/js/Component/Assets/Button.js",
        __DIR__."/src/js/Component/Assets/NavButton.js",
        __DIR__."/src/js/Component/Assets/DeleteArticle.js",
        __DIR__."/src/js/index.js"
    ]
];

$output=[
    "css"=>__DIR__."/src/css/minified.css",
    "js"=>__DIR__."/src/js/minified.js"
];


Strings::minify($input["css"],$output["css"],!DEBUG);
echo "CSS minified in ".$output["css"]."\n";
Strings::minify($input["js"],$output["js"],!DEBUG);
echo "JS minified in ".$output["js"]."\n";