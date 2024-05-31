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
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="prevArrow" style="transform: rotate(270deg)" alt="Previous month" onclick="showMonth('previous')">
    <span id="monthYearDisplay"></span>
    <img src="../assets/svg/arrow-circle-filled.svg" role="button" id="nextArrow" style="transform: rotate(90deg)" alt="Next month" onclick="showMonth('next')">

    <script>
        function showMonth(previousOrNext) {
            var url = new URL(window.location.href);
            var monthParam = parseInt(url.searchParams.get('mo'));
            var yearParam = parseInt(url.searchParams.get('yr'));
            var currentMonth = new Date().getMonth() + 1; // 1-12
            var currentYear = new Date().getFullYear();
            var fancyMonths = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];

            var monthIndex = monthParam ? monthParam : currentMonth;
            var newYear = yearParam || currentYear;

            if (previousOrNext === 'previous') {
                monthIndex = (monthIndex === 1) ? 12 : monthIndex - 1;
                if (monthIndex === 12) newYear -= 1;
            } else {
                monthIndex = (monthIndex === 12) ? 1 : monthIndex + 1;
                if (monthIndex === 1) newYear += 1;
            }

            url.searchParams.set('mo', monthIndex);

            if (newYear !== currentYear) {
                url.searchParams.set('yr', newYear);
            } else {
                url.searchParams.delete('yr');
            }

            document.getElementById('monthYearDisplay').textContent = fancyMonths[monthIndex - 1] + " " + newYear;

            window.location.href = url;
        }

        window.onload = function() {
            var url = new URL(window.location.href);
            var monthParam = parseInt(url.searchParams.get('mo'));
            var yearParam = parseInt(url.searchParams.get('yr'));
            var currentMonth = new Date().getMonth() + 1; // 1-12
            var currentYear = new Date().getFullYear();
            var fancyMonths = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];

            var monthIndex = monthParam ? monthParam : currentMonth;
            var newYear = yearParam || currentYear;

            document.getElementById('monthYearDisplay').textContent = fancyMonths[monthIndex - 1] + " " + newYear;

            if (monthIndex === currentMonth && newYear === currentYear) {
                document.getElementById('nextArrow').classList.add('but_disabled');
            } else {
                document.getElementById('nextArrow').classList.remove('but_disabled');
            }
        }
    </script>
</div>

<div class="jobs_head-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/queries/order-list.php"; ?>
</div>