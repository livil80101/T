<?php ?>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            //------------------------------------------------------------------
            //      設置，addImage之後要能配合上傳
            //
            //
            //------------------------------------------------------------------
            var arr = new Array();
            function addImage(img_src, x, y, w, h) {
                var a = {};

                a.src = typeof img_src !== 'Undefined' ? img_src : 0;

                a.x = typeof x !== 'undefined' ? x : 0;
                a.y = typeof y !== 'undefined' ? y : 0;
                a.w = typeof w !== 'undefined' ? w : 300;
                a.h = typeof h !== 'undefined' ? h : 150;

                arr.push(a);
            }
            function madeImage(src, x, y, w, h) {
                ctx.drawImage(src, x, y, w, h);
            }
            //---------------------------------------
            var ctx;
            var canvas;
            var img;
            var c_x, c_y, c_w, c_h;
            $(document).ready(function () {

                addImage("../image/BG.jpeg", 10, 10);
                addImage("../image/D.jpg", 200, 20);
                addImage("../image/R.png", 300, 100, 500, 200);

                canvas = document.getElementById("myCanvas");
                ctx = canvas.getContext("2d");

                c_x = $('#myCanvas').offset().left;
                c_y = $('#myCanvas').offset().top;
                c_w = $('#myCanvas').width();
                c_h = $('#myCanvas').height();

                reDraw();
//                for (var i = 0; i < arr.length; i++) {
//                    var img_data = arr[i];
//                    console.log(img_data.src + " " + img_data.x + " " + img_data.y + " " + img_data.w + " " + img_data.h);
//                    var img = new Image();
//                    img.onload = function () {
//                        ctx.drawImage(img, img_data.x, img_data.y, img_data.w, img_data.h);
//                    };
//                    img.src = img_data.src;
//                    console.log(img_data.src);
//                }

                //------------------------------------------
                $("#myCanvas").click(function (e) {

                    md_x = e.clientX;
                    md_y = e.clientY;

                    for (var i = arr.length - 1; i >= 0; i--) {

                        if (md_x > arr[i].x && md_x < arr[i].x + arr[i].w && md_y > arr[i].y && md_y < arr[i].y + arr[i].h) {
//                            console.log(arr[i].src);
                            break;
                        }

                    }
                    reDraw();
                });

            });
            function reDraw() {
                ctx.clearRect(0, 0, c_w, c_h);

                $(arr).each(function () {
                    var img_data = this;
                    console.log(img_data.src + " " + img_data.x + " " + img_data.y + " " + img_data.w + " " + img_data.h);
                    var img = new Image();
                    img.onload = function () {
                        ctx.drawImage(img, img_data.x, img_data.y, img_data.w, img_data.h);
                    };
                    img.src = img_data.src;
                });
            }
        </script>
    </head>
    <body onload="">

        <canvas id="myCanvas" height="630" width="1200"></canvas>

        <hr>
        <input type="text"  value="">
        <button onclick="">T</button>
        <img src="../image/BG01.jpeg">
    </body>
</html>