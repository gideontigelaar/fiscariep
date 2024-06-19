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
                <p>wij werken samen met de volgende partners: kleisteen, onview en snelstart </p>
                <img src="img/kleisteen.png" alt="Image" style="width: 300px;">
                <img src="img/onview.png" alt="Image" style="width: 300px;">
                <img src="img/Snelstart.png" alt="Image" style="width: 300px;">
            </div>