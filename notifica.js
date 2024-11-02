
function fireNotif(message = '', icon = 'info') {    
    $('#toast').remove();
    const toastElm = $('.toast-container');
    let data = getType(icon);
    let Elm =
'<div id="toast" class="toast align-items-center border-0 ' + data.class + '" role="alert" aria-live="assertive" aria-atomic="true"  data-delay="5000">'+
'<div class="d-flex">'+
'<div class="toast-body" id="toastMessage">'+ message +
'</div>'+
'</div>'+
'</div>';
    toastElm.append(Elm);
    $('#toast').toast('show');

    function getType(name) {
        let data;
        switch (name) {
            case 'success':
                data = {
                    class: 'text-bg-success',
                    type: 'Success'
                }
                return data
            case 'error':
                data = {
                    class: 'text-bg-danger',
                    type: 'Error'
                }
                return data
            case 'warning':
                data = {
                    class: 'text-bg-warning',
                    type: 'Warning'
                }
                return data
            default:
                data = {
                    class: 'text-bg-primary',
                    type: 'Info'
                }
                return data
        }
    }
}