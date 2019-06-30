Components.Logo=function(){
    this.addEventListener("click",e=>{
        e.stopPropagation();
        this.data.title="clicked";
        this.refresh();
    });

    this.data = {
        title: "Logo"
    };
};