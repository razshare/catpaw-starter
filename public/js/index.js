document.addEventListener("DOMContentLoaded", async function(event) { 
    await use.js("Component/Inputs/TextInput");

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