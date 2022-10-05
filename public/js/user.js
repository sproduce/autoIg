

function loadTitle($row)
{


}



function DialogUser(load_url,cb=null){
 $('#modal-content').empty();
 $('#modal-dialog').addClass("modal-lg");
 $('#modal').modal('toggle');
 $('#modal-content').load(load_url,function(){if(cb){cb();}});
}

function DialogUserMin(load_url,cb=null){
   $('#modal-content').empty();
   $('#modal-dialog').removeClass("modal-lg");
   $('#modal').modal('toggle');
   $('#modal-content').load(load_url,function(){if(cb){cb();}});
}

function DialogUserSMin(load_url,cb=null){
   $('#modal-content').empty();
   $('#modal-dialog').removeClass("modal-lg");
   $('#modal-dialog').addClass("modal-sm");
   $('#modal').modal('toggle');
   $('#modal-content').load(load_url,function(){if(cb){cb();}});
}


function ShowImage(imageUrl){
    $('#modal-content').empty();
    $('#modal-dialog').removeClass("modal-lg");
    $('#modal-dialog').addClass("modal-sm");

    $('#modal-content').prepend("<img  src=\""+imageUrl+"\" />");

    $('#modal').modal('toggle');
}

