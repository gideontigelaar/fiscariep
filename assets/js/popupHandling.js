function nextPopupStep(popupTitle, popupSubtext, popupContentPHP, confirmFunction) {
    if (!popupTitle) {
        popupTitle = 'An unknown error occurred';
    }

    if (document.querySelector('.pp_head-container')) {
        newPopupContainer(popupTitle, popupSubtext, popupContentPHP, confirmFunction);
        return;
    }

    // set db_content-items to opacity 40% and pointer-events none. this is a container there's only 1
    let dbContentItems = document.querySelector('.db_content-items');
    dbContentItems.style.opacity = '0.4';
    dbContentItems.style.pointerEvents = 'none';

    fetch('/pages/popup.php')
        .then(response => response.text())
        .then(html => {
            // Create a container for the popup
            let container = document.createElement('div');
            container.innerHTML = html;

            // Append the container to the top of the body
            document.body.prepend(container);

            document.querySelector('.pp_container-title').innerHTML = popupTitle;
            document.querySelector('.pp_container-subtext').innerHTML = popupSubtext;

            if (confirmFunction) {
                document.querySelector('.pp_button-container').style.display = 'flex';
                document.querySelector('.pp_button-container').style.marginTop = '20px';
                document.querySelector('.button-confirm').setAttribute('onclick', confirmFunction);
            }

            if (!popupContentPHP) {
                return;
            }

            // add pages/popups/"popupContentPHP".php to the container right below the title
            fetch('/pages/popups/' + popupContentPHP + '.php')
            .then(response => {
                if (!response.ok) {
                    fetch('/pages/popups/404.php')
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.pp_container-content').innerHTML = html;
                    });
                }
                return response.text();
            })
            .then(html => {
                document.querySelector('.pp_container-content').innerHTML = html;
                var scripts = document.querySelectorAll('.pp_container-content script');
                scripts.forEach(script => {
                    eval(script.innerHTML);
                });
            })
            .catch(error => {
                console.error('Error loading popup:', error);
                fetch('/pages/popups/404.php')
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.pp_container-content').innerHTML = html;
                    });
            });
        })
    .catch(error => {
        console.error('Error loading popup:', error);
        fetch('/pages/popups/404.php')
            .then(response => response.text())
            .then(html => {
                document.querySelector('.pp_container-content').innerHTML = html;
            })
    });
}

function newPopupContainer(popupTitle, popupSubtext, popupContentPHP, confirmFunction) {
    let containers = document.querySelectorAll('.pp_container');
    let headContainer = document.querySelector('.pp_head-container');

    if (!containers || !headContainer) {
        console.error('Container or head container not found');
        return;
    }

    containers.forEach(container => {
        // Initialize transform property if not set
        if (!container.style.transform) {
            container.style.transform = 'scale(1) translateY(0)';
        }

        // Extract current scale and translateY values from the transform style
        let transform = container.style.transform;
        let scaleMatch = transform.match(/scale\(([^)]+)\)/);
        let translateYMatch = transform.match(/translateY\(([^)]+)\)/);

        if (!scaleMatch || !translateYMatch) {
            console.error('Invalid transform format');
            return;
        }

        let scale = parseFloat(scaleMatch[1]);
        let translateY = parseFloat(translateYMatch[1]);

        // Update the container's transform
        container.style.transform = `scale(${scale - 0.1}) translateY(${translateY - 80}px)`;
        container.style.height = '450px';
        container.style.overflow = 'hidden';

        // if there are more than 10 containers, remove the oldest one
        if (headContainer.children.length > 5) {
            headContainer.removeChild(headContainer.children[0]);
        }
    });

    // Clone the container and reset its transform
    let container = document.querySelector('.pp_container');

    let newContainer = container.cloneNode(true);
    newContainer.style.transform = 'scale(1) translateY(80px)';
    setTimeout(() => {
        newContainer.style.transform = 'scale(1) translateY(0px)';
    }, 1);

    // clear the content
    newContainer.querySelector('.pp_container-content').innerHTML = '';

    if (popupContentPHP) {
        // add pages/popups/"popupContentPHP".php to the container right below the title
        fetch('/pages/popups/' + popupContentPHP + '.php')
        .then(response => {
            if (!response.ok) {
                fetch('/pages/popups/404.php')
                .then(response => response.text())
                .then(html => {
                    newContainer.querySelector('.pp_container-content').innerHTML = html;
                });
            }
            return response.text();
        })
        .then(html => {
            newContainer.querySelector('.pp_container-content').innerHTML = html;
            var scripts = document.querySelectorAll('.pp_container-content script');
            scripts.forEach(script => {
                eval(script.innerHTML);
            });
        })
        .catch(error => {
            console.error('Error loading popup:', error);
            fetch('/pages/popups/404.php')
                .then(response => response.text())
                .then(html => {
                    newContainer.querySelector('.pp_container-content').innerHTML = html;
                });
        });
    }

    if (confirmFunction) {
        newContainer.querySelector('.pp_button-container').style.display = 'flex';
        newContainer.querySelector('.pp_button-container').style.marginTop = '20px';
        newContainer.querySelector('.button-confirm').setAttribute('onclick', confirmFunction);
    }

    // set popup title
    newContainer.querySelector('.pp_container-title').innerHTML = popupTitle;
    newContainer.querySelector('.pp_container-subtext').innerHTML = popupSubtext;

    // Append the new container to the headContainer
    headContainer.appendChild(newContainer);
}

function removePopupContainer() {
    let containers = document.querySelectorAll('.pp_container');
    let headContainer = document.querySelector('.pp_head-container');

    if (!containers || !headContainer) {
        console.error('Container or head container not found');
        return;
    }

    containers.forEach(container => {
        // Initialize transform property if not set
        if (!container.style.transform) {
            container.style.transform = 'scale(1) translateY(0)';
        }

        // Extract current scale and translateY values from the transform style
        let transform = container.style.transform;
        let scaleMatch = transform.match(/scale\(([^)]+)\)/);
        let translateYMatch = transform.match(/translateY\(([^)]+)\)/);

        if (!scaleMatch || !translateYMatch) {
            console.error('Invalid transform format');
            return;
        }

        let scale = parseFloat(scaleMatch[1]);
        let translateY = parseFloat(translateYMatch[1]);

        // Update the container's transform
        container.style.transform = `scale(${scale + 0.1}) translateY(${translateY + 80}px)`;
        container.style.height = '';
        container.style.overflow = '';

        // if there are more than 10 containers, remove the oldest one
        if (headContainer.children.length > 5) {
            headContainer.removeChild(headContainer.children[0]);
        }
    });

    // delete the last container
    headContainer.removeChild(headContainer.children[headContainer.children.length - 1]);

    // if this is the last one, yeet the head container
    if (headContainer.children.length === 0) {
        document.querySelector('.pp_head-container').remove();
        let dbContentItems = document.querySelector('.db_content-items');
        dbContentItems.style.opacity = '1';
        dbContentItems.style.pointerEvents = 'all';
    }
}