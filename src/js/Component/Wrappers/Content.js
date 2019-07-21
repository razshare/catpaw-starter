Components.Content=function(){
    const ANIMATION_DURATION = 100;
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
        transition: "opacity "+ANIMATION_DURATION+"ms"
    });
    
    this.change=function(templateName){
        this.css({
            opacity: 0
        });
        setTimeout(async ()=>{
            await this.template(templateName);
            this.css({
                opacity: 1,
                top: 0
            });
        },ANIMATION_DURATION);
    };
}