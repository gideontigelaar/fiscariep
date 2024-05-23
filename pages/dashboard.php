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

    <link rel="stylesheet" href="../css/import.css">
    <script src="/assets/js/logoutUser.js"></script>
</head>

<body style="margin:0;" class="db_body">
    <div class="db_topbar-container">
        <div class="db_topbar-logo">
            <img src="../assets/svg/logo/fiscariep-logo-white-rgb.svg" alt="Fiscariep Logo">
        </div>
        <div class="db_topbar-logout-container">
            <span>Goedendag, <b><?php echo $userData['username']; ?></b></span>
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
                $link = strtolower($item['title']);
                echo "<a href='?p={$link}' class='db_sidebar-item'>{$item['title']}</a>";
            }
        ?>

        </div>
        <div class="db_content">
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
</body>
</html>