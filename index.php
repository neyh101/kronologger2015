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

<title>Kronologger - Platform to Connecting U to your neighborhood</title>

<link href="http://<? echo $host ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="http://<? echo $host ?>/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="http://<? echo $host ?>/css/animated.css" rel="stylesheet">
<!--<link href="theme.css" rel="stylesheet">-->

<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link href="//fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet" type="text/css">





<script type="text/javascript" src="http://<? echo $host ?>/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    skin : "o2k7",
    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "http://<? echo $host ?>/lists/template_list.js",
		external_link_list_url : "http://<? echo $host ?>/lists/link_list.js",
		external_image_list_url : "http://<? echo $host ?>/lists/image_list.js",
		media_external_list_url : "http://<? echo $host ?>/lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->




</head>


<a name="top"></>
<body role="document">


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=253900361486973";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
          <a class="navbar-brand" href="http://<? echo $host ?>/index.php">Kronologger.Com</a>
        </div>

	  <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://<? echo $host ?>/index.php"><img src="http://<? echo $host ?>/icon-refresh.jpg" alt="refresh" width="15" height="15">&nbsp;Refresh</a></li>
            <li><a href="http://<? echo $host ?>/#top"><img src="http://<? echo $host ?>/icon-up.png" alt="refresh" width="15" height="15">&nbsp;Up/TopPage</a></li>
            <li><a href="http://<? echo $host ?>/#formdisplay"><img src="http://<? echo $host ?>/icon-view.jpg" alt="view" width="15" height="15">&nbsp;View</a></li>
            <li><a href="http://<? echo $host ?>/#formpost"><img src="http://<? echo $host ?>/icon-newpost.jpg" alt="new post" width="15" height="15">&nbsp;New Post</a></li>
       			<li><a href="http://<? echo $host ?>/#disclaimer"><img src="http://<? echo $host ?>/icon-about.jpg" alt="about" width="15" height="15">&nbsp;About</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<p>&nbsp;</p>

<section id="wrapper">
<!--<meta name="viewport" content="width=620" />-->
<script src="http://<? echo $host ?>/js/jquery.min.js"></script>
<script src="http://<? echo $host ?>/js/jquery.transit.min.js"></script>
<script src="http://<? echo $host ?>/js/main.js"></script>



	<p>

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=253900361486973";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


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



<?
$cookies_php_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
$mode = $_POST['mode'];
if ($mode=="") {
  $mode = $_GET['mode'];

}
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
    $result = $link->exec($sqlinsert);
               $errorUpload="<script>alert('Comment Succeed ! ')</script>";
                 echo $errorUpload;
	}
}



if ($mode=="updatestatus") {
	$inputContent = $_POST['content'];
	if ($inputContent=="") {
  	$inputContent = $_GET['content'];
  }

  $inputContent = clear_variable_post_get($inputContent);
   // $inputContent  = makeClickableLinks($inputContent) ;
	$lat_post =  $_POST['lat_post'];
	$lon_post =  $_POST['lon_post'];

  $check_lat_decimal = containsDecimal($lat_post);
  $check_lon_decimal = containsDecimal($lon_post);

  if ($check_lat_decimal!=true || $check_lon_decimal!=true) {
          $bolehlanjut=0;
          $msgstatus=$msgstatus."<br>we dont know wher you are2 ";
          exit;
  }

  if  ($lat_post=="" && $lon_post=="") {
  	$lat_post =  $_GET['lat'];
	  $lon_post =  $_GET['lng'];
  }
  if  ($lat_post=="" && $lon_post=="") {
     $bolehlanjut=0;
     $msgstatus=$msgstatus."<br>we dont know wher you are ";
  }


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

  $checextensionkattachment_4huruf =  substr(basename($_FILES['image_url']['name']), -4);
	$checextensionkattachment_4huruf = mb_strtolower($checextensionkattachment_4huruf);

  //  echo "<p>Type Image URL = " . $_FILES["image_url"]["type"] ;
	//echo "<p>Extension File = " . $checextensionkattachment;
  //  echo "<p>Type Image URL Size = " . $_FILES["image_url"]["size"];
	//exit;


	if ($checextensionkattachment_4huruf=="pptx") {
		   $extension = "pptx";
			$bolehupload = "1";
	}

	if ($checextensionkattachment_4huruf=="docx") {
		   $extension = "docx";
			$bolehupload = "1";
	}

 	if ($checextensionkattachment_4huruf=="xlsx") {
		   $extension = "xlsx";
			$bolehupload = "1";
	}


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
      $result = $link->exec($sql);
                              $errorUpload="<script>alert('Posting berhasil ')</script>";
                 echo $errorUpload;

        }
        else {
              $divpanelclass="panel panel-danger";
        } //tutup ifbolehlanjut=1 masuk ke database


} // tutup if mode='updatestatus'
?>

      <div class="row">
        <div class="col-md-8">
      <? include("maplayout.php"); ?>
      <? include("formpost.php"); ?>
      <? include("displaymsg.php"); ?>
           </div>

        <div class="col-md-4">
        <? include("disclaimer.php"); ?>
<? include("sourcecode.php"); ?>
<? include("reference.php"); ?>
        <? include("fblike.php"); ?>
        </div>

      </div>


<p>&nbsp;</p>
<? include("ga.php");
?>
</p>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://<? echo $host ?>/js/bootstrap.min.js"></script>

</html>
<?
  function containsDecimal( $value ) {
    if ( strpos( $value, "." ) !== false ) {
        return true;
    }
    return false;
}
?>
