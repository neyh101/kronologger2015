
<a name="formdisplay"></a>
<p>&nbsp;</p>
<p>&nbsp;</p>
 <div class="row">
        <div class="col-sm-12">
<?

$mode = $_POST['mode'];
$bolehbukafile=0;

//echo "<br>Tahap 1 = variable volehubkafile = ".$bolehbukafile;

if ($mode=="revealfile") {
  $valuerevealpassword = $_POST['revealpassword'];
  $cekMd5revealpassword =  md5("kronologger".$valuerevealpassword);
  $valueidmessages = $_POST['idmessages'];
  $sqlcondition = " and msgid='$valueidmessages' ";
  $ambilpassworddaridatabase = getpasswordFile($valueidmessages);

  if ($cekMd5revealpassword==$ambilpassworddaridatabase) {

    $pesan_buka_file="Congratulation !!, yourpassword is correct ! ";
         $errorUpload="<script>alert('$pesan_buka_file')</script>";
    $bolehbukafile=1;
       echo $errorUpload;
  }
  else {
    $pesan_buka_file="Sorry...Incorrect Password !";
        $errorUpload="<script>alert('$pesan_buka_file')</script>";
        echo $errorUpload;
    $bolehbukafile=0;
  }
}


$viewkron = $_GET['viewkron'];

if ($viewkron!="") {
$sql_condition_id_tertentu = " and msgid ='$viewkron' ";
}

$cookies_p_lat = $_COOKIE['latitude-cookies'];
$cookies_php_lon = $_COOKIE['longitude-cookies'];
$lat_min = $cookies_php_lat - 0.032;
$lat_max = $cookies_php_lat + 0.032;
$lon_min = $cookies_php_lon - 0.032;
$lon_max = $cookies_php_lon + 0.032;

$sql = "select msgid,   lat_shout, lon_shout, ";
$sql = $sql. " contentmsg,   fileattachment , thumbnail, msgdate , passprotected ";
$sql = $sql. " from shout ";
$sql = $sql. " where 1=1 ";
$sql = $sql. " and lat_shout between $lat_min and $lat_max ";
$sql = $sql. " and lon_shout between $lon_min and $lon_max ";
$sql = $sql. $sqlcondition ;
$sql = $sql. $sql_condition_id_tertentu;
$sql = $sql. " order by msgid desc limit 0,50 ";
$sql = $sql. " ";
$sql = $sql. " ";

//echo $sql;

