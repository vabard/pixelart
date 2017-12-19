$("#buttonenvoyes").on('click',function(){
    if($("#envoyes").css('display')=="none"){
       $("#brouillons").fadeOut(500);
       $("#envoyes").fadeIn(500,function(){
           $(this).parent().height($(this).height());
       });
       
    }
});

$("#buttonbrouillons").on('click',function(){
    if($("#brouillons").css('display')=="none"){
       $("#envoyes").fadeOut(500);
       $("#brouillons").fadeIn(500,function(){
           $(this).parent().height($(this).height());
       });
    }
});


//if ($(".image").width()<$(".image").height()){
//   $(".image").height(400);
//   $(".image").width(400*($(".image").attr('src').width()/$(".image").attr('src').height()));
//    };
//    
//if ($(".image").width()==$(".image").height()){
//    $(".image").width($(".image").parent().width());
//   $(".image").height($(".image").width);
//   };
//    
//if ($(".image").width()>$(".image").height()){
//    $(".image").width($(".image").parent().width());
//   $(".image").height(($(".image").parent().width())*($(".image").width()/$(".image").height()));
// };
// 
// window.onresize=function(){
//     $(".image").width($(".image").parent().width());
// }




