document.addEventListener("DOMContentLoaded", async function(event) {

    //SETUP MAIN TEMPLATE
    await main.template("Wrapper/Nav");
    await main.template("Wrapper/Content");

    //DEFINE ROUTES
    await use.route("^/(home|start)?$",location=>{
        content.template("View/Home");
    });
    await use.route("^/about$",location=>{
        content.template("View/About");
    });
    
});