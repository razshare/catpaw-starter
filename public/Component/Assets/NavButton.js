Components.NavButton=function(){
    this.extends("Button");

    this.$origin=()=>{
        window.navbtn = this;
        this.data={
            enabled: true,
            text:"Home",view:"Views/Home",state:"/Home",
    
            list: [
                {text:"Home",view:"Views/Home",state:"/Home"},
                {text:"About",view:"Views/About",state:"/About"}
            ]
        };
    };

    this.$foreach=()=>{
        
        window.lastbtn = this;
        this.onclick=()=>{
            content.template(this.dataset.view);
            state(this.dataset.state);
        };
    };
};