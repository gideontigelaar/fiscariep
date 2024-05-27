<div>
    <div>
        <label for="printLayout">Drukwerk layout</label>
        <select id="printLayout">
            <option value="A3">A3</option>
            <option value="A4">A4</option>
            <option value="A5">A5</option>
            <option value="A4-alt">Boekje A4 (Dubbelgevouwen A3)</option>
            <option value="A5-alt">Boekje A5 (Dubbelgevouwen A4)</option>
        </select>
    </div>

    <div>
        <label for="printAmount">Aantal exemplaren</label>
        <input type="number" id="printAmount">
    </div>

    <div>
        <label for="paperAmount">Aantal papieren per exemplaar</label>
        <input type="number" id="paperAmount">
    </div>

    <!-- Dubbezijdig afdrukken verbergen en aanzetten als er gekozen is voor papieren boekje -->
    <div>
        <label for="doubleSided">Dubbelzijdig afdrukken</label>
        <input type="checkbox" id="doubleSided">
    </div>

    <div>
        <label for="printColor">Gekleurd afdrukken</label>
        <input type="checkbox" id="printColor">
    </div>

    <div>
        <label for="paperColor">Papierkleur</label>
        <input type="text" id="paperColor">
    </div>

    <!-- Checkbox voor andere kaftkleur, als deze aangevinkt is, nieuwe input field voor kaftkleur, anders wordt dit hetzelfde als papierkleur -->

    <div>
        <label for="paperWeight">Gewicht papier</label>
        <input type="number" id="paperWeight">
    </div>

    <!-- Geniette afdruk verbergen en aanzetten als er gekozen is voor papieren boekje -->
    <div>
        <label for="staple">Geniette afdruk</label>
        <input type="checkbox" id="staple">
    </div>

    <div>
        <label for="uploadPrint">Upload PDF</label>
        <input type="file" id="uploadPrint">
    </div>

    <div>
        <label for="additionalWishes">Aanvullende wensen/opmerkingen</label>
        <textarea id="additionalWishes"></textarea>
    </div>

    <!-- Voeg prijsindicatie toe bij button, samen met nieuwe page voor prijslijst -->
    <button class="but_primary" type="submit" onclick="submitPrintOrder(event)">Verstuur</button>
</div>