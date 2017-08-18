function ajaxGET(url,callback) {
    
    $.ajax({
        url: url,
        method: 'GET',
    }).done(function(response) {
        if(callback) {
            callback(response);
        }
    }).fail(function( jqXHR, textStatus ) {
        if(!jqXHR.responseJSON) {
            toastError('Sorry, an unexpected error occurred.');
        } else {
            toastError(jqXHR.responseJSON.message);
        }
    });
    
}

function ajaxFormDataPOST(url, fd, callback) {
    
    $.ajax({
        url: url,
        method: 'POST',
        processData: false,
        contentType: false,
        data: fd,
    }).done(function(response) {
        if(callback) {
          callback(response);
        }
    }).fail(function( jqXHR, textStatus ) {
        if(!jqXHR.responseJSON) {
            toastError('Sorry, an unexpected error occurred.');
        } else {
            toastError(jqXHR.responseJSON.message);
        }
    });
}

function ajaxDELETE(url, callback) {
    $.ajax({
        url: url,
        method: 'POST',
        data: {_method: "delete"}
    }).done(function(response) {
        if(callback) {
            callback(response);
        }
    }).fail(function( jqXHR, textStatus ) {
        if(!jqXHR.responseJSON) {
            toastError('Sorry, an unexpected error occurred.');
        } else {
            toastError(jqXHR.responseJSON.message);
        }
        
    });
}

function toastSuccess(msg) {
    Materialize.toast(msg, 2000, 'green');
}

function toastError(msg) {
    Materialize.toast(msg, 2000, 'red');
}