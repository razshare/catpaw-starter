Component.NavButton=function(){
    this.extends("Button");
    
    console.log(this);
    this.classList.add("p-5");
    this.classList.remove("rounded");
    this.classList.add("border-r");
    this.addEventListener("click",e=>{
        /*if(!this.dataset.view) return;
        content.module("Views/"+this.dataset.view);
        state(this.dataset.state);*/
    });
    this.data={};
    this.data.sample = "hello";
    this.data.list= [
        {order: 0,state:"/home",view:"Home",text:"Home"},
        {order: 2,state:"/about",view:"About",text:"About"},
        {order: 1,state:"/contacts",view:"Contacts",text:"Contacts"}
    ];
};