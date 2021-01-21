




$(function(){
'use strict';
//hide place holder on form focus
$('[placeholder]').focus(function(){

$(this).attr('data-text', $(this).attr('placeholder'));
$(this).attr('placeholder', '');
}).blur(function(){


$(this).attr('placeholder', $(this).attr('data-text'));


});//the first function end
/////////////////////////////////////////////////////////////////////////

$('input').each(function(){
    if($(this).attr('required')==='required'){
    $(this).after('<span class="astrisk"> * </span>');
    
    }
    
    


    
}); //the  end of second function
///////////////////////////////////////////////////////////////////////////////






$('.eye').hover(function(){

    $('.password').attr('type','text');

}, function(){

    $('.password').attr('type','password');

});



$('.confirm').click(function(){

return confirm('Are You Sure');

});



///////////////////////////////////////////////////


$('.c-panel-body .cat h2').click(function(){

$(this).next().next().fadeToggle(200);


});

///////////////////////////////////////////////////////
/*

$('.full').click(function(){

$('.c-panel-body .fd-in-out').fadeIn(200);

});

///////////////////////////////////////////////////////
$('.classic').click(function(){

$('.c-panel-body .fd-in-out').fadeOut(200);

});
*/
////////////////////////////////////////





/////////////////////////////////

$('.c-panel-head .rb span').click(function(){

$(this).addClass('gray').siblings('span').removeClass('gray');

if($(this).data('view')==='full'){
$('.fd-in-out').fadeIn(200);

}else{
$('.fd-in-out').fadeOut(200);


}

});


//////////////////////////////////////////////////

$('.tog').click(function(){

    $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

   if($('.tog').hasClass('selected')){

    $(this).html('<i class="fa fa-plus fa-lg"></i>');

   }else{
    $(this).html('<i class="fa fa-minus fa-lg"></i>');

   }

 

});
/////////////////////////////////////////////////////////////////

$('.tog2').click(function(){

$(this).toggleClass('selected2').parent().next('.panel-body2').fadeToggle(100);

if($(this).hasClass('selected2')){

    $(this).html('<i class="fa fa-plus fa-lg"></i>');
}else{

    $(this).html('<i class="fa fa-minus fa-lg"></i>');
}

});


////////////////////////////////////////////////////////////////////////////////////////



$(".darkee").click(function(){


/*$(".com").toggleClass("com");*/

});


/////////////////////////////////////////////////////////////////////////////
/*


$('.comment-c').hover(function(){

$('.span-c').css('right','0px')},

function(){
$('.span-c').css('right','-300px')
}

);


*/

$('.all').click(function(){


    $(this).find("span .fas").toggleClass('tog');
    $(this).find(".togCat").fadeToggle(300);

});

// notice  mal7oza  when we click the item then we notice that all items that have the same 
//class will be affected by the function and that is not true so we use    $(this).find( 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
}); //the end of the main function










































































