let savedCoverColorValue = '';

let basePrices = {
    printLayout: 0,
    paperAmount: 0,
    doubleSided: 0,
    printColor: 0,
    coverPrintColor: 0,
    paperColor: 0,
    differentCoverColor: 0,
    staple: 0
};

function updatePrintLayoutPrice(price1, price2, price3, price4, price5) {
    let printLayout = document.getElementById('printLayout').value;
    let doubleSided = document.getElementById('doubleSided');
    let coverPrintColor = document.getElementById('coverPrintColor');
    let staple = document.getElementById('staple');

    if (printLayout === 'A4-alt' || printLayout === 'A5-alt') {
        doubleSided.parentElement.parentElement.style.display = 'none';
        doubleSided.checked = true;

        coverPrintColor.parentElement.parentElement.style.display = 'flex';
        coverPrintColor.checked = false;

        staple.parentElement.style.display = 'none';
        staple.checked = true;
    } else {
        doubleSided.parentElement.parentElement.style.display = 'flex';
        doubleSided.checked = false;

        coverPrintColor.parentElement.parentElement.style.display = 'none';
        coverPrintColor.checked = false;

        staple.parentElement.style.display = 'flex';
        staple.checked = false;
    }

    if (printLayout === 'A3') {
        basePrices.printLayout = price1;
    } else if (printLayout === 'A4') {
        basePrices.printLayout = price2;
    } else if (printLayout === 'A5') {
        basePrices.printLayout = price3;
    } else if (printLayout === 'A4-alt') {
        basePrices.printLayout = price4;
    } else if (printLayout === 'A5-alt') {
        basePrices.printLayout = price5;
    }

    updateTotalPrice();
}

function updatePrintAmountPrice() {
    updateTotalPrice();
}

function updatePaperAmountPrice(price) {
    let paperAmount = document.getElementById('paperAmount').value;
    basePrices.paperAmount = paperAmount * price;
    updateTotalPrice();
}

function updateDoubleSidedPrice(price) {
    let doubleSided = document.getElementById('doubleSided');
    basePrices.doubleSided = doubleSided.classList.contains('active') ? price : 0;
    updateTotalPrice();
}

function updatePrintColorPrice(price) {
    let printColor = document.getElementById('printColor');
    basePrices.printColor = printColor.classList.contains('active') ? price : 0;
    updateTotalPrice();
}

function updateCoverPrintColorPrice(price) {
    let coverPrintColor = document.getElementById('coverPrintColor');
    basePrices.coverPrintColor = coverPrintColor.classList.contains('active') ? price : 0;
    updateTotalPrice();
}

function updatePaperColorPrice(price) {
    let paperColor = document.getElementById('paperColor');
    basePrices.paperColor = (paperColor.value === 'wit') ? 0 : price;
    updateTotalPrice();
}

function updateDifferentCoverColorPrice(price) {
    let differentCoverColor = document.getElementById('differentCoverColor-checkbox');
    let coverColor = document.getElementById('coverColor');

    if (differentCoverColor.checked) {
        basePrices.differentCoverColor = price;
        coverColor.parentElement.style.display = 'flex';
        coverColor.value = savedCoverColorValue ? savedCoverColorValue : 'wit';
    } else {
        basePrices.differentCoverColor = 0;
        savedCoverColorValue = coverColor.value;
        coverColor.parentElement.style.display = 'none';
        coverColor.value = '';
    }

    updateTotalPrice();
}

function updatePaperWeightPrice(price1, price2, price3, price4) {
    let paperWeight = document.getElementById('paperWeight').value;

    if (paperWeight === '80') {
        basePrices.paperWeight = price1;
    } else if (paperWeight === '100') {
        basePrices.paperWeight = price2;
    } else if (paperWeight === '120') {
        basePrices.paperWeight = price3;
    } else if (paperWeight === '160') {
        basePrices.paperWeight = price4;
    }

    updateTotalPrice();
}

function updateStaplePrice(price) {
    let staple = document.getElementById('staple');
    basePrices.staple = (staple.value === 'geen') ? 0 : price;
    updateTotalPrice();
}

function updateTotalPrice() {
    let printAmount = document.getElementById('printAmount').value || 1;
    let totalAmount = 0;

    for (let key in basePrices) {
        totalAmount += basePrices[key];
    }

    totalAmount *= printAmount;

    let minus10Percent = totalAmount * 0.9;
    let plus10Percent = totalAmount * 1.1;

    minus10Percent = minus10Percent.toFixed(2).replace('.', ',');
    plus10Percent = plus10Percent.toFixed(2).replace('.', ',');

    let priceAmountTotalExpectation = minus10Percent + ' - ' + plus10Percent;
    document.getElementById('priceAmountTotal').textContent = priceAmountTotalExpectation;
}