document.addEventListener("DOMContentLoaded", async function(event) { 
    // Check that service workers are supported
    window.install = null;
    if ('serviceWorker' in navigator) {
        // Use the window load event to keep the page load performant
        navigator.serviceWorker.register('/worker.js');
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            install = e;

            (function poll(){
                if(modalBottom){
                    if(!localStorage["autoprompted"])
                        modalBottom.open();
                    localStorage.setItem("autoprompted",true);
                    return;
                }
                setTimeout(poll,500);
            })();
        });
    }
    
    //loading content area
    await main.template("Wrappers/Nav");
    await main.template("Wrappers/Content");
    //=============DEFINE ROUTES HERE
    await use.route("^/(home|start)?$",location=>{
        content.template("Views/Home");
    });
    await use.route("^/documentation$",location=>{
        content.template("Views/Documentation");
    });
});