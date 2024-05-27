function togglePrintLayout() {
    let printLayout = document.getElementById('printLayout').value;
    let doubleSided = document.getElementById('doubleSided');
    let staple = document.getElementById('staple');

    if (printLayout === 'A4-alt' || printLayout === 'A5-alt') {
        doubleSided.parentElement.style.display = 'none';
        staple.parentElement.style.display = 'none';
        doubleSided.checked = true;
        staple.checked = true;
    } else {
        doubleSided.parentElement.style.display = 'flex';
        staple.parentElement.style.display = 'flex';
        doubleSided.checked = false;
        staple.checked = false;
    }
}

function toggleCoverColor() {
    let differentCoverColor = document.getElementById('differentCoverColor').checked;
    let coverColor = document.getElementById('coverColor');

    if (differentCoverColor) {
        coverColor.parentElement.style.display = 'flex';
        coverColor.value = 'wit';
    } else {
        coverColor.parentElement.style.display = 'none';
        coverColor.value = '';
    }
}