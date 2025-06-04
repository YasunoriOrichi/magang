<?php
<<<<<<< Updated upstream
require_once 'env.php';
echo getBaseUrl(); 
include 'connect.php';
=======
define('ENV_PATH', __DIR__ . '/config/env.php');
require_once ENV_PATH;
>>>>>>> Stashed changes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0; url=connect.php">
    <title>Document</title>
</head>
<body>
<<<<<<< Updated upstream
    <script>
        // Redirect to the connect.php page
        window.location.href = 'pages/index.php';
    </script>
=======
    <?php
        header('Location: pages/dashboard/index.php');
    ?>
>>>>>>> Stashed changes
</body>
</html>