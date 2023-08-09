<?php
include 'connection.inc.php';



if($_SERVER["REQUEST_METHOD"]== "POST")
 {
    // echo var_dump($_POST);
    $country = $_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];

    $cdata="SELECT * FROM countries where id=$country;";
    $sdata="SELECT * FROM states where id=$state;";
    $ctdata="SELECT * FROM cities where id=$city;";


    $county_qry = mysqli_query($conn, $cdata);
    $row1 = mysqli_fetch_assoc($county_qry);

    $state_qry = mysqli_query($conn, $sdata);
    $row2 = mysqli_fetch_assoc($state_qry);

    $city_qry = mysqli_query($conn, $ctdata);
    $row3 = mysqli_fetch_assoc($city_qry);
    // echo $row1['name'];
    // echo $row2['name'];
    // echo $row3['name'];

  // mysqli_real_escape_string()

  //  mysqli_select_db($conn1, "AA3");

    $insert="insert into user_profiles2 (Country,State,City) values ('{$row1['name']}','{$row2['name']}','{$row3['name']}');";
    // var_dump($insert);
    $m=mysqli_query($conn1,$insert);


    
 }






 ?>       



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="logout.php">logout</a>

    <h1>Data Added to Database</h1>
</body>
</html>