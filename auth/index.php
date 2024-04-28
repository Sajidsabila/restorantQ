<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-form {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "login_error") {
            echo "<div class='alert alert-danger'>Gagal Login</div>";
        } else if ($_GET['status'] == "akses_denied") {
            echo "<div class='alert alert-danger'>Silahkan Login Untuk Mengakses Index</div>";
        }
    }
    ?>
    <div class="login-form">
        <h2 class="text-center mb-4">Login</h2>
        <form action="login_proses.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>