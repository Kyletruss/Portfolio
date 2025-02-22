<?php
// PHP can be used to generate the HTML and JavaScript code dynamically.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script type="text/javascript">
        // JavaScript function to redirect after 3 seconds
        setTimeout(function() {
            window.location.href = 'index.php'; // Replace with your destination URL
        }, 3000); // 3000ms = 3 seconds
    </script>
</head>
<body>
    <h1>You are not permitted to access this page, taking you back to the home screen in 3 seconds</h1>
</body>
</html>
