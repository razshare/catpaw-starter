Components.Button=function(){
    this.classList.add("waves-effect");
    this.classList.add("waves-light");
    this.classList.add("btn");

    //colors
    this.classList.add("blue");
    this.classList.add("darken-3");

    this.addEventListener("mouseover",e=>{
        this.classList.add("light-blue");
        this.classList.add("accent-4");
        
        this.classList.remove("blue");
        this.classList.remove("darken-3");
    });

    this.addEventListener("mouseout",e=>{
        this.classList.remove("light-blue");
        this.classList.remove("accent-4");

        this.classList.add("blue");
        this.classList.add("darken-3");
    });
};