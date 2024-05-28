<div>
    <div class="gl_ordinary-input-field">
        <label for="printLayout">Drukwerk layout</label>
        <select id="printLayout" onchange="togglePrintLayout()">
            <option value="A3">A3</option>
            <option value="A4">A4</option>
            <option value="A5">A5</option>
            <option value="A4-alt">Boekje A4 (Dubbelgevouwen A3)</option>
            <option value="A5-alt">Boekje A5 (Dubbelgevouwen A4)</option>
        </select>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printAmount">Aantal exemplaren</label>
        <input type="number" id="printAmount">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperAmount">Aantal papieren per exemplaar</label>
        <input type="number" id="paperAmount">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="doubleSided">Dubbelzijdig afdrukken</label>
        <div class="gl_ordinary-checkbox" id="doubleSided" onclick="toggleCheckbox('doubleSided-checkbox', 'doubleSided')">
            <div class="gl_ordinary-checkbox-indicator"></div>
            <input type="checkbox" id="doubleSided-checkbox" style="display:none;">
        </div>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printColor">Gekleurde inkt</label>
        <div class="gl_ordinary-checkbox" id="printColor" onclick="toggleCheckbox('printColor-checkbox', 'printColor')">
            <div class="gl_ordinary-checkbox-indicator"></div>
            <input type="checkbox" id="printColor-checkbox" style="display:none;">
        </div>
    </div>

    <div class="gl_ordinary-input-field" style="display:none;">
        <label for="coverPrintColor">Gekleurde inkt kaft</label>
        <div class="gl_ordinary-checkbox" id="coverPrintColor" onclick="toggleCheckbox('coverPrintColor-checkbox', 'coverPrintColor')">
            <div class="gl_ordinary-checkbox-indicator"></div>
            <input type="checkbox" id="coverPrintColor-checkbox" style="display:none;">
        </div>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperColor">Papierkleur</label>
        <select id="paperColor">
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
        <div class="gl_ordinary-checkbox" id="differentCoverColor" onclick="toggleCheckbox('differentCoverColor-checkbox', 'differentCoverColor'); toggleCoverColor()">
            <div class="gl_ordinary-checkbox-indicator"></div>
            <input type="checkbox" id="differentCoverColor-checkbox" style="display:none;">
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
        <input type="number" id="paperWeight">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="staple">Geniette afdruk</label>
        <div class="gl_ordinary-checkbox" id="staple" onclick="toggleCheckbox('staple-checkbox', 'staple')">
            <div class="gl_ordinary-checkbox-indicator"></div>
            <input type="checkbox" id="staple-checkbox" style="display:none;">
        </div>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="uploadPrint">Upload PDF</label>
        <button class="but_secondary_icon" style="padding-right:20px !important;" onclick="document.getElementById('uploadPrint').click()">
                <img src="../assets/svg/arrow-circle-filled.svg" alt="Upload knop">
                <span class="gl_upload-button-text">Upload PDF</span>
                <input type="file" id="uploadPrint" class="gl_upload-button" style="display:none;" accept=".pdf">
        </button>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="additionalWishes">Aanvullende wensen/opmerkingen</label>
        <textarea id="additionalWishes" maxlength="200"></textarea>
    </div>

    <!-- Voeg prijsindicatie toe bij button, samen met nieuwe page voor prijslijst -->
    <button class="but_primary" type="submit" onclick="submitPrintOrder(event)">Verstuur</button>
</div>