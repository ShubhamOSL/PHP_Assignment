<?php
    function is_valid()
    {
        session_start();
        $ret = isset($_SESSION['username']);
        return $ret;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
      <title>Assignment1</title>
</head>
<body>
    <div class="container">
        <div class="container__header">
           <span class="bigheading">DEV COMMUNITY</span>
            <?php
                if(is_valid())
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
                    if(is_valid())
                        echo "WELCOME " . strtoupper($_SESSION["username"]);
                    else
                        echo "YOU ARE NOT LOGGED IN";
                ?>
            </div>
        </div>
        <div class="container__footer footer">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <input type="text"> <button>SUBMIT</button>
        </div>
    </div>
</body>
</html>