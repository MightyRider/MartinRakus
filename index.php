<?php
session_start();   // otvorenie session

$error = "";  

// kontrola ci uz bol potvrdeny formular a ci boli vyplnene obidva udaje aj username aj password
if (isset($_POST['login']) && !empty($_POST['username']) 
    && !empty($_POST['password'])) {

    // connect string do DB
    $servername = "localhost";
    $username = "rakus3a";
    $password = "Heslo123.";
    $dbname = "rakus3a";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // vyber hesla z DB podla usera, ktory sa prihlasuje
    $sql = "SELECT password FROM t_user where username ='".$_POST['username']."'";
    $result = $conn->query($sql);

    // ak vrati select viac ako 0 riadkov, user existuje
    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
        // if($row["password"]==$_POST['password']) {
        if (password_verify($_POST['password'], $row["password"])) {
            $_SESSION['valid'] = true; // ulozenie session
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];

            // presmerovanie na dalsiu stranku
            header("Location: welcome.php", true, 301);
            exit();
        } else {
            $error = "wrong password";
        }
    } else {
        $error = "wrong username";
    }

    $conn->close();
}     
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login form</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #DE3163; 
        }
        form {
            background-color: #FF7F50;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #6495ED; 
            color: white;
            cursor: pointer;
        }
        p {
            color: red;
            text-align: center;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="username" required autofocus><br>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" name="login" value="Login">
        <p><?php echo $error; ?></p>
        <a href="register.php">Register</a>
    </form>
    <body style="background-color: #00224D;">
    <div class="pecivo" style="background-color: #fff;">

</body>
</html>
