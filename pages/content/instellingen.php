<?php
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<script src="/assets/js/settings.js"></script>
<script src="/assets/js/showError.js"></script>
<div>
    <div>
        <div>
            <label for="username">Gebruikersnaam</label>
            <input type="text" id="username" value="<?php echo $userData['username']; ?>">
        </div>

        <div>
            <label for="email">E-mail</label>
            <input type="email" id="email" value="<?php echo $userData['email']; ?>">
        </div>

        <div>
            <label for="address">Adres</label>
            <input type="text" id="address" value="<?php echo $userData['address']; ?>">
        </div>

        <div>
            <label for="postal_code">Postcode</label>
            <input type="text" id="postal_code" value="<?php echo $userData['postal_code']; ?>">
        </div>

        <div>
            <label for="city">Plaats</label>
            <input type="text" id="city" value="<?php echo $userData['city']; ?>">
        </div>

        <div>
            <label for="province">Provincie</label>
            <input type="text" id="province" value="<?php echo $userData['province']; ?>">
        </div>

        <div>
            <label for="country">Land</label>
            <input type="text" id="country" value="<?php echo $userData['country']; ?>">
        </div>

        <div>
            <label for="phone_number">Telefoonnummer</label>
            <input type="text" id="phone_number" value="<?php echo $userData['phone_number']; ?>">
        </div>

        <button class="but_primary" type="submit" onclick="updateSettings()">Opslaan</button>
    </div>

    <div>
        <div>
            <div>
                <label for="oldPassword">Huidig wachtwoord</label>
                <input type="password" id="oldPassword">
            </div>

            <div>
                <label for="newPassword">Wachtwoord</label>
                <input type="password" id="newPassword">
            </div>

            <div>
                <label for="confirmPassword">Bevestig wachtwoord</span></label>
                <input type="password" id="confirmPassword">
            </div>
        </div>

        <button class="but_primary" type="submit" onclick="changePassword()">Opslaan</button>
    </div>
</div>