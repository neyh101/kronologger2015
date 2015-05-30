﻿<h1>Ruas Jalan</h1>
<h2>Powered by Kronologger API</h2>
<?
$url_refresh="index.php";
$appid="1";
$secretkey="Demo";
$hostAPI1 = "http://localhost/kronologger2015/API/getKronMessages";
$hostAPI2 = "http://localhost/kronologger2015/API/getFileAttachment";
$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];


$mode=$_POST['mode'];
//echo "<br>mode = ".$mode;
  if ($mode=="reveal_attachment") {
    $idmessages=$_POST['idmessages'];
    $revealpassword=$_POST['revealpassword'];


     $datagetFileAttachment = array("appid" => "$appid",
      "secretkey" => "$secretkey" ,
        "lat" => "$cookies_php_lat" ,
         "lon" => "$cookies_php_lon" ,
        "msgid" => "$idmessages" ,
         "passwordInput" => "$revealpassword" ,

       );
       /*
        echo "<br>appid = ".$appid;
        echo "<br>secretkey = ".$secretkey;
        echo "<br>lat = ".$cookies_php_lat;
        echo "<br>lon = ".$cookies_php_lon;
        echo "<br>idmessages = ".$idmessages;
        echo "<br>revealpassword = ".$revealpassword;
        */

        $ch_getFileAttachment = curl_init($hostAPI2);
        curl_setopt($ch_getFileAttachment, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch_getFileAttachment, CURLOPT_POSTFIELDS, $datagetFileAttachment);
        curl_setopt($ch_getFileAttachment, CURLOPT_RETURNTRANSFER, true);
        $result_getFileAttachment = curl_exec($ch_getFileAttachment);
      //  echo "<br>result2 = ".  $result_getFileAttachment;
        $jsongetFileAttachment=json_decode($result_getFileAttachment,true);
        //echo "<br>json2 = ".  $jsongetFileAttachment;
        $outputGetFileAttachment="";
         foreach ($jsongetFileAttachment as $result_getFileAttachment) {
              $messagesID_forpasswordreveal =$result_getFileAttachment['msgid'];
              $fileattachment_forpasswordreveal = $result_getFileAttachment['fileattachment'];
              $thumbnail_forpasswordreveal = $result_getFileAttachment['thumbnail'];
         }
  }

?>

<section id="wrapper">
<script>
function success(position) {
  var s = document.querySelector('#status');

  if (s.className == 'success') {
    // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back
    return;
  }

  s.innerHTML = "We found you!";
  s.className = 'success';

  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcanvas';
  mapcanvas.style.left = '10px';
  mapcanvas.style.height = '250px';
  mapcanvas.style.width = '80%';

  document.querySelector('article').appendChild(mapcanvas);

  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

  var myOptions = {
    zoom: 13,
    center: latlng,
    mapTypeControl: false,
    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

  var marker = new google.maps.Marker({
      position: latlng,
      map: map,
      title:"You are here! (at least within a "+position.coords.accuracy+" meter radius)"
 });
    document.cookie="latitude-cookies=" +position.coords.latitude;
      document.cookie="longitude-cookies=" +position.coords.longitude;

     <?php
             $cookies_php_lat = $_COOKIE['latitude-cookies'];
          $cookies_php_lon = $_COOKIE['longitude-cookies'];



      if ($cookies_php_lat=="" && $cookies_php_lon=="") {
        ?>
      window.location = "<?php echo $url_refresh ?>"
        <?php
      }

    ?>


       marker.setMap(map);


          var spotArea = {
          strokeColor: "#AA0000",
          strokeOpacity: 0.1,
          strokeWeight: 2,
          fillColor: "#AA0000",
          fillOpacity: 0.35,
          map: map,
          center: latlng,
          radius: 1500
        };
        cityCircle = new google.maps.Circle(spotArea)


}

function error(msg) {
  var s = document.querySelector('#status');
  s.innerHTML = typeof msg == 'string' ? msg : "failed";
  s.className = 'fail';

  // console.log(arguments);
}

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success, error);

} else {
  error('not supported');
}
</script>
</section>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<h4>Finding your location: <span id="status">checking...</span></h4>
   <p><article>

