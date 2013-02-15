<?php

/* Создаём объект imagickdraw */
$draw = new ImagickDraw();

/* Устанавливаем размер шрифта в 52 */


$draw->setFont('tnr.ttf');
$draw->setFontSize(80);

/* Добавляем свой текст */
$draw->annotation(20, 50, "Hello World!");

/* Создаём новый объект холста и белое изображение */
$canvas = new Imagick();
$canvas->newImage(350, 70, "white");

/* Рисуем ImagickDraw на холсте */
$canvas->drawImage($draw);

/* Устанавливаем формат PNG */
$canvas->setImageFormat('jpg');

/* устанавливаем чёрную рамку шириной 1px вокруг изображения */
$canvas->borderImage('black', 1, 1);


/* Вывод изображения */
header("Content-Type: image/jpg");
echo $canvas;

die;
?>