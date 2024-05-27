<div id="change-password-container">
    <div>
        <div class="gl_ordinary-input-field">
            <label for="oldPassword">Huidig wachtwoord</label>
            <input type="password" id="oldPassword">
        </div>

        <div class="gl_ordinary-input-field">
            <label for="newPassword">Wachtwoord</label>
            <input type="password" id="newPassword">
        </div>

        <div class="gl_ordinary-input-field">
            <label for="confirmPassword">Bevestig wachtwoord</span></label>
            <input type="password" id="confirmPassword">
        </div>
    </div>

    <button class="but_primary" id="save-button-change-pw" onclick="changePassword()">Opslaan</button>
</div>

<script>
    // if there are values that aren't filled in, make the but_primary disabled else enabled
    document.getElementById('save-button-change-pw').classList.add('but_disabled');
    // if ALL input fields inside of change-password-container are filled in, remove the but_disabled class from the save-button, else add it
    document.getElementById('change-password-container').addEventListener('input', function() {
        let inputs = document.querySelectorAll('#change-password-container input');
        let filledIn = true;
        inputs.forEach(input => {
            if (input.value === '') {
                filledIn = false;
            }
        });
        if (filledIn) {
            document.getElementById('save-button-change-pw').classList.remove('but_disabled');
        } else {
            document.getElementById('save-button-change-pw').classList.add('but_disabled');
        }
    });
</script>