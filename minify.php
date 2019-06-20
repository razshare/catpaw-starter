<?php
require_once __DIR__.'/vendor/autoload.php';

use MatthiasMullie\Minify;

$css = new Minify\CSS(__DIR__."/src/css/tailwind.css");
$css->add(__DIR__."/src/css/style.css");
$css->minify(__DIR__."/src/css/minified.css");

$js = new Minify\JS(__DIR__."/vendor/tncrazvan/elk/Main.js");
$js->add(__DIR__."/src/js/index.js");
$js->add(__DIR__."/vendor/tncrazvan/book/Book.js");
$js->add(__DIR__."/src/js/index.js");
$js->add(__DIR__."/src/js/Component/Assets/ArticleButton.js");
$js->add(__DIR__."/src/js/Component/Assets/Button.js");
$js->add(__DIR__."/src/js/Component/Assets/NavButton.js");
$js->add(__DIR__."/src/js/Component/Assets/PageWrapper.js");
$js->add(__DIR__."/src/js/Component/Assets/PrimaryButton.js");
$js->add(__DIR__."/src/js/Component/About.js");
$js->add(__DIR__."/src/js/Component/Article.js");
$js->add(__DIR__."/src/js/Component/Contacts.js");
$js->add(__DIR__."/src/js/Component/Content.js");
$js->add(__DIR__."/src/js/Component/Home.js");
$js->add(__DIR__."/src/js/Component/NavMenu.js");

$js->minify(__DIR__."/src/js/minified.js");