    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  <div class="panel panel-default">

  <a href="http://<? echo $host ?>/index.php"><img src="http://<? echo $host ?>/logo-kronologger-png-mini.png" alt="kronologger.com - Location Based MarketPlace, FileSharing and BulletinBoard"></img></a>
    <div class="panel-heading">Kronologger.com -
    Platform to Connecting U to your neighborhood,
    No LOGIN Required, No REGISTRATION
    </div>
    <div class="panel-body">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
    </script>
            <p><article>
<?
  include("sponsor.php");
?>
      <h4>Finding your location: <span id="status">checking...</span></h4>

     <?

 	    $cookies_php_lat = $_COOKIE['latitude-cookies'];
 	    $cookies_php_lon = $_COOKIE['longitude-cookies'];

    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$cookies_php_lat.",".$cookies_php_lon."&sensor=true";
    $data = @file_get_contents($url);
    $jsondata = json_decode($data,true);
  // echo "<p>url = ".$url;
   // echo "<p>jsondata = ".$jsondata;
  //  echo "<p>jsondata status = ".$jsondata['status'];

    if(is_array($jsondata) && $jsondata['status'] == "OK")
    {
          $lima = $jsondata['results']['0']['address_components']['5']['long_name'];
          $enam = $jsondata['results']['0']['address_components']['6']['long_name'];
          $tujuh = $jsondata['results']['0']['address_components']['7']['long_name'];
          //$formatted_address = $jsondata['results']['0']['formatted_address'];
          $formatted_address = $lima.", ".$enam. ", ".$tujuh;
          echo "<h5>you are around ".$formatted_address. "</h5>";
    }


      ?>
  </p>

    </div>
  </div>

	</article>


