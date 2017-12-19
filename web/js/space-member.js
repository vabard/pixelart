$("#buttonenvoyes").on('click',function(){
    if($("#envoyes").css('display')=="none"){
       $("#brouillons").fadeOut(500);
       $("#envoyes").fadeIn(500,function(){
           $(this).parent().height($(this).height());
       });
       
    }
    if($("#envoyes").css('display')!="none" && $("#brouillons").css('display')!="none"){
        $("#envoyes").css('position',"absolute");
       $("#envoyes").css('z-index',1);
       $("#brouillons").css('z-index',2);
       $("#brouillons").fadeOut(500,function(){
           
       $("#envoyes").css('position',"absolute");
       $("#envoyes").css('z-index',1);
       $("#brouillons").css('z-index',2);
       $("#envoyes").parent().height($(this).height());
       });
       //$("#brouillons").fadeOut(200);
       //$("#envoyes").fadeIn(500);
       
    
    }
});

       $("#buttonbrouillons").on('click',function(){
    if($("#brouillons").css('display')=="none"){
       $("#envoyes").fadeOut(500);
       $("#brouillons").fadeIn(500,function(){
           $(this).parent().height($(this).height());
       });
    }
   if($("#envoyes").css('display')!="none" && $("#brouillons").css('display')!="none"){
       $("#envoyes").fadeOut(200,function(){
           //$(this).parent().height($(this).height());
       $("#envoyes").css('position',"absolute");
       $("#envoyes").css('z-index',1);
       $("#brouillons").css('z-index',2);
       });
       $(this).parent().height($(this).height());
        
       
       
       
    
    }
});

$("#buttontous").on('click',function(){
    if($("#brouillons").css('display')=="none"){
        $("#envoyes").css('position',"static");
       $("#envoyes").css('z-index','');
       $("#brouillons").css('z-index','');
       $("#envoyes").fadeOut(200,function(){
       $(this).parent().height($(this).height());
       
       
    })
    $("#brouillons").fadeIn(500);
    $("#envoyes").fadeIn(500);
    
}
    if($("#envoyes").css('display')=="none"){
        $("#envoyes").css('position',"static");
       $("#envoyes").css('z-index','');
       $("#brouillons").css('z-index','');
       $("#envoyes").fadeIn(500,function(){
       //$(this).parent().height($(this).height());
       
       
    })
    
    
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




