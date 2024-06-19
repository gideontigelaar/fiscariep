<?php @include"barnav.php"; ?>
            <div class="begroeting">
            <?php
            if(date('H') < '6') {
            echo "<h3>Goedenacht, welkom bij Fiscariep!</h1>";
            }
            elseif (date('H') < '12') {
            echo "<h3>Goedemorgen, welkom bij Fiscariep!</h1>";
            }
            elseif (date('H') < '18') {
            echo "<h3>Goedemiddag, welkom bij Fiscariep!</h1>";
            }
            else {
            echo "<h3>Goedeavond, welkom bij Fiscariep!</h1>";
            }
            ?>
            </div>   

            <div class="text1">
                <h2>Contactgegevens</h2>

                <div>
                    <p>Vaste telefoonnummer: 0596-574815</p>
                    <p>U kan ook met ons contact openen via whatsapp: 06-22620508</p>
                    <p>Email: info@fiscariep.nl</p>
                    <p>Adres: Stationslaan 1, 9919 AB Loppersum</p>
                </div>
                <p>Heeft u vragen of opmerkingen? <br>Neem dan contact met ons op via de bovenstaande contactgegevens.</p><br>

                <h2>U kunt natuurlijk ook bij ons langskomen:</h2>
            
                <div class="openingstijden">
                    <h2>Openingstijden:</h2>
                    <p>Maandag: 9:00 - 16:30</p>
                    <p>Dinsdag: 9:00 - 16:30</p>
                    <p>Woensdag: 9:00 - 16:30</p>
                    <p>Donderdag: 9:00 - 12:00</p>
                    <p>Vrijdag: 9:00 - 12:00</p>
                    <p>Zaterdag: Gesloten</p>
                    <p>Zondag: Gesloten</p>
                </div>

                <br><br><br><br><br><br><br><br><br><br><br><br>

            </div>

        </body>
    </html>