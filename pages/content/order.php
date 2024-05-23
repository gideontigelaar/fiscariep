
<form>
    <div>
        <label for="printLayout">Drukwerk layout</label>
        <select id="printLayout" name="printLayout">
            <option value="A3">A3</option>
            <option value="A4">A4</option>
            <option value="A5">A5</option>
            <option value="A4-alt">Boekje A4 (Dubbelgevouwen)</option>
            <option value="A5-alt">Boekje A5 (Dubbelgevouwen)</option>
        </select>
    </div>

    <div>
        <label for="printAmount">Aantal exemplaren</label>
        <input type="number" id="printAmount" name="printAmount">
    </div>

    <div>
        <label for="paperAmount">Aantal papieren per exemplaar</label>
        <input type="number" id="paperAmount" name="paperAmount">
    </div>

    <div>
        <label for="doubleSided">Dubbelzijdig afdrukken</label>
        <input type="checkbox" id="doubleSided" name="doubleSided">
    </div>

    <div>
        <label for="printColor">Gekleurd afdrukken</label>
        <input type="checkbox" id="printColor" name="printColor">
    </div>

    <div>
        <label for="paperColor">Papierkleur</label>
        <input type="text" id="paperColor" name="paperColor">
    </div>

    <div>
        <label for="paperWeight">Gewicht papier</label>
        <input type="number" id="paperWeight" name="paperWeight">
    </div>

    <div>
        <label for="staple">Geniette afdruk</label>
        <input type="checkbox" id="staple" name="staple">
    </div>

    <div>
        <label for="uploadPrint">Upload PDF</label>
        <input type="file" id="uploadPrint" name="uploadPrint">
    </div>

    <div>
        <label for="additionalWishes">Aanvullende wensen/opmerkingen</label>
        <textarea id="additionalWishes" name="additionalWishes"></textarea>
    </div>

    <button class="but_primary" type="submit" onclick="submitPrintOrder(event)">Verstuur</button>
</form>