<?php

define("LEFT", 1);
define("CENTER", 2);
define("RIGHT", 3);
error_reporting(E_ALL);

$image_src = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if (strpos($_POST['img'],'://')>0){
    $blah = parse_url($_POST['img']);
    $_POST['img'] = $blah['path'];
  }

  $draw = new ImagickDraw();
  $draw->setFont('tnr.ttf');
  $draw->setTextAlignment(CENTER);
  $draw->setFontSize((int)$_POST['fs']);

  $image = new Imagick();
  $image->newImage(315, 420, new ImagickPixel('white'));
  $image->setImageFormat('jpg');

  $src = substr($_POST['img'], 1);


  $picture = new Imagick($src);

  if ($_POST['new_w'] && $_POST['new_h']) {
    $picture->resizeImage($_POST['new_w'],$_POST['new_h'], Imagick::FILTER_LANCZOS, 0.9);
  }
  

  $picture->cropImage($_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']);

  $image->compositeImage( $picture, Imagick::COMPOSITE_DEFAULT, $_POST['px'], $_POST['py'] );


  // накладываем виньетку
  if ($_POST['vin'])
  {
    if (file_exists($_POST['vin']))
    {
      $vin = new Imagick($_POST['vin']);
      $image->compositeImage( $vin, Imagick::COMPOSITE_DEFAULT, 0, 0 );
  
      $image->annotateImage($draw, $_POST['tx']-2, $_POST['ty']+18, 0, $_POST['text']);
      $image_src = 'files/result/'.time().'.jpg';
      $image->writeImage($image_src);

      header('Content-type: application/json');
      echo( json_encode(
                        array(  
                                'success'=>1,
                                'result'=>$image_src)
                              )
                        );
      die;

    }
    else
    {
      header('Content-type: application/json');
      echo( json_encode(array('error'=>'Не найден файл виньетки (file path:'.substr($_POST['vin'],1).')')));
      die;
    }
  }
} else {
  echo 'empty data';
}
?>