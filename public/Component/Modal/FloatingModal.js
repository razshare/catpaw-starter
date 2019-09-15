Components.$init("Modal/FloatingModal",function(){
    this.data={
        title: "Add to apps",
        message: "Would you like to add this service to your app list?"
    };

    this.$onReady=()=>{
        let $this = this;
        this.classList.add("modal");
        //this.classList.add("modal-fixed-footer");
        let content = create(".modal-content",[...$this.children]);

        let cancel = create("Button","Cancel");
        let confirm = create("Button","Confirm");

        let footer = create(".modal-footer",[cancel,confirm]);

        this.appendChild(content);
        this.appendChild(footer);

        

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
    
});