Component.ArticleButton=function(){
    this.extends("PrimaryButton");

    this.addEventListener("click",e=>{
        content.module("Article",{
            article: this.dataset.article
        });
        state("/article",this.dataset.article);
    });
};