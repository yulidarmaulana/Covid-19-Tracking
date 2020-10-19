<?php

        function separate($number)
        {
          return number_format((float)$number, 0, ',', '.');
        }

         $sumber = 'https://disease.sh/v3/covid-19/all';
         $sumber2 = 'https://disease.sh/v3/covid-19/countries/Indonesia';
         $sumber3 = 'https://disease.sh/v3/covid-19/countries/Japan';
         $konten = file_get_contents($sumber);
         $konten2 = file_get_contents($sumber2);
         $konten3 = file_get_contents($sumber3);
         $data = json_decode($konten, true);
         $data2 = json_decode($konten2, true);
         $data3 = json_decode($konten3, true);
         
         // Global Kasus
         $confirmed = separate($data['updated']);
         $cases = separate($data['cases']);
         $deaths = separate($data['deaths']);
         $recovered = separate($data['recovered']);
         
         // Indonesia Kasus
         $konfirmasi  = separate($data2['cases']);
         $meninggal = separate($data2['deaths']);
         $sembuh = separate($data2['recovered']);
         $negara = $data2['country'];

         // Japan Kasus
         $cases2 = separate($data3['cases']);
         $deaths2 = separate($data3['deaths']);
         $recovered2 = separate($data3['recovered']);
         $country = $data3['country'];


         $url = "https://api.kawalcorona.com/";

         $client = curl_init($url);
         curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

         $response = curl_exec($client);
         $result = json_decode($response, true);  
       
         $dateTimeString = $result[0]['attributes']['Last_Update'] / 1000; 
         $lastUpdate = date("l, d F Y H:i:s", $dateTimeString);
       

?>  
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pantau Penyebaran Virus Covid-19</title>
  </head>
  <body>

  <style>
  nav{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  </style>

  <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white ">
  <a class="navbar-brand text-white" href="#" >Pantau Covid-19</a>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav text-white ">
      <li class="nav-item">
        <a class="nav-link text-white" href="https://kawalcovid19.id/category/artikel">Informasi <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="https://www.halodoc.com/kesehatan/coronavirus">Artikel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="https://covid19.go.id/p/konten/kontak-layanan-kementerianlembaga-untuk-covid-19">Kontak</a>
      </li>
       
      </ul>
    </div>
  </nav>

  <div class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container text-center">
      <h1 class="display-4 text-center">Corona Virus</h1>
      <p class="lead">
        <h4>
          PANTAU PENYEBARAN COVID-19 DI DUNIA 
        </h4>
        <?php
            print "<h6>" .$lastUpdate;"</h6>"
        ?>
      </p>
    </div>
  </div>

  <style type="text/css">
    .box{
      padding: 30px 40px;
      border-radius: 10px;;
    }
  </style>
 
  <div class="container">
    <div class="row">
      <div class="col-md-4">
          <div class="bg-info box text-white text-bold">
            <div class="row">
            
              <div class="col-md-6">
                <h5>Confirmed</h5>
                <?php
                print "<h2>" .$cases;"</h2>"
                ?>
                <h4>people</h4>
              </div>
              <div class="col-md-4">
                <img src="img/sad.svg" style="width: 100px;">
              </div>
            </div>
          </div>
      </div>

      <div class="col-md-4">
          <div class="bg-danger box text-white text-bold">
            <div class="row">
              <div class="col-md-6">
                <h5>Deaths</h5>
                <?php
                // <h2 id="data-mati"> 1234 </h2>
                print "<h2>" .$deaths;"</h2>"
                ?>
                <h4>people</h4>
              </div>
              <div class="col-md-4">
                <img src="img/cry.svg" style="width: 100px;">
              </div>
            </div>
          </div>
      </div>
      
      <div class="col-md-4">
          <div class="bg-success box text-white text-bold">
            <div class="row">
              <div class="col-md-6">
                <h5>Recovered</h5>
                <?php
                // print "<h2 id="data-sembuh">".$result[36]['attributes']['Recovered']"</h2>"
                print "<h2>" .$recovered;"</h2>"
                ?>
                <h4>People</h4>
              </div>
              <div class="col-md-4">
                <img src="img/happy.svg" style="width: 100px;">
              </div>
            </div>
          </div>
      </div>

      <div class="col-md-6 mt-3">
          <div class="bg-primary box text-white text-bold">
            <div class="row">
              <div class="col-md-8">
                <?php
                 print "<h2><b> $negara </b></h2>";
              
                 print "<h4> Positif   :  ".$konfirmasi;"</h4><br>";
                 print "<h4> Meninggal :  ".$meninggal;"</h4><br>";
                 print "<h4> Sembuh    :  ".$sembuh;"</h4><br>";
                ?>
              </div>
              <div class="col-md-4">
                <img src="img/indonesia.svg" style="width: 100px;">
              </div>
            </div>
          </div>
      </div>

      <div class="col-md-6 mt-3">
          <div class="bg-primary box text-white text-bold">
            <div class="row">
              <div class="col-md-8">
                <?php
                 print "<h2><b> $country </b></h2>";
              
                 print "<h4> Positif   :  ".$cases2;"</h4><br>";
                 print "<h4> Meninggal :  ".$deaths2;"</h4><br>";
                 print "<h4> Sembuh    :  ".$recovered2;"</h4><br>";
                ?>
              </div>
              <div class="col-md-4">
                <img src="img/japan.svg" style="width: 100px;">
              </div>
            </div>
          </div>
      </div>

    </div>
  </div>

  <footer class="bg-light text-center text-dark mt-3 bt-2 pb-2">
    Create by Yulidar Maulana
  </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>