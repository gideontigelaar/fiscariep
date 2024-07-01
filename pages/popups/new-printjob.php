<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php";

$stmt = $pdo->prepare("SELECT * FROM pricelist ORDER BY created_at DESC LIMIT 1");
$stmt->execute();
$pricelistData = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div>
    <div class="pp-npj_price-indication">
        <span class="pp-npj_price-indication-heading">Prijsindicatie</span>
        <span>€ <span class="pp-npj_price-indication-numbers" id="priceAmountTotal">0</span></span>
        <span id="priceAmount" style="display:none;">0</span>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printLayout">Drukwerk layout</label>
        <select id="printLayout" onchange="updatePrintLayoutPrice(<?= $pricelistData['print_layout_1']; ?>, <?= $pricelistData['print_layout_2']; ?>, <?= $pricelistData['print_layout_3']; ?>, <?= $pricelistData['print_layout_4']; ?>, <?= $pricelistData['print_layout_5']; ?>)">
            <option value="" disabled selected>-- Selecteer een optie --</option>
            <option value="A3">A3</option>
            <option value="A4">A4</option>
            <option value="A5">A5</option>
            <option value="A4-alt">Boekje A4 (Dubbelgevouwen A3)</option>
            <option value="A5-alt">Boekje A5 (Dubbelgevouwen A4)</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printAmount">Aantal exemplaren</label>
        <input type="number" placeholder="0" id="printAmount" required onchange="updatePrintAmountPrice()">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperAmount">Aantal papieren per exemplaar</label>
        <input type="number" placeholder="0" id="paperAmount" required onchange="updatePaperAmountPrice(<?= $pricelistData['paper_amount']; ?>)">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="doubleSided">Dubbelzijdig afdrukken</label>
        <div onclick="updateDoubleSidedPrice(<?= $pricelistData['double_sided']; ?>)">
            <div class="gl_ordinary-checkbox" id="doubleSided" onclick="toggleCheckbox('doubleSided-checkbox', 'doubleSided')">
                <div class="gl_ordinary-checkbox-indicator"></div>
                <input type="checkbox" id="doubleSided-checkbox" style="display:none;">
            </div>
        </div>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printColor">Kleurprint</label>
        <div onclick="updatePrintColorPrice(<?= $pricelistData['print_color']; ?>)">
            <div class="gl_ordinary-checkbox" id="printColor" onclick="toggleCheckbox('printColor-checkbox', 'printColor')">
                <div class="gl_ordinary-checkbox-indicator"></div>
                <input type="checkbox" id="printColor-checkbox" style="display:none;">
            </div>
        </div>
    </div>

    <div class="gl_ordinary-input-field" style="display:none;">
        <label for="coverPrintColor">Kleurprint kaft</label>
        <div onclick="updateCoverPrintColorPrice(<?= $pricelistData['cover_print_color']; ?>)">
            <div class="gl_ordinary-checkbox" id="coverPrintColor" onclick="toggleCheckbox('coverPrintColor-checkbox', 'coverPrintColor')">
                <div class="gl_ordinary-checkbox-indicator"></div>
                <input type="checkbox" id="coverPrintColor-checkbox" style="display:none;">
            </div>
        </div>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperColor">Papierkleur</label>
        <select id="paperColor" onchange="updatePaperColorPrice(<?= $pricelistData['paper_color']; ?>)">
            <option value="wit">Wit</option>
            <option value="zwart">Zwart</option>
            <option value="rood">Rood</option>
            <option value="blauw">Blauw</option>
            <option value="groen">Groen</option>
            <option value="geel">Geel</option>
            <option value="paars">Paars</option>
            <option value="oranje">Oranje</option>
            <option value="bruin">Bruin</option>
            <option value="grijs">Grijs</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="differentCoverColor">Andere kaftkleur</label>
        <div onclick="updateDifferentCoverColorPrice(<?= $pricelistData['cover_color']; ?>)">
            <div class="gl_ordinary-checkbox" id="differentCoverColor" onclick="toggleCheckbox('differentCoverColor-checkbox', 'differentCoverColor')">
                <div class="gl_ordinary-checkbox-indicator"></div>
                <input type="checkbox" id="differentCoverColor-checkbox" style="display:none;" onchange="updateDifferentCoverColorPrice(<?= $pricelistData['cover_color']; ?>)">
            </div>
        </div>
    </div>

    <div class="gl_ordinary-input-field" style="display:none;">
        <label for="coverColor">Kaftkleur</label>
        <select id="coverColor">
            <option value="wit">Wit</option>
            <option value="zwart">Zwart</option>
            <option value="rood">Rood</option>
            <option value="blauw">Blauw</option>
            <option value="groen">Groen</option>
            <option value="geel">Geel</option>
            <option value="paars">Paars</option>
            <option value="oranje">Oranje</option>
            <option value="bruin">Bruin</option>
            <option value="grijs">Grijs</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperWeight">Gewicht papier</label>
         <select id="paperWeight" onchange="updatePaperWeightPrice(<?= $pricelistData['paper_weight_1']; ?>, <?= $pricelistData['paper_weight_2']; ?>, <?= $pricelistData['paper_weight_3']; ?>, <?= $pricelistData['paper_weight_4']; ?>)">
            <option value="" disabled selected>-- Selecteer een optie --</option>
            <option value="80">80 gram</option>
            <option value="100">100 gram</option>
            <option value="120">120 gram</option>
            <option value="160">160 gram</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="staple">Nietstatus</label>
        <select id="staple" onchange="updateStaplePrice(<?= $pricelistData['staple']; ?>)">
            <option value="geen">Geen nietjes</option>
            <option value="linksboven">Nietje linksboven</option>
            <option value="linksmidden">Nietje linksmidden</option>
            <option value="rechtsboven">Nietje rechtsboven</option>
            <option value="rechtsmidden">Nietje rechtsmidden</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="uploadPrint">Upload PDF</label>
        <button class="but_secondary_icon" style="padding-right:20px !important;" onclick="document.getElementById('uploadPrint').click()">
            <img src="../assets/svg/arrow-circle-filled.svg" alt="Upload knop">
            <span class="gl_upload-button-text">Upload PDF</span>
            <input type="file" id="uploadPrint" class="gl_upload-button" style="display:none;" accept=".pdf" required>
        </button>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="additionalWishes">Aanvullende wensen/opmerkingen</label>
        <textarea placeholder="Vul hier je wens/opmerking in. Dit is niet vereist." id="additionalWishes" maxlength="200"></textarea>
    </div>

    <button class="but_primary" type="submit" onclick="submitPrintOrder(event)" style="width:100%;margin-top:10px;">Toevoegen</button>
