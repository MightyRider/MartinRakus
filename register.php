<?php

$error = " ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "rakus3a";
    $password = "Heslo123.";
    $dbname = "rakus3a";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $input_confirm_password = $_POST['confirm_password'];
    $input_email = $_POST['email'];

    $check_username_sql = "SELECT * FROM t_user WHERE username='$input_username'";
    $result = $conn->query($check_username_sql);
    $check_email_sql = "SELECT * FROM t_user WHERE email='$input_email'";
    $result2 = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        if($result2->num_rows > 0){
            $error = "E-mail already in use";
        } else {
            if ($input_password !== $input_confirm_password) {
                $error = "Passwords do not match";
            } else {
                $input_password = password_hash($input_password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO t_user (username, password, email) VALUES ('$input_username', '$input_password', '$input_email')";

                if ($conn->query($insert_sql) === TRUE) {
                    $error = "New login created";
                } else {
                    $error = "User already exists";
                }
            }
        }
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration form</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #6495ED;
        }
        form {
            background-color: #40E0D0;
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
            background-color: #CCCCFF; 
            color: white;
            cursor: pointer;
        }
        p {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required autofocus><br>
        <input type="email" name="email" placeholder="Email" required autofocus><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <input type="submit" name="login" value="Register">
        <p><?php echo $error; ?></p>
        <a href="index.php">Login</a>
    </form>
</body>
</html>
