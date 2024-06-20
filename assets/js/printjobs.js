let savedCoverColorValue = '';

function updatePrintLayoutPrice(price1, price2, price3, price4, price5) {
    let printLayout = document.getElementById('printLayout').value;
    let doubleSided = document.getElementById('doubleSided');
    let coverPrintColor = document.getElementById('coverPrintColor');
    let staple = document.getElementById('staple');

    // dynamically update price based on whats checked and what printLayout is selected
    if (printLayout === 'A4-alt' || printLayout === 'A5-alt') {
        doubleSided.parentElement.parentElement.style.display = 'none';
        doubleSided.checked = true;

        coverPrintColor.parentElement.parentElement.style.display = 'flex';
        coverPrintColor.checked = false;

        staple.parentElement.parentElement.style.display = 'none';
        staple.checked = true;
    } else {
        doubleSided.parentElement.parentElement.style.display = 'flex';
        doubleSided.checked = false;

        coverPrintColor.parentElement.parentElement.style.display = 'none';
        coverPrintColor.checked = false;

        staple.parentElement.parentElement.style.display = 'flex';
        staple.checked = false;
    }


    let printLayoutPrice = document.getElementById('printLayoutPrice').children[0];

    if (printLayout === 'A3') {
        printLayoutPrice.textContent = price1;
    } else if (printLayout === 'A4') {
        printLayoutPrice.textContent = price2;
    } else if (printLayout === 'A5') {
        printLayoutPrice.textContent = price3;
    } else if (printLayout === 'A4-alt') {
        printLayoutPrice.textContent = price4;
    } else if (printLayout === 'A5-alt') {
        printLayoutPrice.textContent = price5;
    }

    updateTotalPrice();
}

function updatePrintAmountPrice() {
    let printAmount = document.getElementById('printAmount').value;
    updateTotalPrice(printAmount);
}

function updatePaperAmountPrice(price) {
    let paperAmount = document.getElementById('paperAmount').value;
    let paperAmountPrice = document.getElementById('paperAmountPrice').children[0];
    let priceAmount = paperAmount * price;
    paperAmountPrice.textContent = priceAmount;

    updateTotalPrice();
}

function updateDoubleSidedPrice(price) {
    let doubleSided = document.getElementById('doubleSided');
    let doubleSidedPrice = document.getElementById('doubleSidedPrice').children[0];

    if (doubleSided.classList.contains('active')) {
        doubleSidedPrice.textContent = price;
    } else {
        doubleSidedPrice.textContent = 0;
    }

    updateTotalPrice();
}

function updatePrintColorPrice(price) {
    let printColor = document.getElementById('printColor');
    let printColorPrice = document.getElementById('printColorPrice').children[0];

    if (printColor.classList.contains('active')) {
        printColorPrice.textContent = price;
    } else {
        printColorPrice.textContent = 0;
    }

    updateTotalPrice();
}

function updateCoverPrintColorPrice(price) {
    let coverPrintColor = document.getElementById('coverPrintColor');
    let coverPrintColorPrice = document.getElementById('coverPrintColorPrice').children[0];

    if (coverPrintColor.classList.contains('active')) {
        coverPrintColorPrice.textContent = price;
    } else {
        coverPrintColorPrice.textContent = 0;
    }

    updateTotalPrice();
}

function updatePaperColorPrice(price) {
    let paperColor = document.getElementById('paperColor');
    let paperColorPrice = document.getElementById('paperColorPrice').children[0];

    if (paperColor.value === 'wit') {
        paperColorPrice.textContent = 0;
    } else {
        paperColorPrice.textContent = price;
    }

    updateTotalPrice();
}

function updateDifferentCoverColorPrice(price) {
    let differentCoverColor = document.getElementById('differentCoverColor-checkbox');
    let differentCoverColorPrice = document.getElementById('differentCoverColorPrice').children[0];
    let coverColor = document.getElementById('coverColor');

    if (differentCoverColor.checked) {
        differentCoverColorPrice.textContent = price;
        coverColor.parentElement.style.display = 'flex';
        coverColor.value = savedCoverColorValue ? savedCoverColorValue : 'wit';
    } else {
        differentCoverColorPrice.textContent = 0;
        savedCoverColorValue = coverColor.value;
        coverColor.parentElement.style.display = 'none';
        coverColor.value = '';
    }

    updateTotalPrice();
}

function updateStaplePrice(price) {
    let staple = document.getElementById('staple');
    let staplePrice = document.getElementById('staplePrice').children[0];

    if (staple.classList.contains('active')) {
        staplePrice.textContent = price;
    } else {
        staplePrice.textContent = 0;
    }

    updateTotalPrice();
}

function updateTotalPrice(printAmount) {
    let priceAmounts = document.querySelectorAll('#priceAmount');
    let totalAmount = 0;

    for (let i = 0; i < priceAmounts.length; i++) {
        totalAmount += parseInt(priceAmounts[i].textContent);
    }

    if (printAmount) {
        totalAmount *= printAmount;
    }

    let minus10Percent = totalAmount * 0.9;
    let plus10Percent = totalAmount * 1.1;

    minus10Percent = minus10Percent.toFixed(2);
    plus10Percent = plus10Percent.toFixed(2);

    minus10Percent = minus10Percent.replace('.', ',');
    plus10Percent = plus10Percent.replace('.', ',');

    let priceAmountTotalExpectation = minus10Percent + ' - ' + plus10Percent;

    let priceAmountTotalExpectationElement = document.getElementById('priceAmountTotal');
    priceAmountTotalExpectationElement.textContent = priceAmountTotalExpectation;
}