

<?php
function is_auth()
{
    session_start();
    $ret = isset($_SESSION['username']);
    return $ret;
}

if (!is_auth()) {
    header("location: index.php");
}
?>


<?php
$connection = mysqli_connect('localhost', 'root', 'S18@Shift', 'AA3');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $topic_of_interest = $_POST['topic_of_interest'];
    $education = $_POST['education'];
    $profession = $_POST['profession'];
    $hobbies = $_POST['hobbies'];

    $query = "SELECT * FROM user_profiles WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $query = "UPDATE user_profiles SET topic_of_interest = '$topic_of_interest',
                                          education = '$education',
                                          profession = '$profession',
                                          hobbies = '$hobbies'
                  WHERE username = '$username'";
    } else {
        $query = "INSERT INTO user_profiles (username, topic_of_interest, education, profession, hobbies)
                  VALUES ('$username', '$topic_of_interest', '$education', '$profession', '$hobbies')";
    }

    mysqli_query($connection, $query);

    header("Location: about_us.php?username=$username");
    exit();
}elseif (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Retrieve user data from the database
    $query = "SELECT * FROM user_profiles WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        // Populate form fields with user data
        $topic_of_interest = $userData['topic_of_interest'];
        $education = $userData['education'];
        $profession = $userData['profession'];
        $hobbies = $userData['hobbies'];
    }
}
?>




<?php
$connection = mysqli_connect('localhost', 'root', 'S18@Shift', 'AA3');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    session_start();
    $username=$_SESSION["username"];
    
    // echo $username;
                               

    $query = "SELECT * FROM user_profiles WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $topic_of_interest = $userData['topic_of_interest'];
        $education = $userData['education'];
        $profession = $userData['profession'];
        $hobbies = $userData['hobbies'];
    }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
   
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="container__header">
            <img src="resource/logo.png" alt=""><span class="font--massive">DEV COMMUNITY</span>
            <span class="link--action">
                <!-- <div class="process--circle">

                </div><a href="logout.php">logout</a> -->
            </span>
        </div>
        <div class="container__body">
            <div class="container__body__content">
                MAKE PROFILE SECTION
            </div>
            <form method="post" action="profile.php">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username ?? ''; ?>" required><br><br>
        <label>Topic of Interest:</label>
        <input type="text" name="topic_of_interest" value="<?php echo $topic_of_interest ?? ''; ?>"><br><br>
        <label>Education:</label>
        <input type="text" name="education" value="<?php echo $education ?? ''; ?>"><br><br>
        <label>Profession:</label>
        <input type="text" name="profession" value="<?php echo $profession ?? ''; ?>"><br><br>
        <label>Hobbies:</label>
        <input type="text" name="hobbies" value="<?php echo $hobbies ?? ''; ?>"><br><br>
        <input type="submit" name="submit" value="Save">
    </form>
        </div>
        <div class="container__footer font--sub-massive">
            SUBCRIBE TO OUR NEWSLETTER
            <br>
            <form action="index.php" method="POST">
                <input class="font--lighter" type="text" name="name" placeholder="YOUR NAME" />
                <input class="font--lighter" type="text" name="email" placeholder="YOUR EMAIL" />
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>

</html>