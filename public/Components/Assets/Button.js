Components.$init("Button",function(){
    this.classList.add("waves-effect");
    this.classList.add("waves-cat");
    this.classList.add("btn-flat");  
})
Components.$init("Tests/Button",function(){
    console.log(this.$namespace,this);
});