Component.About=function($this){
    let page1 = create("h3","Test page 1");
    let page2 = create("h3","Test page 2");
    let page3 = create("h3","Test page 3");
    let page4 = create("h3","Test page 4");
    $this.book = new Book([
        page1,
        page2,
        page3,
        page4
    ]);
    
    $this.css({
        position: "relative",
        width: Percent(100),
        height: Percent(100),
        margin: 0
    }).appendChild($this.book);
};