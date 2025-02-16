<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php";

$stmt = $pdo->prepare("SELECT * FROM pricelist ORDER BY created_at DESC LIMIT 1");
$stmt->execute();
$pricelistData = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div id="pricelist-container">
    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printLayout1">A3 layout</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printLayout1" value="<?= $pricelistData['print_layout_1']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printLayout2">A4 layout</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printLayout2" value="<?= $pricelistData['print_layout_2']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printLayout3">A5 layout</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printLayout3" value="<?= $pricelistData['print_layout_3']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printLayout4">Boekje A4 layout</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printLayout4" value="<?= $pricelistData['print_layout_4']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printLayout5">Boekje A5 layout</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printLayout5" value="<?= $pricelistData['print_layout_5']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperAmount">Papieren per exemplaar</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperAmount" value="<?= $pricelistData['paper_amount']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="doubleSided">Dubbelzijdig afdrukken</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="doubleSided" value="<?= $pricelistData['double_sided']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="printColor">Kleurprint</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="printColor" value="<?= $pricelistData['print_color']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="coverPrintColor">Kleurprint kaft</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="coverPrintColor" value="<?= $pricelistData['cover_print_color']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperColor">Papierkleur (anders dan wit)</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperColor" value="<?= $pricelistData['paper_color']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="coverColor">Kaftkleur (anders dan wit)</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="coverColor" value="<?= $pricelistData['cover_color']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperWeight1">80 grams papier</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperWeight1" value="<?= $pricelistData['paper_weight_1']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperWeight2">100 grams papier</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperWeight2" value="<?= $pricelistData['paper_weight_2']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperWeight3">120 grams papier</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperWeight3" value="<?= $pricelistData['paper_weight_3']; ?>" required>
        </div>
    </div>

    <div class="gl_ordinary-input-field gl_input-small">
        <label for="paperWeight4">160 grams papier</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="paperWeight4" value="<?= $pricelistData['paper_weight_4']; ?>" required>
        </div>
    </div>
    <div class="gl_ordinary-input-field gl_input-small">
        <label for="stapledPrint">Geniette afdruk</label>
        <div class="gl_input-icon">
            <span class="pp_input-label">€</span>
            <input type="number" id="stapledPrint" value="<?= $pricelistData['staple']; ?>" required>
        </div>
    </div>
</div>

<button class="but_primary" type="submit" onclick="updatePricelist()">Opslaan</button>

<script>
    function formatToTwoDecimalPlaces(value) {
        if (!value.includes('.')) {
            return value + '.00';
        } else {
            let splitValue = value.split('.');
            if (splitValue[1].length === 1) {
                return splitValue[0] + '.' + splitValue[1] + '0';
            } else if (splitValue[1].length === 0) {
                return splitValue[0] + '.00';
            }
        }
        return value;
    }

    document.querySelectorAll('#pricelist-container input').forEach(input => {
        input.value = formatToTwoDecimalPlaces(input.value);
    });

    document.querySelector('.but_primary').classList.add('but_disabled');
    for (let i = 0; i < document.querySelectorAll('.gl_ordinary-input-field input').length; i++) {
        document.querySelectorAll('.gl_ordinary-input-field input')[i].addEventListener('input', function() {
            let requiredFields = document.querySelectorAll('.gl_ordinary-input-field input[required]');
            let filledInFields = 0;

            for (let j = 0; j < requiredFields.length; j++) {
                if (requiredFields[j].value !== '') {
                    filledInFields++;
                }
            }

            if (filledInFields === requiredFields.length) {
                document.querySelector('.but_primary').classList.remove('but_disabled');
            } else {
                document.querySelector('.but_primary').classList.add('but_disabled');
            }
        });
    }
</script>