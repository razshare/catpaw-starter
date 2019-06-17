Component.ArticleButton=function($this){
    Component.PrimaryButton($this);
    $this.addEventListener("click",e=>{
        content.view("Article",{
            article: $this.dataset.article
        });
        state("/article",$this.dataset.article);
    });
};