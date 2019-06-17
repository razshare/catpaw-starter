(async ()=>{
    //=============LOAD COMPONENTS HERE
    await use.js("Component/Assets/PageWrapper");
    await use.js("Component/Assets/Button");
    await use.js("Component/Assets/PrimaryButton");
    await use.js("Component/Assets/ArticleButton");
    await use.js("Component/Assets/NavButton");
    //loading navigation bar
    await nav.view("NavMenu");
    //loading content area
    await main.view("Content");


    //=============DEFINE ROUTES HERE
    await use.route("^/(home)?$",location=>{
        content.view("Home");
    });
    await use.route("^/about$",location=>{
        content.view("About");
    });
    await use.route("^/contacts$",location=>{
        content.view("Contacts");
    });
    await use.route("^/article/(?=.*$)",location=>{
        content.view("Article",{
            article: location.args[0]
        });
    });
})();