<?php
    session_start();
    $weather = "";
    $error = "";
    // Using the Session Variable that where passed on from the previous page
    @$city = $_SESSION['city'];
    @$img = $_SESSION['condition'];

        // Extracting the JSON file from the URL
        $urlContents = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($city).",&appid=186e4109bd1ad68877955aa61a0abb1b");
        // Decoding the JSON file into an Associative Array for our use
        $weatherArray = json_decode($urlContents, true);

          // Assigning the JSON content to various forecasts values
          $temp = intval($weatherArray['main']['temp'] - 273);
          $weather = $weatherArray['weather'][0]['description'];
          $humidity = $weatherArray['main']['humidity'];
          @$visibility = $weatherArray['visibility'];
          $presssure = $weatherArray['main']['pressure'];
          $speed = $weatherArray['wind']['speed'];
          $sunset = $weatherArray['sys']['sunset'];
          $sunrise = $weatherArray['sys']['sunrise'];
          $max =  intval($weatherArray['main']['temp_max']);
          $min = intval($weatherArray['main']['temp_min']);

          // Setting the Default time zone for converting the time stamp into a valid time
          date_default_timezone_set('Asia/Bangkok');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      <style type="text/css">
      html {
          background: url(images/anton-darius-ebHCU8n7G38-unsplash.jpg) no-repeat center center fixed;
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
          body {
              background: none;
              font-family: "Helvetica";
          }
          .container {
              text-align: center;
              margin-top: 100px;
              width: 450px;
              padding-left:1px;
          }
          input {
              margin: 20px 0;
          }
          #weather {
              margin-top:15px;
          }
          .card{
            text-align: center;
            font-weight: bold;
            transition: 1400ms;
            opacity: 0.8;
          }

          /*
          flip card
          */
          .card-flip > div {
            backface-visibility: hidden;
            transition: transform 200ms;
            transition-timing-function: linear;
            width: 100%;
            height: 100%;
            margin: 0;
            display: flex;
          }

          .card-front {
            transform: rotateY(0deg);
          }

          .card-back {
            transform: rotateY(180deg);
            position: absolute;
            top: 0;
          }

          .card-flip:hover .card-front {
            transform: rotateY(-180deg);
          }

          .card-flip:hover .card-back {
            transform: rotateY(0deg);
          }


      </style>

  </head>
  <body>

      <div class="container">
        <h1 style="  color: white;" >Weather for <?php echo $city; ?></h1>
          <br>
          <a class="btn btn-primary btn-lg" href="http://localhost/Weather_Web_Application/9.2.php" role="button">Check For Another City</a>
          <br>
          <br>
          <br>
      </div>

      <!-- Forcast Cards Deck 1 -->
      <div class="row">
        <div class="col-md-2 col-md-offset-1">
      <div class="card-deck">

                <!-- Individual Forecast Card -->
                <div class="card card-flip h-100">
                    <div class="card-front text-white bg-dark">
                        <div class="card-body">
                            <i class="fa fa-search fa-5x float-right"></i>
                            <img style="padding: 15px;height:180px; width:190px;"class="card-img-top"src="images/temperature-2-xxl.png" alt="Card image cap">
                            <div class="card-footer bg-transparent border-success"><strong>Temprature</strong> </div>
                        </div>
                    </div>
                    <div class="card-back bg-white">
                        <div class="card-body">
                            <br>
                            <br>
                            <br>
                            <h1 class="card-text"style="text-align: center;"> <strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $temp."&deg;C"; ?></strong></h1>
                        </div>
                    </div>
                </div>

                <!-- Individual Forecast Card -->
                <div class="card card-flip h-100">
                    <div class="card-front text-white bg-dark">
                        <div class="card-body">
                            <i class="fa fa-search fa-5x float-right"></i>
                            <img style="padding: 15px; height:180px;width:190px;"class="card-img-top"src="images/<?php echo $img; ?>.png" alt="Card image cap">
                            <div class="card-footer bg-transparent border-success"><strong>Weather</strong> </div>
                        </div>
                    </div>
                    <div class="card-back bg-white">
                        <div class="card-body">
                            <br>
                            <br>
                            <br>
                            <h3 class="card-text-center">&nbsp <strong><?php echo $weather ?></strong></h3>
                        </div>
                    </div>
                </div>

                <!-- Individual Forecast Card -->
                <div class="card card-flip h-100">
                    <div class="card-front text-white bg-dark">
                        <div class="card-body">
                            <i class="fa fa-search fa-5x float-right"></i>
                            <img style="padding: 15px; height:180px;width:190px;"class="card-img-top"src="images/caves-a-vin-montreal-humidite.png" alt="Card image cap">
                            <div class="card-footer bg-transparent border-success"><strong>Humidity</strong> </div>
                        </div>
                    </div>
                    <div class="card-back bg-white">
                        <div class="card-body">
                            <br>
                            <br>
                            <br>
                            <h1 class="card-text"> <strong>&nbsp&nbsp&nbsp<?php echo $humidity."% rh"; ?></strong></h1>
                        </div>
                    </div>
                </div>

                <!-- Individual Forecast Card -->
                <div class="card card-flip h-100">
                    <div class="card-front text-white bg-dark">
                        <div class="card-body">
                            <i class="fa fa-search fa-5x float-right"></i>
                            <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/images1.png" alt="Card image cap">
                            <div class="card-footer bg-transparent border-success"><strong>Visibility</strong> </div>
                        </div>
                    </div>
                    <div class="card-back bg-white">
                        <div class="card-body">
                            <br>
                            <br>
                            <br>
                            <h1 class="card-text-center"> &nbsp<strong><?php echo $visibility." m"; ?></strong></h1>
                        </div>
                    </div>
                </div>

                <!-- Individual Forecast Card -->
                <div class="card card-flip h-100">
                    <div class="card-front text-white bg-dark">
                        <div class="card-body">
                            <i class="fa fa-search fa-5x float-right"></i>
                            <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/download.png" alt="Card image cap">
                            <div class="card-footer bg-transparent border-success"><strong>Pressure</strong> </div>
                        </div>
                    </div>
                    <div class="card-back bg-white">
                        <div class="card-body">
                            <br>
                            <br>
                            <h1 class="card-text"style="text-align: center;">  <strong><?php echo $presssure." mmHg"; ?></strong></h1>
                        </div>
                    </div>
                </div>

      </div>
     </div>
    </div>

    <br>
    <br>

    <!-- Forcast Cards Deck 1 -->
    <div class="row">
      <div class="col-md-2 col-md-offset-1">
        <div class="card-deck">

          <!-- Individual Forecast Card -->
          <div class="card card-flip h-100">
              <div class="card-front text-white bg-dark">
                  <div class="card-body">
                      <i class="fa fa-search fa-5x float-right"></i>
                      <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/windmill-xxl.png" alt="Card image cap">
                      <div class="card-footer bg-transparent border-success"><strong>Wind Speed</strong> </div>
                  </div>
              </div>
              <div class="card-back bg-white">
                  <div class="card-body">
                      <br>
                      <br>
                      <br>
                      <h1 class="card-text"style="text-align: center;">  <strong>&nbsp&nbsp<?php echo $speed." m/s" ?></strong></h1>
                  </div>
              </div>
          </div>

          <!-- Individual Forecast Card -->
          <div class="card card-flip h-100">
              <div class="card-front text-white bg-dark">
                  <div class="card-body">
                      <i class="fa fa-search fa-5x float-right"></i>
                      <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/ios11-weather-sunset-icon.png" alt="Card image cap">
                      <div class="card-footer bg-transparent border-success"><strong>Sunset</strong> </div>
                  </div>
              </div>
              <div class="card-back bg-white">
                  <div class="card-body">
                      <br>
                      <br>
                      <br>
                      <h1 class="card-text"style="text-align: center;">&nbsp&nbsp&nbsp&nbsp<strong><?php echo date('H:i',$sunset);  ?></strong></h1>
                  </div>
              </div>
          </div>


          <!-- Individual Forecast Card -->
          <div class="card card-flip h-100">
              <div class="card-front text-white bg-dark">
                  <div class="card-body">
                      <i class="fa fa-search fa-5x float-right"></i>
                      <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/ios11-weather-sunrise-icon.png" alt="Card image cap">
                      <div class="card-footer bg-transparent border-success"><strong>Sunrise</strong> </div>
                  </div>
              </div>
              <div class="card-back bg-white">
                  <div class="card-body">
                      <br>
                      <br>
                      <br>
                      <h1 class="card-text"style="text-align: center;">  <strong>&nbsp&nbsp&nbsp&nbsp<?php echo date('H:i',$sunrise);  ?></strong></h1>
                  </div>
              </div>
          </div>


          <!-- Individual Forecast Card -->
          <div class="card card-flip h-100">
              <div class="card-front text-white bg-dark">
                  <div class="card-body">
                      <i class="fa fa-search fa-5x float-right"></i>
                      <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/ios11-weather-hot-icon.png" alt="Card image cap">
                      <div class="card-footer bg-transparent border-success"><strong>Max Temp</strong> </div>
                  </div>
              </div>
              <div class="card-back bg-white">
                  <div class="card-body">
                      <br>
                      <br>
                      <br>
                      <h1 class="card-text"style="text-align: center;">&nbsp&nbsp&nbsp&nbsp&nbsp<strong><?php echo ($max-273)."&deg;C"; ?></strong></h1>
                  </div>
              </div>
          </div>


          <!-- Individual Forecast Card -->
          <div class="card card-flip h-100">
              <div class="card-front text-white bg-dark">
                  <div class="card-body">
                      <i class="fa fa-search fa-5x float-right"></i>
                      <img style="padding: 15px;height:180px;width:190px;"class="card-img-top"src="images/ios11-weather-frigid-temps-icon.png" alt="Card image cap">
                      <div class="card-footer bg-transparent border-success"><strong>Min Temp</strong> </div>
                  </div>
              </div>
              <div class="card-back bg-white">
                  <div class="card-body">
                      <br>
                      <br>
                      <br>
                      <h1 class="card-text"style="text-align: center;">&nbsp&nbsp&nbsp&nbsp&nbsp<strong><?php echo ($min-273)."&deg;C"; ?></strong></h1>
                  </div>
              </div>
          </div>

        </div>
      </div>
    </div>

    <br>
    <br>
    <br>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
