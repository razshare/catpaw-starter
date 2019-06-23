Component.Article=function(){
    this.extends("PageWrapper");
    article.clear();
    article.appendChild(create("small","This is article "+this.data.article));
};