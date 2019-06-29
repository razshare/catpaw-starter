Components.NavButton=function(){
    this.addEventListener("click",e=>{
        content.template("Views/"+this.dataset.view,this.data.article?{
            article: this.data.article
        }:null);
        
        state(this.dataset.state);
    });

    this.data={
        list:[
            {text:"Home",state:"/home",view:"Home"},
            {text:"About",state:"/about",view:"About"},
            {text:"Contacts",state:"/contacts",view:"Contacts"},
            {text:"Article",state:"/article/1",view:"Article", article: 1}
        ]
    }
};