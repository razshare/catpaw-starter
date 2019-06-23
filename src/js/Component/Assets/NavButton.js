Component.NavButton=function(){
    this.extends("Button");
    
    this.classList.add("p-5");
    this.classList.remove("rounded");
    this.classList.add("border-r");
    this.addEventListener("click",e=>{
        if(!this.dataset.view) return;
        content.module("Views/"+this.dataset.view);
        state(this.dataset.state);
    });
    this.data={
        title:"this is a title"
    };
};