<span>Om aan de slag te gaan is het verplicht om jouw gegevens in te vullen. Dit is nodig om jouw account te beveiligen en om jouw gegevens te kunnen verwerken.</span>

<div style="margin-top:20px;">
    <div class="gl_ordinary-input-field">
        <label for="address">Adres</label>
        <input type="text" id="address" value="<?php echo $userData['address']; ?>">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="postal_code">Postcode</label>
        <input type="text" id="postal_code" value="<?php echo $userData['postal_code']; ?>">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="city">Plaats</label>
        <input type="text" id="city" value="<?php echo $userData['city']; ?>">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="province">Provincie</label>
        <input type="text" id="province" value="<?php echo $userData['province']; ?>">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="country">Land</label>
        <input type="text" id="country" value="<?php echo $userData['country']; ?>">
    </div>

    <div class="gl_ordinary-input-field">
        <label for="phone_number">Telefoonnummer</label>
        <input type="text" id="phone_number" value="<?php echo $userData['phone_number']; ?>">
    </div>
    <button class="but_primary" type="submit" style="width:100%;margin-top:20px;">Opslaan</button>
</div>

<script>
    let ppContents = document.querySelectorAll('.pp_container-contents .but_secondary_icon');
    ppContents.forEach(content => {
        content.remove();
    });

    document.querySelector('.pp_head-container').style.boxShadow = 'rgb(47 49 146 / 75%) 0px 0px 0px 2000px inset';
    document.querySelector('.pp_container').style.pointerEvents = 'none';
    document.querySelector('.pp_container-contents').style.pointerEvents = 'all';
</script>