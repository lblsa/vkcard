<?php

/* Создаём объект imagickdraw */
$draw = new ImagickDraw();

/* Устанавливаем размер шрифта в 52 */
$draw->setFontSize(14);

/* Добавляем свой текст */
$draw->annotation(20, 50, "Hello World!");

/* Создаём новый объект холста и белое изображение */
$canvas = new Imagick();
$canvas->newImage(350, 70, "white");

/* Рисуем ImagickDraw на холсте */
$canvas->drawImage($draw);

/* Устанавливаем формат PNG */
$canvas->setImageFormat('png');

/* устанавливаем чёрную рамку шириной 1px вокруг изображения */
$canvas->borderImage('black', 1, 1);


/* Вывод изображения */
header("Content-Type: image/png");
echo $canvas;

die;
?>