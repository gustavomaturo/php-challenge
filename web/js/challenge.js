var shipOrdeDetail = null;
var objDelete = {};

$(function(){
    
    function init () {

        $('.dropify').dropify();
        $('.modal').modal();
        $('[name=rdType]').change(function(){
            $('#divFile').removeClass('hide');
            $('.dropify-clear').click();
            this.value == 's' ? $('#divTablePeople').addClass('hide') : $('#divTableShip').addClass('hide');
            fillTable();
        });
        
        $('#inputFile').change(function(){
            var fd = new FormData();
            fd.append('file', $('#inputFile').prop('files')[0]);
            
            ajaxFormDataPOST(getUrlApi(), fd, function(response) {
                $('.dropify-clear').click();
                toastSuccess(response.message);
                fillTable();
            });
        });
        
    }
    
    init();
});

function getPeople (url) {
        ajaxGET(url, function(response){
            var $tblPeople = $('#tblPeople');
            var row = '';
            $tblPeople.find('tbody').html('');
            
            if(Array.isArray(response.data)) {
                
                if(response.data.length == 0) {
                    $tblPeople.append('<tr><td colspan="4">No records found</td></tr>');
                }
                response.data.forEach(function(obj, key){
                    row += `<tr>
                            <td>${obj.name}</td>
                            <td>${obj.phones.map(function(value){ return value.number }).join(', ')}</td>
                            <td><i class="small material-icons" onclick="showModalConfirm(${obj.id}, this, 'people');">clear</i></td>
                            </tr>`;        
                });
                
                $tblPeople.append(row);
                $('#divTablePeople').removeClass('hide');
            }
        });
    }

function getShipOrder (url) {
        ajaxGET(url, function(response){
            var $tblShip = $('#tblShip');
            var row = '';
            $tblShip.find('tbody').html('');
            
            if(Array.isArray(response.data)) {
                shipOrdeDetail = response.data;
                
                if(response.data.length == 0) {
                    $tblShip.append('<tr><td colspan="5">No records found</td></tr>');
                }
                response.data.forEach(function(obj, key){
                    row += `<tr>
                            <td>${obj.name}</td>
                            <td>${obj.address}</td>
                            <td>${obj.city}</td>
                            <td>${obj.country}</td>
                            <td>
                                <i class="small material-icons" onclick="detailShipOrder(${key});">pageview</i>
                                <i class="small material-icons" onclick="showModalConfirm(${obj.id}, this, 'ship');">clear</i>
                            </td>
                            </tr>`;        
                });
                
                $tblShip.append(row);
                $('#divTableShip').removeClass('hide');
            }
        });
    }

function detailShipOrder(key) {
   
    $('#modal').modal('open');
    $('#divBody').html('');
    var html = '';
    
    if(Array.isArray(shipOrdeDetail[key].itemOrder)) {
        shipOrdeDetail[key].itemOrder.forEach(function(obj, key){
         html += `<div class="row">
                    <h4>Item ${key + 1}</h4>
                    <div class="col s6">Note</div>
                    <div class="col s6">${obj.note}</div>
                    
                    <div class="col s6">Price</div>
                    <div class="col s6">$ ${parseFloat(obj.price).toFixed(2)}</div>

                    <div class="col s6">Quantity</div>
                    <div class="col s6">${obj.quantity}</div>

                    <div class="col s6">Title</div>
                    <div class="col s6">${obj.title}</div>
                  </div>`;
        })
       
        $('#divBody').append(html);
    }
}

function removePeople(id, elem) {
    ajaxDELETE(URL_BASE_API + '/people/' + id, function (response) {
        toastSuccess(response.message);
        $(elem).parent().parent().remove();
        
        if($('#tblPeople').find('tbody').find("tr").length == 0) {
            $('#tblPeople').append('<tr><td colspan="4">No records found</td></tr>');
        }
    });
}

function showModalConfirm(id, elem, type) {
    objDelete.type = type;
    objDelete.elem = elem;
    objDelete.id = id;
    
    $('#modalConfirm').modal('open');
}

function confirmRemove() {
    objDelete.type == 'ship' ? removeShip(objDelete.id, objDelete.elem) : removePeople(objDelete.id, objDelete.elem);
}

function cancelRemove() {
    objDelete = {};
}

function removeShip(id, elem) {
    ajaxDELETE(URL_BASE_API + '/ship/' + id, function (response) {
        toastSuccess(response.message);
        $(elem).parent().parent().remove();
        
        if($('#tblShip').find('tbody').find("tr").length == 0) {
            $('#tblShip').append('<tr><td colspan="5">No records found</td></tr>');
        }
    });
}

function getUrlApi() {
    return $('[name=rdType]').filter(':checked').val() == 's' ? URL_BASE_API + '/ship' : URL_BASE_API + '/people';
}

function fillTable() {
    $('[name=rdType]').filter(':checked').val() == 's' ? getShipOrder(getUrlApi()) : getPeople(getUrlApi());
}