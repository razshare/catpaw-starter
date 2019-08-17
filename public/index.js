document.addEventListener("DOMContentLoaded", async function(event) {

    //SETUP MAIN TEMPLATE
    await main.template("Wrappers/Nav");
    await main.template("Wrappers/Content");

    //DEFINE ROUTES
    await use.route("^/(home|start)?$",location=>{
        content.template("Views/Home");
    });
    await use.route("^/about$",location=>{
        content.template("Views/About");
    });
    
});