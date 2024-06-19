let savedCoverColorValue = '';

function updatePrintLayoutPrice(price1, price2, price3, price4, price5) {
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

    let priceAmount = document.getElementById('priceAmount');
    let printLayoutPrice = document.getElementById('printLayoutPrice').children[0];
    if (printLayout === 'A3') {
        priceAmount.textContent = '1';
        printLayoutPrice.textContent = price1;
    } else if (printLayout === 'A4') {
        priceAmount.textContent = '2';
        printLayoutPrice.textContent = price2;
    } else if (printLayout === 'A5') {
        priceAmount.textContent = '3';
        printLayoutPrice.textContent = price3;
    } else if (printLayout === 'A4-alt') {
        priceAmount.textContent = '4';
        printLayoutPrice.textContent = price4;
    } else if (printLayout === 'A5-alt') {
        priceAmount.textContent = '5';
        printLayoutPrice.textContent = price5;
    }

    updateTotalPrice();
}

function updatePrintAmountPrice(price) {
    let printAmount = document.getElementById('printAmount').value;
    let priceAmount = document.getElementById('priceAmount');
    let printAmountPrice = document.getElementById('printAmountPrice').children[0];
    priceAmount.textContent = printAmount;
    printAmountPrice.textContent = price;

    updateTotalPrice();
}

function toggleCoverColor() {
    let differentCoverColor = document.getElementById('differentCoverColor-checkbox').checked;
    let coverColor = document.getElementById('coverColor');

    if (differentCoverColor) {
        coverColor.parentElement.style.display = 'flex';
        coverColor.value = savedCoverColorValue ? savedCoverColorValue : 'wit';
    } else {
        savedCoverColorValue = coverColor.value;
        coverColor.parentElement.style.display = 'none';
        coverColor.value = '';
    }
}

function updateTotalPrice() {
    let priceAmounts = document.querySelectorAll('#priceAmount');
    let totalAmount = 0;

    for (let i = 0; i < priceAmounts.length; i++) {
        totalAmount += parseInt(priceAmounts[i].textContent);
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