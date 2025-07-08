<?php
define('ENV_PATH', __DIR__ . '/config/env.php');
require_once ENV_PATH;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="0; url=connect.php"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <title>Document</title>
</head>
<body>
    <?php
    $query = "SELECT * FROM account WHERE REMEMBER = 'true'"; // Check if there is any account with REMEMBER set to true
    if (mysqli_fetch_assoc(mysqli_query(getConnection(), $query)) > 0) {
        $query = "SELECT * FROM account WHERE REMEMBER = 'true'"; // Reset previous remember me status
        $fetch = mysqli_fetch_assoc(mysqli_query(getConnection(), $query));
        $username = $fetch['USERNAME'];
        session_start();
        $_SESSION['username'] = $username;
        header("Location: pages/dashboard/index.php"); // Redirect to dashboard
    } else {
        header('Location: pages/auth/login.php');
    }
    ?>
</body>
</html>