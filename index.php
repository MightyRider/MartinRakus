<?php
session_start(); // Otevření session

$errorMessage = ""; // Inicializace proměnné pro chybovou zprávu

// Kontrola, zda byl odeslán formulář a zda byly vyplněny obě pole - uživatelské jméno a heslo
if (isset($_POST['login']) && !empty($_POST['username']) 
    && !empty($_POST['password'])) {

    // Připojení k databázi
    $servername = "localhost";
    $username = "rakus3a1";
    $password = "14837944,Aa";
    $dbname = "rakus3a1";

    // Vytvoření spojení
    $conn = new mysqli($servername, $username, 
        $password, $dbname);

    // Kontrola spojení
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Výběr hesla z DB podle uživatele, který se přihlašuje
    $sql = "SELECT password FROM t_user WHERE username = '".$_POST['username']."'";
    $result = $conn->query($sql);

    // Pokud vrátí select více než 0 řádků, uživatel existuje
    if ($result->num_rows > 0) {
        // Výstup dat každého řádku
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row["password"])) {
            $_SESSION['valid'] = true; // Uložení session
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];

            // Přesměrování na další stránku
            header("Location: welcome.php", true, 301);
            exit();
        } else {
            $errorMessage = "Wrong password"; // Pokud je heslo špatné, nastavíme chybovou zprávu
        }
    } else {
        $errorMessage = "Wrong username"; // Pokud je uživatelské jméno špatné, nastavíme chybovou zprávu
    }

    $conn->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #18d801;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Přidáno pro lepší vizuální uspořádání */
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: calc(100% - 22px); /* Odstranění marginu */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block; /* Přidáno pro lepší zarovnání */
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #0d01d8;
            color: #fff;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login Form</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required autofocus><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <div class="error-message"><?php echo $errorMessage; ?></div> <!-- Výpis chybové zprávy -->
    <p style="text-align: center;">Not registered yet? <a href="register.php">Register here</a>.</p> <!-- Odkaz na registrační stránku -->
</div>

</body>
</html>

