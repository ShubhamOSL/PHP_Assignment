<?php
    function isvalid()
    {
        session_start();
        $ret = isset($_SESSION['username']);
        return $ret;
    }

    $request_type = $_SERVER["REQUEST_METHOD"];
    if($request_type == "POST")
    {
        if(isset( $_POST["name"]) and isset($_POST["email"]))
        {
            $_POST["email-sub-sucess"] = true;
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
           <span class="font--massive">DEV COMMUNITY</span>
            <?php
                if(isvalid())
                {
                    ?> <span class="link--action"><a href="profile.php">profile</a><a href="logout.php">logout</a></span> <?php
                }
                else
                {
                    ?> <span class="link--action"><a href="login.php">login</a></span> <?php
                }
            ?>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST")
                    {
                        echo "THANK YOU ". strtoupper($_POST["name"]) . " FOR SUBSCRIBING TO OUR EMAILING LIST <BR>";
                    }
                    else if(isvalid())
                        echo "WELCOME " . strtoupper($_SESSION["username"]);
                    else
                        echo "YOU ARE NOT LOGGED IN";
                ?>
            </div>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <form action="index.php" method="POST">
                <input class="font--lighter" type="text" name="name" placeholder="YOUR NAME"/>
                <input class="font--lighter" type="text" name="email" placeholder="YOUR EMAIL"/>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>
</html>