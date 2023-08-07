<?php
    function isvalid()
    {
        session_start();
        return $_SESSION["username"];
    }

    $name="";
    $nameErr="";

    $request_type = $_SERVER["REQUEST_METHOD"];
    if($request_type == "POST")
    {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } 
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
              $nameErr = "Only letters and white space allowed";
            
          }


          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
            }
          


        if(isset($_POST["email"]) and isset( $_POST["name"]) )
        {
            $_POST["email__success"] = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $cookie_name="username";
            $cookie_value=$_POST["name"];
            setcookie($cookie_name, $cookie_value, time() + 120, "/"); 
            header( "refresh:120;URL=http://localhost:8080/login.php" );
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
        <div             setcookie
class="container__header">
           <span class="bigheading">DEV COMMUNITY</span>
            <?php
                if(isvalid())
                {
                    ?> <span class="link"><a href="logout.php">logout</a></span> <?php
                }
                else
                {
                    ?> <span class="link"><a href="login.php">login</a></span> <?php
                }
            ?>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST")
                    {
                        if($_POST["email__success"])
                        {
                            echo "THANKS, ". strtoupper($_POST["name"]) . " FOR SUBSCRIBING TO OUR NEWSLETTER <BR>";
                        }
                        else
                        {
                            echo "EMAIL SUBSCRIPTION DENIED!<BR>PLEASE TRY AGAIN<BR>";
                        }               
                    }
                    else if(isvalid())
                        echo "WELCOME " . strtoupper($_SESSION["username"]);
                    else
                    {
                        echo "NOT LOGGED IN";
                    }   


                ?>
            </div>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <form action="index.php" method="POST">
                <input class="smallheading" type="text" name="name" placeholder="ENTER NAME" />
                <input class="smallheading" type="text" name="email" placeholder="ENTER EMAIL"/>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>
</html>