

function showAlert() {
    alert('It wasnt that succcesful');
}

function approveROF(rofID) {
    swal({
        text: "Approve Request Order?",
        icon: "info",
        buttons: true,
    })
    .then((approve) => {
        if (approve) {
            var url = '/rof/approve/rofID';
            url = url.replace('rofID', rofID);
            window.location.href=url;
        } else {
            return false;
        }
    });  
}

function receiveROF(rofID) {
    swal({
        text: "Receive this order?",
        icon: "info",
        buttons: true,
    })
    .then((approve) => {
        if (approve) {
            var url = '/rof/receive/rofID';
            url = url.replace('rofID', rofID);
            window.location.href=url;
        } else {
            return false;
        }
    });  
}

function rejectROF(rofID) {
    swal({
        text: "Reject Request Order?",
        icon: "warning",
        buttons: true,
    })
    .then((reject) => {
        if (reject) {
            swal({
                text: "Remarks: ",
                content: "input",
                buttons: true,
                dangerMode: true,
            }).then((remarks) => {
                if (remarks !== null){
                    //below code appends two parameter, rofID and remarks, to the route
                    //var url = '{{ route("rejectROF", [rofID, remarks => "-remarks"]) }}';
                    var url = '/rof/reject/rofID?remarks=-remarks';

                    //replace string with dynamic value
                    url = url.replace('rofID', rofID);
                    url = url.replace('-remarks', remarks);

                    window.location.href=url; 
                }
                else{
                    swal('Request Order reject cancelled');
                }
            })
        } else {
            return false;
        }
    });  
}