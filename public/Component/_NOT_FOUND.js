Components.$init("_NOT_FOUND",function(){
    this.$isComponent=false;
    if(this.$parent)
        this.data = this.$parent.data;
});