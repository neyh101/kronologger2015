<!DOCTYPE html>
<?
  $judulcontent="Fake News - MetroKini";
  $template="template/ridwan-kamil.png";
  $w_step1= 210;
  $h_step1= 210;
  $w_step2= 555;
  $h_step2= 432;
  $ukuran_text_meoncover=10;
  $titik_x_tulisan=326;
  $titik_y_tulisan=481;
?>
<html lang="en">
<? include("head.php"); ?>

  <body>
  <? include("menuatas.php"); ?>



      <div class="jumbotron">
        <h2><? echo $judulcontent ?></h2>
        <? include("ads2.php"); ?>
<?
include("function.php");
$maximumsize=100000000000000000;
 $maximumsizeinkb=$maximumsize/1000;
$apakahUpload = $_GET['apakahUpload'];
$urlimage = $_GET['urlimage'];
if ($urlimage=="") {
$urlimage = $_POST['urlimage'];
$cek_extension = substr($urlimage, -3);

if ($apakahUpload=="1") {

    $r1=rand(1,9999999);
    $r2=rand(9,88889999999);
    $r3=rand(14,212312322222222);
    $gen_file=md5($r1.$r2.$r3);
		$filename = basename($_FILES['image_url']['name']);
		$besarsize= $_FILES["image_url"]["size"];
 		$besarsizeinkb= $besarsize/1000;
 		$bolupload = "0";

		if ( ($_FILES["image_url"]["type"] == "image/pjpeg" || ($_FILES["image_url"]["type"] == "image/jpeg") ) &&  ($_FILES["image_url"]["size"] < $maximumsize) )
		{
		 	$bolupload = "1";
		}

    if ($cek_extension=="jpg") {
      $bolupload = "1";
    }

  	$target_path = "results/";
		$target_path = $target_path . $filename;

	if(move_uploaded_file($_FILES['image_url']['tmp_name'], $target_path)) {
  	// File and new size
			$filename = $target_path ;
      }
      if ($urlimage !="") {
       $filename = $urlimage;
      }

    	// Get new sizes
			list($width, $height) = getimagesize($filename);

       $dst_x=0;
			$dst_y=0;

      $src_x=0;
			$src_y=0;

			$dst_w =$w_step1;
			$dst_h = $h_step1;

      $src_w=$width;
			$src_h=$height;


			// Load   gambar upload
			$dst_image = imagecreatetruecolor($dst_w, $dst_h);
			$src_image = imagecreatefromjpeg($filename);

      	imagecopyresized($dst_image, $src_image,
      $dst_x, $dst_y,
      $src_x, $src_y,
      $dst_w, $dst_h,
      $src_w, $src_h );

			// Output
			$filestep1 = "temp/".$gen_file."-reSIZE.jpg";

      imagejpeg($dst_image,$filestep1);
      $sumber_images_akan_diolah =  $dst_image;
      $namafile_images_akan_diolah  = $filestep1;

     	list($width, $height) = getimagesize($namafile_images_akan_diolah);

       $dst_x=210; //koordinat x gambar mulai ditempel
			$dst_y=140; //koordinay y

      $src_x=0;
			$src_y=0;

			$dst_w = $w_step2;
			$dst_h = $h_step2;

      $src_w=$w_step2;
			$src_h=$h_step2;
     	$dst_image = imagecreatetruecolor($dst_w, $dst_h);
			$src_image = imagecreatefromjpeg($namafile_images_akan_diolah);
        imagecopyresized($dst_image, $src_image,
      $dst_x, $dst_y,
      $src_x, $src_y,
      $dst_w, $dst_h,
      $src_w, $src_h );

      // Output
			$filestep2 = "temp/".$gen_file."-reSIZE_into_template.jpg";
			imagejpeg($dst_image,$filestep2);

  		$image = imagecreatefromjpeg($filestep2);
	  	$insert = imagecreatefrompng($template);
  		$image = image_overlap_f($image, $insert);
      $filestep3 = "results/".$gen_file."-result-".$magazine.".jpg";

      $text1=$_POST['text1'];
      $text2=$_POST['text2'];

      $text1=strtoupper($text1);
      $text2=strtoupper($text2);

      $size1=10;
      $x1=90;       // $titik_x_tulisan=326;
      $y1=350;       // $titik_y_tulisan=481;
      $x2=20;       // $titik_x_tulisan=326;
      $y2=470;       // $titik_y_tulisan=481;
      $black = imagecolorallocate($image, 150, 178, 195);
      $white = imagecolorallocate($image, 150, 178, 195);
     // $font1 = 'arialbd.ttf';
      $font1 = 'arialbd.ttf';

      //$string="http://MeonCover.com";
      imagettftext($image, $size1, 0, $x1, $y1, $white, $font1, $text1);
     // imagettftext($image, $size1, 0, $x2, $y2, $white, $font1, $text2);


      imagejpeg($image,$filestep3);
      ?>
     <p>Hasil :</p>
    <img src="<? echo $filestep3 ?>">
    <h3>Tekan klik kanan pada gambar dengan mouse, lalu pilih save as untuk menyimpan gambar pada komputer anda !</h3>
      <?

    imageDestroy($dst_image);
    imageDestroy($image);
    imageDestroy($src_image);





   } // tutup bila move_uploaded_files


}  //tuutp if apakahupload=1

//echo "<br>target_path=".$target_path;
if ($target_path!="") {
unlink($target_path);
}


function image_overlap_f($background, $foreground){
//echo "<p>background1 = ".$background;
//echo "<p>foreground1 = ".$foreground;

   $dst_x=0;
   $dst_y=0;
   $src_x=0;
   $src_y=0;
   $src_w = imagesx($foreground);
   $src_h = imagesy($foreground);

imagecopymerge($background,$foreground,
$dst_x,$dst_y,
$src_x,$src_y,
$src_w,$src_h,
100);
 return $background;
  }

?>
      <form enctype="multipart/form-data" action="?apakahUpload=1" method="POST">
        <div class="foto"> <h3>Upload Photo anda :</h3>
          <p>
          <input name="image_url" type="file" />
           <div class="mesg">Maksimum file size 300 kb saja, hanya menerima format gambar JPG saja. Ukuran Foto 480x640</div>
           <p>Atau masukkan url image
           <input type="text" name="urlimage">
          </p>

           <p>Masukkan Text baris pertama
           <input type="text" name="text1" value="Headline baris pertama" maxlength="41" size="41">
          </p>



        </div>
        <div class="in">
      	  <input name="submit" type="submit" value="Generate My Picture !">
          <input type="hidden" name="MAX_FILE_SIZE" value="<? echo $maximumsize ?>" /></p>
        </div>
        </div>
</form>
<? include("ads.php"); ?>
      </div>
    </div>
<? include ("footer.php") ;?>
  </body>
</html>
