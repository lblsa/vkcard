<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  
  //var_dump($_POST); die;

  $image = new Imagick();
  $image->newImage(315, 420, new ImagickPixel('white'));
  $image->setImageFormat('jpg');

  $src = substr($_POST['img'], 1);
  $picture = new Imagick($src);
  $picture->cropImage($_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']);

  $image->compositeImage( $picture, Imagick::COMPOSITE_DEFAULT, $_POST['px'], $_POST['py'] );

  if ($_POST['vin'])
  {
    $vin = new Imagick('vignette/14_'.$_POST['vin'].'.png');
    //$vin->thumbnailImage(250, 250);
    $image->compositeImage( $vin, Imagick::COMPOSITE_DEFAULT, 0, 0 );
  }

  header('Content-type: image/jpeg');
  //echo $picture;
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
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/vkcard/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/vkcard/css/jquery.Jcrop.css" type="text/css" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .vin_cont {
        width: 315px;
        height: 420px;
        position: relative;
        margin-top: -420px;
      }
      .card {
        width:315px;
        height: 420px;
        background-color: #ddd;
      }
      .clone {
        position:absolute;
        width:250px;
        height:250px;
        background: rgba(221, 221, 221, 0.2);
        cursor: move;
        top:0px;
        left:0px;
      }
    </style>
    <link href="/vkcard/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">Vk Cards</a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="span6">
          <p> <img src="/vkcard/img/samurai.jpg" alt="" id="cropbox" /> </p>
        </div>
        <div class="span6">
          <h3>Предпросмотр</h3>
          <div class="row-fluid">
            <div class="span8" style="position:relative;">
              <div class="card">
                <div style="width:0px;height:0px;overflow:hidden;" id="prev_container">
                  <img src="/vkcard/img/samurai.jpg" id="preview" alt="Preview" class="jcrop-preview" />
                </div>
              </div>
              <div class="vin_cont hide"></div>
              <div class="clone hide"></div>
            </div>
            <div class="span3">
              <textarea style="width: 190px;"></textarea>
            </div>
          </div>
          <form action="/vkcard.php" method="post" onsubmit="return checkCoords();">
            <input type="hidden" id="px" name="px" value="0" />
            <input type="hidden" id="py" name="py" value="0" />
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="img" name="img" />
            <input type="submit" value="Crop Image" />
          

            <h3>Виньетки</h3>
            <table class="table table-bordered">
              <tr>
                <td>
                  <img src="/vignette/14_1.png" alt="">
                  <label for=""><input class="vin" type="radio" value="1" name="vin" /></label>
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
          </form>
          <p>Наложить виньетку</p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Developed by <a href="http://showdev.ru">showdev.ru</a></p>
      </footer>
    </div>
    <script src="/vkcard/js/jquery.min.js"></script>    
    <script src="/vkcard/js/jquery.Jcrop.js"></script>
    <script src="/vkcard/js/jquery-ui-1.10.0.custom.min.js"></script>
    <script language="Javascript">

      $(function(){

        $('#cropbox').Jcrop({
          onChange: updatePreview,
          onSelect: updatePreview,
          aspectRatio: 1,
        },function(){
          // Use the API to get the real image size
          var bounds = this.getBounds();
          boundx = bounds[0];
          boundy = bounds[1];
          // Store the API in the jcrop_api variable
          jcrop_api = this;
        });

        $('#prev_container, .clone').draggable({
          containment: ".card",
          stop: function( event, ui ) {
            $('#prev_container, .clone').css({left:ui.position.left,top:ui.position.top});
            $('#px').val(ui.position.left);
            $('#py').val(ui.position.top);
          }
        });

        /*$( ".card" ).droppable({          
          accept: "#prev_container",
          activeClass: "ui-state-hover",
          hoverClass: "ui-state-active",
          drop: function( event, ui ) {
            console.log(ui);
          }
        });*/

      });

      function updateCoords(c)
      {
      };

      function checkCoords()
      {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
      };

      function updatePreview(c)
      {
        //updateCoords
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
        $('#img').val( $('#cropbox').attr('src') );


        if (parseInt(c.w) > 0)
        {
          var rx = 250 / c.w;
          var ry = 250 / c.h;

          $('#preview').css({
            //width: Math.round(rx * boundx) + 'px',
            //height: Math.round(ry * boundy) + 'px',
            //marginLeft: '-' + Math.round(rx * c.x) + 'px',
            //marginTop: '-' + Math.round(ry * c.y) + 'px'
            marginLeft: '-' + c.x + 'px',
            marginTop: '-' + c.y + 'px'
          });
          
          $('#prev_container, .clone').css({ width: c.w + 'px', height:  c.h + 'px'});
        }
      };

      $('.vin').click(function(){
        $('.vin_cont').html('<img width="100%"  src="/vignette/14_'+$(this).val()+'.png" />');
        $('.vin_cont').show();
        $('.clone').show();
      });



    </script>
  </body>
</html>