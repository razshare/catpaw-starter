(async ()=>{
    //loading navigation bar
    await nav.module("NavMenu");
    //loading content area
    await main.module("Content");


    //=============DEFINE ROUTES HERE
    await use.route("^/(home)?$",location=>{
        content.module("Home");
    });
    await use.route("^/about$",location=>{
        content.module("About");
    });
    await use.route("^/contacts$",location=>{
        content.module("Contacts");
    });
    await use.route("^/article/(?=.*$)",location=>{
        content.module("Article",{
            article: location.args[0]
        });
    });
})();