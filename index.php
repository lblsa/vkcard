<?php
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


  header('Content-type: image/jpeg');
  echo $image;
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap, from Twitter</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="marchukilya@gmail.com">
  <!-- Le styles -->
  <script src="http://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>
  <link href="/vkcard/css/bootstrap.css" rel="stylesheet">
  <link href="/vkcard/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="/vkcard/css/jquery.Jcrop.css" rel="stylesheet" />
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
<form action="/index.php" method="post" onsubmit="return checkCoords();">
  <table class="main">
    <tr>
      <td class="left_bar">
        <ul class="nav nav-pills">
          <li class="dropdown">
            <a class="dropdown-toggle btn-link" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
              Выберите друга
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" id="vk_auth" role="menu" aria-labelledby="dLabel"></ul>
          </li>
        </ul>

          <div class="row-fluid">
            <div class="span6" style="position:relative;">
              <div class="card">
                <div style="width:0px;height:0px;overflow:hidden;" id="prev_container">
                  <img src="/vkcard/img/samurai.jpg" id="preview" alt="Preview" class="jcrop-preview" />
                </div>
              </div>
              <div class="vin_cont">
                  <img width="100%" src="/vignette/14_1.png">
                  <div id="inner_text"><p></p></div>
              </div>
              <div class="clone"></div>
              <textarea id="text" name="text" style="width: 302px; margin: 10px 0px 10px; height: 72px;"></textarea>
            </div>
          </div>
          <input type="hidden" id="px" name="px" value="1" />
          <input type="hidden" id="py" name="py" value="1" />
          <input type="hidden" id="tx" name="tx" value="36" />
          <input type="hidden" id="ty" name="ty" value="293" />
          <input type="hidden" id="x" name="x" />
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
          <input type="hidden" id="img" name="img" />
          <input type="submit" class="btn" value="Crop Image" />
      </td>
      <td class="right_bar">
        <p> <img src="/vkcard/img/samurai.jpg" alt="" id="cropbox" /> </p>
        <p>
          <button class="btn btn-link drop" id="dropzone">Перетащите файл сюда или выберите с диска</button>
          <p><small>Загрузите ваше фото, размером менее 1Mb</small></p>
          <div class="fix_block">
              <div id="progress" class="progress progress-striped hide">
                  <div class="bar" style="width: 0%;"></div>
              </div>
          </div>
          <input id="fileupload" type="file" class="hidden" name="files[]" data-url="/upload.php" />
          <span id="upload_inf"></span>
          <div id="upload_alert"></div>
        </p>

        <h3>Виньетки</h3>
        <table class="table table-bordered">
          <tr>
            <td>
              <img src="/vignette/14_1.png" alt="">
              <label for=""><input class="vin" type="radio" value="1" checked name="vin" /></label>
            </td>
            <td>
              <img src="/vignette/14_2.png" alt="">
              <label for=""><input class="vin" type="radio" value="2" name="vin" /></label>
            </td>
            <td>
              <img src="/vignette/14_3.png" alt="">
              <label for=""><input class="vin" type="radio" value="3" name="vin" /></label>
            </td>
            <td>
              <img src="/vignette/14_4.png" alt="">
              <label for=""><input class="vin" type="radio" value="4" name="vin" /></label>
            </td>
            <td>
              <img src="/vignette/14_5.png" alt="">
              <label for=""><input class="vin" type="radio" value="5" name="vin" /></label>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
    <script type="text/javascript" src="/vkcard/js/jquery.min.js"></script>
    <script type="text/javascript" src="/vkcard/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/vkcard/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/vkcard/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="/vkcard/js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="/vkcard/js/jquery.Jcrop.js"></script>
    <script type="text/javascript" src="/vkcard/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script type="text/javascript" src="/vkcard/js/main.js"></script>
  </body>
</html>