Components.NavButton=function(){
    let colors={
        background: {
            normal: "transparent",
            hover: "#c54531"
        },
        text: {
            normal: "#ffffff",
            hover: "#ffffff"
        }
    };

    this.css({
        background: colors.background.normal,
        color: colors.text.normal,
        padding: "1em",
        transition: "all 200ms",
        display: "inline-block",
        cursor: "pointer"
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
            color: colors.text.normal
        });
    });

    this.addEventListener("click",async e=>{
        state(this.dataset.state);
        await content.change(this.dataset.view);
    });

    this.data={
        list: [
            {text:"Quick Start",view:"Views/Home",state:"/home"},
            {text:"Documentation",view:"Views/Documentation",state:"/documentation"}
        ]
    };
};