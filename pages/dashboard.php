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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Welkom, <?php echo $userData['username']; ?></h5>
                </div>
            </div>

            <div class="card col-12 col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Recent ingeleverd</h5>
                    <p class="card-text">Er zijn geen recent ingeleverde documenten.</p>
                </div>
            </div>

            <div class="card col-12 col-md-6">
                <div class="card-body">
                    <h5 class="card-title">Nieuwe opdracht</h5>
                    <form>
                        <div class="mb-3">
                            <label for="opdracht" class="form-label">Opdracht</label>
                            <input type="text" class="form-control" id="opdracht" name="opdracht">
                        </div>
                        <div class="mb-3">
                            <label for="document" class="form-label">Document</label>
                            <input type="file" class="form-control" id="document" name="document">
                        </div>
                        <button type="submit" class="btn btn-primary">Verstuur</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>