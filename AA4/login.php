<?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
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
                if($ret->num_rows > 0)
                {
                    $row = $ret->fetch_assoc();
                    $_SESSION["username"] = $row["full_name"];
                    header("Location: index.php");
                }
                else
                {
                    $_SESSION = [];
                    session_destroy();
                    echo "login failed";
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
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="container">
        <div class="container__header">
            <span class="font--massive">DEV COMMUNITY</span>
        </div>
        <div class="container__body">
            <form action="login.php" method="POST">
                <div class="form__heading font--massive">
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