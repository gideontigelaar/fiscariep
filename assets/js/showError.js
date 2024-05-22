function showErrorMessage(code, text, duration) {
    if (document.getElementById('error-message')) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/pages/errors/error-message.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // add the error message to the body
            document.body.innerHTML += xhr.responseText;
            document.getElementById('error-code').innerHTML = 'Error ' + code;
            document.getElementById('error-description').innerHTML = text;

            var errorHeadContainer = document.getElementsByClassName('error_head-container')[0];
            
            
            
            setTimeout(function() {
                shakeErrorMessage();
                errorHeadContainer.style.top = '20px';
            }, 100);

            var countdownElement = document.querySelector('.error-countdown-text');
            if (countdownElement) {
                var countdown = duration;
                countdownElement.innerHTML = countdown;
                
                var countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.innerHTML = countdown;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        var errorMessage = document.getElementById('error-message');
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
    var errorHeadContainer = document.getElementsByClassName('error_head-container')[0];
    var shakeSequence = [-10, 10, -5, 5, 0];
    var delay = 100;

    shakeSequence.forEach(function(position, index) {
        setTimeout(function() {
            errorHeadContainer.style.transform = `translateX(${position}px)`;
        }, delay * index);
    });
}