<?
 $cookies_php_lat = $_COOKIE['latitude-cookies'];
 $cookies_php_lon = $_COOKIE['longitude-cookies'];
?>
<br>Latitude  : <? echo $cookies_php_lat ?>
<br>Longitude : <? echo $cookies_php_lon?>
<br>URL REFESH : <? echo $url_refresh?>

 	</article>
<?
  if ($cookies_php_lat!="" && $cookies_php_lon!="") {
$lat = $cookies_php_lat;
$lon = $cookies_php_lon;


$data = array("appid" => "$appid",
 "secretkey" => "$secretkey" ,
 "contentshout" => "$inputContent" ,
 "lat" => "$lat" ,
 "lon" => "$lon" ,
 );

$ch = curl_init($hostAPI1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
 $json=json_decode($result,true);
//echo "<br>result1 = ".  $result_getFileAttachment;
//echo "<br>json1 = ".  $json;
$output="";

  foreach ($json as $rj) {
  $msgid = $rj['msgid'];
  $contentmsg = $rj['contentmsg'];
  $msgdate = $rj['msgdate'];
  $isthumbnail = $rj['isthumbnail'];
  $isAttachment = $rj['isAttachment'];
  $isPassword = $rj['isPassword'];

  $outputformentrpassword="";
  if ($isPassword=="1") {
  $outputformentrpassword=$outputformentrpassword. "<form action='#".$msgid."' method='post'>
   <p><input type='password' name='revealpassword'>
              <input type='hidden' name='idmessages' value='".$msgid."'>
              <input type='hidden' name='mode' value='reveal_attachment'>
              <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
  $outputformentrpassword=$outputformentrpassword. "</form>";


  } // tutup ifpassword=1

  if ($isAttachment=="1" && $isPassword=="0" ) {
      $datagetFileAttachment = array("appid" => "$appid",
      "secretkey" => "$secretkey" ,
        "lat" => "$lat" ,
         "lon" => "$lon" ,
        "msgid" => "$msgid" ,
       );
       $ch_getFileAttachment = curl_init($hostAPI2);
        curl_setopt($ch_getFileAttachment, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch_getFileAttachment, CURLOPT_POSTFIELDS, $datagetFileAttachment);
        curl_setopt($ch_getFileAttachment, CURLOPT_RETURNTRANSFER, true);
        $result_getFileAttachment = curl_exec($ch_getFileAttachment);
       // echo "<br>result2 = ".  $result_getFileAttachment;
        $jsongetFileAttachment=json_decode($result_getFileAttachment,true);
       // echo "<br>json2 = ".  $jsongetFileAttachment;
        $outputGetFileAttachment="";

         foreach ($jsongetFileAttachment as $result2) {
              $fileattachment = $result2['fileattachment'];
              $thumbnail = $result2['thumbnail'];
         }

      $showLinkFileAtcchment = $fileattachment;
      $showLinkThumbnail = $thumbnail;
  }
  else {
          $fileattachment="";
          $thumbnail="";
          $showLinkFileAtcchment = "";
          $showLinkThumbnail="";
  }     // tutup if ispassword=0 and attachment=1


      if ($msgid==$messagesID_forpasswordreveal) {
              $showLinkFileAtcchment = $fileattachment_forpasswordreveal;
              $showLinkThumbnail = $thumbnail_forpasswordreveal;
       }

  $output .= "<br>";
  $output .= "<a name='".$msgid."'></a>";
  $output .= "<br>msgid : ". $msgid;
  $output .= "<br>contentmsg : ". $contentmsg;
  $output .= "<br>msgdate : ". $msgdate;
  $output .= "<br>isthumbnail Status : ". $isthumbnail;
  $output .= "<br>isAttachment : ". $isAttachment;
  $output .= "<br>File Attachment : ". $showLinkFileAtcchment;
  $output .= "<br>Thumbnail : ". $showLinkThumbnail;
  $output .= "<br>isPassword : ". $isPassword;
  if ($isPassword=="1") {
        $output .= $outputformentrpassword;
  }


  $output .= "<br>";

  } // tutup foreach1
    echo $output;

  } // tutup if cookes!=""

?>


