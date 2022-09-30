

function deleteEvent(current)
{
    $currentLine = $(current).parent().closest('.row');
     if (confirm('Удалить событие?')){
         url= "/rentEvent/"+$currentLine.data('event')+"/"+$currentLine.data('id')+"/destroy";
         $.get(url).done(function(){
             $(current).prop('disabled',true);
             $currentLine.css('textDecoration', 'line-through');
         });
     }

}

