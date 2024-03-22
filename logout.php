<?php
session_start(); //otvorenie session

unset($_SESSION["username"]); //vymazanie session
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logout</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #0b5e99;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .logout-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .logout-container p {
        margin-bottom: 20px;
    }
    .logout-container a {
        color: ##b0f428;
        text-decoration: none;
    }
    .logout-container a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="logout-container">
    <p>You have been logged out and the session has been cleared.</p>
    <p>Redirecting you to the <a href="index.php">login page</a>...</p>
</div>

</body>
</html>

<?php
header('Refresh: 2; URL = index.php'); // presmerovanie na prihlasenie
?>
