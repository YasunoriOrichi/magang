<?php
    include '../connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input</title>
</head>
<body>
    <h1>INPUT TEST</h1>
    <main>
        <form action="../function/input.php" method="POST">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="item">Item: </label>
            <select name="item" id="item">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM item");
                while ($data = mysqli_fetch_assoc($query)) {
                    echo "<option value='".$data['ID']."'>".$data['NAME']."</option>";
                }
                ?>
            </select>
            <br>
            <button type="submit">Submit</button>
        </form>

        <?php
            if (isset($_GET['error'])) {
                echo "<p style='color: red;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
            }
        ?>
    </main>
</body>
</html>