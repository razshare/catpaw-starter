<?php
namespace api\http;

use com\github\tncrazvan\catpaw\tools\ServerFile;

return fn(string &$username) => ServerFile::include('../public/index.php',$username);