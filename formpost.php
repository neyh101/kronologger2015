<p>&nbsp;</p>
<form  enctype="multipart/form-data" name="posting" role="form" method="post" action="" class="form-horizontal" >
<a name="formpost"></a>
  <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title">
            <h3 class="animated infinite shake">
             Posting New Messages</h3></h3>
            </div>

              <div class="panel-body">
                    <p><label for="textArea">
                    As a Location Based Sevices for MarketPlace, FileSharing and BulletinBoard,
                    <br>all you can post/write/share here is only will viewable within radius 1 kilometres away</label>
                    <p><textarea id="elm1" name="content" class="form-control" rows="8" cols="5"  id="textArea"></textarea>
           <p>Read This : Type File Attachment allowed are :
           <br><b>image jpg/png/gif ,
           video mp4  , audio mp3, Zip File,
           document pdf/xls/doc/txt/ppt
           <br>Maximum file only 5Mb: </b>
           <br>
           <input class="btn btn-sm btn-default" name="image_url" type="file" />

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
      <h2 class="animated infinite rubberBand"><a href="index.php">Sorry, button Submit is not available,
      Please Allow me to detect your location and click this link, or refresh !</a></h2>

      </p>
    </button>
      <?

    }
    else {

?>

    <p><button type="submit" class="btn btn-primary">
    Post/Sharing your Info
    </button>


    </p>
<p>&nbsp;</p>

<?php
    } // tutup if cookies kosong
?>

      </div>

    </form>

