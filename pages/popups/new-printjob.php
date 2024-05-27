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
        <input type="checkbox" id="doubleSided">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="printColor">Gekleurd afdrukken</label>
        <input type="checkbox" id="printColor">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperColor">Papierkleur</label>
        <input type="text" id="paperColor">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="differentCoverColor">Andere kaftkleur</label>
        <input type="checkbox" id="differentCoverColor" onchange="toggleCoverColor()">
    </div>

    <div class="gl_ordinary-input-field" style="display:none;">
        <label for="coverColor">Kaftkleur</label>
        <input type="text" id="coverColor">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="paperWeight">Gewicht papier</label>
        <input type="number" id="paperWeight">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="staple">Geniette afdruk</label>
        <input type="checkbox" id="staple">
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
        <textarea id="additionalWishes"></textarea>
    </div>

    <!-- Voeg prijsindicatie toe bij button, samen met nieuwe page voor prijslijst -->
    <button class="but_primary" type="submit" onclick="submitPrintOrder(event)">Verstuur</button>
</div>