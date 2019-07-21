Components.Coding=function(){
    let html = this.innerHTML;
    let language = this.hasAttribute("language")?this.getAttribute("language"):"plaintext";
    this.innerHTML = "";
    let code = create("code."+language,html);
    let pre = create("pre",code)
    this.appendChild(pre);
    hljs.highlightBlock(code);

    code.classList.add("selectable");

    this.css({
        display: "inline-block",
        padding: 0,
        margin: 0
    });
    code.css({
        display: "inline",
        background: "transparent",
        padding: 0,
        margin: 0
    });
    pre.css({
        margin: 0,
        background: "#f1f1f1",
        paddingLeft: "0.5em",
        paddingRight: "0.7em",
        paddingTop: "0.1em",
        paddingBottom: "0.1em",
    });
}