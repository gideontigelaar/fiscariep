<h1>Alle printjobs</h1>
<?php
$stmt = $pdo->prepare("SELECT * FROM prints");
$stmt->execute();
$prints = $stmt->fetchAll();

if (count($prints) > 0) {
    foreach ($prints as $print) {
        echo "<div class='card'>";
        echo "<h2>Printjob #" . $print['order_id'] . "</h2>";
        echo "<p>Printlayout: " . $print['print_layout'] . "</p>";
        echo "<p>Aantal prints: " . $print['print_amount'] . "</p>";
        echo "<p>Aantal vellen papier: " . $print['paper_amount'] . "</p>";
        echo "<p>Dubbelzijdig: " . ($print['double_sided'] ? "Ja" : "Nee") . "</p>";
        echo "<p>Kleur: " . ($print['print_color'] ? "Ja" : "Nee") . "</p>";
        echo "<p>Kleur papier: " . $print['paper_color'] . "</p>";
        echo "<p>Gewicht papier: " . $print['paper_weight'] . "</p>";
        echo "<p>Geniet: " . ($print['staple'] ? "Ja" : "Nee") . "</p>";
        echo "<p>Opmerkingen: " . $print['additional_wishes'] . "</p>";
        echo "<p>Geupload bestand: <a href='data:application/octet-stream;base64," . base64_encode($print['upload_print']) . "' download='printjob-" . $print['order_id'] . ".pdf'>Download</a></p>";
        echo "<p>Besteld op: " . $print['created_at'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Er zijn geen openstaande printjobs.</p>";
}
?>