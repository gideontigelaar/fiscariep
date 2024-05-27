function showErrorMessage(code, text, duration) {
    if (document.getElementById('error-message')) {
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open('GET', '/pages/errors/error-message.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // add the error message to the body
            document.body.innerHTML += xhr.responseText;
            document.getElementById('error-code').innerHTML = 'Error ' + code;
            document.getElementById('error-description').innerHTML = text;

            let errorHeadContainer = document.getElementsByClassName('error_head-container')[0];



            setTimeout(function() {
                shakeErrorMessage();
                errorHeadContainer.style.top = '20px';
            }, 100);

            let countdownElement = document.querySelector('.error-countdown-text');
            if (countdownElement) {
                let countdown = duration;
                countdownElement.innerHTML = countdown;

                let countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.innerHTML = countdown;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        let errorMessage = document.getElementById('error-message');
                        if (errorMessage) {
                            errorMessage.remove();
                        }

                        errorHeadContainer.style.top = '-100px';
                        setTimeout(function() {
                            errorHeadContainer.remove();
                        }, 200);
                    }
                }, 1000);
            }
        }
    };
    xhr.send();
}

function shakeErrorMessage() {
    let errorHeadContainer = document.getElementsByClassName('error_head-container')[0];
    let shakeSequence = [-10, 10, -5, 5, 0];
    let delay = 100;

    shakeSequence.forEach(function(position, index) {
        setTimeout(function() {
            errorHeadContainer.style.transform = `translateX(${position}px)`;
        }, delay * index);
    });
}
