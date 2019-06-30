Components.ArticlesList=function(){
    this.data={
        articles: {}
    };
    this.data.articles[uuid()] = "article 1";
    this.data.articles[uuid()] = "article 2";
    this.data.articles[uuid()] = "article 3";
};