<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .logout-box {
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
        }

        .loading-gif {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="logout-box">
        <?php
            session_start();

            unset($_SESSION["username"]);

            echo 'You have logged out and cleaned session';

            echo '<p><iframe src="https://giphy.com/embed/3oEjI6SIIHBdRxXI40" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/mashable-3oEjI6SIIHBdRxXI40"></a></p>';

            header('Refresh: 2; URL = index.php');
        ?>
    </div>
</body>
</html>