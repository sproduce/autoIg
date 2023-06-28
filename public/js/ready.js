$(function() {



    initDialogWindow();

    initClearButton();

    if (Cookies.get('fileLinkId')){
        window.location.href = "/file/downloadLink/"+Cookies.get('fileLinkId');
        Cookies.remove('fileLinkId');
    }

});


$('.sumToText').each(function(){
            $(this).text($(this).text().replace(/\B(?=(\d{3})+(?!\d))/g, "`"));
            });

function initClearButton(){
    $("a.clearButton").click(function(e){
        e.preventDefault();
        clearButton(this);}
            );
    $("button.clearForm").click(function(e){
        e.preventDefault();
        clearForm(this);
    });
 
}




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
    $(current).closest('div.clearRow').find('input').each(function(){$(this).val("");});
}


function clearForm(current){
    $(current).closest('form')[0].reset();
}
