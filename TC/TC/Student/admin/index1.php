<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
</head>
<body>
    <?php
    if (isset($_GET['update_success']) && $_GET['update_success'] == 1) {
        echo "<p>Updated successfully!</p>";
    }
    ?>
    <!-- Your other HTML content here -->
</body>
</html>
