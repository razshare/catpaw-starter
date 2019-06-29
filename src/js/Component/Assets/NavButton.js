Components.NavButton=function(){
    this.addEventListener("click",e=>{
        content.template("Views/"+this.dataset.view);
        state(this.dataset.state);
    });

    if(this.hasAttribute("@foreach")){
        this.data={
            list:[
                {text:"Home",state:"/home",view:"Home"},
                {text:"About",state:"/about",view:"About"},
                {text:"Contacts",state:"/contacts",view:"Contacts"},
                {text:"Article",state:"/article/1",view:"Article"}
            ]
        }
    }
};