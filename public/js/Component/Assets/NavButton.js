Components.NavButton=function(){
    this.extends("Button");

    this.$foreach=item=>{
        console.log(item.$key);
        item.onclick=()=>{
            content.template(item.dataset.view);
            state(item.dataset.state);
        };
    };
    

    
    
    this.data={
        enabled: true,
        text:"Home",view:"Views/Home",state:"/Home",

        list: [
            {text:"Home",view:"Views/Home",state:"/Home"},
            {text:"About",view:"Views/About",state:"/About"}
        ]
    };
};