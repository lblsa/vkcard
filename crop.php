<?php
$image_src = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if (strpos($_POST['img'],'://')>0){
    $blah = parse_url($_POST['img']);
    $_POST['img'] = $blah['path'];
  }

  $draw = new ImagickDraw();
  $draw->setFont('tnr.ttf');
  $draw->setFontSize(20);

  $image = new Imagick();
  $image->newImage(315, 420, new ImagickPixel('white'));
  $image->setImageFormat('jpg');

  $src = substr($_POST['img'], 1);
  $picture = new Imagick($src);
  $picture->cropImage($_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']);

  $image->compositeImage( $picture, Imagick::COMPOSITE_DEFAULT, $_POST['px'], $_POST['py'] );


  // накладываем виньетку
  if ($_POST['vin'])
  {
    $vin = new Imagick('vignette/14_'.$_POST['vin'].'.png');
    $image->compositeImage( $vin, Imagick::COMPOSITE_DEFAULT, 0, 0 );
  }

  $image->annotateImage($draw, $_POST['tx']-2, $_POST['ty']+18, 0, $_POST['text']);
  $image_src = 'files/result/'.time().'.jpg';
  $image->writeImage($image_src);

  echo $image_src;
  die;

} else {
  echo 'empty data'
}
?>