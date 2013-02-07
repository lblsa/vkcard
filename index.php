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
<body id="body">
<form action="/crop.php" method="post" onsubmit="return checkCoords();">
  <table class="main">
    <tr>
      <td class="left_bar">
          <div class="dropdown">
            <a class="dropdown-toggle btn-link btn-block" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
              <span>Выберите друга</span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" id="vk_auth" role="menu" aria-labelledby="dLabel">
              <li><a>Петр Холявко</a></li>
              <li><a>Василий Вертушинский</a></li>
              <li><a>Виола Петровская</a></li>
            </ul>
          </div>
        </ul>
          <div class="row-fluid">
            <div class="" style="position:relative;">
              <div class="card">
                <div style="width:0px;height:0px;overflow:hidden;" id="prev_container">
                  <img src="" id="preview" alt="Preview" class="jcrop-preview" />
                </div>
              </div>
              <div class="vin_cont">
                  <img width="315" src="/vignette/14_1.png">
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
          <input type="submit" class="btn btn-block" id="crop" value="Go!" />
      </td>
      <td class="right_bar">
        <?php if ($image_src == '') { ?>
        <p> <img src="" alt="" id="cropbox" /> </p>
        <p>
          <span class="btn btn-link btn-block drop" id="dropzone">Перетащите файл сюда или выберите с диска</span>
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
        <table class="table">
          <tr>
            <td>
              <img width="80" src="/vignette/14_1.png" alt="">
              <label for=""><input class="vin" type="radio" value="1" checked name="vin" /></label>
            </td>
            <td>
              <img width="80" src="/vignette/14_2.png" alt="">
              <label for=""><input class="vin" type="radio" value="2" name="vin" /></label>
            </td>
            <td>
              <img width="80" src="/vignette/14_3.png" alt="">
              <label for=""><input class="vin" type="radio" value="3" name="vin" /></label>
            </td>
            <td>
              <img width="80" src="/vignette/14_4.png" alt="">
              <label for=""><input class="vin" type="radio" value="4" name="vin" /></label>
            </td>
            <td>
              <img width="80" src="/vignette/14_5.png" alt="">
              <label for=""><input class="vin" type="radio" value="5" name="vin" /></label>
            </td>
          </tr>
        </table>
        <?php } ?>
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
    <script type="text/javascript" src="/vkcard/js/underscore-min.js"></script>
    <script type="text/javascript" src="/vkcard/js/main.js"></script>
  </body>
</html>