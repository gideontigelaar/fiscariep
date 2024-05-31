<?php
$stmt = $pdo->prepare("SELECT * FROM prints WHERE status = 'openstaand' ORDER BY created_at DESC");
$stmt->execute();
$openPrints = $stmt->fetchAll();
?>
<div>
    <h1 style="margin-bottom: 0px;">Alle printjobs</h1>
    <div class="gl_head-info">
        <p>Er <?= count($openPrints) == 1 ? "is" : "zijn" ?> <?= count($openPrints); ?> openstaande printjob<?= count($openPrints) == 1 ? "" : "s" ?></p>
        <button id="new-printjob-btn" class="but_primary_icon" style="padding-right:20px !important;" onclick="nextPopupStep('Nieuwe printjob', '','new-printjob')">
            <img src="../assets/svg/plus-circle-filled.svg" alt="Nieuwe printjob-icoon">
            Nieuwe printjob
        </button>
    </div>
</div>

<hr class="gl_top-divider">

<div class="jobs_month-picker but_primary_icon" style="padding-right: revert;">
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="prevArrow" style="transform: rotate(270deg)" alt="Vorige maand">
    <span id="monthYearDisplay"></span>
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="nextArrow" style="transform: rotate(90deg)" alt="Volgende maand">

    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        let monthDifference = 0;
        var months = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];

        function changeMonth(difference) {
            monthDifference += difference;

            if (monthDifference > 0) {
                monthDifference = 0;
            }

            let newDate = new Date();
            newDate.setMonth(currentMonth + monthDifference);

            let year = newDate.getFullYear();
            let month = newDate.getMonth();

            document.getElementById('monthYearDisplay').innerText = months[month] + " " + year;

            if (monthDifference === 0) {
                document.getElementById('nextArrow').classList.add('but_disabled');
            } else {
                document.getElementById('nextArrow').classList.remove('but_disabled');
            }

            loadMonth(monthDifference);
        }

        document.getElementById('prevArrow').addEventListener('click', () => changeMonth(-1));
        document.getElementById('nextArrow').addEventListener('click', () => changeMonth(1));

        changeMonth(0);
    </script>
</div>

<div class="jobs_head-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/queries/order-list.php"; ?>
</div>