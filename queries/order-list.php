<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/pdo-connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$difference = abs($_POST['difference'] ?? 0);
$response = [
    'difference' => $difference,
    'content' => '',
];

$stmt = $pdo->prepare("SELECT * FROM prints WHERE MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL :difference MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE - INTERVAL :difference MONTH) ORDER BY created_at DESC");
$stmt->execute(['difference' => $difference]);
$prints = $stmt->fetchAll();

ob_start();

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
                    <span>Order <?= $print['order_id'] ?>, <?= $print['print_layout'] ?></span>
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
                    <span><?= ucfirst($print['paper_color']) ?></span>
                    <span><?= $print['paper_weight'] ?> gram</span>
                    <span><?= $print['staple'] ? "Geniet" : "Niet geniet" ?></span>
                    <span style="font-weight: 600;"><?= $timeAgo ?></span>
                </div>
                <button class="jobs_details-button" onclick="showDetailView(<?= $print['order_id']; ?>)">Details</button>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>Er zijn geen openstaande printjobs.</p>";
}

$response['content'] = ob_get_clean();
echo json_encode($response);
?>