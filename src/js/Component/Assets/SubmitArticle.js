Components.SubmitArticle=function(){
    this.extends("Button");
    let home = this.getParentComponent();
    let list = home.ref("articles-list");
    let articleName = home.ref("article-name");
    this.addEventListener("click",e=>{
        if(articleName.value.trim() === ""){
            return;
        }
        list.data.articles[uuid()] = articleName.value;
        articleName.value = "";
        list.refresh();
    });
};