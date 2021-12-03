$(function() {
    if(Cookies.get("notice_text")!==undefined){
        $("#notice").text(Cookies.get("notice_text"));
        setTimeout(function(){$('#notice').fadeOut('fast')},10000);
        Cookies.remove("notice_text");
    }



    $(".DialogUser").on( "click", function() {
        DialogUser($( this ).attr('href'));
        return false;
    });


    $(".DialogUserMin").on( "click", function() {
        DialogUserMin($( this ).attr('href'));
        return false;
    });




    $(".DialogUserSMin").on( "click", function() {
        DialogUserSMin($( this ).attr('href'));
        return false;
    });






});



