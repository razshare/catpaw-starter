function Book(content=null,options={}){let $this=create("div",content,options);let update=function(){if(busy)return;let widths=new Array();for(let i=0;i<$this.children.length;i++){widths.push(Percent(100))}
$this.style.gridTemplateColumns=widths.join(" ")};$this.update=update;let start=null;let end=null;let last=null;let busy=!1;$this.addEventListener("touchstart",e=>{if(busy)return;start=e.touches[0];start.time=new Date().getTime()});let hook=function(deltaX,time){const unit=$this.children[0].offsetWidth*0.2;const velocity=(deltaX/time).truncate(1);if(velocity<=-0.5){page(currentPage-1)}else if(velocity>=0.5){page(currentPage+1)}else if(deltaX<=unit&&deltaX>=-unit){page(currentPage)}else if(deltaX<0){page(currentPage-1)}else if(deltaX>0){page(currentPage+1)}};$this.addEventListener("touchend",e=>{if(busy)return;last=null;try{hook(start.clientX-end.clientX,end.time-start.time);start=null;end=null}catch(e){}});$this.addEventListener("touchcancel",e=>{if(busy)return;last=null;try{hook(start.clientX-end.clientX,end.time-start.time);start=null;end=null}catch(e){}});$this.addEventListener("touchmove",e=>{if(busy)return;if(last!==null){const x=e.touches[0].clientX-last.clientX;$this.scrollLeft+=-x}
last=e.touches[0];end=e.touches[0];end.time=new Date().getTime()});$this.next=function(){return page(currentPage+1)}
$this.prev=function(){return page(currentPage-1)}
let currentPage=0;let page=function(i,inc=15){if(busy)return;busy=!0;return new Promise(resolve=>{if(!$this.children[i]){busy=!1;return(resolve)(!1)}
let destination=$this.children[i].offsetLeft;let x=$this.scrollLeft;let deltaX=destination-x;(async function poll(){if(deltaX>0&&x<destination){x+=inc;if(x>destination)x=destination;$this.scrollLeft=x}else if(deltaX<0&&x>destination){x-=inc;if(x<destination)x=destination;$this.scrollLeft=x}else{currentPage=i;busy=!1;return(resolve)(!0)}
setTimeout(poll,1)})()})};$this.page=page;update();return $this.css({display:"grid",gridGap:0,maxWidth:Percent(100),width:Percent(100),overflow:"hidden"})};(async()=>{await nav.module("NavMenu");await main.module("Content");await use.route("^/(home)?$",location=>{content.module("Home")});await use.route("^/about$",location=>{content.module("About")});await use.route("^/contacts$",location=>{content.module("Contacts")});await use.route("^/article/(?=.*$)",location=>{content.module("Article",{article:location.args[0]})})})();Component.ArticleButton=function(){this.extends("PrimaryButton");this.addEventListener("click",e=>{content.module("Article",{article:this.dataset.article});state("/article",this.dataset.article)})};Component.Button=function(){this.classList.add("relative");this.classList.add("flex");this.classList.add("p-3");this.classList.add("font-bold");this.classList.add("crop-text");this.classList.add("cursor-pointer");this.setClickEffect(50,50,50)};Component.NavButton=function(){this.extends("Button");this.classList.add("p-5");this.classList.remove("rounded");this.classList.add("border-r");this.addEventListener("click",e=>{if(!this.dataset.view)return;content.module(this.dataset.view);state(this.dataset.state)});this.data={title:"this is a title"}};Component.PageWrapper=function(){this.classList.add("p-5")};Component.PrimaryButton=function(){this.extends("Button");this.classList.add("border");this.classList.add("border-gray");this.classList.add("bg-blue");this.classList.add("text-white")};Component.About=function(){let page1=create("h3","Test page 1");let page2=create("h3","Test page 2");let page3=create("h3","Test page 3");let page4=create("h3","Test page 4");page1.extends("PageWrapper");page2.extends("PageWrapper");page3.extends("PageWrapper");page4.extends("PageWrapper");this.book=new Book([page1,page2,page3,page4]);this.css({position:"relative",width:Percent(100),height:Percent(100),margin:0}).appendChild(this.book)};Component.Article=function(){this.extends("PageWrapper");article.clear();article.appendChild(create("small","This is article "+this.data.article))};Component.Contacts=function(){this.extends("PageWrapper")};Component.Content=function(){this.classList.add("flex");this.classList.add("w-full");this.classList.add("bg-white");this.classList.add("p-0");this.classList.add("m-0")};Component.Home=function(){this.extends("PageWrapper")};Component.NavMenu=function(){this.classList.add("flex");this.classList.add("w-full");this.classList.add("bg-white");this.classList.add("border-b");this.classList.add("border-gray");this.classList.add("shadow")}