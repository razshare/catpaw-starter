Components.FloatingModal=function(){
    this.innerHTML = "";
    let $this = this;
    this.classList.add("modal");
    //this.classList.add("modal-fixed-footer");
    let header = create("h4",$this.getAttribute("header"));
    let message = create("p",$this.getAttribute("message"));
    let content = create(".modal-content",[header,message]);

    let cancel = create("Button","Cancel");
    let confirm = create("Button","Confirm");

    let footer = create(".modal-footer",[cancel,confirm]);

    this.appendChild(content);
    this.appendChild(footer);

    this.data={
        header: "Add to apps",
        message: "Would you like to add this service to your app list?"
    };

    cancel.addEventListener("click",e=>{
       this.close();
    });

    confirm.addEventListener("click",e=>{
        install.prompt();
        install
            .userChoice
            .then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the A2HS prompt');
                } else {
                    console.log('User dismissed the A2HS prompt');
                }
                deferredPrompt = null;
            });
        this.close();
    });

    let instance = M.Modal.init(this);

    this.open=function(){
        //localStorage["promped"] = true;
        instance.open();
    };

    this.close=function(){
        instance.close();
    };

    this.destroy=function(){
        instance.destroy();
    };

};