<?php ?>
<html>
    <head>
        <link href="css/c1.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

        <script>
            var token = 'CAAF3ZBpHSQFwBAHJ3e4NdPZBhOp0Yaj0smfsDgRtFT6PoObaYgNbMmIeYPmJqZCJJZBhIQZCZBWOKZBf5Je8umrWTuHfi3lCwuesHzpeqOkIrvFvZBBjp5KUiEXU3PgTboNHEa0Xx0Ir8PMHqZBtAqk9ZC3NPGzZCsh0ixYDJ8M5i4Xlu47mgRbVg2v3ZC8UGslp7ZAZAWspblMW3XGNBLzmvmv3im';

            var parent_l = 0;
            var parent_t = 0;

            $(document).ready(function () {
                reSetView();
                reSetMouseEvent();

                parent_l = $('#show').offset().left;
                parent_t = $('#show').offset().top;

                $('#make').click(function () {
                    $('#output').html('');


                    $('.view').each(function () {
                        var d_type = $(this).attr('d-type');
//            console.log(d_type);
                        switch (d_type) {
                            case 'P':
                                makeImage(this);
                                break;
                            case 'W':
                                makeWordImage(this);
                                break;
                            case 'FB_N':

                                break;
                            case 'FB_P':
                                makeFB_P(this);
                                break;
                        }

//            makeImage(this);

                    });


                });
            });
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
        </style>
    </head>
    <body>
        <div class="imageMake">
            <div id="show">
                <!--                <div class="view" im="../image/BG01.jpeg" style="top: 70px; height: 500px; width: 400px;" d-type='P'></div>
                                <div class="view" im="../image/BG.jpeg" style="top: 20px; left: 30px; height: 500px; width: 400px;" d-type='P'></div>-->
                <div class="view view_fp" d-type='FB_P' d-fid="100002081915136"></div>
                <div class="view" im="../image/DD.png" style="top: 20px; left: 300px; height: 500px; width: 400px;" d-type='P'></div>
                <div class="view view_w" d-type='W' content="我想對你說"></div>
                <div class="view view_fn" d-type='FB_N' d-display="對象名字" d-fid="100002081915136"></div>

            </div>
            <div id="controller" style="">
                <div>
                    <input type="text">
                    <select name="sel">
                        <option value="P" selected>圖片</option>
                        <option value="W">文字</option>
                        <option value="FB_N">對象名字</option>
                        <option value="FB_P">對象照片</option>
                    </select>
                    <button>加入</button>
                </div>
                <button id="make">MAKE</button>
                <hr>
                <div id="output">

                </div>

            </div>
        </div>


    </body>
</html>