$execute0 = mysql_query($sql) or die('Error, pada waktu retrieve data!');
      $rt=0;
      while($row = mysql_fetch_array($execute0))
      {
          $rt=$rt+1;
          $msgid=$row['msgid'];
          $lat_shout=$row['lat_shout'];
          $lon_shout=$row['lon_shout'];
          $contentmsg=$row['contentmsg'];
          $fileattachment=$row['fileattachment'];
          $thumbnail=$row['thumbnail'];
          $postdate=$row['msgdate'];
          $passprotected= $row['passprotected'];
          $checkattachment =  substr($fileattachment, -3);
          $checkattachment = mb_strtolower($checkattachment);
          //echo "<br>check attachemnt = ".$checkattachment;

$month = substr($postdate,5,2);
          $day = substr($postdate,8,2);
          $year = substr($postdate,0,4);
          $hour = substr($postdate,11,2);
          $minute = substr($postdate,14,2);
          $second= substr($postdate,17,2);
          $tt=floor((time()-mktime($hour,$minute,$second,$month,$day,$year))/1);
          $keteranganwaktu = time_left($tt);
          $zonawaktujakarta = tampilkanconverzonawaktu($postdate);
          $displayimage="";

          if ( ($checkattachment=="jpg" || $checkattachment=="png") && $thumbnail!="") {

            $displayimage = "<a href='http://".$host."/".$fileattachment."' target='_new'><img src='http://".$host."/".$thumbnail."'></a>";
            $displayimage = $displayimage. "<br><a href='http://".$host."/".$fileattachment."' target='_new'>Click here to open original images</a> ";
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
            $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
              $dropbox_save="";
              $displayimage ="";
              $displayimage = "<img src='http://".$host."/icon-jpg.jpg'  width='60' height='80'>".
              $displayimage = $displayimage. "<br>Sorry, Needs Password to open this JPG File ";
              $displayimage = $displayimage. "<div class='form-group'>";
              $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
              <p><input type='password' name='revealpassword'>
              <input type='hidden' name='idmessages' value='".$msgid."'>
              <input type='hidden' name='mode' value='revealfile'>
              <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
              $displayimage = $displayimage. "</form>";
              $displayimage = $displayimage. "</div>";
            }
          }

          if ($checkattachment=="gif" && $thumbnail=="") {
              $displayimage = "<img src='http://".$host."/".$fileattachment."'>";
               $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
            $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
          $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
            if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
              $dropbox_save="";
              $displayimage ="";
              $displayimage = "<img src='http://".$host."/icon-gif.jpg'  width='60' height='80'>".
              $displayimage = $displayimage. "<br>Sorry, Needs Password to open this GIF File ";
              $displayimage = $displayimage. "<div class='form-group'>";
              $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
              <p><input type='password' name='revealpassword'>
              <input type='hidden' name='idmessages' value='".$msgid."'>
              <input type='hidden' name='mode' value='revealfile'>
              <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
              $displayimage = $displayimage. "</form>";
              $displayimage = $displayimage. "</div>";
            }

          }

          if ($checkattachment=="swf") {
            $displayimage = "";
            $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='http://".$host."/icon-swf.jpg'  width='60' height='80'></a>";
            $displayimage = $displayimage. "<p><a target='_new' href='http://".$host."/".$fileattachment."'>Download document SWF file here</a>";
            $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
            $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
            if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                 $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/icon-swf.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this SWF File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
          }
          if ($checkattachment=="ppt") {
              $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='icon-ppt.jpg'  width='60' height='80'></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='".$fileattachment."'>Download document PPT file here</a>";
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
              $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/icon-ppt.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this PPT File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
            }

          if ($checkattachment=="txt") {
              $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='http://".$host."/icon-txt.png'  width='60' height='80'></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='http://".$host."/".$fileattachment."'>Download document TXT file here</a>";
              //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
            $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
            $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
            if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/icon-txt.png'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this TXT File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
          }
          if ($checkattachment=="pdf") {
              $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='http://".$host."/images-pdf-document.jpg'  width='60' height='80'></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='http://".$host."/".$fileattachment."'>Download document PDF file here</a>";
              //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
              $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/images-pdf-document.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this PDF File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
          }
          if ($checkattachment=="xls") {
              $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='http://".$host."/images-xls-document.jpg' width='70' height='100' ></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='http://".$host."/".$fileattachment."'>Download document XLS file here</a>";
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
              $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";

              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/images-xls-document.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this XLS File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
          }

          if ($checkattachment=="zip") {

              $displayimage = "<a target='_new' href='http://".$host."/".$fileattachment."'><img src='http://".$host."/icon-zip.png'  width='60' height='80'></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='http://".$host."/".$fileattachment."'>Download document ZIP file here</a>";
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
                 $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
              $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/icon-zip.png'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this ZIP File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
          }
          if ($checkattachment=="doc") {
              $displayimage = "<a target='_new' href='".$fileattachment."'><img src='images-doc-document.jpg'  width='60' height='80'></a>";
              $displayimage=$displayimage. "<p><a target='_new' href='".$fileattachment."'>Download document DOC file here</a>";
              $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
              $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
             $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
              if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/images-doc-document.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this DOC File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>
                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
                //$displayimage=$displayimage. "<p>Variabel bolehbukafile = ".$bolehbukafile;
              }
              }
          if ($checkattachment=="mp4" || $checkattachment=="mp3") {
            if ($checkattachment=="mp4") {
              $boxw="320";
              $boxh="240";
              $typeplayer="audio/mp3";
            }
            else {
              $boxw="320";
              $boxh="60";

              $typeplayer="video/mp4";

            }

            $displayimage = "<video width=\"$boxw\" height=\"$boxh\" controls>";
            $displayimage=$displayimage. "<source src=\"http://".$host."/$fileattachment\" type=\"$typeplayer\">";
            $displayimage=$displayimage. "Your browser does not support the video tag";
            $displayimage=$displayimage. "</video>";
            $displayimage=$displayimage. "<p><br><a target='_new' href='http://".$host."/$fileattachment'>Download this audio/video here</a></p>";
            $dropbox_save = "<script type='text/javascript' src='https://www.dropbox.com/static/api/2/dropins.js' id='dropboxjs' data-app-key='k98k2vmr46h14q4'></script>";
            $dropbox_save = $dropbox_save. "<p>&nbsp;</p><a href='http://".$host."/".$fileattachment."' class='dropbox-saver'></a>";
            $dropbox_save = $dropbox_save. "<a href='https://db.tt/nGZfRdiC' target='_new'><img width='20' height='20' src='http://".$host."/icon-dropbox.jpg'><small>Create Account at DropBox</small></a>";
            if (($passprotected!="" && $mode !="revealfile") || ($passprotected!="" && $bolehbukafile==0)) {
                 $dropbox_save="";
                $displayimage ="";
                $displayimage = "<img src='http://".$host."/icon-audiovideo.jpg'  width='60' height='80'>".
                $displayimage = $displayimage. "<br>Sorry, Needs Password to open this Audio/Video File ";
                $displayimage = $displayimage. "<div class='form-group'>";
                $displayimage = $displayimage. "<form  method='post' action='' class='form-horizontal'>                <p><input type='password' name='revealpassword'>
                <input type='hidden' name='idmessages' value='".$msgid."'>
                <input type='hidden' name='mode' value='revealfile'>
                <p><button type='submit' class='btn btn-primary'>Entry password to open File</button></p>";
                $displayimage = $displayimage. "</form>";
                $displayimage = $displayimage. "</div>";
            }
          }

          $sepuluhkatapertama = get_snippet($contentmsg,6);
          $sepuluhkatapertama=  clear_variable_post_get($sepuluhkatapertama);
          $sepuluhkatapertama = str_replace(" ", "_", $sepuluhkatapertama);
      ?>

    <a name="msgid<? echo $msgid ?>"></a>
      <div class="panel panel-info">
            <div class="panel-heading">
            <h2 class="panel-title"><? echo $contentmsg ?></h2>
            </div>
          <div class="panel-body">
          <?
          if ($displayimage!="") {
            echo $displayimage;
            echo $dropbox_save;
          }    ?>

           <br><small>URL Link: <a href="http://<? echo $host ?>/viewkron/<? echo $msgid ?>/<? echo $sepuluhkatapertama ?>">http://<? echo $host ?>/viewkron/<? echo $msgid ?>/<? echo $sepuluhkatapertama ?></a></small>
          <br><small>MessagesID:<? echo $msgid ?></small>
          <br><small>posted on <? echo $zonawaktujakarta ?> (Based on GMT +7)</small>
          <br><small><? echo $keteranganwaktu ?></small>
          <p>
          <?
          include("comment.php");
          ?>
          <br>
                  </div>
          </div>
      <?
      }
     // echo "<h1>variabel RT = ".$rt;

      if ($rt==0) {
      ?>
             <div class="panel panel-danger">
            <div class="panel-heading">
            <h2 class="panel-title">Ooooppsss...Sorry..</h2>
            </div>
          <div class="panel-body">
          You Can't View this Messages due to reason
          <br>1. You are out of reach (not in within area where this messages comes from)
          <br>2. Content has been deleted
                  </div>
          </div>
      <?
      }
?>
    </div>
</div>
<?
  function get_snippet( $str, $wordCount = 10 ) {
  return implode(
    '',
    array_slice(
      preg_split(
        '/([\s,\.;\?\!]+)/',
        $str,
        $wordCount*2+1,
        PREG_SPLIT_DELIM_CAPTURE
      ),
      0,
      $wordCount*2-1
    )
  );
}

?>