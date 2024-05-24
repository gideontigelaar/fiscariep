function nextPopupStep(popupTitle, popupContentPHP) {
    if (!popupTitle) {
        popupTitle = 'An unknown error occurred';
    }

    if (document.querySelector('.pp_head-container')) {
        newPopupContainer(popupTitle, popupContentPHP);
        return;
    }

    // set db_content-items to opacity 40% and pointer-events none. this is a container there's only 1
    var dbContentItems = document.querySelector('.db_content-items');
    dbContentItems.style.opacity = '0.4';
    dbContentItems.style.pointerEvents = 'none';

    fetch('/pages/popup.php')
        .then(response => response.text())
        .then(html => {
            // Create a container for the popup
            var container = document.createElement('div');
            container.innerHTML = html;

            // Append the container to the top of the body
            document.body.prepend(container);

            document.querySelector('.pp_container-title').innerHTML = popupTitle;
        })
    .catch(error => {
        console.error('Error loading popup:', error);
    });
}

function newPopupContainer(popupTitle, popupContentPHP) {
    var containers = document.querySelectorAll('.pp_container');
    var headContainer = document.querySelector('.pp_head-container');

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
        var transform = container.style.transform;
        var scaleMatch = transform.match(/scale\(([^)]+)\)/);
        var translateYMatch = transform.match(/translateY\(([^)]+)\)/);

        if (!scaleMatch || !translateYMatch) {
            console.error('Invalid transform format');
            return;
        }

        var scale = parseFloat(scaleMatch[1]);
        var translateY = parseFloat(translateYMatch[1]);

        // Update the container's transform
        container.style.transform = `scale(${scale - 0.1}) translateY(${translateY - 80}px)`;

        // if there are more than 10 containers, remove the oldest one
        if (headContainer.children.length > 5) {
            headContainer.removeChild(headContainer.children[0]);
        }
    });

    // Clone the container and reset its transform
    var container = document.querySelector('.pp_container');

    var newContainer = container.cloneNode(true);
    newContainer.style.transform = 'scale(1) translateY(80px)';
    setTimeout(() => {
        newContainer.style.transform = 'scale(1) translateY(0px)';
    }, 1);

    // set popup title
    newContainer.querySelector('.pp_container-title').innerHTML = popupTitle;

    // Append the new container to the headContainer
    headContainer.appendChild(newContainer);
}



function removePopupContainer() {
    var containers = document.querySelectorAll('.pp_container');
    var headContainer = document.querySelector('.pp_head-container');

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
        var transform = container.style.transform;
        var scaleMatch = transform.match(/scale\(([^)]+)\)/);
        var translateYMatch = transform.match(/translateY\(([^)]+)\)/);

        if (!scaleMatch || !translateYMatch) {
            console.error('Invalid transform format');
            return;
        }

        var scale = parseFloat(scaleMatch[1]);
        var translateY = parseFloat(translateYMatch[1]);

        // Update the container's transform
        container.style.transform = `scale(${scale + 0.1}) translateY(${translateY + 80}px)`;

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
        var dbContentItems = document.querySelector('.db_content-items');
        dbContentItems.style.opacity = '1';
        dbContentItems.style.pointerEvents = 'all';
    }
}
