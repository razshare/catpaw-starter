<?php
return [
    "css"=>[
        "input"=>[
            "src/www/css/fonts/meterial.css",
            "src/www/css/materialize.css"
        ],
        "output"=>"src/www/minified/minified.css"
    ],
    "js"=>[
        "input"=>[
            //MATERIALIZE
            "src/www/js/Materialize/materialize.js",
    
            //MAIN LIBS
            "vendor/tncrazvan/elk/Main.js",
    
            //WRAPPERS
            "src/www/Component/Wrapper/Nav.js",
            "src/www/Component/Wrapper/Content.js",
            "src/www/Component/Wrapper/Container.js",
    
            //MODALS
            "src/www/Component/Modal/FloatingModal.js",
    
            //INPUTS
            "src/www/Component/Form/Input/TextInput.js",
    
            //BUTTONS
            "src/www/Component/Button.js",
            "src/www/Component/NavButton.js",
    
            //INDEX
            "src/www/index.js"
        ],
        "output"=>"src/www/minified/minified.js"
    ]
];