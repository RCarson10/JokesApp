<head>
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";

$username = addslashes($_POST['username']);
$password = $_POST['password'];
 


echo "You attempted to login with " . $username . " and  " . $password . "<br>";

$stmt = $mysqli->prepare("SELECT id, username, password FROM users where username = ?");
$stmt->bind_param("s", $username);

$stmt->execute();
$stmt->store_result();

$stmt->bind_result($userid,$uname,$pw);

if($stmt->num_rows == 1)
{
    echo "There is one person with that username<br>";
    $stmt->fetch();
    if(password_verify($password,$pw)){
        echo "The password matches<br>";
        echo "Login success<br>";
        $_SESSION['username'] = $uname;
        $_SESSION['userid'] = $userid;
        echo "<br><a href = 'index.php'>Return to the main page</a>";

        exit;
    }
    else {
        $_SESSION = [];
        session_destroy();
    }
}
else {
    $_SESSION = [];
    session_destroy();
}
echo "Login Failed";
echo "<br><a href = 'index.php'>Return to the main page</a>";
echo "<br><a href = 'login_form.php'>Or you can login again</a>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>"; 

?>
