Components.NavButton=function(){
    const ACTION_DEFAULT = 0;
    const ACTION_INSTALL = 1;
    let colors={
        background: {
            normal: "transparent",
            hover: "#922a1a",
            pressed: Rgba(255,255,255,0.2)
        },
        text: {
            normal: "#ffffff",
            hover: "#ffffff"
        }
    };

    this.css({
        fontWeight: "bold",
        background: colors.background.normal,
        color: colors.text.normal,
        paddingTop: "0.5em",
        paddingBottom: "0.5em",
        paddingLeft: "2em",
        paddingRight: "2em",
        transition: "all 200ms",
        display: "inline-block",
        cursor: "pointer",
        borderRadius: "2em",
        marginTop: "0.5em",
        marginLeft: "0.5em"
    });

    this.addEventListener("mousedown",e=>{
        this.css({
            transform: "scale(0.9)",
            background: colors.background.pressed
        });
    });

    this.addEventListener("mouseup",e=>{
        this.css({
            transform: "scale(1)",
            background: colors.background.normal
        });
    });

    this.addEventListener("mouseover",e=>{
        this.css({
            background: colors.background.hover,
            color: colors.text.hover
        });
    });

    this.addEventListener("mouseout",e=>{
        this.css({
            background: colors.background.normal,
            color: colors.text.normal,
            transform: "scale(1)"
        });
    });

    this.addEventListener("click",async e=>{
        //state(this.dataset.state);
        console.log(this.dataset);
        switch(parseInt(this.dataset.action)){
            case ACTION_DEFAULT:
                await content.change(this.dataset.view);
            break;
            case ACTION_INSTALL:
                modalBottom.open();
            break;
        }
    });

    this.data={
        list: [
            {text:"Quick Start",view:"Views/Home",state:"/home",action:ACTION_DEFAULT},
            {text:"Install",view:"Views/Home",state:"/home",action:ACTION_INSTALL}
        ]
    };
};