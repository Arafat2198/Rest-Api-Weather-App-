<?php
    session_start();
    $weather = "";
    $error = "";
        if (isset($_POST['submit']))
        {
              $city=$_POST['city'];
              // Extracting the JSON file from the URL
              $urlContents = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($city).",&appid=186e4109bd1ad68877955aa61a0abb1b");
              // Decoding the JSON file into an Associative Array for our use
              $weatherArray = json_decode($urlContents, true);
              echo $weatherArray;

              // For choosing what image to put up for weather
              if ($weatherArray['cod'] == 200)
              {
                $w1 = "cloud";
                $w2 = "rain";
                $w3 = "clear";
                $w4 = "mist";
                $w5 = "sno";
                $w6 = "dus";
                $w7 = "haz";
                $w8 = "smoke";
                if(strpos($weatherArray['weather'][0]['description'], $w1) !== false)
                {
                  $condition = 1;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w2) !== false)
                {
                  $condition = 2;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w3) !== false)
                {
                  $condition = 3;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w4) !== false)
                {
                  $condition = 4;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w5) !== false)
                {
                  $condition = 5;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w6) !== false)
                {
                  $condition = 6;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w7) !== false)
                {
                  $condition = 7;
                }
                else if(strpos($weatherArray['weather'][0]['description'], $w8) !== false)
                {
                  $condition = 1;
                }
                // Using the Session Variable to pass on the necessary details
                $_SESSION['condition']=$condition;
                $_SESSION['city']=$city;
                header("location:9.3.php");
              }
               else
              {
                  $error = "Could not find city - please try again.";
              }
        }
?>
<html>
<head>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style media="screen">


        body {
        background-image: url('images/anton-darius-ebHCU8n7G38-unsplash.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        }
        .jumbotron{
          width: 450px;
          position: inherit;
          transition: 1500ms;
          opacity: 0.8;
        }

</style>
</head>

<body>
  <br>
  <br>
  <br>
  <br>
  <br>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 offset-4 float-md-center">
  <div class="jumbotron">
    <h1 class="display-5 text-center" > <b>Quick Weather App</b> </h1>
      <p class="lead text-center">Enter any city name</p>
        <hr class="my-4">

        <!-- Form For entering the city name -->
          <form method="post">
                  <div class="form-group">
                    <input type="text" name="city" class="form-control" aria-describedby="emailHelp" placeholder="eg: Bangalore,Lucknow">
                  </div>
                  <div class="form-group form-check">
                  <button type="submit" class="btn btn-success" name="submit">Search</button>
                  </div>
                  <!-- Error alert will be displayed if the city name is not valid -->
                  <?php if ($error)
                  {
                      echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                  } ?>
          </form>

  </div>
</div>
</body>
</html>
