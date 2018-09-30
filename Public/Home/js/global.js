$(".wapnav  ul ").prepend('<div class="shut"><a href="javascript:;"></a></div>')
$(".wapnav").on("click",".shut a",function(){
	$(".wapnav").removeClass("show");//.slideUp(100);
})
$(".navBtn").on("click",function(){
	//$(this).find("i").toggleClass("icon-caidan").toggleClass("icon-guanbi")
	$(".wapnav").addClass("show");//.slideToggle(100);
})

$(".head .searchIcon").on("click",function(){
	$('.head .search').toggleClass("hi")
})
$(".head .search input").on("blur",function(){
	$('.head .search').toggleClass("hi")
})

$("#firstpane a.menu_head").click(function(){
	$(this).next("div.menu_body").slideToggle(300).show();
	$("ul.menu_yq").hide();
	$(this).siblings();
})
$("#Link_list a.menu_top").click(function(){
	$(this).next("ul.menu_yq").slideToggle(300).show();
	$("div.menu_body").hide();
	$(this).siblings();
})

$(".hov").on("mouseenter",function(){
	$(this).addClass("hover")
}).mouseleave(function(){
	$(this).removeClass("hover")
})

$(".bottom_nav p.nav_head").click(function(){
	$(this).toggleClass("current").parents(".bottom_nav").find("div").toggleClass("hi");
})

$(".con_hov").on("mouseenter",function(){
	$(this).addClass("con_hover")
}).mouseleave(function(){
	$(this).removeClass("con_hover")
})


$(".Left_Box h2").click(function(){
	$(this).toggleClass("current").parents(".Left_Box").find("ul").toggleClass("hi");
})