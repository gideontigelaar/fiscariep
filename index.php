<?php @include"home/navbar.php"; ?>
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
                <h1>Welkom bij Fiscariep</h1>
                <p>Op de website kan je alles vinden wat wij doen.<br> Hier kan je informatie vinden over de belastingdienst, belastingaangifte en nog veel meer.<br> Ook kan je hier terecht voor hulp bij je belastingaangifte en andere belastingzaken.<br> Kijk gerust rond op de website en als je vragen hebt, neem dan contact met ons op.</p>
            </div>

        </body>
    </html>