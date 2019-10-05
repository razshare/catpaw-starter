<?php
return [
    "css"=>[
        "input"=>[
            "www/css/fonts/meterial.css",
            "www/css/materialize.css"
        ],
        "output"=>"www/minified/minified.css"
    ],
    "js"=>[
        "input"=>[
            //MATERIALIZE
            "www/js/Materialize/materialize.js",
    
            //MAIN LIBS
            "vendor/tncrazvan/elk/Main.js",
    
            //WRAPPERS
            "www/Component/Wrapper/Nav.js",
            "www/Component/Wrapper/Content.js",
            "www/Component/Wrapper/Container.js",
    
            //MODALS
            "www/Component/Modal/FloatingModal.js",
    
            //INPUTS
            "www/Component/Form/Input/TextInput.js",
    
            //BUTTONS
            "www/Component/Button.js",
            "www/Component/NavButton.js",
    
            //INDEX
            "www/index.js"
        ],
        "output"=>"www/minified/minified.js"
    ]
];