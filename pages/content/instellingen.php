<?php
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<script src="/assets/js/settings.js"></script>
<script src="/assets/js/showError.js"></script>

<div>
    <h1 style="margin-bottom: 0px;">Instellingen</h1>
    <div class="gl_head-info">
        <p>Wijzig gebruikersinstellingen</p>
    </div>
</div>

<hr class="gl_top-divider">


<div style="max-width:90%;">
    <div class="gl_ordinary-input-field">
        <label for="username">Gebruikersnaam</label>
        <input type="text" id="username" value="<?= $userData['username']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="email">E-mail</label>
        <input type="email" id="email" value="<?= $userData['email']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="address">Adres</label>
        <input type="text" id="address" value="<?= $userData['address']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="postal_code">Postcode</label>
        <input type="text" id="postal_code" value="<?= $userData['postal_code']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="city">Plaats</label>
        <input type="text" id="city" value="<?= $userData['city']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="province">Provincie</label>
        <input type="text" id="province" value="<?= $userData['province']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="country">Land</label>
        <input type="text" id="country" value="<?= $userData['country']; ?>" required>
    </div>

    <div class="gl_ordinary-input-field">
        <label for="phone_number">Telefoonnummer</label>
        <input type="text" id="phone_number" value="<?= $userData['phone_number']; ?>" required>
    </div>
    <button class="but_primary" type="submit" onclick="updateSettings()">Opslaan</button>

    <button onclick="nextPopupStep('Wijzig wachtwoord', '','change-password')">Wijzig wachtwoord</button>

    <?php if ($userData['role'] == 'admin') { ?>
        <button onclick="nextPopupStep('Wijzig prijslijst', '','change-pricelist')">Wijzig prijslijst</button>
    <?php } ?>
</div>

<script>
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