

function deleteEvent(current)
{
    $currentLine = $(current).parent().closest('.row');
     if (confirm('Удалить событие?')){
         $(current).prop('disabled',true);
         $currentLine.css('textDecoration', 'line-through');
         console.log($currentLine.data('event'));
         console.log($currentLine.data('id'));
     }


}

