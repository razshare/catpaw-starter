Components.NavButton=function(){
    this.extends("Button");

    this.$origin=()=>{
        window.navbtn = this;
        this.data={
            enabled: true,
            list: [
                {text:"Home",view:"Views/Home",state:"/Home",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]},
                {text:"About",view:"Views/About",state:"/About",others:["a","b","c"]}
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