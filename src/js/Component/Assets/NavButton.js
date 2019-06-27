Components.NavButton=function(){
    this.addEventListener("click",e=>{
        content.template("Views/"+this.dataset.view);
        state(this.dataset.state);
    });

    if(this.hasAttribute("@foreach")){
        this.data={
            list:[
                {content:create("a","Home"),state:"/home",view:"Home"},
                {content:create("a","About"),state:"/about",view:"About"},
                {content:create("a","Contacts"),state:"/contacts",view:"Contacts"},
                {content:create("a","Article"),state:"/article/1",view:"Article"}
            ]
        }
    }
};