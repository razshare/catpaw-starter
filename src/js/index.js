(async ()=>{
    //loading navigation bar
    await nav.template("NavMenu");
    //loading content area
    let result = await main.template("Content");

    //=============DEFINE ROUTES HERE
    await use.route("^/(home)?$",location=>{
        content.template("Views/Home");
    });
    await use.route("^/about$",location=>{
        content.template("Views/About");
    });
    await use.route("^/contacts$",location=>{
        content.template("Views/Contacts");
    });
    await use.route("^/article/(?=.*$)",location=>{
        content.template("Views/Article",{
            article: location.args[0]
        });
    });
})();