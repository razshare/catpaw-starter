Components.Content=function(){
    const ANIMATION_DURATION = 250;
    this.classList.add("row");
    this.classList.add("col");

    //mobile
    this.classList.add("s12");
    this.classList.add("offset-s0");

    //tablet
    this.classList.add("m12");
    this.classList.add("offset-m0");

    //desktop
    this.classList.add("l12");
    this.classList.add("offset-0");

    //large desktop
    this.classList.add("xl12");
    this.classList.add("offset-xl0");

    this.css({
        position: "relative",
        zIndex: 1,
        transition: "top "+ANIMATION_DURATION+"ms, opacity "+ANIMATION_DURATION+"ms"
    });
    
    this.change=function(templateName){
        return new Promise(resolve=>{
            this.css({
                opacity: 0,
                top: Pixel(-10)
            });
            setTimeout(async ()=>{
                await this.template(templateName);
                (resolve)();
            },ANIMATION_DURATION);
        });
    };
}