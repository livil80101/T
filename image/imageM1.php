<?php

$l1 = "你的影子看起來好瘦!";
$l2 = "你的臉好像沒那麼水腫?";
$l3 = "好想跟你立刻喝咖啡聊是非!!!";

$Symbol = '。';

$t_x = 300;
$t_y = 500 - 100;



$im = imagecreate(900, 500);
$black = ImageColorAllocate($im, 0, 0, 0);

$white = ImageColorAllocate($im, 255, 255, 255);

ImageTTFText($im, 30, 0, $t_x, $t_y - 180, $white, "AdobeFanHeitiStd-Bold.otf", $Symbol . $l1);
ImageTTFText($im, 30, 0, $t_x, $t_y - 90, $white, "AdobeFanHeitiStd-Bold.otf", $Symbol . $l2);
ImageTTFText($im, 30, 0, $t_x, $t_y, $white, "AdobeFanHeitiStd-Bold.otf", $Symbol . $l3);



Header("Content-type: image/gif");
ImageGif($im);
ImageDestroy($im);


//AdobeFanHeitiStd-Bold.otf