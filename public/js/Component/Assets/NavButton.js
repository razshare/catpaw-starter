Components.NavButton=function(){
    this.extends("Button");
    const ACTION_DEFAULT = 0;
    const ACTION_INSTALL = 1;

    this.onclick=function(){
        content.template(this.dataset.view);
        state(this.dataset.state);
    };

    this.data={
        list: [
            {text:"Home",view:"Views/Home",state:"/Home",action:ACTION_DEFAULT},
            {text:"About",view:"Views/About",state:"/About",action:ACTION_INSTALL}
        ]
    };
};