<?php

$arr_l = array();


$type = 'jpeg';

header("Content-type: image/" . $type);

//$im_src_path = "BG01.jpg";
$im_src_path = "bg00.png";
$srcType=  explode('.', $im_src_path)[1];

$w = 1200;
$h = 630;

//--------------------------------------------------------------------------------------
function Str_cut($str) {
    global $arr_l;

    $str_limit = 11;

    $len = mb_strlen($str);
    if ($len < $str_limit + 1) {

        array_push($arr_l, '‧' . $str);
    } else {

        $substr = mb_substr($str, 0, $str_limit, 'utf8');
        array_push($arr_l, '‧' . $substr);

        $substr = mb_substr($str, $str_limit, $len - $str_limit, 'utf8');
        array_push($arr_l, '　' . $substr);
    }
}

//--------------------------------------------------------------------------------------
//字數超過11進行自動換行，字體大小再縮小X
$l1 = "無駄無駄無駄無駄無駄";
$l2 = "你麼水腫";
$l3 = "好想跟你立刻喝咖啡聊是非";

Str_cut($l1);
Str_cut($l2);
Str_cut($l3);

$Symbol = '';

$arr_size = count($arr_l);

$str_start_x = 0.30;
$str_start_y = 0.42;    //文字Y
$str_sp = 0.18 - ($arr_size * 0.01);
//$str_sp = 0.16;
//字型
//$font = "AdobeFanHeitiStd-Bold.otf";
$font = "A.TTC";

//bg00.png
//得到原始图片信息
//$im_src = imagecreatefromjpeg($im_src_path);
$im_src = call_user_func('imagecreatefrom' . $srcType, $im_src_path);

$dst_info = getimagesize($im_src_path);

$o_w = imagesx($im_src);
$o_h = imagesy($im_src);

//這是打浮水印用的
//$im_new = imagecreatetruecolor($w, $h);
//imagecopyresized($im_new, $im_src, 0, 0, 0, 0, $o_w, $o_h, $w, $h);
//加入文字
$white = ImageColorAllocate($im_src, 0, 0, 0);



foreach ($arr_l as $key => $s) {
    ImageTTFText($im_src, $o_w * (0.045 - ($arr_size * 0.001)), 0, $o_w * $str_start_x, ( $h * ($str_start_y + ($key * $str_sp))), $white, $font, $Symbol . $s);
}

//ImageTTFText($im_src, $o_w * 0.04, 0, $o_w * $str_start_x, ( $h * $str_start_y), $white, $font, $Symbol . $l1);
//ImageTTFText($im_src, $o_w * 0.04, 0, $o_w * $str_start_x, ( $h * ($str_start_y + 0.15)), $white, $font, $Symbol . $l2);
//ImageTTFText($im_src, $o_w * 0.04, 0, $o_w * $str_start_x, ( $h * ($str_start_y + 0.3)), $white, $font, $Symbol . $l3);

call_user_func('image' . $type, $im_src);

imagedestroy($im_src);
