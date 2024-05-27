let savedCoverColorValue = '';

function togglePrintLayout() {
    let printLayout = document.getElementById('printLayout').value;
    let doubleSided = document.getElementById('doubleSided');
    let coverPrintColor = document.getElementById('coverPrintColor');
    let staple = document.getElementById('staple');

    if (printLayout === 'A4-alt' || printLayout === 'A5-alt') {
        doubleSided.parentElement.style.display = 'none';
        coverPrintColor.parentElement.style.display = 'flex';
        staple.parentElement.style.display = 'none';
        doubleSided.checked = true;
        coverPrintColor.checked = false;
        staple.checked = true;
    } else {
        doubleSided.parentElement.style.display = 'flex';
        coverPrintColor.parentElement.style.display = 'none';
        staple.parentElement.style.display = 'flex';
        doubleSided.checked = false;
        coverPrintColor.checked = false;
        staple.checked = false;
    }
}

function toggleCoverColor() {
    let differentCoverColor = document.getElementById('differentCoverColor-checkbox').checked;
    let coverColor = document.getElementById('coverColor');

    if (differentCoverColor) {
        coverColor.parentElement.style.display = 'flex';
        coverColor.value = savedCoverColorValue ? savedCoverColorValue : 'white';
    } else {
        savedCoverColorValue = coverColor.value;
        coverColor.parentElement.style.display = 'none';
        coverColor.value = '';
    }
}