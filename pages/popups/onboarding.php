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

<script>
    // if gl_circle-icon-primary is clicked on, change the scale of the img inside of it with 5% each time its clicked. so 5% + 5% + 5% etc.

    // set initial scale to 1
    document.querySelectorAll('.gl_circle-icon-primary img').forEach(img => {
        img.style.transform = 'scale(1)';
    });

    // after 14 clicks, change ALL text on the page to comic sans

    var clicks = 0;

    document.querySelectorAll('.gl_circle-icon-primary').forEach(circle => {
        circle.addEventListener('click', function() {
            let img = circle.querySelector('img');
            img.style.transform = `scale(${parseFloat(img.style.transform.split('(')[1].split(')')[0]) + 0.05})`;
            clicks++;
            performActions();
        });
    });

    function performActions() {
        if (clicks === 14) {
        document.querySelectorAll('body *').forEach(element => {
            element.style.fontFamily = 'Comic Sans MS';
        });
        }

        if (clicks === 20) {
            document.querySelectorAll('body *').forEach(element => {
                element.style.color = `rgb(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)})`;
            });
            let body = document.querySelector('body');
            body.style.filter = 'hue-rotate(' + Math.floor(Math.random() * 360) + 'deg)';
            body.style.backgroundColor = `rgb(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)})`;
        }

        function rotate() {
            document.querySelector('body').style.transform = 'rotateX(0deg) rotateY(45deg)';
            setTimeout(() => {
                document.querySelector('body').style.transform = 'rotateY(0deg) rotateX(45deg)';
                setTimeout(() => {
                    rotate();
                }, 200);
            }, 200);
        }
        
        if (clicks === 25) {
            rotate();

            var memeText = [
                'who let da dogs out',
                'i can has cheezburger',
                'all your base are belong to us',
                'do a barrel roll',
                'i like turtles',
                'numa numa',
                'never gonna give you up',
                'oooooohhhhhhh',
                'i am your father',
                'baba booey',
                'henlo',
                'big chungus',
                'epic fail',
                'bing chilling',
                'pringles',
                'poggers',
                'KEKW',
                'help i am stuck in a computer',
                'i am a robot',
                'aliens',
                'area 51',
                'fortnite',
                'minecraft',
                'fortnite battle royale',
                'herobrine is real'
            ]

            document.querySelectorAll('span, label, h1, h2, h3, h4, h5, h6, p, a, button').forEach(element => {
                element.innerText = memeText[Math.floor(Math.random() * memeText.length)];
            });
        }
    }
</script>