 
$(function (){
      thissize_sy();
      $(window).resize(thissize_sy);
      $("#adver").owlCarousel({
          items: 1,
          paginationNumbers: false,
          autoplay: true, //是否自动轮播，默认 false
          autoplayTimeout: 3000,  //轮播间隔时间,
          loop: true, //是否重复 默认 false
          smartSpeed:2200,
      })
   });

 function thissize_sy() {
      //替换Logo
      if ($("html").width() > 750) {
          $("#logo").attr("src", "/Images/logo.png");
      } else {
          $("#logo").attr("src", "/Images/logo_n.png");

      }
  };
  
  function show (obj)
  {
      var img = document.getElementById ("showimg");
      if (img.src = obj.src)
      {
          img.src = obj.src;
      }
      img.style.display = "";
      img.style.position = "absolute";
      img.style.left = obj.offsetleft + obj.width;
  }
  function hide ()
  {
      document.getElementById ("showimg").style.display = "none";
  }

$(function(){
    $('#pics').owlCarousel({
          loop: true, //是否重复 默认 false
          nav: false,  //显示上下按钮 默认false
          responsive: { 1000: { items: 4}},   //显示个数
          margin: 0, //右边距 默认 0 
          slideBy: 1, //每次一下个轮播个数 默认 1
          autoplay: false, //是否自动轮播，默认 false
          autoplayTimeout: 3000,  //轮播间隔时间,
          smartSpeed: 250,   //轮播速度 默认250
          autoplayHoverPause: true    //鼠标停留是否暂停
      })
/**********/
var owl23 = $("#pics").data('owlCarousel');
 $("#next").click(function () { owl23.next(); })
 $("#pre").click(function () { owl23.prev(); })
  }); 


// $(function(){
//   var a=0;
//   $("#hengli .cont .eltie .eltie_nub").eq(1).click(function(){
//     a++;
//     if (a==1){
//       $("#hengli .cont .eltie .article").eq(1).show(500);
//       $("#hengli .cont .eltie .eltie_nub").eq(1).css("border-bottom","none");
//     }if(a>1)a=0;
//     if (a==0){
//       $("#hengli .cont .eltie .article").eq(1).hide(500);
//       $("#hengli .cont .eltie .eltie_nub").eq(1).css("border-bottom","2.5px dotted rgb( 220, 220, 220 )");
//     }
//   });
// });



