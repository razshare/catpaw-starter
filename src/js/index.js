(async ()=>{
    //=============LOAD COMPONENTS HERE
    await use.component("Assets/Button");
    await use.component("Assets/PrimaryButton");
    await use.component("Assets/ArticleButton");
    await use.component("Assets/NavButton");
    //loading navigation bar
    await nav.component("$/NavMenu");
    //loading content area
    await main.component("$/Content");


    //=============DEFINE ROUTES HERE
    await use.route("^/(home)?$",location=>{
        content.component("$/Views/Home");
    });
    await use.route("^/about$",location=>{
        content.component("$/Views/About");
    });
    await use.route("^/contacts$",location=>{
        content.component("$/Views/Contacts");
    });
    await use.route("^/article/(?=.*$)",location=>{
        content.component("$/Views/Article",{
            article: location.args[0]
        });
    });
})();