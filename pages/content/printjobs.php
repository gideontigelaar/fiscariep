<div>
    <h1 style="margin-bottom: 0px;">Alle printjobs</h1>
    <div class="gl_head-info">
        <p>Er <?= count($openPrints) == 1 ? "is" : "zijn" ?> <?= count($openPrints); ?> openstaande printjob<?= count($openPrints) == 1 ? "" : "s" ?></p>
        <button class="but_primary_icon" style="padding-right:20px !important;" onclick="nextPopupStep('Nieuwe printjob', '','new-printjob')">
            <img src="../assets/svg/plus-circle-filled.svg" alt="Nieuwe printjob-icoon">
            Nieuwe printjob
        </button>
    </div>
</div>

<hr class="gl_top-divider">

<div class="jobs_month-picker but_primary_icon" style="padding-right: revert;">
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="prevArrow" style="transform: rotate(270deg)" alt="Vorige maand" onclick="changeMonth(-1)">
    <span id="monthYearDisplay">Jangustus</span>
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="nextArrow" style="transform: rotate(90deg)" alt="Volgende maand" onclick="changeMonth(1)">

    <script>
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth();
        var currentYear = currentDate.getFullYear();
        var months = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];

        function updateMonthYearDisplay() {
            var monthYearDisplay = document.getElementById("monthYearDisplay");
            monthYearDisplay.textContent = months[currentMonth] + ' ' + currentYear;

            var nextArrow = document.getElementById("nextArrow");
            if (currentMonth === new Date().getMonth() && currentYear === new Date().getFullYear()) {
                nextArrow.classList.add("but_disabled");
            } else {
                nextArrow.classList.remove("but_disabled");
            }
        }

        function changeMonth(delta) {
            var newMonth = currentMonth + delta;
            var newYear = currentYear;

            if (newMonth < 0) {
                newMonth = 11;
                newYear--;
            } else if (newMonth > 11) {
                newMonth = 0;
                newYear++;
            }

            var futureDate = new Date(newYear, newMonth);
            var today = new Date();

            if (futureDate <= today) {
                currentMonth = newMonth;
                currentYear = newYear;
                updateMonthYearDisplay();
            }
        }

        document.getElementById("prevArrow").onclick = function() {
            changeMonth(-1);
        };

        document.getElementById("nextArrow").onclick = function() {
            changeMonth(1);
        };

        updateMonthYearDisplay();
    </script>
</div>

<div class="jobs_head-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/queries/order-list.php"; ?>
</div>
