document.addEventListener("DOMContentLoaded", async function(event) { 
    const ACTION_DEFAULT = 0;
    const ACTION_INSTALL = 1;
    window.navButtons= {
        list: [
            {text:"Home",view:"Views/Home",state:"/Home",action:ACTION_DEFAULT},
            {text:"About",view:"Views/About",state:"/About",action:ACTION_INSTALL}
        ]
    }

    //loading content area
    await main.template("Wrappers/Nav");
    await main.template("Wrappers/Content");
    //=============DEFINE ROUTES HERE
    await use.route("^/(home|start)?$",location=>{
        content.template("Views/Home");
    });
    await use.route("^/about$",location=>{
        content.template("Views/About");
    });
});