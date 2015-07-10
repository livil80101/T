<?php ?>
<html>
    <head>
        <link href="css/c1.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <style>
            .imageMake{

                position: absolute;
            }
            #controller{
                position: absolute;
                top: 600px;
                width:900px;
            }
            #show{
                z-index: 1;
                background-color: red; 
                height: 600px;
                width: 800px;
                overflow: hidden;
                position: absolute;
            }
            .view{
                /*    background-image:  url(../../image/BG01.jpeg);*/
                background-repeat: no-repeat;
                position: absolute;
                top: 9px;
                left: 11px;
                height: 600px;
                width: 800px;
                background-color: transparent;

                white-space: nowrap;

            }
            .view_fn{
                font-size:99px;;
                height: auto; 
                width:auto;
                background-color: rgba(125,125,125,0.5);
            }
            .view_fn:after{
                content: attr(d-display);
            }
            .view_w{
                font-size:72px;;
                height: auto; 
                width:auto;
                background-color: rgba(125,125,125,0.5);
            }
            .view_w:after{
                content: attr(content);
            }
            .view_fp{
                height: 300px;
                width: 300px;
            }
            .view_fp:after{

            }
            #controller table{
                border-style: none;
            }
            #controller table thead{
                background-color: aqua;
            }
        </style>
        <script>
            var token = 'CAAF3ZBpHSQFwBAHJ3e4NdPZBhOp0Yaj0smfsDgRtFT6PoObaYgNbMmIeYPmJqZCJJZBhIQZCZBWOKZBf5Je8umrWTuHfi3lCwuesHzpeqOkIrvFvZBBjp5KUiEXU3PgTboNHEa0Xx0Ir8PMHqZBtAqk9ZC3NPGzZCsh0ixYDJ8M5i4Xlu47mgRbVg2v3ZC8UGslp7ZAZAWspblMW3XGNBLzmvmv3im';

            var parent_l = 0;
            var parent_t = 0;

            $(document).ready(function () {
//    reSetView();
                reSetView_control();
                reSetMouseEvent();

                parent_l = $('#show').offset().left;
                parent_t = $('#show').offset().top;

                $('#view_add').click(function () {

                    if ($('.c_view').length <= 6 && $('#addNewPic input').val().length > 0) {
                        var s_type = $('#addNewPic select').val();
                        var s_text = $('#addNewPic select :selected').text();

                        var n_tr = document.createElement('tr');
                        n_tr.id = 'cv_' + ($('.c_view').length + 1);
                        $(n_tr).addClass('c_view');


                        var n_td1 = document.createElement('td');
                        $(n_td1).html($('.c_view').length + 1);

                        var n_td2 = document.createElement('td');
                        $(n_td2).addClass('d_type');
                        $(n_td2).attr('d-type', s_type);
                        $(n_td2).html(s_text);

                        var n_td3 = document.createElement('td');
                        $(n_td3).addClass('content');
                        var t3i = document.createElement('input');
                        $(t3i).attr('disabled', true);
                        $(t3i).val($('#addNewPic input').val());
                        //歸零動作
                        $('#addNewPic input').val('');

                        $(n_td3).append(t3i);

                        var n_td4 = document.createElement('td');
                        var t4b = document.createElement('button');
                        $(t4b).addClass('btn_up');
                        $(t4b).html('上移');
                        $(n_td4).append(t4b);

                        var n_td5 = document.createElement('td');
                        var t5b = document.createElement('button');
                        $(t5b).addClass('btn_down');
                        $(t5b).html('下移');
                        $(n_td5).append(t5b);

                        var n_td6 = document.createElement('td');
                        var t6b = document.createElement('button');
                        $(t6b).addClass('btn_del');
                        $(t6b).html('刪除');
                        $(n_td6).append(t6b);

                        $(n_tr).append(n_td1);
                        $(n_tr).append(n_td2);
                        $(n_tr).append(n_td3);
                        $(n_tr).append(n_td4);
                        $(n_tr).append(n_td5);
                        $(n_tr).append(n_td6);



                        console.log();


                        $('#controller div table tbody').append(n_tr);

                        reSetView_control();
                        reSetMouseEvent();


                    } else {
                        alert('');
                    }


                });

                $('#make').click(function () {
                    $('#output').html('');

                    var myString = createJson();
                    console.log(myString);

                    Json2Image(myString);
//        var myObject = new Object();
//        myObject.name = "John";
//        myObject.age = 12;
//        myObject.pets = {A: "cat", B: "dog"};
//
//        var myString = JSON.stringify(myObject);
//
//        console.log(myString);
                });
                //-------------------------------------------


            });

            function createJson() {
                var c_Canvas = new Object();

                c_Canvas.width = 800;
                c_Canvas.height = 600;
                c_Canvas.picList = [];
//    c_Canvas.picList.push({a: 10});
                $('.c_view').each(function () {
                    var _c_v = $(this);
                    var _id = _c_v.attr('id');
//        console.log(_id);

                    var cv_zindex = _c_v.find('.zIndex').html();
                    var cv_DType = _c_v.find('.d_type').attr('d-type');
                    var cv_con = _c_v.find('.content input').val();
                    var v_x = _c_v.attr('v_x');
                    var v_y = _c_v.attr('v_y');

                    var v_w = $('.view[for="' + _id + '"]').width();
                    var v_h = $('.view[for="' + _id + '"]').height();



                    c_Canvas.picList.push(
                            {
                                cv_zindex: cv_zindex,
                                cv_DType: cv_DType,
                                cv_con: cv_con,
                                v_x: v_x, v_y: v_y,
                                v_w: v_w, v_h: v_h,
                                font_size: 72
                            }
                    );
                });

                return JSON.stringify(c_Canvas);

            }
            function Json2Image(src) {
                var json = JSON.parse(src);

                //生成畫布
                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');

                var arr_base64 = [];

                c.height = json.height;
                c.width = json.width;

// console.log(json.picList);

                $.each(json.picList, function (k, v) {
//        ctx.clearRect(0, 0, json.width, json.height);
//        var c = document.createElement('canvas');
//        var ctx = c.getContext('2d');

                    var d_type = v.cv_DType;

                    switch (d_type) {
                        case 'P':

                            var img_src = v.cv_con;
                            var x = v.v_x,
                                    y = v.v_y;
                            var w = v.v_w,
                                    h = v.v_h;

                            var img = new Image();
//                img.crossOrigin = '*';
                            img.src = img_src;

                            ctx.drawImage(img, 0, 0, w, h, x, y, w, h);

//                var src_base64 = c.toDataURL("image/png");


//                var n_img = document.createElement('img');
//                n_img.src = src_base64;
//                $('body').append(n_img);
//
//                arr_base64.push(src_base64);
//
//                img = null;
                            console.log("v.cv_con:" + v.cv_con + "  x:" + v.v_x + " y:" + v.v_y);
                            break;
                        case 'W':

                            var x = v.v_x,
                                    y = v.v_y;
                            var w = v.v_w,
                                    h = v.v_h;
                            var w_y = Number(y) + Number(h);

                            ctx.font = v.font_size + "px 新細明體";
                            ctx.fillText(v.cv_con, x, w_y);
//                ctx.fillText(v.cv_con, x, 250);

//                console.log("v.cv_con:" + v.cv_con + "  x:" + v.v_x + " y:" + v.v_y + " w:" + v.v_w + " h:" + v.v_h);
//                console.log("v.cv_con:" + w_y);
                            break;
                        case 'FB_N':

                            break;
                        case 'FB_P':

                            var Fid = v.cv_con;
                            var x = v.v_x,
                                    y = v.v_y;
                            var w = v.v_w,
                                    h = v.v_h;
                            var FB_pic = 'http://graph.facebook.com/' + Fid + '/picture?width=' + w + '&height=' + h;
//
                            var img = new Image();
                            img.crossOrigin = '*';
//                
                            img.onload = function () {
                                ctx.drawImage(img, x, y);
//
//                    var src_base64 = c.toDataURL("image/png");
//                    var n_img = document.createElement('img');
//                    n_img.src = src_base64;
//
//
//                    $('#output').append(n_img);
                            };
//                
//                img.src = FB_pic;

                            console.log("v.cv_con:" + v.cv_con + "  x:" + v.v_x + " y:" + v.v_y);
                            break;
                    }

                });

                var src_base64 = c.toDataURL("image/png");
                var n_img = document.createElement('img');
                n_img.src = src_base64;
                $('body').append(n_img);

//    console.log(arr_base64);
            }

            function j_cImage() {

            }

            function T_action() {
                var t = document.createElement('div');
                t.innerHTML = "YYYYYYYYYY";

                var body = document.getElementById('show');
                body.appendChild(t);

                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');

                var img = new Image();
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                };
                img.src = '../image/BG01.jpeg';

                body.appendChild(c);
            }
            function makeImage(src) {
                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');

                c.height = 600;
                c.width = 800;

                var img_src = $(src).attr('im');
                var l = $(src).offset().left - parent_l;
                var t = $(src).offset().top - parent_t;
                var w = $(src).width();
                var h = $(src).height();

                var img = new Image();
                img.src = img_src;
                ctx.drawImage(img, 0, 0, w, h, l, t, w, h);
                var src_base64 = c.toDataURL("image/png");
                //輸出base64

//    $('#t').attr('src', src_base64);
                var n_img = document.createElement('img');
                n_img.src = src_base64;


                $('#output').append(n_img);
            }
            function makeWordImage(src) {
                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');

                c.height = 600;
                c.width = 800;

                var w_src = $(src).attr('content');
                var l = $(src).offset().left - parent_l;
                var t = $(src).offset().top - parent_t;
                var w = $(src).width();
                var h = $(src).height();


                ctx.font = "72px 新細明體";
                ctx.fillText(w_src, l, t + h);


                var src_base64 = c.toDataURL("image/png");
                //輸出base64

//    $('#t').attr('src', src_base64);
                var n_img = document.createElement('img');
                n_img.src = src_base64;

                $('#output').append(n_img);
            }

            function makeFB_P(src) {
                var c = document.createElement('canvas');
                var ctx = c.getContext('2d');
                c.height = 600;
                c.width = 800;

                var fid = $(src).attr('d-fid');
                var l = $(src).offset().left - parent_l;
                var t = $(src).offset().top - parent_t;
                var w = $(src).width();
                var h = $(src).height();
                var FB_pic = 'http://graph.facebook.com/' + fid + '/picture?width=' + w + '&height=' + h;

                var img = new Image();
                img.crossOrigin = '*';
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);

                    var src_base64 = c.toDataURL("image/png");
                    var n_img = document.createElement('img');
                    n_img.src = src_base64;


                    $('#output').append(n_img);
                };
                img.src = FB_pic;
            }

            function reSetView() {
//    console.log('rsv');
                $('.view').each(function () {
                    var d_type = $(this).attr('d-type');
//        console.log(d_type);

                    $('.view').each(function () {
                        var d_type = $(this).attr('d-type');
//            console.log(d_type);
                        switch (d_type) {
                            case 'P':
                                var _view = $(this);
                                var im = _view.attr('im');
                                if (im) {
                                    var img = new Image();
                                    var w, h;
                                    img.onload = function () {
                                        w = this.width;
                                        h = this.height;

                                        _view.width(w);
                                        _view.height(h);
                                    };
                                    img.src = im;
                                    _view.css('background-image', 'url(' + im + ')');
                                    img = null;
                                }
                                break;
                            case 'W':

                                break;
                            case 'FB_N':

                                break;
                            case 'FB_P':
                                var _view = $(this);
                                var fid = _view.attr('d-fid');
                                h = _view.height();
                                w = _view.width();

                                if (fid) {
                                    _view.css('background-image', 'url(' + 'http://graph.facebook.com/' + fid + '/picture?width=' + w + '&height=' + h + ')');
                                }

                                img = null;
                                break;
                        }

//            makeImage(this);

                    });



                });
            }
            function reSetView_control() {
                $('#show').html('');

//    var z_i_limit=10;

                $('#controller div table tbody .c_view').each(function () {
                    var _v_c = $(this);

                    var z_i = _v_c.find('.zIndex').html();
                    var d_t = _v_c.find('.d_type').attr('d-type');
                    var v_con = _v_c.find('.content input').val();

//        console.log(v_con);
                    var newDiv = document.createElement('div');
                    var _newDiv = $(newDiv);
                    $(_newDiv).attr('for', $(this).attr("id"));
                    _newDiv.addClass('view');
                    var success = 'A';
                    switch (d_t) {
                        case 'P':

                            var img = new Image();
                            var w, h;
//                img.crossOrigin = '*';
                            img.onload = function () {
                                w = this.width;
                                h = this.height;

//                    console.log(w + " " + h);

                                _newDiv.width(w);
                                _newDiv.height(h);


                            };
                            img.onerror = function () {

                                //讀取錯誤並且刪除對象

                            };
                            img.src = v_con;

                            _newDiv.css('background-image', 'url(' + v_con + ')');

                            img = null;

                            break;
                        case 'W':
                            _newDiv.addClass('view_w')
                            _newDiv.attr('content', v_con);

                            //
                            break;
                        case 'FB_N':

                            break;
                        case 'FB_P':

                            var w = 150, h = 150;
                            _newDiv.width(w);
                            _newDiv.height(h);

                            _newDiv.css('background-image', 'url(' + 'http://graph.facebook.com/' + v_con + '/picture?width=' + w + '&height=' + h + ')');

                            break;
                    }

//        if (success) {
//             console.log(''+success);
                    var forName = '#' + _newDiv.attr('for');
                    var now_x = $(forName).attr('v_x');
                    var now_y = $(forName).attr('v_y');


                    console.log( );

                    _newDiv.css('left', now_x + 'px');
                    _newDiv.css('top', now_y + 'px');


                    $('#show').append(newDiv);
//        }


                });

            }
