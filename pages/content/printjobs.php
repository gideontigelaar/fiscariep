<?php
$stmt = $pdo->prepare("SELECT * FROM prints");
$stmt->execute();
$prints = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM prints WHERE status = 'openstaand'");
$stmt->execute();
$openPrints = $stmt->fetchAll();
?>
<div>
    <h1>Alle printjobs</h1>
    <p>Er <?= count($openPrints) == 1 ? "is" : "zijn" ?> <?= count($openPrints); ?> openstaande printjob<?= count($openPrints) == 1 ? "" : "s" ?></p>
</div>
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
        <div class="">
            <h3>Order #<?= $print['order_id'] ?>, <?= $print['print_layout'] ?></h3>
            <span><?= $print['status'] ?></span>
            <span><?= $print['print_amount'] ?> <?= $print['print_amount'] == 1 ? "exemplaar" : "exemplaren" ?></span>
            <span><?= $print['paper_amount'] ?> <?= $print['paper_amount'] == 1 ? "papier" : "papieren" ?></span>
            <span><?= $print['double_sided'] ? "Dubbelzijdig" : "Enkelzijdig" ?></span>
            <span><?= $print['print_color'] ? "Gekleurd" : "Zwart-wit" ?></span>
            <span><?= $print['paper_color'] ?></span>
            <span><?= $print['paper_weight'] ?> gram</span>
            <span><?= $print['staple'] ? "Geniet" : "Niet geniet" ?></span>
            <span><b><?= $timeAgo ?></b></span>
        </div>
        <?php
    }
} else {
    echo "<p>Er zijn geen openstaande printjobs.</p>";
}
?>