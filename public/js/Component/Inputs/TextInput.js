Components.TextInput=function(){
    this.data={
        value: "hello world"
    };

    
    this.appendChild(create(".row",create(".input-field.col.s6",[
        create("input",null,{
            "id":"tmpinput",
            ":value":"this.value",
            type: "text"
        })
    ])));
};