<?php ?>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            var ctx;
            var canvas;
            var img;
            var c_x, c_y, c_w, c_h;
            $(window).load(function () {

                img = new Image();
                img.onload = function () {
                    ctx.drawImage(img, 0, 0, 300, 151);
                };
                img.src = "../image/imageM2.php";
                canvas = document.getElementById("myCanvas");
                ctx = canvas.getContext("2d");

                c_x = $('#myCanvas').offset().left;
                c_y = $('#myCanvas').offset().top;
                c_w = $('#myCanvas').width();
                c_h = $('#myCanvas').height();

//                $('button').html(c_x + " " + c_y + " " + c_w + " " + c_h);

                $('#myCanvas').mousedown(function (e) {
                    c_md(e);
                });
                $('#myCanvas').mousemove(function (e) {
                    c_mm(e);
                });
                $('#myCanvas').mouseup(function (e) {
                    c_mu(e);
                });
                $('#myCanvas').mouseout(function (e) {
                    c_mo(e);
                });
                $('#myCanvas').on('ondrag', function (e) {
//                    e.clientX;
                    $('button').html(e.clientX + " " + e.clientY);
                });
            });

            //-----------------------
            var isD;
            var m_x, m_y;
            var md_x, md_y;

            //-----------------------
            function c_md(e) {
                md_x = e.clientX;
                md_y = e.clientY;
                isD = true;
//                $('button').html(e.clientX + " " + e.clientY);
            }
            function c_mm(e) {
                m_x = e.clientX;
                m_y = e.clientY;
//                $('button').html(m_x + " " + m_y + ' ' + md_x + " " + md_y);
                if (isD) {
                    //c_x, c_y, c_w, c_h;
                    ctx.clearRect(0, 0, c_w, c_h);
                    ctx.drawImage(img, m_x - c_x - 150, m_y - c_y - 75, 300, 151);


                }
            }
            function  c_mu(e) {
                isD = false;
            }
            function c_mo(e) {
                isD = false;
            }
        </script>
        <style>
            #myCanvas{
                /*                width: 100%;
                                height: 500px;*/
            }
        </style>
    </head>
    <body onload="">

        <canvas id="myCanvas" height="630" width="1200"></canvas>

        <hr>
        <input type="text"  value="../image/bg00.png">
        <button onclick="">T</button>

    </body>
</html>