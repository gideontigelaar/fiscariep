<?php
$stmt = $pdo->prepare("SELECT * FROM prints");
$stmt->execute();
$prints = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM prints WHERE status = 'openstaand'");
$stmt->execute();
$openPrints = $stmt->fetchAll();
?>
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
    <img src="../assets/svg/arrow-circle-filled.svg" style="transform: rotate(270deg)" alt="Vorige maand">
    Jangustus
    <img src="../assets/svg/arrow-circle-filled.svg" style="transform: rotate(90deg)" alt="Volgende maand">
</div>

<div class="jobs_head-container">
    <!--<div class="jobs_item-container"> // EXAMPLE
        <div class="jobs_item-content">
            <div class="jobs_item-title">
                <img src="../assets/svg/images-filled.svg" alt="Images Icon">
                <span>Stapel A5</span>
                <div class="status-indicator status-indicator_green"></div>
            </div>
            <div class="jobs_item-short-info">
                <span>1 exemplaar</span>
                <span>1 papier</span>
                <span>Enkelzijdig</span>
                <span>Zwart-wit</span>
                <span>Wit</span>
                <span>80 gram</span>
                <span>Niet geniet</span>
                <span style="font-weight: 600;">Zojuist</span>
            </div>
            <button class="jobs_details-button">Details</button>
        </div>
    </div> -->

<?php
if (count($prints) > 0) {
    foreach ($prints as $print) {
        $created_at = new DateTime($print['created_at']);
        $now = new DateTime();
        $interval = $created_at->diff($now);
        $timeAgo = "";
        if ($interval->y > 0) {
            $timeAgo = $interval->y . " jaar geleden";
        } elseif ($interval->m > 0) {
            $timeAgo = $interval->m . ($interval->m == 1 ? " maand" : " maanden") . " geleden";
        } elseif ($interval->d > 0) {
            $timeAgo = $interval->d . ($interval->d == 1 ? " dag" : " dagen") . " geleden";
        } elseif ($interval->h > 0) {
            $timeAgo = $interval->h . " uur geleden";
        } elseif ($interval->i > 0) {
            $timeAgo = $interval->i . ($interval->i == 1 ? " minuut" : " minuten") . " geleden";
        } else if ($interval->i < 5) {
            $timeAgo = "Zojuist";
        }
        ?>
            <div class="jobs_item-container">
                <div class="jobs_item-content">
                    <div class="jobs_item-title">
                        <img src="../assets/svg/images-filled.svg" alt="Images Icon">
                        <span>Order #<?= $print['order_id'] ?>, <?= $print['print_layout'] ?></span>
                        <div class="status-indicator
                        <?php
                            if ($print['status'] == "openstaand" && $interval->m > 1) {
                                echo "status-indicator_red";
                            } else if ($print['status'] == "openstaand") {
                                echo "status-indicator_orange";
                            } else {
                                echo "status-indicator_green";
                            }
                        ?>
                        "></div>
                    </div>
                    <div class="jobs_item-short-info">
                        <span><?= $print['print_amount'] ?> exempla<?= $print['print_amount'] == 1 ? "ar" : "ren" ?></span>
                        <span><?= $print['paper_amount'] ?> papier<?= $print['paper_amount'] == 1 ? "" : "en" ?></span>
                        <span><?= $print['double_sided'] ? "Dubbelzijdig" : "Enkelzijdig" ?></span>
                        <span><?= $print['print_color'] ? "Gekleurd" : "Zwart-wit" ?></span>
                        <span><?= $print['paper_color'] ?></span>
                        <span><?= $print['paper_weight'] ?> gram</span>
                        <span><?= $print['staple'] ? "Geniet" : "Niet geniet" ?></span>
                        <span style="font-weight: 600;"><?= $timeAgo ?></span>
                    </div>
                    <button class="jobs_details-button">Details</button>
                </div>
            </div>
        <?php
    }
} else {
    echo "<p>Er zijn geen openstaande printjobs.</p>";
}
?>


<!--<?php
//if (count($prints) > 0) {
//    foreach ($prints as $print) {
//        $created_at = new DateTime($print['created_at']);
//        $now = new DateTime();
//        $interval = $created_at->diff($now);
//        $timeAgo = "";
//        if ($interval->y > 0) {
//            $timeAgo = $interval->y . " jaar geleden";
//        } elseif ($interval->m > 0) {
//            $timeAgo = $interval->m . ($interval->m == 1 ? " maand" : " maanden") . " geleden";
//        } elseif ($interval->d > 0) {
//            $timeAgo = $interval->d . ($interval->d == 1 ? " dag" : " dagen") . " geleden";
//        } elseif ($interval->h > 0) {
//            $timeAgo = $interval->h . " uur geleden";
//        } elseif ($interval->i > 0) {
//            $timeAgo = $interval->i . ($interval->i == 1 ? " minuut" : " minuten") . " geleden";
//        } else if ($interval->i < 5) {
//            $timeAgo = "Zojuist";
//        }
        ?>
<!--        <div class="">
//            <h3>Order #<?= $print['order_id'] ?>, <?= $print['print_layout'] ?></h3>
//            <span><?= $print['status'] ?></span>
//            <span><?= $print['print_amount'] ?> <?= $print['print_amount'] == 1 ? "exemplaar" : "exemplaren" ?></span>
//            <span><?= $print['paper_amount'] ?> <?= $print['paper_amount'] == 1 ? "papier" : "papieren" ?></span>
//            <span><?= $print['double_sided'] ? "Dubbelzijdig" : "Enkelzijdig" ?></span>
//            <span><?= $print['print_color'] ? "Gekleurd" : "Zwart-wit" ?></span>
//            <span><?= $print['paper_color'] ?></span>
//            <span><?= $print['paper_weight'] ?> gram</span>
//            <span><?= $print['staple'] ? "Geniet" : "Niet geniet" ?></span>
//            <span><b><?= $timeAgo ?></b></span>
//        </div>
!-->       <?php
//    }
//} else {
//    echo "<p>Er zijn geen openstaande printjobs.</p>";
//}
//?>