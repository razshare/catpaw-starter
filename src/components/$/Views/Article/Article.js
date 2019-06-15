Component.Article=function($this){
    Component.PageWrapper($this);
    
    article.clear();
    article.appendChild(create("small","This is article "+$this.data.article));
};