//-------------------------------------------

            var parent_l = 0;
            var parent_t = 0;

//var _div;

            var drag = {
                elem: null,
                x: 0,
                y: 0,
                state: false
            };
            var delta = {
                x: 0,
                y: 0
            };

            function  reSetMouseEvent() {
//    console.log('rsme');
                parent_l = $('#show').offset().left;
                parent_t = $('#show').offset().top;

                var _div = $('.view');

                _div.mousedown(function (e) {
                    if (!drag.state) {
                        drag.elem = this;
//            this.style.backgroundColor = '#f00';
                        drag.x = e.pageX;
                        drag.y = e.pageY;
                        drag.state = true;
                    }
                    return false;
                });
                $(document).mousemove(function (e) {
                    if (drag.state) {
//            drag.elem.style.backgroundColor = '#f0f';

                        delta.x = e.pageX - drag.x;
                        delta.y = e.pageY - drag.y;

                        var cur_of = $(drag.elem).offset();

                        $(drag.elem).offset({
                            left: (cur_of.left + delta.x),
                            top: (cur_of.top + delta.y)
                        });

                        var for_cv = $(drag.elem).attr('for');

                        $('#' + for_cv).attr("v_x", cur_of.left + delta.x - parent_l);
                        $('#' + for_cv).attr("v_y", cur_of.top + delta.y - parent_t);

                        drag.x = e.pageX;
                        drag.y = e.pageY;

                    }
                });

                $(document).mouseup(function () {
                    if (drag.state) {
//            drag.elem.style.backgroundColor = '#808';
                        drag.state = false;
                    }
                });
            }

        </script>
    </head>
    <body>
        <div class="imageMake">
            <div id="show">
                <div class="view view_fp" d-type='FB_P' d-fid="100002081915136" style=""></div>
                <div class="view" im="../image/DD.png" style="top: 20px; left: 300px; height: 500px; width: 400px;" d-type='P'></div>
                <div class="view view_w" d-type='W' content="我想對你說"></div>
                <!--<div class="view view_fn" d-type='FB_N' d-display="對象名字" d-fid="100002081915136"></div>-->

            </div>
            <div id="controller" style="">
                <div>
                    <table border="0">
                        <thead>
                        <td>圖層</td>
                        <td>類型</td>
                        <td colspan="4">內容</td>

                        </thead>
                        <tbody>

                            <tr class="c_view" id="cv_1" v_x="0" v_y="0" >
                                <td class="zIndex">1</td>
                                <td class="d_type" d-type='FB_P'>對象照片</td>
                                <td class="content"><input disabled value="100002081915136"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>
                            <tr class="c_view" id="cv_2"  v_x="0" v_y="0" >
                                <td class="zIndex">2</td>
                                <td class="d_type" d-type='P'>圖片</td>
                                <td class="content"><input disabled value="../image/D.jpg"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>
                            <tr class="c_view" id="cv_3" v_x="0" v_y="0"  >
                                <td class="zIndex">3</td>
                                <td class="d_type" d-type='W'>文字</td>
                                <td class="content"><input disabled value="我想對你說"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>

                        </tbody>
                    </table>
                    <div id="addNewPic">
                        <select name="sel">
                            <option value="W" selected>文字</option>
                            <option value="P">圖片</option>                            
                            <option value="FB_N">對象名字</option>
                            <option value="FB_P">對象照片</option>
                        </select>                    
                        <input  type="text">
                        <button id="view_add">加入</button>
                    </div>
                </div>
                <button id="make">MAKE</button>
                <hr>
                <div id="output">

                </div>

            </div>
        </div>


    </body>
</html>