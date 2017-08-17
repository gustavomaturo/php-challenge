$(function(){
    
    function init () {
        
        $('#btnSave').click(function(){
            var fd = new FormData();
            fd.append('file', $('#inputFile').prop('files')[0]);
            
            $.ajax({
                url: 'http://127.0.0.1:8000/api/people',
                method: 'POST',
                processData: false,
                contentType: false,
                data: fd,
            }).done(function(response) {
                console.log(response);
            }).fail(function( jqXHR, textStatus ) {
              console.log('foi');
            });
        });
    }
    
    
    init();
});