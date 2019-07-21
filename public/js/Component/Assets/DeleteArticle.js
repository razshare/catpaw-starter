Components.DeleteArticle=function(){
    this.classList.add("waves-effect");
    this.classList.add("waves-light");
    this.classList.add("btn");

    //colors
    this.classList.add("red");
    this.classList.add("darken-3");

    this.addEventListener("mouseover",e=>{
        this.classList.add("accent-4");
        this.classList.remove("darken-3");
    });

    this.addEventListener("mouseout",e=>{
        this.classList.remove("accent-4");
        this.classList.add("darken-3");
    });
    let list = this.getParentComponent();
    this.addEventListener("click",e=>{
        delete list.data.articles[this.key];
        list.refresh();
    });
};