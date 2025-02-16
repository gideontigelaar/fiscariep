<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php";

$stmt = $pdo->prepare("SELECT * FROM prints WHERE order_id = :orderID");
$stmt->execute(['orderID' => $_POST['orderID']]);
$print = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :userID");
$stmt->execute(['userID' => $print['user_id']]);
$user = $stmt->fetch();

$minus10Percent = number_format($print['total_price'] * 0.9, 2, ',', '');
$plus10Percent = number_format($print['total_price'] * 1.1, 2, ',', '');
?>
<div class="dv_head-container">
    <div class="dv_container">
        <div class="dv_container-contents">
            <button class="but_secondary_icon" style="padding-right:20px !important;margin-bottom:20px;" onclick="removeDetailViewContainer()">
                <img src="../assets/svg/arrow-circle-filled.svg" alt="Terugknop" style="transform: rotate(270deg)">
                Terug naar overzicht
            </button>
            <div class="dv_item-info-container" style="justify-content: space-between;align-items:center;display:flex;">
                <div style="display:grid;">
                    <span class="dv_container-title">Order <?= $print['order_id'] ?>, <?= $print['print_layout'] ?></span>
                    <span class="dv_container-subtext">Aangevraagd op <?= date("d-m-Y", strtotime($print['created_at'])) ?> door <?= $user['username'] ?></span>
                </div>
                <div>
                    <?php if ($print['status'] == "openstaand" && $user['role'] == "admin") { ?>
                        <button class="but_primary_icon" style="padding-right:20px !important;"
                        onclick="nextPopupStep('Weet je het zeker dat je deze printjob als gereed wil markeren?', 'Je kan dit niet ongedaan maken', '', 'markPrintJob(<?= $print['order_id'] ?>)')">
                            <img src="../assets/svg/check-circle-filled.svg" alt="Nieuwe printjob-icoon">
                            Markeer als gereed
                        </button>
                    <?php } ?>
                </div>
            </div>
            <div class="dv_container-content">
                <hr class="gl_top-divider">
                <div class="dv_item-container" style="margin-top:20px;margin-bottom:20px;">
                    <div class="gl_circle-icon-primary" style="justify-content: center;">
                        <img src="../assets/svg/coins.svg" alt="Coins icon" style="width: 27px;">
                    </div>
                    <div>
                        <span class="dv_price">€ <?= $minus10Percent ?> - € <?= $plus10Percent ?></span>
                        <span class="dv_price-disclaimer">Deze prijs is een indicatie en kan afwijken van de werkelijke prijs.</span>
                    </div>
                </div>
                <div class="dv_item-head-container">
                    <div class="dv_item-container" style="width:40%;">
                        <div class="gl_circle-icon-primary">
                            <img src="../assets/svg/circles-four.svg" alt="Grid icon">
                        </div>
                        <div>
                            <span><?= $print['print_amount'] ?> exempla<?= $print['print_amount'] == 1 ? "ar" : "ren" ?></span>
                            <span><?= $print['paper_amount'] ?> papier<?= $print['paper_amount'] == 1 ? "" : "en" ?></span>
                            <span><?= $print['double_sided'] ? "Dubbelzijdig" : "Enkelzijdig" ?></span>
                            <span><?= $print['print_color'] ? "Gekleurd" : "Zwart-wit" ?></span>
                            <span><?= ucfirst($print['paper_color']) ?></span>
                            <span><?= $print['paper_weight'] ?> gram</span>
                            <span><?= $print['staple'] == "geen" ? "Geen nietjes" : "Nietje " . $print['staple'] ?></span>
                        </div>
                    </div>
                    <div class="dv_item-container" style="width:60%;">
                        <div class="gl_circle-icon-primary">
                            <img src="../assets/svg/user.svg" alt="Grid icon">
                        </div>
                        <div>
                            <span style="font-weight:600;"><?= $user['username'] ?></span>
                            <span><?= $user['address'] ?>, <?= $user['city'] ?>, <?= $user['postal_code'] ?></span>
                            <br>
                            <span><?= $user['phone_number'] ?></span>
                            <br>
                            <span><?= $user['email'] ?></span>
                        </div>
                    </div>
                </div>

                <?php if (!empty($print['additional_wishes'])) { ?>
                    <div class="dv_item-container" style="margin-top:20px;">
                        <div class="gl_circle-icon-primary">
                            <img src="../assets/svg/note-filled.svg" alt="Grid icon">
                        </div>
                        <div style="overflow-y: auto;">
                            <span><?= $print['additional_wishes'] ?></span>
                        </div>
                    </div>
                <?php } ?>

                <div class="dv_container-buttons" style="display:flex;column-gap:10px;margin-top:20px;">
                    <button class="but_primary_icon" style="padding-right:20px !important;" onclick="downloadPDF(<?= $print['order_id'] ?>)">
                        <img src="../assets/svg/check-circle-filled.svg" alt="Download als PDF">
                        Download als PDF
                    </button>
                    <?php if ($user['role'] == "admin") { ?>
                        <button class="but_negative_icon" style="padding-right:20px !important;" onclick="nextPopupStep('Weet je het zeker dat je deze printjob wilt verwijderen?', 'Je kan dit niet ongedaan maken', '', 'deletePrintJob(<?= $print['order_id'] ?>)')">
                            <img src="../assets/svg/trash-circle-filled.svg" alt="Verwijderen" style="width:30px;">
                            Verwijderen
                        </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>