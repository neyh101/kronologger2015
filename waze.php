<p>Diwabah ini ada peta WAZE!</p>
<br>Lon : <?  echo $cookies_php_lon ?>
<br>Lat :<?  echo $cookies_php_lat ?>
<?
if ($cookies_php_lat!="" && $cookies_php_lon!="" ) {
?>
<iframe src="https://www.waze.com/livemap/?lon=<?  echo $cookies_php_lon ?>&lat=<? echo $cookies_php_lat ?>&zoom=13" frameborder="0" scrolling="no" width="100%" height="100%"></iframe>
<?

}
?>
  <br>
  </p>
