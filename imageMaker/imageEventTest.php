<?php ?>

<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>

            $(function () {
                var c = document.getElementById('c')
                var ctx = c.getContext('2d');

                var img = new Image();
                img.crossOrigin='*';
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                    c.toDataURL("image/jpeg");
//                   ctx.getImageData(10,10,50,50);
                };
                img.src="http://graph.facebook.com/100002081915136/picture?width=300&height=300";
//                img.src = "../image/BG01.jpeg";
    
            });
        </script>
    </head>
    <body>
        <img id="t_img_1" src="http://graph.facebook.com/100002081915136/picture?width=300&height=300">
        <img id="t_img_2" src="../image/BG01.jpeg">
        <hr>
        <canvas id="c" width="800" height="600">

        </canvas>
        <button>A</button>
    </body>
</html>