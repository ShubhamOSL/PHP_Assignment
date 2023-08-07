<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            require_once("database.php");
            if(is_conn_alive())
            {
                session_start();
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password = md5($password);
                mysqli_select_db($conn, "AA1");
                $query = "select * from users where username='" . $username . "' and password='" . $password . "' limit 1;";
                $ret = mysqli_query($conn, $query);
                if(mysqli_num_rows($ret) > 0)
                {
                    $row = $ret->fetch_assoc();
                    $_SESSION["username"] = $row["full_name"];
                    $_SESSION["first_login"] = $_SERVER["REQUEST_TIME"];
                    header("Location: index.php");
                }
                else
                {
                    $_SESSION = [];
                    session_destroy();
                    header("Location: login.php");
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
 <title>Assignment</title>
</head>
<body>
    <div class="container">
        <div class="container__header">
            <img src="resource/logo.png" alt=""><span class="bigheading">DEV COMMUNITY</span>
        </div>
        <div class="container__body">
            <form action="login.php" method="POST">
                <div class="form__heading bigheading">
                    LOGIN
                </div>
                <input name="username" type="text" placeholder="username"/><br>
                <input name="password" type="password" placeholder="password"/><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
        <div class="container__footer font--sub-massive">
            
        </div>
    </div>
</body>
</html>