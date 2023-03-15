$(function() {



    initDialogWindow();

    $("a.clearButton").click(function(){clearButton(this);});

    if (Cookies.get('fileLinkId')){
        window.location.href = "/file/downloadLink/"+Cookies.get('fileLinkId');
        Cookies.remove('fileLinkId');
    }

});


function initDialogWindow()
{

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


}


function clearButton(current){
    $(current).closest('div.clearRow').find('input').each(function(){$(this).val("")});
}
