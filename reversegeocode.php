<?
$lat =-6.237057;
$lng =106.907332;

$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true";
    $data = @file_get_contents($url);
    $jsondata = json_decode($data,true);
    echo "<p>url = ".$url;
    echo "<p>jsondata = ".$jsondata;

    if(is_array($jsondata) && $jsondata['status'] == "OK")
    {
          $city = $jsondata['results']['0']['address_components']['2']['long_name'];
          $country = $jsondata['results']['0']['address_components']['5']['long_name'];
          $street = $jsondata['results']['0']['address_components']['1']['long_name'];
          $street3 = $jsondata['results']['0']['address_components']['3']['long_name'];
          $street4 = $jsondata['results']['0']['address_components']['4']['long_name'];
          $formatted_address = $jsondata['results']['0']['formatted_address'];


          echo "<br>city = ".$city;
          echo "<br>country = ".$country;
          echo "<br>street = ".$street;
          echo "<br>street3 = ".$street3;
          echo "<br>street4 = ".$street4;
          echo "<br>formatted_address = ".$formatted_address;
    }


?>


