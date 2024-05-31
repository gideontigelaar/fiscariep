function showDetailView(orderID) {
    console.log('showDetailView() called of orderID:', orderID);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/pages/detailview.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var scrollTop = document.querySelector('.db_content').scrollTop;
            document.body.innerHTML = xhr.responseText + document.body.innerHTML;
            document.querySelector('.db_content').scrollTop = scrollTop;
            var dvContainer = document.querySelector('.dv_container');
            dvContainer.style.transform = 'translateY(800px)';
            setTimeout(function() {
                var dbContent = document.querySelector('.db_content-items');
                dbContent.style.opacity = '0.4';
                dbContent.style.pointerEvents = 'none';
                dvContainer.style.transform = 'translateY(0px)';
            }, 5);

            var scripts = document.querySelectorAll('.dv_head-container script');
            scripts.forEach(function(script) {
                eval(script.innerHTML);
            });
        }
    };
    xhr.send('orderID=' + encodeURIComponent(orderID));
}

function removeDetailViewContainer() {
    var dvContainer = document.querySelector('.dv_container');
    dvContainer.style.transform = 'translateY(800px)';

    var dbContent = document.querySelector('.db_content-items');
    dbContent.style.opacity = '1';
    dbContent.style.pointerEvents = 'all';
    setTimeout(function() {
        dvContainer.remove();
    }, 200);
}

function markPrintJob(orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/queries/mark-printjob.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };
    xhr.send('orderID=' + encodeURIComponent(orderID));
}

function deletePrintJob(orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/queries/delete-printjob.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };
    xhr.send('orderID=' + encodeURIComponent(orderID));
}

function downloadPDF(orderID) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/queries/download-pdf.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.responseType = 'blob';  // Important to handle binary data in response
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var filename = "order_" + orderID + ".pdf";
            var blob = new Blob([xhr.response], { type: 'application/pdf' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;
            link.click();
        } else if (xhr.readyState == 4) {
            console.error('Error downloading PDF');
        }
    };
    xhr.send('orderID=' + encodeURIComponent(orderID));
}