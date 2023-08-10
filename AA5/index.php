<?php











ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
$status="";
$msg="";
$city="";
if(isset($_POST['submit'])){
   $city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=49c0bad2c7458f1c76bec9654081a661";
   // $url = "https://api.openweathermap.org/data/2.5/weather?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=49c0bad2c7458f1c76bec9654081a661";
   //  $city=$_POST['city'];
   $ch = curl_init();
   // var_dump($ch);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    $status="yes";
    if($result['cod']==200){
        $status="yes";
      //   echo "ok";
    }else{
        $msg=$result['message'];
    }
}
?>

<html lang="en" class=" -webkit-">
   <head>
      <meta charset="UTF-8">
      <title>Weather Application</title>
          <link rel="stylesheet" href="style/style.css">

      
   </head>
   <body>
      <div class="form">
         <form style="width:100%;" method="post">
            <input type="text" class="text" placeholder="enter city" name="city" />
            <input type="submit" value="Submit" class="submit" name="submit"/>
            <?php echo $msg?>
         </form>
      </div>
      
      <?php if($status=="yes"){?>
      <article class="widget">
         <div class="weatherIcon">
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png"/>
         </div>
         <div class="weatherInfo">
            <div class="temperature">
               <span><?php echo round($result['main']['temp']-273.15)?>°</span>
            </div>
            <div class="description mr45">
               <div class="weatherCondition"><?php echo $result['weather'][0]['main']?></div>
               <!-- <div class="place"><?php echo $result['name']?></div> -->
            </div>
            <div class="description">
               <div class="weatherCondition">Wind</div>
               <div class="place"><?php echo $result['wind']['speed']?> M/H</div>
            </div>
         </div>
         <div class="date">
            <?php echo date('d M',$result['dt'])?> 
             
         </div>
         
      </article>
      <?php } ?>
   </body>
</html>