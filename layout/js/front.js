



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

/*   the fuction of putting astrisk after each input */

$('input').each(function(){
    if($(this).attr('required')==='required'){
    $(this).after('<span class="astrisk"> * </span>');
    
    }
    
    
    
}); //the  end of second function
///////////////////////////////////////////////////////////////////////////////









$('.confirm').click(function(){

return confirm('Are You Sure');

});



///////////////////////////////////////////////////


$('.c-panel-body .cat h2').click(function(){

$(this).next().fadeToggle(200);


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
/*

$('.c-panel-head .rb span').click(function(){

$(this).addClass('gray').siblings('span').removeClass('gray');

if($(this).data('view')==='full'){
$('.fd-in-out').fadeIn(200);

}else{
$('.fd-in-out').fadeOut(200);


}

});

*/


//////////////////////////////////////////////////


/*
$('.tog').click(function(){

    $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

   if($('.tog').hasClass('selected')){

    $(this).html('<i class="fa fa-plus fa-lg"></i>');

   }else{
    $(this).html('<i class="fa fa-minus fa-lg"></i>');

   }

 

});
*/
/////////////////////////////////////////////////////////////////


/*
$('.tog2').click(function(){

$(this).toggleClass('selected2').parent().next('.panel-body2').fadeToggle(100);

if($(this).hasClass('selected2')){

    $(this).html('<i class="fa fa-plus fa-lg"></i>');
}else{

    $(this).html('<i class="fa fa-minus fa-lg"></i>');
}

});
*/

////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////
/*


$('.comment-c').hover(function(){

$('.span-c').css('right','0px')},

function(){
$('.span-c').css('right','-300px')
}

);


*/



/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////////
                        //////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                        ////////////////////////////////////////
                                                //////////////////////////
      
      
                                                */

/*the function of login/signup which make the login red when click it and will make the signup red when we click               */

$('.login-container h2 span').click(function(){

$(this).addClass('f-selected');
$(this).siblings('span').removeClass('f-selected');
$('.front-login form').hide();
$('.' + $(this).data('class')).fadeIn(100);

});

//////////////////////////////////////////////////////////////////////////////////////////////////////////




/*
$('#lessPro').click(function(){

    $(this).fadeOut(100);
    $(this).siblings('#morePro').fadeIn(100);
 
    
});*/



///////////////////////////////////////////////////////////


$('.button1').click(function(){

$('.pic').addClass('mark');


});




if(isset($_GET['com'])&& $_GET['com']=='all'){



    $('li').removeClass('lis',function(){

        $(this).addClass('lisAll');

    });




}

////////////////////////////////////////////////////////////////////////////////////////

/*
$('.namePut').keyup(function(){

    $('.nameAdd').text($(this).val());



});
*/

$("input").keydown(function(){
    $("input").css("background-color", "yellow");
  });

  $("input").keyup(function(){
    $("input").css("background-color", "pink");
  });











/////////////////////////////////////////////////////////////////////////////////////////////////////////////
}); //the end of the main function










$(document).ready(function(){

    $('.namePut').keyup(function(){

        $('.nameAdd').text($(this).val());

    });


/*----------------------------------------------*/
$('.datePut').change(function(){

    $('.dateAdd').text($(this).val());


});

/*----------------------------------------------*/

$('.pricePut').keyup(function(){

$('.priceAdd').text($(this).val() +'$');


});
/*-------------------------------------------------*/

$('.price2Put').change(function(){

    $('.price2Add').text($(this).val());

});

/*-------------------------------------------------*/

$('.countryPut').keyup(function(){

    $('.countryAdd').text($(this).val());

});

/*-------------------------------------------------*/
$('.statusPut').change(function(){

    $('.statusAdd').text($(this).val());

});

/*------------------------------------------------------*/






$(".tagPut").keyup(function(){

    $(".tagAdd").text($(this).val());


});




  /*--------------------------------------------------------*/

  $('.descriptionPut').keyup(function(){


    $('.descriptionAdd').text($(this).val());


  });


/*

    $('.showArrow').click(function(){

        $('.thumbnail').css('height','300px');
        $(this).css('display','none');
        $('.hideArrow').css('display','block');

    });



    $('.hideArrow').click(function(){


        $('.thumbnail').css('height','260px');
        $(this).css('display','none');
        $('.showArrow').css('display','block');
        $('.caption').css('overflow','hidden');
      
    });


*/


});





























































