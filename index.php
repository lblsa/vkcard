<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Фотовиньетки</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="marchukilya@gmail.com">
  <!-- Le styles -->
  <?php if($_SERVER['HTTP_HOST']!='vkcard.il'){ ?>
  <script src="http://vk.com/js/api/xd_connection.js?2" type="text/javascript"></script>
  <?php } ?>
  <link href="/vkcard/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vkcard/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="/vkcard/css/jquery.Jcrop.css" rel="stylesheet" />
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body id="body">
<h1><a href="/">Стартовая - Фотовиньетки</a></h1>
<ul class="nav nav-tabs" id="myTab">
  <li><a href="#feb14">14 февраля</a></li>
  <li><a href="#feb23">23 февраля</a></li>
  <li class="hide"><a href="#mar8">8 марта</a></li>
</ul>
<form action="/crop.php" method="post" onsubmit="return checkCoords();">
<div class="tab-content">
  <div class="tab-pane" id="feb14">
    <h2>Открытки к 14 февраля</h2>
    <div class="row-fluid">
      <div class="span6">
        <div class="media hide" id="user">
          <a class="pull-left" class="user_link" target="_blank" href="#">
            <img class="media-object" src="" />
          </a>
          <div class="media-body">
            <h4 class="media-heading"></h4>
          </div>
        </div>
        <div class="dropdown">
          <a class="dropdown-toggle btn-link btn-block" id="dLabel" target="_blank" role="button" data-toggle="dropdown" href="#">
            <span>Выберите друга</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu" id="vk_auth" role="menu" aria-labelledby="dLabel"></ul>
        </div>
        <div class="row-fluid" id="pre_result">
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
          <input type="submit" class="btn btn-block" id="crop" value="Сделать виньетку" />
        </div>

        <div class="row" style="display:none;" id="result">
          <div class="span6">

            <img src="" border="0" id="result_image" />
            <div class="btn-group">
              <a href="#" class="btn" id="back">Назад</a>
              <a href="#" class="btn" id="post_to_wall">Отправить на стену другу</a>
            </div>
            <br>
            <a href="#" class="btn btn-link hide" id="link_to_wall" target="_blank"></a>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                Загрузить фото
              </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
              <div class="accordion-inner">
                <p><img src="" alt="" id="cropbox" /></p>
                <p class="upload_block">
                  <span class="btn btn-link btn-block drop" id="dropzone">Перетащите файл сюда или выберите с диска</span>
                  <small>Загрузите ваше фото, размером менее 1Mb</small>
                </p>
                <div class="fix_block">
                    <div id="progress" class="progress progress-striped hide">
                        <div class="bar" style="width: 0%;"></div>
                    </div>
                </div>
                <input id="fileupload" type="file" class="hidden" name="files[]" data-url="/upload.php" />
                <span id="upload_inf"></span>
                <div id="upload_alert"></div>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Виньетки
              </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
              <div class="accordion-inner">
                <table class="table"><tr>
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
                </tr></table>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                Текст на открытку
              </a>
            </div>
            <div id="collapseThree" class="accordion-body in collapse" style="height: auto;">
              <div class="accordion-inner">
                <label class="form-inline">Шрифт:
                  <select name="fontsize" class="fontsize" id="fs">
                    <option value="8">8px</option>
                    <option value="9">9px</option>
                    <option value="10">10px</option>
                    <option value="11">11px</option>
                    <option value="12">12px</option>
                    <option value="13">13px</option>
                    <option selected value="14">14px</option>
                    <option value="15">15px</option>
                    <option value="16">16px</option>
                    <option value="17">17px</option>
                    <option value="18">18px</option>
                    <option value="19">19px</option>
                    <option value="20">20px</option>
                    <option value="21">21px</option>
                    <option value="22">22px</option>
                    <option value="23">23px</option>
                    <option value="24">24px</option>
                    <option value="25">25px</option>
                    <option value="26">26px</option>
                    <option value="27">27px</option>
                    <option value="28">28px</option>
                  </select>
                </label>
                <textarea id="text" placeholder="Ваш текст" name="text"></textarea>
                <div class="row-fluid">
                <button type="button" class="btn btn-small">Очистить</button>
                <button type="button" class="btn btn-small" data-fontsize="12" data-toggle="popover" data-original-title="Жена поздравляет мужа" data-fontsize="10" data-content="                              Ты помнишь?
А помнишь, как мы первый раз поцеловались?
А как часами болтали по телефону… 
как я учила тебя кататься на коньках… 
а ты меня играть в футбол… 
К чему это я? ― С  нем влюбленных, дорогой!">Мужу</button>
          <button type="button" class="btn btn-small" data-toggle="popover" data-original-title="Универсальное (для женщин)" data-fontsize="11" data-content="                             Береги меня
Я та, с кем ты становишься собой. 
Я та, кого тебе не обмануть. 
Я та, для кого ты лучший на всем белом свете. 
Я та, для которой ты ― единственный.
                                                                 Любовь">Универсальное</button>
          <button type="button" class="btn btn-small" data-fontsize="12" data-toggle="popover" data-original-title="Для смелых девушек (как повод сделать первый шаг)" data-content="                              Я есть
Если ты один в этот день ― не грусти. 
Это не значит, что тебя никто не выбрал. 
Это значит, что ты не подпускаешь к себе тех, 
кто тебе не нужен.
                                                        Единственная">Для смелых девушек</button>
          <button type="button" class="btn btn-small" data-content="                   Люби меня по расчету
В этот праздничный день я прошу тебя 
об одном: не люби меня просто так.
Я ведь не козел
                                  Самый лучший человек" data-fontsize="13" data-toggle="popover" data-original-title="Провокационное (для мужчин)">Провокационное</button>
          <button type="button" class="btn btn-small" data-placement="left" data-content="                  Моей королеве
Сегодня я у твоих ног, любимая. 
Впрочем, как всегда.
                                         Верный паж" data-fontsize="14" data-toggle="popover" data-original-title="Только для настоящих мужчин">Для настоящих мужчин</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="feb23">
    <h2>Открытки к 23 февраля</h2>
    <div class="row-fluid">
      <div class="span6">
        123
      </div>
      <div class="span6">
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Collapsible Group Item #1
              </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
              <div class="accordion-inner">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                Collapsible Group Item #2
              </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
              <div class="accordion-inner">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                Collapsible Group Item #3
              </a>
            </div>
            <div id="collapseThree" class="accordion-body in collapse" style="height: auto;">
              <div class="accordion-inner">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="mar8">
    <h2>Открытки к 8 марта</h2>
  </div>
</div>
</form>
    <script type="text/javascript" src="/vkcard/js/widgets.js"></script>
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