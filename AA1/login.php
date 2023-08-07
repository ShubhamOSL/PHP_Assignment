<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } 

          if (empty($_POST["password"])) {
            $nameErr = "Password is required";
          } 


        if(isset($_POST['username']) && isset($_POST['password']))
        {
             

            require("database.php");
                session_start();
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password = md5($password);


                mysqli_select_db($conn, "AA1");
                $query = "select * from users where username='" . $username . "' and password='" . $password . "';";
                $ret = mysqli_query($conn, $query);
                
                var_dump($ret);
                if($ret->num_rows > 0)
                {

                    $row = $ret->fetch_assoc();
                    $_SESSION["username"] = $row["username"];
                    header("Location:index.php");
                }
                else
                {

                    $_SESSION = [];
                    session_destroy();
                     header("Location: login.php");
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
      
        <span class="bigheading">DEV COMMUNITY</span>
        </div>
        <div class="container__body">
            <form action="login.php" method="POST">
                <div class="form__heading bigheading">
                    LOGIN
                </div>
                <input name="username" type="text" placeholder="username" required/>
                <span class="error">* <?php echo $nameErr;?></span><br>
                <input name="password" type="password" placeholder="password" required/>
                <span class="error">* <?php echo $passErr;?></span><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <input type="text" name="info"> <button>SUBMIT</button>
        </div>
    </div>
</body>
</html>