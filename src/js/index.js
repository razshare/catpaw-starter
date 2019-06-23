(async ()=>{
    //loading navigation bar
    await nav.module("NavMenu");
    //loading content area
    await main.module("Content");


    //=============DEFINE ROUTES HERE
    await use.route("^/(home)?$",location=>{
        content.module("Views/Home");
    });
    await use.route("^/about$",location=>{
        content.module("Views/About");
    });
    await use.route("^/contacts$",location=>{
        content.module("Views/Contacts");
    });
    await use.route("^/article/(?=.*$)",location=>{
        content.module("Views/Article",{
            article: location.args[0]
        });
    });
})();