</div>

<script>
    document.querySelector('.but_primary').classList.add('but_disabled');

    document.querySelectorAll('.gl_ordinary-input-field input').forEach(function(input) {
        input.addEventListener('input', function() {
            let requiredFields = document.querySelectorAll('.gl_ordinary-input-field input[required]');
            let filledInFields = 0;

            requiredFields.forEach(function(field) {
                if (field.value !== '') {
                    filledInFields++;
                }
            });

            let printLayoutSelect = document.getElementById('printLayout');
            if (filledInFields === requiredFields.length && printLayoutSelect.value !== '') {
                document.querySelector('.but_primary').classList.remove('but_disabled');
            } else {
                document.querySelector('.but_primary').classList.add('but_disabled');
            }
        });
    });

    function updateButtonState() {
        let requiredFields = document.querySelectorAll('.gl_ordinary-input-field input[required]');
        let filledInFields = 0;

        requiredFields.forEach(function(field) {
            if (field.value !== '') {
                filledInFields++;
            }
        });

        let printLayoutSelect = document.getElementById('printLayout');
        let paperWeightSelect = document.getElementById('paperWeight');

        if ((filledInFields === requiredFields.length && printLayoutSelect.value !== '') ||
            (filledInFields === requiredFields.length && paperWeightSelect.value !== '')) {
            document.querySelector('.but_primary').classList.remove('but_disabled');
        } else {
            document.querySelector('.but_primary').classList.add('but_disabled');
        }
    }

    document.getElementById('printLayout').addEventListener('change', updateButtonState);

    document.getElementById('paperWeight').addEventListener('change', updateButtonState);
</script>