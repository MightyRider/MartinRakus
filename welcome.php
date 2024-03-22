<?php
session_start(); //otvorenie session

//zistenie ci je session nastavene
if(isset($_SESSION['username'])) {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Welcome</title>';
    echo '<style>';
    echo 'body {';
    echo '  font-family: Arial, sans-serif;';
    echo '  background-color: #28f458   ;';
    echo '  margin: 0;';
    echo '  padding: 0;';
    echo '  display: flex;';
    echo '  justify-content: center;';
    echo '  align-items: center;';
    echo '  height: 100vh;';
    echo '}';
    echo '.welcome-container {';
    echo '  background-color: #fff;';
    echo '  padding: 20px;';
    echo '  border-radius: 5px;';
    echo '  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);';
    echo '}';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<div class="welcome-container">';
    echo '  <h2>Welcome '.$_SESSION['username'].'</h2>';
    echo '  <p>Click <a href="logout.php" title="Logout">here</a> to logout.</p>'; //odkaz na odhlasenie
    echo '</div>';
    echo '</body>';
    echo '</html>';
} else {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Error</title>';
    echo '</head>';
    echo '<body>';
    echo '<div>';
    echo '  <p>Error: You are not logged in.</p>';
    echo '  <p>Go back to <a href="index.php" title="Login">login page</a>.</p>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
}
?>
