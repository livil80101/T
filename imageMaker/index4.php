<?php ?>
<html>
    <head>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            var parent_l = 0;
            var parent_t = 0;

            $(document).ready(function () {
                reSetView();

                parent_l = $('#show').offset().left;
                parent_t = $('#show').offset().top;

                $('#make').click(function () {
                    $('.view').each(function () {
                        var d_type = $(this).attr('d-type');
                        console.log(d_type);
                        switch (d_type) {
                            case 'P':
                                makeImage(this);
                                break;
                            case 'W':
                                break;
                            case 'FB_N':
                                break;
                            case 'FB_P':
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
                $('body').append(n_img);
            }
            function reSetView() {
                $('.view').each(function () {
                    var im = $(this).attr('im');
                    if (im) {
                        $(this).css('background-image', 'url(' + im + ')');
                    }

                });
            }

        </script>
        <style>
            #show{
                z-index: 0;
                background-color: red; 
                height: 600px;
                width: 800px;
                overflow: hidden;

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
            }

        </style>
    </head>
    <body>
        <div id="show" style="">
            <div class="view" im="../image/BG01.jpeg" style="top: 70px; height: 500px; width: 400px;" d-type='P'></div>
            <div class="view" im="../image/BG.jpeg" style="top: 20px; left: 30px; height: 500px; width: 400px;" d-type='P'></div>
            <div class="view" im="../image/D.jpg" style="top: 20px; left: 300px; height: 500px; width: 400px;" d-type='P'></div>
            <div class="view" d-type='FB_N' ><p>對象名字</p></div>
        </div>
        <div id="controller" style="width: 800px;">

            <input type="text">
            <select name="sel">
                <option value="P" selected>圖片</option>
                <option value="W">文字</option>
                <option value="FB_N">對象名字</option>
                <option value="FB_P">對象照片</option>
            </select>
            <button>刪除</button>
        </div>
        <button id="make">MAKE</button>
        <hr>
        <img id="t" >
    </body>
</html>