function loadMonth(difference) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../queries/order-list.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);

                if (response.content) {
                    document.querySelector('.jobs_head-container').innerHTML = response.content;
                } else {
                    console.error("No content received from the server.");
                }
            } else {
                console.error("Error with the request: ", xhr.status, xhr.statusText);
            }
        }
    }
    xhr.send('difference=' + encodeURIComponent(difference));
}