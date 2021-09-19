<?php
namespace api\v1;

use net\razshare\catpaw\attributes\http\methods\GET;
use net\razshare\catpaw\attributes\http\Path;
use net\razshare\catpaw\attributes\Produces;
use net\razshare\catpaw\attributes\Singleton;

#[Singleton]
#[Path("/api/v1/test")]
class Test{

    #[GET]
    #[Produces("text/plain,text/html")]
    public function todo():string{
        return "todo";
    }
}