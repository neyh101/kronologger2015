<?php 
include("db.php"); 
include("function.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<!--<meta name="viewport" content="width=620">-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<title>Kronologger - Place to share file and spread news around you</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<!--<link href="theme.css" rel="stylesheet">-->
	
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link href="//fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet" type="text/css">
</head>


<body role="document">
	<a name="menu"></a>     
 <nav class="navbar navbar-inverse navbar-fixed-top">
     
	 <div class="container">
       <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Kronologger.Com</a>
        </div>
 
	  <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home / Map</a></li>
            <li><a href="#formdisplay">View</a></li>
            <li><a href="#formpost">New Post</a></li>
			<li><a href="#disclaimer">Disclaimer</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<p>&nbsp;</p>	




<section id="wrapper">
<!--<meta name="viewport" content="width=620" />-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.transit.min.js"></script>
<script src="js/main.js"></script>


		  
   <div class="row">
        <div class="col-sm-12">
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<div class="panel panel-default">
		<div class="panel-heading">Map</div>
		<div class="panel-body">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
             <p><article>
	<?php
	include("sponsor.php"); 
	?>
      <p>Finding your location: <span id="status">checking...</span></p>
	</p>

		</div>
  </div>
  </div>
</div>  
	
	</p>

	  
   
	</article>
	
	<p>
<script>
function success(position) {
  var s = document.querySelector('#status');
  
  if (s.className == 'success') {
    // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back    
    return;
  }
  
  s.innerHTML = "found you!";
  s.className = 'success';
  
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcanvas';
  mapcanvas.style.left = '50px';
  mapcanvas.style.height = '250px';
  mapcanvas.style.width = '220px';
    
  document.querySelector('article').appendChild(mapcanvas);
  
  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

  var myOptions = {
    zoom: 11,
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
          radius: 5000
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
<?php	  
$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
$mode = $_POST['mode'];

//echo "<br>mode = ". $mode;
//echo "<br>cookies_php_lat = ". $cookies_php_lat;
//echo "<br>cookies_php_lon = ". $cookies_php_lon;

if ($mode=="postcomment") {
	$commentuser = $_POST['commentuser'];
	$commentuser = clear_variable_post_get($commentuser);
	$id_pesandariform = $_POST['idpesan'];
	//echo "<br>commentuser = ". $commentuser;
	//echo "<br>id_pesandariform = ". $id_pesandariform;
	if ($commentuser!="") {
		$sqlinsert = "insert into comment (msgid,contentcomment,commentdate) values ('$id_pesandariform','$commentuser',now()) ";
		//echo "<br>sqlinsert = ". $sqlinsert;
		 $execute_insert = mysql_query($sqlinsert) or die('Error, pada waktu kirim komentar');
               $errorUpload="<script>alert('Comment Succeed ! ')</script>";
                 echo $errorUpload;
	}
}



if ($mode=="updatestatus") {
	$inputContent = $_POST['content'];
	$inputContent = clear_variable_post_get($inputContent);
    $inputContent  = makeClickableLinks($inputContent) ;
	$lat_post =  $_POST['lat_post'];
	$lon_post =  $_POST['lon_post'];
	$passwordcode = $_POST['passwordcode'];
	$bolehlanjut=1;
	if ($inputContent=="") {
            $bolehlanjut=0;
            $msgstatus=$msgstatus."<br>Konten tidak boleh dikosongkan ";
        }

	if ($bolehlanjut==1) {

           $bolehupload=0;
           $r1=rand(1,9999999999);
           $r2=rand(1,9999999999);
           $r3=rand(1,99999999999);

   	$filename = basename($_FILES['image_url']['name']);
    $filename = $r1."-".$r2."-".$r3;
    $maximumsize=5000000000;
	$checextensionkattachment =  substr(basename($_FILES['image_url']['name']), -3);
	$checextensionkattachment = mb_strtolower($checextensionkattachment);

  //  echo "<p>Type Image URL = " . $_FILES["image_url"]["type"] ;
	//echo "<p>Extension File = " . $checextensionkattachment;
  //  echo "<p>Type Image URL Size = " . $_FILES["image_url"]["size"];		
	//exit;
	
	
	if ($checextensionkattachment=="swf") {
		   $extension = "swf";
			$bolehupload = "1";
	}
	
	if ($checextensionkattachment=="ppt") {
		   $extension = "ppt";
			$bolehupload = "1";
	}

	
	if ($checextensionkattachment=="txt") {
		   $extension = "txt";
			$bolehupload = "1";
	}
	
	if ($checextensionkattachment=="mp3") {
		   $extension = "mp3";
			$bolehupload = "1";
	}
	
	if ($checextensionkattachment=="zip") {
		   $extension = "zip";
			$bolehupload = "1";
	}
	
	if ($checextensionkattachment=="doc") {
		   $extension = "doc";
			$bolehupload = "1";
	}
	
	if ($checextensionkattachment=="xls") {
		   $extension = "xls";
			$bolehupload = "1";
	}
	
	 if ( $_FILES["image_url"]["type"] == "video/mp4" ) {
        $extension = "mp4";
       	$bolehupload = "1";
    }

    if ( $_FILES["image_url"]["type"] == "image/gif" ) {
        $extension = "gif";
       	$bolehupload = "1";
    }

    if ( $_FILES["image_url"]["type"] == "image/png" ) {
        $extension = "png";
       	$bolehupload = "1";
    }

    if ( $_FILES["image_url"]["type"] == "image/pjpeg" || $_FILES["image_url"]["type"] == "image/jpeg" ) {
        $extension = "jpg";
      	$bolehupload = "1";
    }
	
	 if ( $_FILES["image_url"]["type"] == "application/pdf" ) {
        $extension = "pdf";
       	$bolehupload = "1";
    }

    //echo "<br>Extension = ". $extension;
    //echo "<br>bolehupload = ". $bolehupload;
	
	 if ( $bolehupload=="1" && $_FILES["image_url"]["size"] < $maximumsize )
		{
		 	$bolehupload = "1";
		}
    else {
            $bolehupload=0;
            $msgstatus=$msgstatus." File Attachment tidak berhasil diupload ";
            $msgstatus=$msgstatus. " Type Image URL Size = " . $_FILES["image_url"]["size"];
    }
	
	$target_path = "files/";
		$target_path = $target_path . $filename.".".$extension;

    $target_path_thumbnail = "thumbnail/";
    $target_path_thumbnail = $target_path_thumbnail."th-".$filename.".".$extension;

    if($bolehupload=="1" )
    {
        move_uploaded_file($_FILES['image_url']['tmp_name'], $target_path) ;
        move_uploaded_file($_FILES['image_url']['tmp_name'], $target_path_thumbnail) ;
  	// File and new size
		 	$filename = $target_path;

      //gambar diresize dahulu khusus jpg atau png
        if ($extension=="jpg" || $extension=="png") {
         	$filename_thumbnail = $target_path_thumbnail;
         	list($width, $height) = getimagesize($filename);
         if ($width>$height) {
          $type="landscape";
          $newwidth = 220;
          $newheight = 100;

         }
         else  if ($width<$height) {
           $type="potrait";
           $newwidth = 220;
           $newheight = 350;
         }
         else {
           $type="rectangular";
           $newwidth = 220;
           $newheight = 220;
         }


         $thumb = imagecreatetruecolor($newwidth, $newheight);
         if ($extension=="jpg") {
          $source = imagecreatefromjpeg($filename);
         }

         if ($extension=="png") {
          $source = imagecreatefrompng($filename);
         }

          // Resize
          imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

          // Output
            if ($extension=="jpg") {
              imagejpeg($thumb,$filename_thumbnail);
            }

           if ($extension=="png") {
              imagepng($thumb,$filename_thumbnail);
            }

          } // tutup if exctension=jpg or extension==png;


    }
    else {
        $filename="";
    }

	
	
	} // tutup ifbolehlanjut=1
	
	if ($bolehlanjut==1) {
			if ($passwordcode!="") {
				$passmd5 = md5("kronologger".$passwordcode);
			}
			else {
				$passmd5="";
			}
            $msgstatus = "Posting berhasil !";
            $divpanelclass="panel panel-success";
            $sql = " insert into shout ";
            $sql = $sql. " (lat_shout,lon_shout, ";
            $sql = $sql. "  contentmsg, thumbnail, fileattachment, msgdate , passprotected) ";
            $sql = $sql. " values ";
            $sql = $sql. " ('$lat_post','$lon_post' , ";
            $sql = $sql. " '$inputContent','$filename_thumbnail','$filename',now(),'$passmd5' ) ";
            $sql = $sql. " ";
            $sql = $sql. " ";
			//echo $sql;
            $execute1 = mysql_query($sql) or die('Error, pada waktu kirim posting');
               $errorUpload="<script>alert('Posting berhasil ')</script>";
                 echo $errorUpload;

        }
        else {
              $divpanelclass="panel panel-danger";
        } //tutup ifbolehlanjut=1 masuk ke database
		
	
} // tutup if mode='updatestatus'
?>
<p>&nbsp;</p>	
<?
include("displaymsgall.php");
?>
<p>&nbsp;</p>	

<p>&nbsp;</p>	

 <div class="row">
        <div class="col-sm-12">
		
<form  enctype="multipart/form-data" name="posting" role="form" method="post" action="" class="form-horizontal" >
<a name="formpost"></a>
	<div class="panel panel-info">
						<div class="panel-heading"><h5 class="panel-title">

						Posting New Messages</h5>
						</div>
						
							<div class="panel-body">
							
     
                    <p><label for="textArea">Whats Happening within this area ?, Your post will viewable within radius 5 kilometres away</label>
                    <p><textarea name="content" class="form-control" rows="8" cols="30"  id="textArea"></textarea>
					 <p>Read This : Type File Attachment allowed are : 
					 <br><b>image jpg/png/gif ,
					 video mp4  , audio mp3, Zip File, 
					 document pdf/xls/doc/txt/ppt
					 <br>Maximum file only 5Mb: </b> 
					 <br>
					 <input class="btn btn-primary" name="image_url" type="file" />
					 <p>Do you need password for this file Attachment ?
					 <br>if you put password, someone needs to entry password to open this file attachment
					 <br>Entry your password here : <input type="password" name="passwordcode">
 					 <br>Let it blank, if you dont need to protect your file attachment
    
	</div>
         
	   <input type="hidden" name="lat_post" value="<?php echo $cookies_php_lat ?>" />
        <input type="hidden" name="lon_post" value="<?php echo $cookies_php_lon ?>" />
		
	  <input type="hidden" name="mode" value="updatestatus">
<?php 
$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
		if ($cookies_php_lat==""  || $cookies_php_lon=="") {
			?>
			<p><a href="index.php">Sorry, button Submit is not available, Please Allow me to detect your location and click this link, or refresh !</a></p>
			<?
			
		}
		else {
			
?>      
	  <p><button type="submit" class="btn btn-primary">Post/Sharing your Info</button></p>
<?php
		} // tutup if cookies kosong 
?>


		</div>
					</div>

      </div>
    </div>

	</form>

<p>

<?php
include("disclaimer.php");
?>
</p>
<p>&nbsp;</p>	
<?php
include("sponsor.php"); 
?>
</p>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
	
</html>