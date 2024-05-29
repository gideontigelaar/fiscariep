<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/queries/validate-session.php";

$_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT username, role FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiscariep</title>

    <link rel="icon" href="../assets/svg/logo/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../css/import.css">
    <script src="/assets/js/logoutUser.js"></script>
    <script src="/assets/js/detailViewHandling.js"></script>
    <script src="/assets/js/popupHandling.js"></script>
    <script src="/assets/js/dashboard.js"></script>
    <script src="/assets/js/showError.js"></script>
    <script src="/assets/js/printjobs.js"></script>
    <script src="/assets/js/checkboxToggler.js"></script>
    <script src="/assets/js/uploadBtnListener.js"></script>
    <script src="/assets/js/loadOrders.js"></script>
</head>

<body style="margin:0;" class="db_body">
    <div class="db_topbar-container">
        <div class="db_topbar-logo">
            <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
        </div>
        <div class="db_topbar-logout-container">
            <span><?= date("H") >= 0 && date("H") < 6 ? "Goedenacht" : (date("H") >= 6 && date("H") < 12 ? "Goedemorgen" : (date("H") >= 12 && date("H") < 18 ? "Goedemiddag" : "Goedenavond")) ?>, <b><?php echo $userData['username']; ?></b></span>
            <div class="db_topbar-logout" onclick="logOutUser()">
                <img src="../assets/svg/signout.svg" alt="Signout Icon">
            </div>
        </div>
    </div>
    <div class="db_content-container">
        <div class="db_sidebar">

        <?php
            $sidebarItems = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/json/sidebar-items.json"), true);
            foreach ($sidebarItems['menu'] as $item) {
                if (isset($_GET['p']) && strtolower($item['title']) == $_GET['p']) {
                    echo "<div class='db_sidebar-item active' onclick='window.location.href=\"?p=" . strtolower($item['title']) . "\"'>";
                } else {
                    echo "<div class='db_sidebar-item' onclick='window.location.href=\"?p=" . strtolower($item['title']) . "\"'>";
                }
                echo "<div class='db_sidebar-active-symbol'></div>";
                echo "<span>" . $item['title'] . "</span>";
                echo "</div>";
            }
        ?>

        </div>
        <div class="db_content">
            <div class="db_content-items">
                <?php
                    if (isset($_GET['p'])) {
                        $page = $_GET['p'];
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/pages/content/$page.php")) {
                            require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/content/$page.php";
                        } else {
                            require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/content/404.php";
                        }
                    } else {
                        require_once $_SERVER['DOCUMENT_ROOT'] . "/pages/content/404.php";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>


<script>
    document.addEventListener('keydown', function(e) {
        if (e.key === 'u') {
            nextPopupStep('<div style="margin-bottom:20px;" class="gl_circle-icon-primary"><img src="../assets/svg/happy-smile-filled.svg" alt="Happy icon"></div> Welkom bij de online omgeving van Fiscariep.', '', 'onboarding');
        }
    });
</script>