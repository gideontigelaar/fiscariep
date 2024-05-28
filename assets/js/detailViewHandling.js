function showDetailView(orderID) {
    console.log('showDetailView() called of orderID:', orderID);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/pages/detailview.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {

            document.body.innerHTML = xhr.responseText + document.body.innerHTML;
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
    xhr.send();
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
